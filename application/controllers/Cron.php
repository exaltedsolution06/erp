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
		$this->db->join(
			'move_students_category',
			'move_students.batch_id = move_students_category.batch_id'
		);
		$this->db->where('move_students.status', 1);
		$this->db->where('move_students_category.status', 1);
		$this->db->where('move_students.current_session_id', $this->current_session);
		$this->db->group_by('batch_id');
		$query = $this->db->get();
		
		foreach($query->result_array() as $result){
			
			$this->db->from('move_students');
			$this->db->join('classes', 'classes.id = move_students.next_class_id');
			$this->db->where('move_students.batch_id', $result['batch_id']);
			$this->db->where('move_students.status', 1);
			$qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
			$classData = $qr->result_array();
			//echo "<pre>";print_r($classData);
			$sectionArr = [];
			foreach($qr->result_array() as $val){
				echo $val['batch_id'].'</br>';
				//$sectionArr = [];
				$this->db->from('move_students');
				$this->db->join('classes', 'classes.id = move_students.next_class_id');
				//$this->db->where('move_students.batch_id', $val['batch_id']);
				$this->db->where('classes.id', $val['next_class_id']);
				$this->db->where('move_students.status', 1);
				$qr = $this->db->where('move_students.current_session_id', $this->current_session)->get();
				$classes = $qr->row_array();
				echo "<pre>";print_r($classes);
				$this->db->from('classes');
				$this->db->where('session_id',  $classes['next_session_id']);
				$this->db->where('class', $classes['class']);
				$query = $this->db->get();
				if($query->num_rows() == 0)
				{
					$this->db->select('sections.section')->from('class_sections');
					$this->db->join('sections', 'sections.id = class_sections.section_id');
					$this->db->where('class_sections.class_id', $classes['next_class_id']);
					$qr = $this->db->get();
					$sectionData = $qr->result_array();
					foreach($sectionData as $sec)
					{
						if($sec['section'] != $section_name)
						{
							$data = array(
								'section' => $sec['section'],
								'session_id' => $classes['next_session_id'],
							);
							$section_id = $this->section_model->add($data);
							$sectionArr[] = $section_id;
							$section_name = $sec['section'];
						}
					}
					//echo "<pre>";print_r($sectionData);die;
					//echo $classData['class'].'->'.$sectionData['section']."</br>";
					//echo "<pre>";print_r($sectionArr);
					
					$class_array = array(
						'class' => $classes['class'],
						'session_id' => $classes['next_session_id'],
					);
					$sections = $sectionArr;
					$this->classsection_model->add($class_array, $sections);
				}
				else{
					echo 'yes';
				}
				
				//echo $classes['next_class_id'].'->';
			}
		}
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
