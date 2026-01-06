<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Changesessions extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }
	public function generateCode($length = 6) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		return substr(str_shuffle($chars), 0, $length);
	}
    public function index()
    {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'move_students');
        $data['title']       = 'Session List';
		$class_result      = $this->class_model->getAll();
        $data['classlist'] = $class_result;
        $session_result      = $this->session_model->getAllSession();
        $data['sessionlist'] = $session_result;
        $batch_id      = $this->session_model->getbatch_id();
		if($batch_id != ''){			
			$data['batch_id'] = $batch_id;
		}else{
			$data['batch_id'] = $this->generateCode();
		}
		$data['feegroupList'] = $this->feegroup_model->get();
        $data['addedListData'] = $this->session_model->addedListData();
        $data['addedListCatData'] = $this->session_model->addedListCatData();
        $this->load->view('layout/header', $data);
        $this->load->view('session/changeSession', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add_list()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('current_class_id', $this->lang->line('class'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('next_session_id', $this->lang->line('session'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('next_class_id', $this->lang->line('class'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $errors = array(
                'current_class_id' => form_error('current_class_id'),
                'next_session_id' => form_error('next_session_id'),
                'next_class_id' => form_error('next_class_id'),
            );
            echo json_encode(array('status' => 'fail', 'msg' => $errors));
        } else {
			$added_exists = $this->session_model->getAddedListExists($this->input->post('current_class_id'));
			// echo $added_exists;exit;
			if($added_exists){
				echo json_encode(array('status' => 'added_in_list', 'msg' => 'Class already added in list.'));
			}else{
				$data_new = array(
					'batch_id' => $this->input->post('batch_id'),
					'current_session_id' => $this->current_session,
					'current_class_id' => $this->input->post('current_class_id'),
					'next_session_id' => $this->input->post('next_session_id'),
					'next_class_id' => $this->input->post('next_class_id'),
					'status' => 0,
				);
				$insert = $this->session_model->add_to_list($data_new);
				if($insert){
					echo json_encode(array('status' => 'success', 'msg' => 'Class data added to list.'));
				}
			}
		}
    }
    public function add_list_category()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('current_category_id', $this->lang->line('category'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('next_category_id', $this->lang->line('category'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $errors = array(
                'current_category_id' => form_error('current_category_id'),
                'next_category_id' => form_error('next_category_id'),
            );
            echo json_encode(array('status' => 'fail', 'msg' => $errors));
        } else {
			$added_exists = $this->session_model->getAddedCategoryExists($this->input->post('current_category_id'));
			if($added_exists){
				echo json_encode(array('status' => 'added_in_list', 'msg' => 'Category already added in list.'));
			}else{
				$data_new = array(
					'batch_id' => $this->input->post('batch_id'),
					'current_session_id' => $this->current_session,
					'current_category_id' => $this->input->post('current_category_id'),
					'next_category_id' => $this->input->post('next_category_id'),
					'status' => 0,
				);
				$insert = $this->session_model->add_to_list_category($data_new);
				if($insert){
					echo json_encode(array('status' => 'success', 'msg' => 'Category data added to list.'));
				}
			}
		}
    }
    public function transfer_batch()
    {
		$discontinue = $this->input->post('discontinue_next_session');
		$carry_zero  = $this->input->post('carry_zero_balance');
	
        $list_exists = $this->session_model->getTransferStudentExists();
		if($list_exists){
			$update = $this->session_model->transfer_batch_next_session($discontinue, $carry_zero);
			if($update){
				echo json_encode(array('status' => 'success', 'msg' => 'Transfer batch to next session set to Cronjob successfully.'));
			}			
		}else{
			echo json_encode(array('status' => 'no_added_list', 'msg' => 'No class added in list.'));
		}
    }
	public function delete_list($id)
    {
        $this->session_model->remove_list($id);
        redirect('changesessions');
    }
	public function delete_list_category($id)
    {
        $this->session_model->remove_list_category($id);
        redirect('changesessions');
    }

}
