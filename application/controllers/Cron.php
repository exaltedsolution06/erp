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
		$this->current_session = $this->setting_model->getCurrentSession();
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
		$key = $this->input->get('key');

        if ($key !== $this->cron_key) {
            exit('Invalid Key or Direct access is not allowe');
        }
		
		
		$this->db->select('move_students.batch_id');
		$this->db->from('move_students');
		/*$this->db->join(
			'move_students_category',
			'move_students.batch_id = move_students_category.batch_id'
		);*/
		$this->db->where('move_students.status', 1);
		// $this->db->where('move_students_category.status', 1);
		$this->db->where('move_students.current_session_id', $this->current_session);
		$this->db->group_by('batch_id');
		$query = $this->db->get();
		// echo '<pre>'; print_r($query->result_array()); exit;
		
		foreach($query->result_array() as $result){
			
			$this->db->from('move_students');
			$this->db->join('classes', 'classes.id = move_students.next_class_id');
			$this->db->where('move_students.batch_id', $result['batch_id']);
			$this->db->where('move_students.status', 1);
			$qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
			$classData = $qr->result_array();
			// echo "<pre>";print_r($classData);die;
			foreach($qr->result_array() as $val){
				$sectionArr = [];
				$new_section_array = [];
				$new_class_array = [];
				$new_house_array = [];
				$new_fee_category_array = [];
				/*
				$this->db->from('move_students');
				$this->db->join('classes', 'classes.id = move_students.next_class_id');
				$this->db->where('classes.id', $val['next_class_id']);
				$this->db->where('move_students.status', 1);
				$qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
				$classes = $qr->row_array();
				*/
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
					//echo "<pre>";print_r($sectionData);die;
					// echo '<pre>'; print_r($new_section_array); exit;
					//echo $classData['class'].'->'.$sectionData['section']."</br>";
					// echo "<pre>";print_r($sectionArr);die;
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
					// echo "<pre>";print_r($class_id);die;				
					// echo "<pre>";print_r($classes);die;
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
					$new_fee_category_array = $this->fee_category_create($classes['next_session_id'], $fee_category_by_move_category);
					// echo "<pre>";print_r($new_fee_category_array);die;
				// create fee category end
				
				// create 'fee_plan' start
					// echo "<pre>";print_r($classes);die;					
					$new_fee_plan_array = $this->fee_plan_create($classes['next_session_id'], $classes['next_class_id'], $fee_category_by_move_category, $new_fee_category_array, $new_class_array);
					// echo "<pre>";print_r($new_fee_plan_array);die;
				// create 'fee_plan' end
				$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
			}
			
		}
		//$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
		
		$this->create_department();
		$this->create_designation();
		$this->create_staff();
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
		$this->db->from('move_students_category');
		$this->db->join('fee_groups', 'fee_groups.id = move_students_category.next_category_id');
		$this->db->where('fee_groups.session_id', $current_session_id);
		$this->db->where('move_students_category.batch_id', $batch_id);
		$this->db->where('move_students_category.status', 1);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
		return $qrArrayData;
	}
	
	public function fee_category_create($next_session_id, $qrArrayData)
    {
		$new_house_array = [];
		// return $qrArrayData;
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
	public function create_department()
	{
		$query = $this->db->from('department')->get();
		foreach($query->result_array() as $val)
		{
			$this->db->from('department');
			$this->db->where('session_id', $this->current_session);
			$this->db->where('department_name', $val['department_name']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('department_name' => $val['department_name'], 'is_active' => 'yes', 'session_id'=> $this->current_session);
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
			$this->db->where('session_id', $this->current_session);
			$this->db->where('designation', $val['designation']);
			$qr = $this->db->get();
			if($qr->num_rows() == 0)
			{
				$data = array('designation' => $val['designation'], 'is_active' => 'yes', 'session_id'=> $this->current_session);
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
		foreach($query->result_array() as $staff)
		{
			$this->db->from('staff');
			$this->db->where('session_id', $this->current_session);
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
				
				// check department for next session
				$qr_dept_chk = $this->db->from('department')->where('id', $data_insert['department'])->get();
				if($qr_dept_chk->num_rows() > 0)
				{
					$department_data = $qr_dept_chk->row_array();
					$department_name = $department_data['department_name'];
					$this->db->where('session_id', $this->current_session);
					$this->db->where('department_name', $department_name);
					$qr_dept = $this->db->get('department');
					if($qr_dept->num_rows() == 0)
					{
						//echo 'has department' ."</br>";
						// add new department
					}
				}
				
			}
		}
		//echo $data_insert['department'];
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
			
			echo "<pre>";print_r($classData);
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
	

}
