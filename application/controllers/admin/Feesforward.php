<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feesforward extends Admin_Controller {

    protected $balance_group;
    protected $balance_type;
    protected $setting_result;

    function __construct() {
        parent::__construct();
        $this->load->config('ci-blog');
        $this->load->model('Receipt_model');
        $this->balance_group = $this->config->item('ci_balance_group');
        $this->balance_type = $this->config->item('ci_balance_type');

        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('previous_session_balance', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'feesforward/index');
        $data['title'] = 'Add Feesforward';
        $data['title_list'] = 'Recent FeeType';
        $class = $this->class_model->get();
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['classlist'] = $class;
        $action = $this->input->post('action');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $setting_result = $this->setting_model->get();
            $current_session = $setting_result[0]['session_id'];
            $data['current_session'] = $current_session;
            $pre_session = $this->session_model->getPreSession($current_session);
			
            $data['pre_session'] = $pre_session;
            //=========date==============
            $fees_due_days = $setting_result[0]['fee_due_days'];
            if ($fees_due_days > 0 && $fees_due_days != "") {

                $due_date = date('Y-m-d', strtotime('+' . $fees_due_days . ' day'));
                $data['due_date_formated'] = date($setting_result[0]['date_format'], $this->customlib->dateYYYYMMDDtoStrtotime($due_date));
            } else {

                $due_date = date('Y-m-d');
                $data['due_date_formated'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($due_date));
            }
			$due_date = date('Y-m-d');
                $data['due_date_formated'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($due_date));

            //========================
            if ($action == 'search') {
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'required');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'required');
                if ($this->form_validation->run() == TRUE) {
                    $data['student_due_fee'] = array();
                    if (!empty($pre_session)) {
                        $student_Array = json_decode($this->findPreviousBalanceFees($pre_session->id, $class_id, $section_id, $current_session));
						// echo '<pre>'; print_r($this->findPreviousBalanceFees($pre_session->id, $class_id, $section_id, $current_session)); echo '</pre>';exit;
						
                        $data['student_due_fee'] = $student_Array->student_Array;
                        $data['is_update'] = $student_Array->is_update;
                    }
                }
            } else if ($action == 'fee_submit') {
				if (!$this->rbac->hasPrivilege('previous_session_balance', 'can_edit')) {
					access_denied();
				}
                $student_Array = json_decode($this->findPreviousBalanceFees($pre_session->id, $class_id, $section_id, $current_session));

                $data['student_due_fee'] = $student_Array->student_Array;
                $data['is_update'] = $student_Array->is_update;
                $this->form_validation->set_rules('due_date', $this->lang->line('date'), 'required');
                $counter = $this->input->post('student_counter');
                if ($this->form_validation->run() == TRUE) {

                    $due_date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('due_date')));
                    // $student_data = array();
                    /*foreach ($counter as $count_key => $count_value) {
                        $student_array = array();
                        $student_array['student_session_id'] = $this->input->post('student_sesion[' . $count_value . ']');
                        $student_array['amount'] = $this->input->post('amount[' . $count_value . ']');
                        $student_array['is_system'] = 1;
                        $student_array['fee_session_group_id'] = 0;
                        $student_data[] = $student_array;
                    }
                    $student_due_fee = $this->studentfeemaster_model->addPreviousBal($student_data, $due_date);*/
                    foreach ($counter as $count_key => $count_value) {
                        $student_array = array();
                        $student_array['id'] = $this->input->post('student_id[' . $count_value . ']');
                        $student_array['amount'] = $this->input->post('amount[' . $count_value . ']');
                        $student_array['is_system'] = 1;
						$student_due_fee = $this->studentfeemaster_model->update_student_fees_master($student_array);
                        // $student_data[] = $student_array;
						
						$amount = (float) str_replace(
							',',
							'',
							$this->input->post('amount[' . $count_value . ']')
						);

						$rec_amount = (float) str_replace(
							',',
							'',
							$this->input->post('rec_amount[' . $count_value . ']')
						);
						$this->Receipt_model->update_student_prev_bal($this->input->post('student_sesion[' . $count_value . ']'),($amount - $rec_amount));
                    }


                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('admin/feesforward');
                }
            }
        }


        $this->load->view('layout/header', $data);
        $this->load->view('admin/feesforward/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function findPreviousBalanceFees($session_id, $class_id, $section_id, $current_session) {

        $studentlist = $this->student_model->getPreviousSessionStudent($session_id, $class_id, $section_id);
// return $studentlist;
        $is_update = false;
        $student_Array = array();
        if (!empty($studentlist)) {
            $student_comma_seprate = array();

            foreach ($studentlist as $student_list_key => $student_list_value) {
               if(isset($student_list_value->previous_student_session_id) && $student_list_value->previous_student_session_id != ''){
                $obj = new stdClass();
                $obj->name = $this->customlib->getFullName($student_list_value->firstname,$student_list_value->middlename,$student_list_value->lastname,$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname);
                $obj->admission_no = $student_list_value->admission_no;
                $obj->roll_no = $student_list_value->roll_no;
                $obj->father_name = $student_list_value->father_name;
                $obj->mother_name = $student_list_value->mother_name;
                $obj->student_session_id = $student_list_value->current_student_session_id;
                $obj->student_previous_session_id = $student_list_value->previous_student_session_id;
                $obj->student_class = $student_list_value->class;
                $obj->student_section = $student_list_value->section;
                // $obj->id = $student_list_value->id;
               
                if (strtotime($student_list_value->admission_date) == 0) {
                    $obj->admission_date = "";
                } else {
                    $obj->admission_date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($student_list_value->admission_date));
                }


                $student_Array[] = $obj;
                $student_comma_seprate[] = $student_list_value->current_student_session_id;
			   }
            }

            $student_session_array = "(" . implode(",", $student_comma_seprate) . ")";
            $record_exists = $this->studentfeemaster_model->getBalanceMasterRecord($this->balance_group, $student_session_array);

            if (!empty($record_exists)) {
                $is_update = true;
                foreach ($student_Array as $stkey => $eachstudent) {

                    $eachstudent->balance = $this->findValueExists($record_exists, $eachstudent->student_session_id);
                    $eachstudent->rec_balance = $this->findRecValue($eachstudent->student_previous_session_id);
                    $eachstudent->disc_amt = $this->findDiscValue($eachstudent->student_previous_session_id);
					$eachstudent->id = $this->findIdExists($record_exists, $eachstudent->student_session_id);
                }
            } else {
                foreach ($student_Array as $stkey => $eachstudent) {


                    //==========================
                    $student_total_fees = array();
                    if ($eachstudent->student_previous_session_id != "") {

                        $student_total_fees = $this->studentfeemaster_model->getPreviousStudentFees($eachstudent->student_previous_session_id);
                    }

                    if (!empty($student_total_fees)) {
                        $totalfee = 0;
                        // $totalPrevfee = 0;
                        $deposit = 0;
                        $discount = 0;
                        $balance = 0;
                        foreach ($student_total_fees as $student_total_fees_key => $student_total_fees_value) {
                            if (!empty($student_total_fees_value->fees)) {
                                foreach ($student_total_fees_value->fees as $each_fee_key => $each_fee_value) {
                                    $totalfee = $totalfee + $each_fee_value->amount;
                                    // $totalPrevfee = $totalPrevfee + $each_fee_value->previous_session_balance;

                                    $amount_detail = json_decode($each_fee_value->amount_detail);
                                    if ($amount_detail != null) {
                                        foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                                            $deposit = $deposit + $amount_detail_value->amount;
                                            $discount = $discount + $amount_detail_value->amount_discount;
                                        }
                                    }
                                }
                            }
                        }

                        $eachstudent->balance = $totalfee - ($deposit + $discount);
                        // $eachstudent->prev_balance = $totalPrevfee;
						$eachstudent->rec_balance = $this->findRecValue($eachstudent->student_previous_session_id);
						$eachstudent->disc_amt = $this->findDiscValue($eachstudent->student_previous_session_id);
                        $eachstudent->id = $student_total_fees_value->id;
                    } else {
                        $eachstudent->balance = "0";
                        $eachstudent->prev_balance = "0";
                    }
                    //===================
                }
// echo '<pre>'; print_r($student_Array);exit;
            }
        }

        return json_encode(array('student_Array' => $student_Array, 'is_update' => $is_update));
    }

    function findValueExists($array, $find) {
        $amount = 0;
        foreach ($array as $x => $x_value) {
            if ($x_value->student_session_id == $find)
                return $x_value->amount;
        }
        return $amount;
    }
    function findIdExists($array, $find) {
        $amount = 0;
        foreach ($array as $x => $x_value) {
            if ($x_value->student_session_id == $find)
                return $x_value->id;
        }
        return $amount;
    }

    function findPrevValueExists($array, $find) {
        $previous_session_balance = 0;
        foreach ($array as $x => $x_value) {
            if ($x_value->student_session_id == $find)
                return $x_value->previous_session_balance;
        }
        return $previous_session_balance;
    }
    function findRecValue($student_previous_session_id) {
        $total = $this->db
			->select_sum('amount')
			->where('previous_student_session_id', $student_previous_session_id)
			->where('status', 1)
			->get('received_previous_balance')
			->row()
			->amount;
        return $total;
    }
    function findDiscValue($student_previous_session_id) {
        $total = $this->db
			->select_sum('discount')
			->where('previous_student_session_id', $student_previous_session_id)
			->where('status', 1)
			->get('received_previous_balance')
			->row()
			->discount;
        return $total;
    }

}
