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
		// echo '<pre>'; print_r($query->result_array()); exit;
		
		foreach($query->result_array() as $result){
			
			$this->db->from('move_students');
			$this->db->join('classes', 'classes.id = move_students.next_class_id');
			$this->db->where('move_students.batch_id', $result['batch_id']);
			$this->db->where('move_students.status', 1);
			// $qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
			$qr = $this->db->get();
			$classData = $qr->result_array();
			// echo "<pre>";print_r($classData);die;
			foreach($qr->result_array() as $val){
				$sectionArr = [];
				$new_section_array = [];
				$new_class_array = [];
				$new_house_array = [];
				$new_fee_category_array = [];
				$new_route_array = [];
				
				// echo "<pre>";print_r($val);die;
				$classes = $val;
				
				// Create section start
					$this->db->select('sections.*')->from('class_sections');
					$this->db->join('sections', 'sections.id = class_sections.section_id');
					$this->db->where('class_sections.class_id', $classes['current_class_id']);
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
					$this->db->where('session_id',  $classes['next_session_id']);
					$this->db->where('class', $classes['class']);
					$query = $this->db->get();
					if($query->num_rows() == 0) // If class not exists
					{
						$class_array = array(
							'class' => $classes['class'],
							'session_id' => $classes['next_session_id'],
						);
						$class_id = $this->classsection_model->add($class_array, $sectionArr);
					}else{ // If class exists
						$class_query = $query->row_array();
						$class_id = $class_query['id'];
						foreach($sectionArr as $sectionArrVal){
							$check_array = array(
								'class_id' => $class_query['id'],
								'section_id' => $sectionArrVal,
							);
							// echo "<pre>";print_r($sectionArr);die;
							$check_class_sec_exists = $this->classsection_model->check_data_exists($check_array);
							if(!$check_class_sec_exists){
								$class_array = array(
									'id' => $class_query['id'],
									'class' => $class_query['class'],
									'session_id' => $classes['next_session_id'],
								);
								$class_id = $this->classsection_model->add($class_array, array($sectionArrVal));
							}
						}
					}
					$new_class_array[] = array($classes['current_class_id'] => $class_id);
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
				
				// create 'fee_plan' start
					$new_fee_plan_array = $this->fee_plan_create($classes['next_session_id'], $classes['next_class_id'], $fee_category_by_move_category, $new_fee_category_array, $new_class_array);
				// create 'fee_plan' end
				
				// create 'route_head' start
					$new_route_array = $this->route_create($classes['next_session_id'], $classes['current_session_id']);
					// echo "<pre>";print_r($new_route_array);die;
				// create 'route_head' end
				
				// create 'route_plan' start
					$new_route_plan_array = $this->route_plan_create($classes['next_session_id'], $classes['next_class_id'], $fee_category_by_move_category, $new_fee_category_array, $new_class_array, $new_route_array);
				// create 'route_plan' end
				
				$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
				
				$move = $this->student_move($classes, $new_class_array, $new_section_array, $new_house_array, $new_fee_category_array, $new_route_array, $fee_category_by_move_category);
				// echo "<pre>";print_r($move);die;
			}
			
			$this->db->where('batch_id', $result['batch_id']);
            $this->db->update('move_students', ['status' => 2]);
			
			$this->db->where('batch_id', $result['batch_id']);
            $this->db->update('move_students_category', ['status' => 2]);
		}
		//$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
		
		$this->create_department();
		$this->create_designation();
		$this->create_staff();
		$this->create_disable_reason();
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
	public function fee_plan_create($next_session_id, $next_class_id, $qrArrayData, $new_fee_category_array, $new_class_array)
    {
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
				// $this->db->where("JSON_CONTAINS(category_ids, '\"" . current($new_fee_category_array_val) . "\"')", NULL, FALSE); // 178
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
						'class_ids'    => json_encode(array(current($new_class_array[0]))),
						'category_ids' => json_encode(array($new_fee_category_array_val)),
						'session_id' => $next_session_id,
					];
					$this->db->insert('fees_plan', $data_insert);
				}
				// 'fees_plan' table add/update end
				
			}
			// return $feePlanData;
		}
	}
	
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
			$this->db->from('account');
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
			}
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
	public function route_plan_create($next_session_id, $next_class_id, $qrArrayData, $new_fee_category_array, $new_class_array, $new_route_array)
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
				// $this->db->where("JSON_CONTAINS(category_ids, '\"" . current($new_route_category_array_val) . "\"')", NULL, FALSE); // 178
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
						'class_ids'    => json_encode(array(current($new_class_array[0]))),
						'category_ids' => json_encode(array($new_route_category_array_val)),
						'session_id' => $next_session_id,
					];
					$this->db->insert('route_plan', $data_insert);
				}
				// 'route_plan' table add/update end				
			}
		}
	}
	
	function student_move($classes, $new_class_array, $new_section_array, $new_house_array, $new_fee_category_array, $new_route_array, $fee_category_by_move_category){
		$this->db->select('student_session.*')->from('students');
		$this->db->join('student_session', 'student_session.student_id = students.id');
		$this->db->where('student_session.session_id', $classes['current_session_id']);
		$this->db->where('student_session.class_id', $classes['current_class_id']);
		if($classes['discontinue_next_session'] == 0){
			$this->db->where('students.is_active', 'yes');
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
				$fees_discount = $val['fees_discount'];
			}
			
			if($val['fee_category_id'] != 0){
				$next_cat_id = array_column($fee_category_by_move_category, 'next_category_id', 'current_category_id')[$val['fee_category_id']] ?? null;
				$student_new_cat_id  = current(array_filter($new_fee_category_array, fn($a) => isset($a[$next_cat_id])))[$next_cat_id] ?? 0;
			}else{
				$student_new_cat_id = 0;
			}
			
			$data_new = array(
				'session_id' => $classes['next_session_id'],
				'student_id' => $student_id,
				'class_id' => current($new_class_array[0]),
				'section_id' => $val['section_id'] != 0 ? current(array_filter($new_section_array, fn($a) => isset($a[$val['section_id']])))[$val['section_id']] ?? 0 : 0,
				'route_id' => $val['route_id'] != 0 ? current(array_filter($new_route_array, fn($a) => isset($a[$val['route_id']])))[$val['route_id']] ?? 0 : 0,
				'school_house_id' => $val['school_house_id'] != 0 ? current(array_filter($new_house_array, fn($a) => isset($a[$val['school_house_id']])))[$val['school_house_id']] ?? 0 : 0,
				'fee_category_id' => $student_new_cat_id,
				'transport_fees' => $val['transport_fees'],
				'fees_discount' => $fees_discount,
			);
			
			$this->student_model->add_student_session($data_new);
			
			$this->db->where('student_session_id', $val['id']);
			$this->db->where('fee_session_group_id', $fee_session_groups_id);
			$query = $this->db->get('student_fees_master');
			if ($query->num_rows() > 0) {
				$to_be_update = array(
					'is_system'           	 => 1,
					'amount' 				 => $fees_discount,
				);
				$this->db->where('id', $query->row()->id);
				$this->db->update('student_fees_master', $to_be_update);
			}else{
				$to_be_insert = array(
					'is_system'           	 => 1,
					'student_session_id' 	 => $val['id'],
					'fee_session_group_id'   => $fee_session_groups_id,
					'amount' 				 => $fees_discount,
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
		//echo "<pre>";print_r($classSectionArr);
		
		$result = [];
		foreach ($classSectionArr as $val) {

			$classKey   = null;
			$classValue = null;
			$sectionKey = null;
			$sectionValue = null;

			foreach ($val as $key => $value) {
				
				if ($key > 1) {
					$classKey   = $key;
					$classValue = $value;
				} 
				
				else {
					$sectionKey   = $key;
					$sectionValue = $value;
				}
			}

			$result[] = [
				'current_class_id'   => $classKey,
				'next_class_id'      => $classValue,
				'current_section_id' => $sectionKey,
				'next_section_id'    => $sectionValue,
			];
		}

		//echo "<pre>";print_r($result);
		
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
									'type_one' => $subject_type,
									'session_id' => $next_session
								);
								
								$new_subject_id = $this->subject_model->add($data);
								$new_subject_arr[] = $new_subject_id;
							}
							else{
								$s_id = $qr_subject->row_array();
								$new_subject_arr[] = $s_id['id'];
							}
							
						}
						
					}
				}
				
				
				// add subjects in subject group
				// get next class and section names
				if(!empty($new_subject_arr))
				{
					$classData = $this->db->where('id', $val['next_class_id'])->get('classes')->row_array();
					$next_class_name = $classData['class'];
					
					$sectionData = $this->db->where('id', $val['next_section_id'])->get('sections')->row_array();
					$next_section_name = $sectionData['section'];
					
					$next_class_section_ids = [];
					$classSectionData = $this->db->where('class_id', $val['next_class_id'])->get('class_sections')->result_array();
					foreach($classSectionData as $ids)
					{
						$next_class_section_ids[] = $ids['id'];
					}
					
					//insert into tables subject_groups ,subject_group_subjects, subject_group_class_sections
					
					$class_array = array(
						'name' => $next_class_name.' '.$next_section_name,
						'session_id' => $next_session,
						'description' => '',
					);
					$subject_group = $new_subject_arr;
					$section_group = $next_class_section_ids;
					
					
					$this->db->insert('subject_groups', $class_array);
					$subject_group_id = $this->db->insert_id();
					
					$subject_group_subject_Array = array();
					foreach ($subject_group as $sub_group_key => $sub_group_value) {

						$vehicle_array = array(
							'subject_group_id' => $subject_group_id,
							'subject_id' => $sub_group_value,
							'session_id' => $next_session,
						);

						$subject_group_subject_Array[] = $vehicle_array;
					}
					$this->db->insert_batch('subject_group_subjects', $subject_group_subject_Array);
					
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
		}
		
	}
	public function create_disable_reason()
	{
		$query = $this->db->from('disable_reason')->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('disable_reason');
			$this->db->where('session_id', $this->current_active_session);
			$this->db->where('reason', $val['reason']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array(
					'reason' => $val['reason'],
					'session_id' => $this->current_active_session,
				);
				$this->disable_reason_model->add($data);
			}
		}
	}
	public function create_department()
	{
		$query = $this->db->from('department')->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('department');
			$this->db->where('session_id', $this->current_active_session);
			$this->db->where('department_name', $val['department_name']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('department_name' => $val['department_name'], 'is_active' => 'yes', 'session_id'=> $this->current_active_session);
				$insert_id = $this->department_model->addDepartmentType($data);
			}
		}
	}
	public function create_designation()
	{
		$query = $this->db->from('staff_designation')->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('staff_designation');
			$this->db->where('session_id', $this->current_active_session);
			$this->db->where('designation', $val['designation']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('designation' => $val['designation'], 'is_active' => 'yes', 'session_id'=> $this->current_active_session);
				$insert_id = $this->designation_model->addDesignation($data);
			}
		}
	}
	public function create_staff()
	{
		$this->db->select('staff.*, staff_roles.role_id');
		$this->db->from('staff');
		$this->db->join(
			'staff_roles',
			'staff_roles.staff_id = staff.id',
			'left'
		);
		$this->db->where('staff.id !=', 1);

		$query = $this->db->get();

		
		//echo "<pre>";print_r($query->result_array());die;
		foreach($query->result_array() as $key=>$staff)
		{
			$this->db->from('staff');
			$this->db->where('session_id', $this->current_active_session);
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
				$data_insert['session_id'] = $this->current_active_session;
				
				// check department for next session
				//echo $staff['department']; die; 
				$qr_dept_chk = $this->db->from('department')->where('id', $staff['department'])->get();
				if($qr_dept_chk->num_rows() > 0)
				{
					$department_data = $qr_dept_chk->row_array();
					$department_name = $department_data['department_name'];
					$this->db->where('session_id', $this->current_active_session);
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
					$this->db->where('session_id', $this->current_active_session);
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
        echo "<pre>";print_r($sectionArr);die;
        
    }
	function student_fees_balance($id='')
	{
		$student = $this->student_model->getByStudentSession($id);
		$monthsPost = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
		$existing_entry = $this->Receipt_model->get_pay_mounth($student['id']);
        $monthsPost = array_values(array_diff($monthsPost, $existing_entry));
		//echo "<pre>";print_r($monthsPost);die;
		$class_id=$student['class_id'];
		$route_id=$student['route_id'];
		$category_id=$student['category_id'];
		
		
		$this->db->from('fee_head');
            $this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
            $this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
            $this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
            if (!empty($monthsPost)) {
                $this->db->group_start(); // Start OR group
                foreach ($monthsPost as $m) {
                    $m_escaped = $this->db->escape_str($m); // Prevent injection or breaking SQL
                    $this->db->or_where("JSON_CONTAINS(fee_head.months, '\"$m_escaped\"')", null, false);
                }
                $this->db->group_end(); // End OR group
            }
            $query = $this->db->get();
            $data['data_list'] = $query->result();
              
			
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
				
				foreach($monthsPost as $key => $value):
				
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
			
			$data['route_data_list'] = $this->updateMonthlyFeeAmounts($data['route_data_list'], $routeDiscountsArr);
			//echo "<pre>";print_r($data['route_data_list']);die;
			
			foreach($route_data_list as $row)
			{
				$db_months = json_decode($row->months);
                $total = 0; 
				
				foreach($months_data as $key => $value):
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
			
		$student_fee = $student['fees_discount']+$final_total;
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
	

}
