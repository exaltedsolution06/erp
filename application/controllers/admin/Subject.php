<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'Academics/subject');
        $data['title'] = 'Add subject';
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        $data['subject_types'] = $this->customlib->subjectType();
        $data['subject_types_one'] = $this->customlib->subjectTypeOne();
        // $this->form_validation->set_rules('name', $this->lang->line('subject_name'), 'trim|required|xss_clean|callback__check_name_exists');
        $this->form_validation->set_rules('name', $this->lang->line('subject_name'), 'trim|required|xss_clean|callback__check_unique_subject');
        $this->form_validation->set_rules('type', $this->lang->line('type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('type_one', $this->lang->line('subject_type_one'), 'trim|required|xss_clean');
        if ($this->input->post('code')) {
            $this->form_validation->set_rules('code', $this->lang->line('code'), 'trim|required|callback__check_code_exists');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'type' => $this->input->post('type'),
                'type_one' => $this->input->post('type_one'),
				'session_id' => $this->current_session
            );
            $this->subject_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/subject/index');
        }
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
        $subject = $this->subject_model->get($id);
        $data['subject'] = $subject;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/subjectShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('subject', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
		
		// by ES 
		$checkData['menu'] = 'addsubject';
		$checkData['table'] = 'subject_group_subjects';
		$checkData['id'] = $id;
		$checkData['field'] = 'subject_id';
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		
		if($ifsection > 0)
		{
			$this->session->set_flashdata('editmsg', '<div class="alert alert-danger text-left">Subject already used in subject group</div>');
		}
		else{
			 $this->subject_model->remove($id);
			$this->session->set_flashdata('editmsg', '<div class="alert alert-success text-left">Subject deleted successfully</div>');
		}
		
        //$this->subject_model->remove($id);
        redirect('admin/subject/index');
    }

    function _check_name_exists() {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->subject_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', $this->lang->line('name_already_exists'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _check_code_exists() {
        $data['code'] = $this->security->xss_clean($this->input->post('code'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code_exists', $this->lang->line('code_already_exists'));
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	public function _check_unique_subject() {
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$type_one = $this->input->post('type_one');

		$exists = $this->subject_model->check_combination_exists($name, $type, $type_one);

		if ($exists) {
			$this->form_validation->set_message('_check_unique_subject', $this->lang->line('sub_already_exists'));
			return FALSE;
		}

		return TRUE;
	}
	public function _check_unique_subject_edit($name, $id) {
		$type = $this->input->post('type');
		$type_one = $this->input->post('type_one');

		$exists = $this->subject_model->check_combination_exists_edit($name, $type, $type_one, $id);

		if ($exists) {
			$this->form_validation->set_message('_check_unique_subject_edit', $this->lang->line('sub_already_exists'));
			return FALSE;
		}
		return TRUE;
	}



    function edit($id) {
        if (!$this->rbac->hasPrivilege('subject', 'can_edit')) {
            access_denied();
        }
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        $data['title'] = 'Edit Subject';
        $data['id'] = $id;
        $subject = $this->subject_model->get($id);
		if(!$subject)
		{
			redirect('admin/subject/index');
		}
        $data['subject'] = $subject;
        $data['subject_types'] = $this->customlib->subjectType();
        $data['subject_types_one'] = $this->customlib->subjectTypeOne();
        // $this->form_validation->set_rules('name', $this->lang->line('subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules(
			'name',
			$this->lang->line('subject'),
			'trim|required|xss_clean|callback__check_unique_subject_edit['.$id.']'
		);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'type' => $this->input->post('type'),
                'type_one' => $this->input->post('type_one'),
				'session_id' => $this->current_session
            );
            $this->subject_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/subject/index');
        }
    }

    function getSubjctByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $date = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($data);
    }

}

?>