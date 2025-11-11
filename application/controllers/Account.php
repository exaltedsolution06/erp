<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'account/index');
        $data['title'] = 'Account List';

        $section_result      = $this->account_model->get();
        $data['sectionlist'] = $section_result;
       
        //$this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
		$this->form_validation->set_rules(
			'section',
			$this->lang->line('section'),
			'trim|required|xss_clean|callback_check_data_unique'
		);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('account/accountList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'account' => $this->input->post('section'),
            );
            $this->account_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('account/index');
        }
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('section', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Section List';
        $section         = $this->account_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('section/sectionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        $data['title'] = 'Section List';
        $this->account_model->remove($id);
        redirect('account/index');
    }

    public function getByClass()
    {
        $class_id = $this->input->get('class_id');
        $data     = $this->account_model->getClassBySection($class_id);
        echo json_encode($data);
    }

    public function getClassTeacherSection()
    {
        $class_id = $this->input->get('class_id');
        $data     = array();
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            $id    = $userdata["id"];
            $query = $this->db->where("staff_id", $id)->where("class_id", $class_id)->get("class_teacher");

            if ($query->num_rows() > 0) {

                $data = $this->account_model->getClassTeacherSection($class_id);
            } else {

                $data = $this->account_model->getSubjectTeacherSection($class_id, $id);
            }
        } else {
            $data = $this->account_model->getClassBySection($class_id);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
     
        $data['title']       = 'Section List';
        $section_result      = $this->account_model->get();
        $data['sectionlist'] = $section_result;
        $data['title']       = 'Edit Section';
        $data['id']          = $id;
        $section             = $this->account_model->get($id);
        $data['section']     = $section;
       
        //$this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
		$this->form_validation->set_rules(
			'section',
			$this->lang->line('section'),
			'trim|required|xss_clean|callback_check_data_unique[' . $id . ']'
		);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('account/accountEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'      => $id,
                'account' => $this->input->post('section'),
            );
            $this->account_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('account/index');
        }
    }
	/**
	* Custom validation callback to check section name uniqueness
	*/
	public function check_data_unique($data, $id)
	{
		$exists = $this->account_model->data_exists($data, $id);

		if ($exists) {
			$this->form_validation->set_message('check_data_unique', 'Record already exists');
			return false;
		} else {
			return true;
		}
	}

}
