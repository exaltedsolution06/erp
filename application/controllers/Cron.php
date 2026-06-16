<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cron extends CI_Controller
{

    protected $cron_key;

    /**
     * This is default constructor of the class
     */
    public function __construct($key = "")
    {
        parent::__construct();
		$this->load->model('setting_model');
        $setting_result = $this->setting_model->getSetting();
        $this->cron_key = $setting_result->cron_secret_key;
        $this->load->model('feereminder_model');
        $this->load->model('classsection_model');
        $this->load->model('section_model');
        $this->load->model('schoolhouse_model');
        $this->load->model('feegroup_model');
        $this->load->model('subject_model');
        $this->load->model('subjectgroup_model');
        $this->load->model('department_model');
        $this->load->model('designation_model');
        $this->load->model('examgroup_model');
		$this->load->library('mailsmsconf');
		$this->current_session = $this->setting_model->getCurrentSession();
		$this->current_active_session = $this->setting_model->getCurrentActiveSession();
		$this->sch_setting_detail = $this->setting_model->getSetting();
		
		$this->balance_group   = $this->config->item('ci_balance_group');
        $this->balance_type    = $this->config->item('ci_balance_type');
		$this->load->model('fee_discount_model');
		$this->load->model('Receipt_model');
    }
	
	
	public function index($key = '')
    {
        if ($key != "" && $this->cron_key == $key) {

            $this->autobackup($key);
            $this->feereminder($key);
            $this->changeSessions($key);
        } else {
            echo "Invalid Key or Direct access is not allowed";
            return;
        }
    }

    public function autobackup($key = '')
    {
        if ($key != "") {
            if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }

            $this->load->dbutil();
            $filename = "db-" . date("Y-m-d_H-i-s") . ".sql";
            $prefs    = array(
                'ignore'     => array(),
                'format'     => 'txt',
                'filename'   => 'mybackup.sql',
                'add_drop'   => true,
                'add_insert' => true,
                'newline'    => "\n",
            );
            $backup = $this->dbutil->backup($prefs);
            $this->load->helper('file');
            write_file('./backup/database_backup/' . $filename, $backup);
        }
    }

    public function feereminder($key = "")
    {
        $setting_result = $this->setting_model->getSetting();
        if ($key != "") {
            if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }
            $this->load->library('mailsmsconf');
            $feereminder   = $this->feereminder_model->get(null, 1);
            $reminter_type = array();
            $studentList   = array();

            if (!empty($feereminder)) {
                foreach ($feereminder as $feereminder_key => $feereminder_value) {
                    if ($feereminder_value->reminder_type == "before") {
                        $date               = date('Y-m-d', strtotime('+' . $feereminder_value->day . ' days'));
                        $fees_type_reminder = $this->feegrouptype_model->getFeeTypeDueDateReminder($date);

                        if (!empty($fees_type_reminder)) {
                            foreach ($fees_type_reminder as $reminder_key => $reminder_value) {

                                $students = $this->feegrouptype_model->getFeeTypeStudents($reminder_value->fee_session_group_id, $reminder_value->id);

                                foreach ($students as $student_key => $student_value) {
                                    $students[$student_key]->{'due_date'}       = $date;
                                    $students[$student_key]->{'fee_type'}       = $reminder_value->type;
                                    $students[$student_key]->{'fee_code'}       = $reminder_value->code;
                                    $students[$student_key]->{'fee_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'due_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($student_value->amount_detail);
                                    if (json_last_error() == JSON_ERROR_NONE) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {
                                            $deposit_amount = $deposit_amount + $fee_collected_value->amount;
                                        };
                                        $students[$student_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $students[$student_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };
                                    $students[$student_key]->{'student_name'} = $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $studentList[]                            = $student_value;
                                }
                            }
                        }

                    } else if ($feereminder_value->reminder_type == "after") {
                        $date               = date('Y-m-d', strtotime('-' . $feereminder_value->day . ' days'));
                        $fees_type_reminder = $this->feegrouptype_model->getFeeTypeDueDateReminder($date);
                        if (!empty($fees_type_reminder)) {
                            foreach ($fees_type_reminder as $reminder_key => $reminder_value) {

                                $students = $this->feegrouptype_model->getFeeTypeStudents($reminder_value->fee_session_group_id, $reminder_value->id);

                                foreach ($students as $student_key => $student_value) {
                                    $students[$student_key]->{'due_date'}       = $date;
                                    $students[$student_key]->{'fee_type'}       = $reminder_value->type;
                                    $students[$student_key]->{'fee_code'}       = $reminder_value->code;
                                    $students[$student_key]->{'fee_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'due_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($student_value->amount_detail);
                                    if (json_last_error() == JSON_ERROR_NONE) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {
                                            $deposit_amount = $deposit_amount + $fee_collected_value->amount;
                                        };
                                        $students[$student_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $students[$student_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };

                                    $students[$student_key]->{'student_name'} = $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $studentList[]                            = $student_value;
                                }
                            }
                        }
                    }
                }

                if (!empty($studentList)) {
                    foreach ($studentList as $eachStudent_key => $eachStudent_value) {
                        if ($eachStudent_value->due_amount <= 0) {
                            unset($studentList[$eachStudent_key]);
                        }
                    }
                }
                if (!empty($studentList)) {
                    foreach ($studentList as $eachStudent_key => $eachStudent_value) {

                        $this->mailsmsconf->mailsms('fees_reminder', $eachStudent_value);
                    }
                }
            }
        }
    }
	
	public function changeSessions($key = "")
	{
		
		// If called from browser
		if (!is_cli()) {
			$key = $this->input->get('key');
		}

        if ($key !== $this->cron_key) {
            exit('Invalid Key or Direct access is not allowe');
        }		
		
		$this->db->select('move_students.batch_id');
		$this->db->from('move_students');
		$this->db->where('move_students.status', 1);
		$this->db->group_by('batch_id');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		
		foreach($query->result_array() as $result){
			
			$this->db->from('move_students');
			$this->db->join('classes', 'classes.id = move_students.next_class_id');
			$this->db->where('move_students.batch_id', $result['batch_id']);
			$this->db->where('move_students.status', 1);
			// $qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
			$qr = $this->db->get();
			$classData = $qr->result_array();
			//echo "<pre>";print_r($classData);die;
			foreach($qr->result_array() as $val){
				$sectionArr = [];
				$new_section_array = [];
				$new_class_array = [];
				$new_house_array = [];
				$new_fee_category_array = [];
				$new_route_array = [];
				
				//echo "<pre>";print_r($val);die;
				$classes = $val;
				$this->insert_opening_balance($classes);
				// Create section start
					$this->db->select('sections.*')->from('sections');
					$this->db->where('session_id', $classes['current_session_id']);
					// $this->db->join('sections', 'sections.id = class_sections.section_id');
					// $this->db->where('class_sections.class_id', $classes['current_class_id']);
					$qr = $this->db->get();
					$sectionData = $qr->result_array();
					foreach($sectionData as $sec)
					{
						$this->db->where('section', $sec['section']);
						$this->db->where('session_id', $classes['next_session_id']);
						$sec_query = $this->db->get('sections');
						if($sec_query->num_rows() > 0){
							$sec_query = $sec_query->row_array();
							$sectionArr[] = $sec_query['id'];
							$new_section_array[] = array($sec['id'] => $sec_query['id']);
						}else{
							$data = array(
								'section' => $sec['section'],
								'session_id' => $classes['next_session_id'],
							);
							$section_id = $this->section_model->add($data);
							$sectionArr[] = $section_id;
							$new_section_array[] = array($sec['id'] => $section_id);
						}
					}
					// echo '<pre>'; print_r($new_section_array); exit;
				// Create section end
				
				// Create class start
					$this->db->from('classes');
					$this->db->where('session_id',  $classes['current_session_id']);
					// $this->db->where('class', $classes['class']);
					$qr = $this->db->get();
					$classData = $qr->result_array();
					foreach($classData as $clas){
						$this->db->where('session_id',  $classes['next_session_id']);
						$this->db->where('class', $clas['class']);
						$class_query = $this->db->get('classes');
						if($class_query->num_rows() > 0){
							$class_query = $class_query->row_array();
							$class_id = $class_query['id'];
						}else{
							$class_array = array(
								'class' => $clas['class'],
								'session_id' => $classes['next_session_id'],
							);
							
							$this->db->where('class_id',  $clas['id']);
							$csec_query = $this->db->get('class_sections');
							$csec_query = $csec_query->result_array();
							$sectionArr = [];
							foreach ($csec_query as $csec_val) {
								foreach ($new_section_array as $map) {
									if (isset($map[$csec_val['section_id']])) {
										$sectionArr[] = $map[$csec_val['section_id']];
									}
								}
							}
							
							$class_id = $this->classsection_model->add($class_array, $sectionArr);
						}
						$new_class_array[] = array($clas['id'] => $class_id);
					}
					// echo '<pre>'; print_r($new_class_array); exit;
				// Create class end	
				
				// create student house start
					$new_house_array = $this->house_create($classes['current_class_id'], $classes['current_session_id'], $classes['next_session_id']);
					// echo "<pre>";print_r($new_house_array);die;
				// create student house end
				
				// create fee_category_by_move_category start
					$fee_category_by_move_category = $this->fee_category_by_move_category($classes['current_session_id'], $result['batch_id']);
					// echo "<pre>";print_r($fee_category_by_move_category);die;
				// create fee_category_by_move_category end
				
				// create fee category start
					$new_fee_category_array = $this->fee_category_create($classes['next_session_id'], $classes['current_session_id']);
					// echo "<pre>";print_r($new_fee_category_array);die;
				// create fee category end
				
				$storeArr['next_session_id'] = $classes['next_session_id'];
				$storeArr['current_session_id'] = $classes['current_session_id'];
				
				$new_fee_head_create = $this->fee_head_create($storeArr); //create fee head		
				$new_account_create = $this->account_create($storeArr); //create account
				
				// create 'fee_plan' start
					//$new_fee_plan_array = $this->fee_plan_create($classes['next_session_id'], $classes['next_class_id'], $fee_category_by_move_category, $new_fee_category_array, $new_class_array);
					$new_fee_plan_array = $this->fee_plan_create($storeArr);
				// create 'fee_plan' end
				
				// create 'route_head' start
					$new_route_array = $this->route_create($classes['next_session_id'], $classes['current_session_id']);
					// echo "<pre>";print_r($new_route_array);die;
				// create 'route_head' end
				
				// create 'route_plan' start
					//$new_route_plan_array = $this->route_plan_create($classes['next_session_id'], $classes['next_class_id'], $fee_category_by_move_category, $new_fee_category_array, $new_class_array, $new_route_array);
					$new_route_plan_array = $this->route_plan_create($storeArr);
				// create 'route_plan' end
				
				$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
				
				$move = $this->student_move($classes, $new_class_array, $new_section_array, $new_house_array, $new_fee_category_array, $new_route_array, $fee_category_by_move_category);
				// echo "<pre>";print_r($new_section_array);die;
				
				$this->create_terms($classes);
				$this->create_department($classes);
				$this->create_designation($classes);
				$this->create_disable_reason($classes);
				$this->create_staff($classes);
				
				$this->insert_opening_balance($classes);
			}
			
			$this->db->where('batch_id', $result['batch_id']);
            $this->db->update('move_students', ['status' => 2]);
			
			$this->db->where('batch_id', $result['batch_id']);
            $this->db->update('move_students_category', ['status' => 2]);
		}
		//$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
		
			
	}
	
	public function house_create($current_class_id, $current_session_id, $next_session_id)
    {
		$new_house_array = [];
		$this->db->from('student_session');
		$this->db->join('school_houses', 'school_houses.id = student_session.school_house_id');
		$this->db->where('student_session.class_id', $current_class_id);
		$this->db->where('student_session.session_id', $current_session_id);
		$this->db->where_not_in('student_session.school_house_id', [0]);
		$this->db->group_by('student_session.school_house_id');
		$qr = $this->db->get();
		$qrhouseData = $qr->result_array();
		// echo "<pre>";print_r($qrhouseData);die;
		foreach($qrhouseData as $qrhouseDataVal){
			$this->db->where('house_name', $qrhouseDataVal['house_name']);
			$house_exists_query = $this->db->where('session_id', $next_session_id)->get('school_houses');
			if($house_exists_query->num_rows() > 0){
				$house_query = $house_exists_query->row_array();
				$school_house_id = $house_query['id'];
			}else{
				$data = array(
					'house_name' => $qrhouseDataVal['house_name'],
					'is_active' => 'yes',
					'description' => '',
					'session_id' => $next_session_id
				);
				$school_house_id = $this->schoolhouse_model->add($data);
			}
			$new_house_array[] = array($qrhouseDataVal['id'] => $school_house_id);
		}
		return $new_house_array;
	}
	
	public function fee_category_by_move_category($current_session_id, $batch_id)
	{
		/**
		 * Step 1: Get existing move mappings
		 */
		$this->db->from('move_students_category');
		$this->db->join(
			'fee_groups',
			'fee_groups.id = move_students_category.next_category_id',
			'inner'
		);
		$this->db->where('fee_groups.session_id', $current_session_id);
		$this->db->where('move_students_category.batch_id', $batch_id);
		$this->db->where('move_students_category.status', 1);

		$moveData = $this->db->get()->result_array();

		/**
		 * Step 2: Get all categories of session
		 */
		$this->db->from('fee_groups');
		$this->db->where('session_id', $current_session_id);
		$this->db->where('is_system', 0);
		$allCategories = $this->db->get()->result_array();

		if (empty($allCategories)) {
			return $moveData;
		}

		/**
		 * Step 3: Find categories already acting as CURRENT
		 */
		$existingCurrentIds = array_column($moveData, 'current_category_id');

		/**
		 * Step 4: Add missing self-mappings
		 */
		foreach ($allCategories as $cat) {

			if (in_array($cat['id'], $existingCurrentIds)) {
				continue; // already mapped
			}

			$moveData[] = [
				'id' => $cat['id'],
				'batch_id' => $batch_id,
				'current_session_id' => $current_session_id,
				'current_category_id' => $cat['id'],
				'next_category_id' => $cat['id'],
				'status' => 1,

				'session_id' => $cat['session_id'],
				'name' => $cat['name'],
				'is_system' => $cat['is_system'],
				'description' => $cat['description'],
				'is_active' => $cat['is_active'],
				'created_at' => $cat['created_at'],
			];
		}

		/**
		 * Optional: sort by category id (clean output)
		 */
		usort($moveData, function ($a, $b) {
			return $a['current_category_id'] <=> $b['current_category_id'];
		});

		return $moveData;
	}

	public function fee_category_create($next_session_id, $current_session_id)
    {
		$new_fee_category_array = [];
		$this->db->from('fee_groups');
		$this->db->where('session_id', $current_session_id);
		$this->db->where('is_system', 0);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
		
		foreach($qrArrayData as $qrArrayDataVal){
			$this->db->where('name', $qrArrayDataVal['name']);
			$value_exists_query = $this->db->where('session_id', $next_session_id)->get('fee_groups');
			if($value_exists_query->num_rows() > 0){
				$value_query = $value_exists_query->row_array();
				$value_id = $value_query['id'];
			}else{
				$data = array(
					'session_id' => $next_session_id,
					'name' => $qrArrayDataVal['name'],
					'is_system' => $qrArrayDataVal['is_system'],
					'description' => '',
					'is_active' => $qrArrayDataVal['is_active'],
				);
				$value_id = $this->feegroup_model->add($data);
			}
			$new_fee_category_array[] = array($qrArrayDataVal['id'] => $value_id);
		}
		return $new_fee_category_array;
	}
	
	public function fee_head_create($data)
    {
		$current_session_id = $data['current_session_id'];
		$next_session_id 	= $data['next_session_id'];
		
		$this->db->from('fee_head');
		$this->db->where('session_id', $current_session_id);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$fee_head_array = $qr->result_array();
			foreach($fee_head_array as $fee_head){
				$this->db->from('fee_head');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('fees_heading', $fee_head['fees_heading']);
				$qr = $this->db->get();
				if($qr->num_rows() == 0){
					$arr = [
						'fees_heading' => $fee_head['fees_heading'],
						'frequency' => $fee_head['frequency'],
						'account_name' => $fee_head['account_name'],
						'months' => $fee_head['months'],
						'session_id' => $next_session_id,
					];
					$this->db->insert('fee_head', $arr);
				}
			}
		}
	}
	public function account_create($data)
    {
		$current_session_id = $data['current_session_id'];
		$next_session_id 	= $data['next_session_id'];
		
		$this->db->from('account');
		$this->db->where('session_id', $current_session_id);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$account_array = $qr->result_array();
			foreach($account_array as $account){
				$this->db->from('account');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('account', $account['account']);
				$qr = $this->db->get();
				if($qr->num_rows() == 0){
					$arr = [
						'account' => $account['account'],
						'session_id' => $next_session_id,
					];
					$this->db->insert('account', $arr);
				}
			}
		}
	}
	public function new_fee_head_id($data) {
		$this->db->from('fee_head');
		$this->db->where('id', $data['fee_group_id']);
		$this->db->where('session_id', $data['current_session_id']);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$qrfeeHeadData = $qr->row_array();
			$fees_heading = $qrfeeHeadData['fees_heading'];
			
			$this->db->from('fee_head');
			$this->db->where('session_id', $data['next_session_id']);
			$this->db->where('fees_heading', $fees_heading);
			$qr = $this->db->get();
			$fee_group_id = '';
			if($qr->num_rows() > 0){
				$fee_head_query = $qr->row_array();
				$fee_group_id = $fee_head_query['id'];
			}
		}
		return $fee_group_id;
	}
	public function new_route_head_id_f($data) {
		$this->db->from('route_head');
		$this->db->where('id', $data['fee_group_id']);
		$this->db->where('session_id', $data['current_session_id']);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$qrfeeHeadData = $qr->row_array();
			$fees_heading = $qrfeeHeadData['fees_heading'];
			
			$this->db->from('route_head');
			$this->db->where('session_id', $data['next_session_id']);
			$this->db->where('fees_heading', $fees_heading);
			$qr = $this->db->get();
			$fee_group_id = '';
			if($qr->num_rows() > 0){
				$fee_head_query = $qr->row_array();
				$fee_group_id = $fee_head_query['id'];
			}
		}
		return $fee_group_id;
	}
	public function new_class_id($data) {	
		$classArr = json_decode($data['class_ids']);
		$return = [];
		foreach($classArr as $classId){
			//echo $class.'<br/>';
			$this->db->from('classes');
			$this->db->where('id', $classId);
			$this->db->where('session_id', $data['current_session_id']);
			$qr = $this->db->get();
			if($qr->num_rows() > 0){
				$qrData = $qr->row_array();
				$class = $qrData['class'];
				
				$this->db->from('classes');
				$this->db->where('session_id', $data['next_session_id']);
				$this->db->where('class', $class);
				$qr = $this->db->get();
				
				$class_id = '';
				if($qr->num_rows() > 0){
					$arr = $qr->row_array();
					$class_id = $arr['id'];
					$return[] = $class_id;
				}
			}
		}
		return json_encode($return);
	}
	public function new_fee_category_id($data) {	
		$feeCategoryArr = json_decode($data['category_ids']);
		$return = [];
		foreach($feeCategoryArr as $categoryId){
			//echo $categoryId.'<br/>';
			$this->db->from('fee_groups');
			$this->db->where('id', $categoryId);
			$this->db->where('session_id', $data['current_session_id']);
			$qr = $this->db->get();
			if($qr->num_rows() > 0){
				$qrData = $qr->row_array();
				$name = $qrData['name'];
				
				$this->db->from('fee_groups');
				$this->db->where('session_id', $data['next_session_id']);
				$this->db->where('name', $name);
				$qr = $this->db->get();
				
				$category_id = '';
				if($qr->num_rows() > 0){
					$arr = $qr->row_array();
					$category_id = $arr['id'];
					$return[] = $category_id;
				}
			}
		}
		return json_encode($return);
	}
	public function fee_plan_create($data)
    {
		//** fees_plan table fee_group_id = fee_head table id
		//** fees_plan table category_ids = fee_groups table id
		//** fees_plan table class_ids 	= classes table id
		
		$current_session_id = $data['current_session_id'];
		$next_session_id 	= $data['next_session_id'];
		
		$this->db->from('fees_plan');
		$this->db->where('session_id', $current_session_id);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$fees_plan_array = $qr->result_array();
			foreach($fees_plan_array as $fees_plan){
				$this->db->from('fees_plan');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('fee_group_id', $fees_plan['fee_group_id']);
				$this->db->where('category_ids', $fees_plan['category_ids']);
				$this->db->where('class_ids', $fees_plan['class_ids']);
				$qr = $this->db->get();
				if($qr->num_rows() == 0){
					$arrData['current_session_id'] 	= $current_session_id;
					$arrData['next_session_id'] 	= $next_session_id;
					$arrData['fee_group_id'] 		= $fees_plan['fee_group_id'];
					$fee_group_id 	= $this->new_fee_head_id($arrData);
					$arrData['class_ids'] 			= $fees_plan['class_ids'];
					$class_ids 		= $this->new_class_id($arrData);
					$arrData['category_ids'] 		= $fees_plan['category_ids'];
					$category_ids 		= $this->new_fee_category_id($arrData);
					
					$arr = [
						'fee_group_id' 	=> $fee_group_id,
						'class_ids' 	=> $class_ids,
						'category_ids' 	=> $category_ids,
						'amount' 		=> $fees_plan['amount'],
						'session_id' 	=> $next_session_id,
					];
					$this->db->insert('fees_plan', $arr);
				}
			}
		}
	}
	/*public function fee_plan_create($next_session_id, $next_class_id, $qrArrayData, $new_fee_category_array, $new_class_array)
    {
		//** fees_plan table fee_group_id = fee_head table id
		//** fees_plan table category_ids = fee_groups table id
		//** fees_plan table class_ids 	= classes table id
		
		// return $qrArrayData;
		foreach($qrArrayData as $qrArrayDataVal){
			$this->db->from('fees_plan');
			$this->db->where("JSON_CONTAINS(class_ids, '\"$next_class_id\"')", NULL, FALSE);
			$this->db->where("JSON_CONTAINS(category_ids, '\"" . $qrArrayDataVal['next_category_id'] . "\"')", NULL, FALSE);
			$qr = $this->db->get();
			$feePlanData = $qr->result_array();
			
			foreach($feePlanData as $feePlanDataVal){
				$this->db->from('fee_head');
				$this->db->where('id', $feePlanDataVal['fee_group_id']);
				$qr = $this->db->get();
				$qrfeeHeadData = $qr->row_array();
				
				// 'fee_head' table add/update start
				$this->db->from('fee_head');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('fees_heading', $qrfeeHeadData['fees_heading']);
				$qr = $this->db->get();
				if($qr->num_rows() > 0){
					$fee_head_query = $qr->row_array();
					$new_fee_head_id = $fee_head_query['id'];
				}else{
					$data = [
						'fees_heading' => $qrfeeHeadData['fees_heading'],
						'frequency' => $qrfeeHeadData['frequency'],
						'account_name' => $qrfeeHeadData['account_name'],
						'months' => $qrfeeHeadData['months'],
						'session_id' => $next_session_id,
					];
					$this->db->insert('fee_head', $data);					
					$new_fee_head_id = $this->db->insert_id(); // Get inserted ID
				}
				// 'fee_head' table add/update start
				
				// 'account' table add/update start
				$this->db->from('account');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('account', $qrfeeHeadData['account_name']);
				$qr = $this->db->get();
				if($qr->num_rows() > 0){
					$account_query = $qr->row_array();
					$new_account_id = $account_query['id'];
				}else{
					$data = [
						'account' => $qrfeeHeadData['account_name'],
						'session_id' => $next_session_id,
					];
					$this->db->insert('account', $data);					
					$new_account_id = $this->db->insert_id(); // Get inserted ID
				}
				// 'account' table add/update start
				
				// 'fees_plan' table add/update start
				$new_fee_category_array_val = current(array_filter($new_fee_category_array, fn($a) => isset($a[$qrArrayDataVal['next_category_id']])))[$qrArrayDataVal['next_category_id']] ?? null;
				$this->db->from('fees_plan');
				$this->db->where("fee_group_id", $new_fee_head_id); // 23
				$this->db->where("JSON_CONTAINS(class_ids, '\"" . current($new_class_array[0]) . "\"')", NULL, FALSE); // 98
				$this->db->where("JSON_CONTAINS(category_ids, '\"" . $new_fee_category_array_val . "\"')", NULL, FALSE); // 178
				$qr = $this->db->get();
				if($qr->num_rows() > 0){
					$fees_plan_query = $qr->row_array();
					
					$data_insert = [
						'category_ids' => $this->add_unique_json_value($fees_plan_query['category_ids'], $new_fee_category_array_val),
						'session_id' => $next_session_id,
					];
					$this->db->where('id', $fees_plan_query['id']);
					$this->db->update('fees_plan', $data_insert);
				}else{
					$data_insert = [
						'fee_group_id' => $new_fee_head_id,
						'amount'       => $feePlanDataVal['amount'],
						'class_ids'    => json_encode(array((string)current($new_class_array[0]))),
						'category_ids' => json_encode(array((string)$new_fee_category_array_val)),
						'session_id' => $next_session_id,
					];
					$this->db->insert('fees_plan', $data_insert);
				}
				// 'fees_plan' table add/update end
				
			}
			// return $feePlanData;
		}
	}*/
	
	public function route_create($next_session_id, $current_session_id)
    {
		$new_route_array = [];
		$this->db->from('route_head');
		$this->db->where('session_id', $current_session_id);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
		
		foreach($qrArrayData as $qrArrayDataVal){
			$this->db->where('fees_heading', $qrArrayDataVal['fees_heading']);
			$value_exists_query = $this->db->where('session_id', $next_session_id)->get('route_head');
			if($value_exists_query->num_rows() > 0){
				$value_query = $value_exists_query->row_array();
				$new_route_head_id = $value_query['id'];
			}else{
				$data = [
					'fees_heading' => $qrArrayDataVal['fees_heading'],
					'frequency'    => $qrArrayDataVal['frequency'],
					'account_name' => $qrArrayDataVal['account_name'],
					'months'       => $qrArrayDataVal['months'],
					'session_id' => $next_session_id,
				];
				$this->db->insert('route_head', $data);
				$new_route_head_id = $this->db->insert_id(); // Get inserted ID
			}
			$new_route_array[] = array($qrArrayDataVal['id'] => $new_route_head_id);
			
			// 'account' table add/update start
			/*$this->db->from('account');
			$this->db->where('session_id', $next_session_id);
			$this->db->where('account', $qrArrayDataVal['account_name']);
			$qr = $this->db->get();
			if($qr->num_rows() > 0){
				$account_query = $qr->row_array();
				$new_account_id = $account_query['id'];
			}else{
				$data = [
					'account' => $qrArrayDataVal['account_name'],
					'session_id' => $next_session_id,
				];
				$this->db->insert('account', $data);
				$new_account_id = $this->db->insert_id(); // Get inserted ID
			}*/
			// 'account' table add/update start
			
			// 'vehicle_routes' table add/update start
			$this->db->from('vehicle_routes');
			$this->db->where('route_id', $qrArrayDataVal['id']);
			$qr = $this->db->get();
			foreach($qr->result_array() as $vhRoutesDataVal){
				$this->db->from('vehicles');
				$this->db->where('id', $vhRoutesDataVal['vehicle_id']);
				$vh = $this->db->get();
				$get_vh = $vh->row_array();
				
				$this->db->from('vehicles');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('vehicle_no', $get_vh['vehicle_no']);
				$new_vh = $this->db->get();
				$new_vh_id = '';
				if($new_vh->num_rows() > 0){
					$new_vh_query = $new_vh->row_array();
					$new_vh_id = $new_vh_query['id'];
				}else{
					if(!empty($get_vh)){
						$data = array(
							'session_id' => $next_session_id,
							'vehicle_no' => $get_vh['vehicle_no'],
							'vehicle_model' => $get_vh['vehicle_model'],
							'driver_name' => $get_vh['driver_name'],
							'driver_licence' => $get_vh['driver_licence'],
							'driver_contact' => $get_vh['driver_contact'],
							'note' => $get_vh['note'],
						);
						$new_vh_id = $this->vehicle_model->add($data);
					}
				}
				
				// new_route_head_id
				if($new_vh_id != ''){
					$this->db->from('vehicle_routes');
					$this->db->where('session_id', $next_session_id);
					$this->db->where('route_id', $new_route_head_id);
					$this->db->where('vehicle_id', $new_vh_id);
					$qr1 = $this->db->get();
					if($qr1->num_rows() == 0){
						$data = array(
							'session_id' => $next_session_id,
							'route_id' => $new_route_head_id,
							'vehicle_id' => $new_vh_id,
						);
						$this->db->insert('vehicle_routes', $data);
					}
				}
			}
			// 'vehicle_routes' table add/update start
		}
		return $new_route_array;
	}
	
	public function route_plan_create($data)
    {
		//** route_plan table fee_group_id = fee_head table id
		//** route_plan table category_ids = fee_groups table id
		//** route_plan table class_ids 	= classes table id
		
		$current_session_id = $data['current_session_id'];
		$next_session_id 	= $data['next_session_id'];
		
		$this->db->from('route_plan');
		$this->db->where('session_id', $current_session_id);
		$qr = $this->db->get();
		if($qr->num_rows() > 0){
			$route_plan_array = $qr->result_array();
			foreach($route_plan_array as $route_plan){
				$this->db->from('route_plan');
				$this->db->where('session_id', $next_session_id);
				$this->db->where('fee_group_id', $route_plan['fee_group_id']);
				$this->db->where('category_ids', $route_plan['category_ids']);
				$this->db->where('class_ids', $route_plan['class_ids']);
				$qr = $this->db->get();
				if($qr->num_rows() == 0){
					$arrData['current_session_id'] 	= $current_session_id;
					$arrData['next_session_id'] 	= $next_session_id;
					$arrData['fee_group_id'] 		= $route_plan['fee_group_id'];
					$fee_group_id 	= $this->new_route_head_id_f($arrData);
					// print_r($fee_group_id);exit;
					$arrData['class_ids'] 			= $route_plan['class_ids'];
					$class_ids 		= $this->new_class_id($arrData);
					$arrData['category_ids'] 		= $route_plan['category_ids'];
					$category_ids 		= $this->new_fee_category_id($arrData);
					
					$arr = [
						'fee_group_id' 	=> $fee_group_id,
						'class_ids' 	=> $class_ids,
						'category_ids' 	=> $category_ids,
						'amount' 		=> $route_plan['amount'],
						'session_id' 	=> $next_session_id,
					];
					$this->db->insert('route_plan', $arr);
				}
			}
		}
	}
	/*public function route_plan_create($next_session_id, $next_class_id, $qrArrayData, $new_fee_category_array, $new_class_array, $new_route_array)
    {
		foreach($qrArrayData as $qrArrayDataVal){
			$this->db->from('route_plan');
			$this->db->where("JSON_CONTAINS(class_ids, '\"$next_class_id\"')", NULL, FALSE);
			$this->db->where("JSON_CONTAINS(category_ids, '\"" . $qrArrayDataVal['next_category_id'] . "\"')", NULL, FALSE);
			$qr = $this->db->get();
			$routePlanData = $qr->result_array();
			
			foreach($routePlanData as $routePlanDataVal){
				// 'route_plan' table add/update start
				$new_route_head_id = current(array_filter($new_route_array, fn($a) => isset($a[$routePlanDataVal['fee_group_id']])))[$routePlanDataVal['fee_group_id']] ?? null;
				
				$new_route_category_array_val = current(array_filter($new_fee_category_array, fn($a) => isset($a[$qrArrayDataVal['next_category_id']])))[$qrArrayDataVal['next_category_id']] ?? null;
				$this->db->from('route_plan');
				$this->db->where("fee_group_id", $new_route_head_id); // 23
				$this->db->where("JSON_CONTAINS(class_ids, '\"" . current($new_class_array[0]) . "\"')", NULL, FALSE); // 98
				$this->db->where("JSON_CONTAINS(category_ids, '\"" . $new_route_category_array_val . "\"')", NULL, FALSE); // 178
				$qr = $this->db->get();
				if($qr->num_rows() > 0){
					$route_plan_query = $qr->row_array();
					
					$data_insert = [
						'category_ids' => $this->add_unique_json_value($route_plan_query['category_ids'], $new_route_category_array_val),
						'session_id' => $next_session_id,
					];
					$this->db->where('id', $route_plan_query['id']);
					$this->db->update('route_plan', $data_insert);
				}else{
					$data_insert = [
						'fee_group_id' => $new_route_head_id,
						'amount'       => $routePlanDataVal['amount'],
						'class_ids'    => json_encode(array((string)current($new_class_array[0]))),
						'category_ids' => json_encode(array((string)$new_route_category_array_val)),
						'session_id' => $next_session_id,
					];
					$this->db->insert('route_plan', $data_insert);
				}
				// 'route_plan' table add/update end				
			}
		}
	}*/
	
	function student_move($classes, $new_class_array, $new_section_array, $new_house_array, $new_fee_category_array, $new_route_array, $fee_category_by_move_category){
		$this->db->select('student_session.*')->from('students');
		$this->db->join('student_session', 'student_session.student_id = students.id');
		$this->db->where('student_session.session_id', $classes['current_session_id']);
		$this->db->where('student_session.class_id', $classes['current_class_id']);
		if($classes['discontinue_next_session'] == 0){
			$this->db->where('student_session.is_active', 'yes');
		}
		$qr = $this->db->get();
		
		//fee group related table start
		$fee_group_id     = 0;
		$fee_type_id      = 0;
	
		$this->db->where('name', $this->balance_group);
		$this->db->where('session_id', $classes['current_session_id']);
		$query = $this->db->get('fee_groups');
		if ($query->num_rows() > 0) {
			$fee_group_id = $query->row()->id;
		} else {
			$this->db->insert('fee_groups', array('session_id' => $classes['current_session_id'], 'name' => $this->balance_group, 'is_system' => 1));
			$fee_group_id = $this->db->insert_id();
		}
		
		$this->db->where('type', $this->balance_type);
		$query = $this->db->get('feetype');
		if ($query->num_rows() > 0) {
			$fee_type_id = $query->row()->id;
		} else {
			$this->db->insert('feetype', array('type' => $this->balance_type, 'code' => $this->balance_type, 'is_system' => 1));
			$fee_type_id = $this->db->insert_id();
		}
		
		$setting_result = $this->setting_model->get();
		$fees_due_days = $setting_result[0]['fee_due_days'];
		$due_date = date('Y-m-d', strtotime('+' . $fees_due_days . ' day'));
		$to_be_insert = array(
			'session_id'           => $classes['current_session_id'],
			'fee_groups_id'        => $fee_group_id,
			'feetype_id'           => $fee_type_id,
			'fee_session_group_id' => 0,
			'due_date'             => $due_date,
		);	
		$this->db->where('fee_groups_id', $fee_group_id);
		$this->db->where('session_id', $classes['current_session_id']);
		$query = $this->db->get('fee_session_groups');
		if ($query->num_rows() > 0) {
			$fee_session_groups_id = $query->row()->id;
		} else {
			$data = array('fee_groups_id' => $fee_group_id, 'session_id' => $classes['current_session_id']);
			$this->db->insert('fee_session_groups', $data);
			$fee_session_groups_id = $this->db->insert_id();
		}
		
		$parentid = $fee_session_groups_id;
		$to_be_insert['fee_session_group_id'] = $parentid;
		
		$session_group_exists = $this->feesessiongroup_model->checkExists($to_be_insert);
		if (!$session_group_exists) {
			$this->db->insert('fee_groups_feetype', $to_be_insert);
		} else {
			$this->db->where('id', $session_group_exists);
			$this->db->update('fee_groups_feetype', $to_be_insert);
		}
		//fee group related table end
		
		foreach($qr->result_array() as $val){
			$student_id = $val['student_id'];
			// return $val;
			if($classes['carry_zero_balance'] == 1){
				$fees_discount = 0;
			}else{
				$fees_discount = $this->student_fees_balance($val['id'], $classes['current_session_id']);
			}
			
			if($val['fee_category_id'] != 0){
				$next_cat_id = array_column($fee_category_by_move_category, 'next_category_id', 'current_category_id')[$val['fee_category_id']] ?? null;
				$student_new_cat_id  = current(array_filter($new_fee_category_array, fn($a) => isset($a[$next_cat_id])))[$next_cat_id] ?? 0;
			}else{
				$student_new_cat_id = 0;
			}
			// echo $fees_discount;exit;
			$result_class = array_column($new_class_array, $classes['next_class_id']);

			$data_new = array(
				'session_id' => $classes['next_session_id'],
				'student_id' => $student_id,
				// 'class_id' => current($new_class_array[0]),
				'class_id' => $result_class[0],
				'section_id' => $val['section_id'] != 0 ? current(array_filter($new_section_array, fn($a) => isset($a[$val['section_id']])))[$val['section_id']] ?? 0 : 0,
				'route_id' => $val['route_id'] != 0 ? current(array_filter($new_route_array, fn($a) => isset($a[$val['route_id']])))[$val['route_id']] ?? 0 : 0,
				'school_house_id' => $val['school_house_id'] != 0 ? current(array_filter($new_house_array, fn($a) => isset($a[$val['school_house_id']])))[$val['school_house_id']] ?? 0 : 0,
				'fee_category_id' => $student_new_cat_id,
				'transport_fees' => $val['transport_fees'],
				'fees_discount' => 0,
				'previous_session_balance' => $fees_discount,
				'previous_student_session_id' => $val['id'],
				'is_active' => $val['is_active'],
				'disable_at' => $val['disable_at'],
				'dis_reason' => $val['dis_reason'],
				'dis_note' => $val['dis_note'],
				'is_alumni' => $val['is_alumni'],
				'default_login' => $val['default_login'],
			);
			
			$this->student_model->add_student_session($data_new);
			
			$this->db->where('student_session_id', $val['id']);
			$this->db->where('fee_session_group_id', $fee_session_groups_id);
			$query = $this->db->get('student_fees_master');
			if ($query->num_rows() > 0) {
				$to_be_update = array(
					'is_system'           	 => 1,
					'amount' 				 => $fees_discount,
					'previous_session_balance' 				 => $fees_discount,
				);
				$this->db->where('id', $query->row()->id);
				$this->db->update('student_fees_master', $to_be_update);
			}else{
				$to_be_insert = array(
					'is_system'           	 => 1,
					'student_session_id' 	 => $val['id'],
					'fee_session_group_id'   => $fee_session_groups_id,
					'amount' 				 => $fees_discount,
					'previous_session_balance' 				 => $fees_discount,
				);
				$this->db->insert('student_fees_master', $to_be_insert);
			}
		}
	}
	
	function add_unique_json_value($json, $newValue)
	{
		// Decode JSON to PHP array
		$array = json_decode($json, true);

		// Ensure array
		if (!is_array($array)) {
			$array = [];
		}

		// Add new value
		$array[] = (string)$newValue;

		// Remove duplicates
		$array = array_unique($array);

		// Sort ascending (numeric)
		sort($array, SORT_NUMERIC);

		// Return JSON
		return json_encode(array_values($array));
	}

	
	public function subject_create($classes, $sections, $current_session, $next_session)
	{
		$classSectionArr = [];
		foreach ($classes as $key => $classArr) {
			$classSectionArr[$key] = $classArr + ($sections[$key] ?? []);
		}
		// echo "<pre>";print_r($classSectionArr);exit;
		
		$result = [];
		foreach ($classes as $index => $class) {

			$currentClassId = key($class);
			$nextClassId = current($class);

			$currentSectionId = null;
			$nextSectionId = null;

			if (isset($sections[$index])) {
				$currentSectionId = key($sections[$index]);
				$nextSectionId = current($sections[$index]);
			}

			$result[] = [
				'current_class_id'   => $currentClassId,
				'next_class_id'      => $nextClassId,
				'current_section_id' => $currentSectionId,
				'next_section_id'    => $nextSectionId,
			];
		}

		// echo "<pre>";print_r($result);exit;
		
		$new_subject_arr = [];
		
		foreach($result as $val)
		{
			$this->db->where('class_id', $val['current_class_id']);
			$this->db->where('section_id', $val['current_section_id']);
			$qr = $this->db->get('class_sections')->row_array();
			$class_section_id = $qr['id'];
			$chk = $this->db->where('class_section_id', $class_section_id)->get('subject_group_class_sections');
			
			if($chk->num_rows() > 0)
			{
				$this->db->where('class_id', $val['next_class_id']);
				$this->db->where('section_id', $val['next_section_id']);
				$next_id = $this->db->get('class_sections')->row_array();
				$next_class_section_id = $next_id['id'];
			 
				$hasRec = $this->db->where('class_section_id', $next_class_section_id)->get('subject_group_class_sections');
				if($hasRec->num_rows() == 0)
				{
					$data = $chk->row_array();
					$subject_group_id = $data['subject_group_id'];
					
					$this->db->from('subject_group_subjects');
					$this->db->where('subject_group_id', $subject_group_id);
					$qrSub = $this->db->get();
					if($qrSub->num_rows() > 0)
					{
						//echo "<pre>";print_r($qrSub->result_array());
						
						foreach($qrSub->result_array() as $subjects)
						{
							$subject_id = $subjects['subject_id'];
							
							// get subject name in currect session
							$this->db->from('subjects');
							$this->db->where('id', $subject_id);
							$this->db->where('session_id' , $current_session);
							$subject_data = $this->db->get()->row_array();
							
							$subject_name = $subject_data['name']; 
							$subject_code = $subject_data['code']; 
							$subject_type = $subject_data['type']; 
							$subject_type_one = $subject_data['type_one'];
														
							// check subject name in next session
							$this->db->from('subjects');
							$this->db->where('name', $subject_name);
							$this->db->where('code', $subject_code);
							$this->db->where('session_id' , $next_session);
							$qr_subject = $this->db->get();
							if($qr_subject->num_rows() == 0)
							{
								// add subject in next session
								$data = array(
									'name' => $subject_name,
									'code' => $subject_code,
									'type' => $subject_type,
									'type_one' => $subject_type_one,
									'session_id' => $next_session
								);
								
								$new_subject_id = $this->subject_model->add($data);
								$new_subject_arr[$subject_data['id']] = $new_subject_id;
							}
							else{
								$s_id = $qr_subject->row_array();
								$new_subject_arr[$subject_data['id']] = $s_id['id'];
							}
							
						}
						
					}
				}
				
				
				// add subjects in subject group
				// get next class and section names
				// echo "<pre>";print_r($new_subject_arr);exit;
				if(!empty($new_subject_arr))
				{
					// $classData = $this->db->where('id', $val['next_class_id'])->get('classes')->row_array();
					// $next_class_name = $classData['class'];
					
					// $sectionData = $this->db->where('id', $val['next_section_id'])->get('sections')->row_array();
					// $next_section_name = $sectionData['section'];
					
					$next_class_section_ids = [];
					$classSectionData = $this->db->where('class_id', $val['next_class_id'])->get('class_sections')->result_array();
					foreach($classSectionData as $ids)
					{
						$next_class_section_ids[] = $ids['id'];
					}
					// echo "<pre>";print_r($next_class_section_ids);exit;
					
					//insert into tables subject_groups ,subject_group_subjects, subject_group_class_sections
					
					// $subject_group = $new_subject_arr;
					$section_group = $next_class_section_ids;
					
					// Subject_groups table start
					$this->db->from('subject_groups');
					$this->db->where('session_id' , $current_session);
					$s_data = $this->db->get();
					if($s_data->num_rows() > 0)
					{
						foreach($s_data->result_array() as $s_val)
						{
							$this->db->from('subject_groups');
							$this->db->where('name', $s_val['name']);
							$this->db->where('session_id' , $next_session);
							$qr_subject1 = $this->db->get();
							if($qr_subject1->num_rows() == 0)
							{
								// add subject in next session
								$class_array = array(
									'name' => $s_val['name'],
									'description' => $s_val['description'],
									'session_id' => $next_session,
								);
								
								$this->db->insert('subject_groups', $class_array);
								$subject_group_id = $this->db->insert_id();
								$new_subject_group_arr[$s_val['id']] = $subject_group_id;
							}
							else{
								$s_id = $qr_subject1->row_array();
								$new_subject_group_arr[$s_val['id']] = $s_id['id'];
							}
						}
					}
					// echo "<pre>";print_r($new_subject_group_arr);exit;
					// Subject_groups table end
					
					// subject_group_subjects table start
					$old_records = $this->db
						->where('session_id', $current_session)
						->get('subject_group_subjects')
						->result_array();

					$existing = $this->db
						->select('subject_group_id, subject_id')
						->where('session_id', $next_session)
						->get('subject_group_subjects')
						->result_array();

					$existing_combinations = [];

					foreach ($existing as $row) {
						$existing_combinations[$row['subject_group_id'].'_'.$row['subject_id']] = true;
					}

					$insert_data = [];

					foreach ($old_records as $row) {

						if (
							!isset($new_subject_group_arr[$row['subject_group_id']]) ||
							!isset($new_subject_arr[$row['subject_id']])
						) {
							continue;
						}

						$new_group_id   = $new_subject_group_arr[$row['subject_group_id']];
						$new_subject_id = $new_subject_arr[$row['subject_id']];

						$key = $new_group_id . '_' . $new_subject_id;

						// Skip if already exists
						if (isset($existing_combinations[$key])) {
							continue;
						}

						$insert_data[] = [
							'subject_group_id' => $new_group_id,
							'session_id'       => $next_session,
							'subject_id'       => $new_subject_id,
							'created_at'       => date('Y-m-d H:i:s'),
						];

						// Prevent duplicates within the same batch
						$existing_combinations[$key] = true;
					}

					if (!empty($insert_data)) {
						$this->db->insert_batch('subject_group_subjects', $insert_data);
					}
					
					$section_group_array = array();
					foreach ($section_group as $section_group_key => $section_group_value) {

						$sections_array = array(
							'subject_group_id' => $subject_group_id,
							'class_section_id' => $section_group_value,
							'session_id' => $next_session,
						);

						$section_group_array[] = $sections_array;
					}
					$this->db->insert_batch('subject_group_class_sections', $section_group_array);
					
					//$this->subjectgroup_model->add($class_array, $subject_group, $section_group);
				}
				
			} // if end
			
			// echo "<pre>";print_r($new_subject_group_arr);exit;
		}
		
	}
	public function create_disable_reason($classes)
	{
		$query = $this->db->from('disable_reason')->where('session_id', $classes['current_session_id'])->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('disable_reason');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('reason', $val['reason']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array(
					'reason' => $val['reason'],
					'session_id' => $classes['next_session_id'],
				);
				$this->disable_reason_model->add($data);
			}
		}
	}
	public function create_terms($classes)
	{
		$new_term_array = [];
		$query = $this->db->from('exam_groups')->where('session_id', $classes['current_session_id'])->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('exam_groups');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('name', $val['name']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array(
					'name' => $val['name'],
					'exam_type' => $val['exam_type'],
					'is_active' => $val['is_active'],
					'description' => $val['description'],
					'session_id' => $classes['next_session_id']
				);
				$insert_id = $this->examgroup_model->add($data);
				$new_term_array[$val['id']] =  $insert_id;
			}else{
				$term_query = $qr->row_array();
				$new_term_array[$val['id']] = $term_query['id'];
			}
			
			// added assesment
			$this->db->from('exam_group_class_batch_exams');
			$this->db->where('session_id', $classes['current_session_id']);
			$this->db->where('exam_group_id', $val['id']);
			$queryAss = $this->db->get();
			if($queryAss->num_rows() > 0)
			{
				foreach($queryAss->result_array() as $valAss)
				{
					$this->db->from('exam_group_class_batch_exams');
					$this->db->where('session_id', $classes['next_session_id']);
					$this->db->where('exam', $valAss['exam']);
					$this->db->where('exam_group_id', $valAss['exam_group_id']);
					$qr = $this->db->get();
					if($qr->num_rows() == 0)
					{
						$array = array(
							'exam' => $valAss['exam'],
							'session_id' => $classes['next_session_id'],
							'description' => $valAss['exam'],
							'is_publish' => 1,
							'is_active' => 1,
							'exam_group_id' => $valAss['id'],
						);
						$this->db->insert('exam_group_class_batch_exams', $array);
					}
				}
			}
		}
		$this->create_scholastic($classes, $new_term_array);
		
	}
	public function create_scholastic($classes, $new_term_array)
	{
		$query = $this->db->from('coscholasticareas')->where('session_id', $classes['current_session_id'])->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('coscholasticareas');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('name', $val['name']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array(
					'name' => $val['name'],
					// 'exam_type' => $this->input->post('exam_type'),
					'is_active' => $val['is_active'],
					'description' => $val['description'],
					'exam_group' => $new_term_array[$val['exam_group']],
					'session_id' => $classes['next_session_id']
				);
				$insert_id = $this->examgroup_model->add_c($data);
			}
			// added assesment
			$this->db->from('exam_group_class_batch_exams');
			$this->db->where('session_id', $classes['current_session_id']);
			$this->db->where('exam_group_id', $val['id']);
			$queryAss = $this->db->get();
			if($queryAss->num_rows() > 0)
			{
				foreach($queryAss->result_array() as $valAss)
				{
					$this->db->from('exam_group_class_batch_exams');
					$this->db->where('session_id', $classes['next_session_id']);
					$this->db->where('exam', $valAss['exam']);
					$this->db->where('exam_group_id', $valAss['exam_group_id']);
					$this->db->where('coscholasticareas', 1);
					$qr = $this->db->get();
					if($qr->num_rows() == 0)
					{
						$array = array(
							'exam' => $valAss['exam'],
							'session_id' => $classes['next_session_id'],
							'description' => $valAss['exam'],
							'is_publish' => 1,
							'is_active' => 1,
							'coscholasticareas' => 1,
							'exam_group_id' => $valAss['id'],
						);
						$this->db->insert('exam_group_class_batch_exams', $array);
					}
				}
			}
		}
	}
	public function create_department($classes)
	{
		$query = $this->db->from('department')->where('session_id', $classes['current_session_id'])->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('department');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('department_name', $val['department_name']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('department_name' => $val['department_name'], 'is_active' => 'yes', 'session_id'=> $classes['next_session_id']);
				$insert_id = $this->department_model->addDepartmentType($data);
			}
		}
	}
	public function create_designation($classes)
	{
		$query = $this->db->from('staff_designation')->where('session_id', $classes['current_session_id'])->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('staff_designation');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('designation', $val['designation']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('designation' => $val['designation'], 'is_active' => 'yes', 'session_id'=> $classes['next_session_id']);
				$insert_id = $this->designation_model->addDesignation($data);
			}
		}
	}
	public function create_staff($classes)
	{
		$this->db->select('staff.*, staff_roles.role_id');
		$this->db->from('staff');
		$this->db->join(
			'staff_roles',
			'staff_roles.staff_id = staff.id',
			'left'
		);
		$this->db->where('staff.id !=', 1);
		$this->db->where('staff.session_id', $classes['current_session_id']);
		$query = $this->db->get();

		foreach($query->result_array() as $key=>$staff)
		{
			$this->db->from('staff');
			$this->db->where('session_id', $classes['next_session_id']);
			$this->db->where('employee_id', $staff['employee_id']);
			$this->db->where('name', $staff['name']);
			$this->db->where('surname', $staff['surname']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data_insert['employee_id'] = $staff['employee_id'];
				$data_insert['lang_id'] = $staff['lang_id'];
				$data_insert['department'] = $staff['department'];
				$data_insert['designation'] = $staff['designation'];
				$data_insert['qualification'] = $staff['qualification'];
				$data_insert['work_exp'] = $staff['work_exp'];
				$data_insert['name'] = $staff['name'];
				$data_insert['surname'] = $staff['surname'];
				$data_insert['father_name'] = $staff['father_name'];
				$data_insert['mother_name'] = $staff['mother_name'];
				$data_insert['contact_no'] = $staff['contact_no'];
				$data_insert['emergency_contact_no'] = $staff['emergency_contact_no'];
				$data_insert['email'] = $staff['email'];
				$data_insert['dob'] = $staff['dob'];
				$data_insert['marital_status'] = $staff['marital_status'];
				$data_insert['date_of_joining'] = $staff['date_of_joining'];
				$data_insert['date_of_leaving'] = $staff['date_of_leaving'];
				$data_insert['local_address'] = $staff['local_address'];
				$data_insert['permanent_address'] = $staff['permanent_address'];
				$data_insert['note'] = $staff['note'];
				$data_insert['image'] = $staff['image'];
				$data_insert['password'] = $staff['password'];
				$data_insert['gender'] = $staff['gender'];
				$data_insert['account_title'] = $staff['account_title'];
				$data_insert['bank_account_no'] = $staff['bank_account_no'];
				$data_insert['bank_name'] = $staff['bank_name'];
				$data_insert['ifsc_code'] = $staff['ifsc_code'];
				$data_insert['bank_branch'] = $staff['bank_branch'];
				$data_insert['payscale'] = $staff['payscale'];
				$data_insert['basic_salary'] = $staff['basic_salary'];
				$data_insert['epf_no'] = $staff['epf_no'];
				$data_insert['contract_type'] = $staff['contract_type'];
				$data_insert['shift'] = $staff['shift'];
				$data_insert['location'] = $staff['location'];
				$data_insert['facebook'] = $staff['facebook'];
				$data_insert['twitter'] = $staff['twitter'];
				$data_insert['linkedin'] = $staff['linkedin'];
				$data_insert['instagram'] = $staff['instagram'];
				$data_insert['resume'] = $staff['resume'];
				$data_insert['joining_letter'] = $staff['joining_letter'];
				$data_insert['resignation_letter'] = $staff['resignation_letter'];
				$data_insert['other_document_name'] = $staff['other_document_name'];
				$data_insert['other_document_file'] = $staff['other_document_file'];
				$data_insert['user_id'] = $staff['user_id'];
				$data_insert['is_active'] = $staff['is_active'];
				$data_insert['verification_code'] = $staff['verification_code'];
				$data_insert['disable_at'] = $staff['disable_at'];
				$data_insert['session_id'] = $classes['next_session_id'];
				
				// check department for next session
				//echo $staff['department']; die; 
				$qr_dept_chk = $this->db->from('department')->where('id', $staff['department'])->get();
				if($qr_dept_chk->num_rows() > 0)
				{
					$department_data = $qr_dept_chk->row_array();
					$department_name = $department_data['department_name'];
					$this->db->where('session_id', $classes['next_session_id']);
					$this->db->where('department_name', $department_name);
					$qr_dept = $this->db->get('department');
					if($qr_dept->num_rows() > 0)
					{
						//echo 'has department' ."</br>";
						// add new department
						$active_department = $qr_dept->row_array();
						$next_department_id = $active_department['id'];// department_id
						//echo $department_name.'->'.$next_department_id."</br>";die;
						$data_insert['department'] = $next_department_id;
					}
				}
				
				// check designation for next session
				//echo $staff['designation']; die;
				$qr_desig_chk = $this->db->from('staff_designation')->where('id', $staff['designation'])->get();
				if($qr_desig_chk->num_rows() > 0)
				{
					$designation_data = $qr_desig_chk->row_array();
					$designation_name = $designation_data['designation'];
					$this->db->where('session_id', $classes['next_session_id']);
					$this->db->where('designation', $designation_name);
					$qr_dept = $this->db->get('staff_designation');
					if($qr_dept->num_rows() > 0)
					{
						//echo 'has designation' ."</br>";
						// add new designation
						$active_designation = $qr_dept->row_array();
						$next_designation_id = $active_designation['id'];// designation_id
						$data_insert['designation'] = $next_designation_id;
					}
				}
				
				// get role_id 
				$role_array = array('role_id' => $staff['role_id'], 'staff_id' => 0);
				$leave_array = [];
				//===== from settings table 
				 
				//$insert                              = true;
				$data_setting                          = array();
				$data_setting['id']                    = $this->sch_setting_detail->setting_session_id;
				$data_setting['staffid_auto_insert']   = $this->sch_setting_detail->staffid_auto_insert;
				$data_setting['staffid_update_status'] = $this->sch_setting_detail->staffid_update_status;
				
				//echo "<pre>";print_r($data_insert);die;
				
				$insert_id = $this->staff_model->batchInsert($data_insert, $role_array,$leave_array, $data_setting); 
				 
				$staff_id  = $insert_id;
				 
				$data_img = array('id' => $staff_id, 'image' => $staff['image']);
                $this->staff_model->add($data_img);
				
				if ($staff_id) {
					$teacher_login_detail = array('id' => $staff_id, 'credential_for' => 'staff', 'username' => $staff['email'], 'password' => $staff['password'], 'contact_no' => $staff['contact_no'], 'email' => $staff['email']);
					$this->mailsmsconf->mailsms('login_credential', $teacher_login_detail);
                }
			}
		}
		//echo "<pre>";print_r($data_insert);die;
	}
	
	public function fee_category_create_bkp($current_class_id, $current_session_id, $next_session_id)
    {
		$new_fee_category_array = [];
		$this->db->from('fee_groups');
		$this->db->where('session_id', $current_session_id);
		$this->db->where('is_system', 0);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
		foreach($qrArrayData as $qrArrayDataVal){
			$this->db->where('name', $qrArrayDataVal['name']);
			$value_exists_query = $this->db->where('session_id', $next_session_id)->get('fee_groups');
			if($value_exists_query->num_rows() > 0){
				$value_query = $value_exists_query->row_array();
				$value_id = $value_query['id'];
			}else{
				$data = array(
					'session_id' => $next_session_id,
					'name' => $qrArrayDataVal['name'],
					'is_system' => $qrArrayDataVal['is_system'],
					'description' => '',
					'is_active' => $qrArrayDataVal['is_active'],
				);
				$value_id = $this->feegroup_model->add($data);
			}
			$new_fee_category_array[] = array($qrArrayDataVal['id'] => $value_id);
		}
		return $new_fee_category_array;
	}
	
	public function changeSessions_bck($key = "")
    {
        //$this->load->model('Student_model');

        //$this->Student_model->update_status();
		$sectionArr = [];
		$key = $this->input->get('key');

        if ($key !== $this->cron_key) {
            exit('Invalid Key or Direct access is not allowe');
        }
		//echo $this->current_session; die;
		$this->db->select('move_students.batch_id');
		$this->db->from('move_students');
		$this->db->join(
			'move_students_category',
			'move_students.batch_id = move_students_category.batch_id'
		);
		$this->db->where('move_students.status', 1);
		$this->db->where('move_students_category.status', 1);
		$this->db->where('move_students.current_session_id', $this->current_session);
		$this->db->group_by('batch_id');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		
		foreach($query->result_array() as $result){
			echo $result['batch_id'].'</br>';
			$this->db->from('move_students');
			$this->db->join('classes', 'classes.id = move_students.next_class_id');
			$this->db->where('move_students.batch_id', $result['batch_id']);
			$this->db->where('move_students.status', 1);
			$qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
			$classData = $qr->row_array();
			
			// echo "<pre>";print_r($classData);
			echo $classData['next_class_id'].'->';
			
			// check class exists in current session
			$this->db->from('classes');
			$this->db->where('session_id',  $classData['next_session_id']);
			$this->db->where('class', $classData['class']);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
					$this->db->select('sections.section')->from('class_sections');
					$this->db->join('sections', 'sections.id = class_sections.section_id');
					$this->db->where('class_sections.class_id', 67);
					$qr = $this->db->get();
					$sectionData = $qr->result_array();
					foreach($sectionData as $sec)
					{
						$data = array(
							'section' => $sec['section'],
							'session_id' => $classData['next_session_id'],
						);
						//$section_id = $this->section_model->add($data);
						$sectionArr[] = $section_id;
					}
					//echo "<pre>";print_r($sectionData);die;
					echo $classData['class'].'->'.$sectionData['section']."</br>";
					
					$class_array = array(
						'class' => $classData['class'],
						'session_id' => $classData['next_session_id'],
					);
					$sections = $sectionArr;
					//$this->classsection_model->add($class_array, $sections);
				
			}
			else{
				echo 'yes'; 
			}
		}
        //echo "<pre>";print_r($sectionArr);die;
        
    }
	function student_fees_balance($id='', $current_session_id='')
	{
		$student = $this->student_model->getByStudentSessionFees($id, $current_session_id);
		$monthsFeesPost = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
		$monthsRoutePost = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
		$existing_fees_entry = $this->Receipt_model->get_fees_pay_mounth_cron($student['id'], $current_session_id);
		$existing_route_entry = $this->Receipt_model->get_route_pay_mounth_cron($student['id'], $current_session_id);
        $monthsFeesPost = array_values(array_diff($monthsFeesPost, $existing_fees_entry));
        $monthsRoutePost = array_values(array_diff($monthsRoutePost, $existing_route_entry));
		//echo "<pre>";print_r($monthsFeesPost);die;
		$class_id=$student['class_id'];
		$route_id=$student['route_id'];
		$category_id=$student['category_id'];
		
		
		$this->db->from('fee_head');
            $this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
            $this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
            $this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
            if (!empty($monthsFeesPost)) {
                $this->db->group_start(); // Start OR group
                foreach ($monthsFeesPost as $m) {
                    $m_escaped = $this->db->escape_str($m); // Prevent injection or breaking SQL
                    $this->db->or_where("JSON_CONTAINS(fee_head.months, '\"$m_escaped\"')", null, false);
                }
                $this->db->group_end(); // End OR group
            }
            $query = $this->db->get();
            $data['data_list'] = $query->result();
			// return $data['data_list'];
            // $feesAlreadyTakenArr = $this->fee_discount_model->get_already_taken_fees($id);  
			
			//---- 20-11-2025---ES--
			$feeDiscountsArr      = $this->fee_discount_model->get_all_fees($id);
			$routeDiscountsArr    = $this->fee_discount_model->get_all_routes($id);
			
			$data_list = $this->updateMonthlyFeeAmounts($data['data_list'], $feeDiscountsArr);
			//echo "<pre>";print_r($data_list);die;
			$final_total = 0;
			foreach($data_list as $row)
			{
				$total = 0;
				$db_months = json_decode($row->months);
				
				foreach($monthsFeesPost as $key => $value):
				
					if(in_array($value, $db_months)){
						
						if(is_array($row->amount)) 
						{
							$amount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
							$total += $amount;
						}
						else{
							$total += $row->amount;
						}
					}
				endforeach;
				
				$final_total += $total;
			}
			//------
			
			 // route

            $this->db->from('route_head');
            $this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
            $this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
            $this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
            $this->db->where('route_head.id', $route_id);
            
            $query = $this->db->get();
            $data['route_data_list'] = $query->result();
			
			$route_data_list = $this->updateMonthlyFeeAmounts($data['route_data_list'], $routeDiscountsArr);
			//echo "<pre>";print_r($data['route_data_list']);die;
			
			foreach($route_data_list as $row)
			{
				$db_months = json_decode($row->months);
                $total = 0; 
				
				foreach($monthsRoutePost as $key => $value):
					if(in_array($value, $db_months))
					{
						if(is_array($row->amount)) 
						{
							$total += $row->amount[$value];
						}
						else{
							$total += $row->amount;
						}
					}
				endforeach;
				
				$final_total += $total;
			}
			
		$student_fee = $student['fees_discount']+$student['previous_session_balance']+$final_total;
		return $student_fee;
	}
	function updateMonthlyFeeAmounts($defaultArray, $paidArray)
	{
		$monthMap = [
			"Apr" => "month_apr",
			"May" => "month_may",
			"Jun" => "month_jun",
			"Jul" => "month_jul",
			"Aug" => "month_aug",
			"Sep" => "month_sep",
			"Oct" => "month_oct",
			"Nov" => "month_nov",
			"Dec" => "month_dec",
			"Jan" => "month_jan",
			"Feb" => "month_feb",
			"Mar" => "month_mar"
		];

		foreach ($defaultArray as &$feeHead) {

			foreach ($paidArray as $paid) {

				if ($paid['fee_type_id'] == $feeHead->id) {

					$months = json_decode($feeHead->months, true);

					if (!is_array($months)) continue;

					$amounts = [];

					foreach ($months as $month) {

						$column = $monthMap[$month];

						$amounts[$month] = isset($paid[$column])
							? floatval($paid[$column])
							: floatval($feeHead->amount); // fallback
					}

					// Replace amount with month-wise array
					$feeHead->amount = $amounts;
				}
			}
		}

		return $defaultArray;
	}
	public function insert_opening_balance($classes)
	{
		$this->db->from('balance_sheets');
		$this->db->where('session_id', $classes['next_session_id']);
		$qr = $this->db->get();
		if($qr->num_rows() == 0)
		{
			// credit total
			$this->db->from('balance_sheets');
			$this->db->select_sum('amount');

			$this->db->where('session_id', $classes['current_session_id']);
			$this->db->where('status', 0);
			$this->db->where('balance_type', 0);

			$query = $this->db->get();
			$result = $query->row();

			$total_credit_amount = $result->amount;
			
			// debit total
			$this->db->from('balance_sheets');
			$this->db->select_sum('amount');

			$this->db->where('session_id', $classes['current_session_id']);
			$this->db->where('status', 0);
			$this->db->where('balance_type', 1);

			$query = $this->db->get();
			$result = $query->row();

			$total_debit_amount = $result->amount;
	
			if($total_credit_amount > $total_debit_amount)
			{
				$data = array(
					'session_id' => $classes['next_session_id'],
					'balance_type' => 0,
					'amount' => $total_credit_amount,
					'date' => date('Y-m-d_H-i-s'),
					'description' => 'Opening balance'
				);
				
				$this->db->insert('balance_sheets', $data);
			}
			
			if($total_debit_amount > $total_credit_amount)
			{
				$data = array(
					'session_id' => $classes['next_session_id'],
					'balance_type' => 1,
					'amount' => $total_debit_amount,
					'date' => date('Y-m-d_H-i-s'),
					'description' => 'Opening balance'
				);
				
				$this->db->insert('balance_sheets', $data);
			}
			
			if($total_debit_amount == $total_credit_amount)
			{
				$data = array(
					'session_id' => $classes['next_session_id'],
					'balance_type' => 1,
					'amount' => 0,
					'date' => date('Y-m-d_H-i-s'),
					'description' => 'Opening balance'
				);
				
				$this->db->insert('balance_sheets', $data);
			}
		}
	}
	

}
