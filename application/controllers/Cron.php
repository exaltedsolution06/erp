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
			$sectionArr = [];
			foreach($qr->result_array() as $val){
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
				
				// create fee category start
					$new_fee_category_array = $this->fee_category_create($classes['current_class_id'], $classes['current_session_id'], $classes['next_session_id'], $result['batch_id']);
					//echo "<pre>";print_r($new_fee_category_array);die;
				// create fee category end
				
				// create 'fee_plan' start
					// echo "<pre>";print_r($classes);die;
					
					//$new_fee_plan_array = $this->fee_plan_create($classes['current_class_id'], $classes['current_session_id'], $classes['next_session_id']);
					
					//echo "<pre>";print_r($new_fee_category_array);die;
				// create 'fee_plan' end
				$this->subject_create($new_class_array, $new_section_array, $classes['current_session_id'], $classes['next_session_id']);
			}
			
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
	
	public function fee_category_create($current_class_id, $current_session_id, $next_session_id, $batch_id)
    {
		$new_house_array = [];
		/*$this->db->from('student_session');
		$this->db->join('fee_groups', 'fee_groups.id = student_session.fee_category_id');
		$this->db->where('student_session.class_id', $current_class_id);
		$this->db->where('student_session.session_id', $current_session_id);
		$this->db->where_not_in('student_session.fee_category_id', [0]);
		$this->db->group_by('student_session.fee_category_id');
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();*/
		$this->db->from('move_students_category');
		$this->db->join('fee_groups', 'fee_groups.id = move_students_category.next_category_id');
		$this->db->where('fee_groups.session_id', $current_session_id);
		$this->db->where('move_students_category.batch_id', $batch_id);
		$this->db->where('move_students_category.status', 1);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
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
	
	public function fee_plan_create($current_class_id, $current_session_id, $next_session_id)
    {
		$this->db->from('fees_plan');
		$this->db->where('fee_groups.session_id', $current_session_id);
		$this->db->where('move_students_category.batch_id', $batch_id);
		$this->db->where('move_students_category.status', 1);
		$qr = $this->db->get();
		$qrArrayData = $qr->result_array();
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
	
	public function subject_create($classes, $sections, $current_session, $next_session)
	{
		//echo "<pre>";print_r($classes);
		//echo "<pre>";print_r($sections);
		
		$classSectionArr = [];
		foreach ($classes as $key => $classArr) {
			$classSectionArr[$key] = $classArr + ($sections[$key] ?? []);
		}
		//echo "<pre>";
		//print_r($classSectionArr);
		
		$result = [];

		foreach ($classSectionArr as $val) {

			$classIds   = array_slice($val, 0, 1, true);
			$sessionIds = array_slice($val, 1, 1, true);

			$result[] = [
				'current_class_id'   => key($classIds),
				'next_class_id'      => current($classIds),
				'current_section_id' => key($sessionIds),
				'next_section_id'    => current($sessionIds),
			];
		}
		
		$new_subject_arr = [];
		
		foreach($result as $val)
		{
			//echo $val['current_class_id'].' # '.$val['current_section_id'];
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
					//echo "<pre>";print_r($next_class_section_ids);
					//insert into tables subject_groups ,subject_group_subjects, subject_group_class_sections
					
					$class_array = array(
						'name' => $next_class_name.' '.$next_section_name,
						'session_id' => $next_session,
						'description' => '',
					);
					$subject_group = $new_subject_arr;
					$section_group = $next_class_section_ids;
					//echo "<pre>";print_r($class_array);
					//echo "<pre>";print_r($subject_group);
					//echo "<pre>";print_r($section_group);
					
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
		
		//echo "<pre>";
		//print_r($result);

		//echo $current_session."</br>";
		//echo $next_session."</br>";die;
		
		//-- for subject group
		
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
