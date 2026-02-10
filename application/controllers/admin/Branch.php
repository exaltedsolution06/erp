<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Branch extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('add_branch', 'can_view')) {
            access_denied();
        }
		
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/branch/index');
        $data['title'] = 'Branch List';

        $branch_result      = $this->branch_model->get();
        $data['branchlist'] = $branch_result;
		
		$this->form_validation->set_rules('branch_name', $this->lang->line('branch_name'), 'trim|required|xss_clean|callback_check_data_unique');
		$this->form_validation->set_rules('branch_url', $this->lang->line('branch_url'), 'trim|required|xss_clean');
		/*$this->form_validation->set_rules('db_host', $this->lang->line('db_host'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_name', $this->lang->line('db_name'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_username', $this->lang->line('db_username'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_password', $this->lang->line('db_password'), 'trim|required|xss_clean');*/


        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/branch/branchList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'branch_name' => $this->input->post('branch_name'),
                'branch_url' => $this->input->post('branch_url'),
                /*'db_host' => $this->input->post('db_host'),
                'db_name' => $this->input->post('db_name'),
                'db_username' => $this->input->post('db_username'),
                'db_password' => $this->input->post('db_password'),*/
            );
            $this->branch_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/branch/index');
        }
    }
	
    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('add_branch', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'branch List';
		
		$this->branch_model->remove($id);
		
        redirect('admin/branch/index');
    }
	
    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('add_branch', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('sub_menu', 'admin/branch/index');
		
        $data['title']       = 'Branch List';
        $branchlist      = $this->branch_model->get();
        $data['branchlist'] = $branchlist;
        $data['title']       = 'Edit Branch';
        $data['id']          = $id;
        $branch             = $this->branch_model->get($id);
        $data['branch']     = $branch;
		$this->form_validation->set_rules('branch_name', $this->lang->line('branch_name'), 'trim|required|xss_clean|callback_check_data_unique[' . $id . ']');
		$this->form_validation->set_rules('branch_url', $this->lang->line('branch_url'), 'trim|required|xss_clean');
		/*$this->form_validation->set_rules('db_host', $this->lang->line('db_host'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_name', $this->lang->line('db_name'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_username', $this->lang->line('db_username'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('db_password', $this->lang->line('db_password'), 'trim|required|xss_clean');*/
		
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/branch/branchEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'      => $id,
                'branch_name' => $this->input->post('branch_name'),
                'branch_url' => $this->input->post('branch_url'),
                /*'db_host' => $this->input->post('db_host'),
                'db_name' => $this->input->post('db_name'),
                'db_username' => $this->input->post('db_username'),
                'db_password' => $this->input->post('db_password'),*/
            );
            $this->branch_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/branch/index');
        }
    }
	
	/**
	* Custom validation callback to check section name uniqueness
	*/
	public function check_data_unique($data, $id)
	{
		$exists = $this->branch_model->section_exists($data, $id);

		if ($exists) {
			$this->form_validation->set_message('check_data_unique', 'Record already exists');
			return false;
		} else {
			return true;
		}
	}

	public function switch_branch()
	{
		if (!$this->rbac->hasPrivilege('switch_branch', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('branch_switch', true);
		$url = $this->input->post('branch');
		redirect($url.'/site/login');
	}


}
