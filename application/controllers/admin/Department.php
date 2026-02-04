<?php

class Department extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper('file');
        $this->config->load("payroll");
        $this->load->model('department_model');
        $this->load->model('staff_model');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    function department() {
		if (!$this->rbac->hasPrivilege('department', 'can_view')) {
			access_denied();
		}
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/department/department');

        $departmenttypeid = $this->input->post("departmenttypeid");
        $DepartmentTypes = $this->department_model->getDepartmentType();
		
        $data["departmenttype"] = $DepartmentTypes;
        $this->form_validation->set_rules(
                'type', $this->lang->line('name'), array('required',
            array('check_exists', array($this->department_model, 'valid_department'))
                )
        );
        $data["title"] = $this->lang->line('add') . " " . $this->lang->line('department');
        if ($this->form_validation->run()) {

            $type = $this->input->post("type");
            $departmenttypeid = $this->input->post("departmenttypeid");
            $status = $this->input->post("status");
            if (empty($departmenttypeid)) {

                if (!$this->rbac->hasPrivilege('department', 'can_add')) {
                    access_denied();
                }
            } else {

                if (!$this->rbac->hasPrivilege('department', 'can_edit')) {
                    access_denied();
                }
				$data["type"] = 'edit';
            }
            if (!empty($departmenttypeid)) {
                $data = array('department_name' => $type, 'is_active' => 'yes', 'id' => $departmenttypeid, 'session_id'=> $this->current_session);
            } else {

                $data = array('department_name' => $type, 'is_active' => 'yes', 'session_id'=> $this->current_session);
            }
            $insert_id = $this->department_model->addDepartmentType($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
            redirect("admin/department/department");
        } else {
            $this->load->view("layout/header");
            $this->load->view("admin/staff/departmentType", $data);
            $this->load->view("layout/footer");
        }
    }

    function departmentedit($id) {
		if (!$this->rbac->hasPrivilege('department', 'can_edit')) {
			access_denied();
		}
        $result = $this->department_model->getDepartmentType($id);
		if(!$result)
		{
			redirect('admin/department/department');
		}

        $data["result"] = $result;
        $data["title"] = $this->lang->line('edit') . " " . $this->lang->line('department');
        $departmentTypes = $this->department_model->getDepartmentType();
        $data["departmenttype"] = $departmentTypes;
        $this->load->view("layout/header");
        $this->load->view("admin/staff/departmentType", $data);
        $this->load->view("layout/footer");
    }

    function departmentdelete($id) {
		if (!$this->rbac->hasPrivilege('department', 'can_delete')) {
			access_denied();
		}
		// by ES
		$checkData['menu'] = 'staff';		
		$checkData['table'] = 'staff';
		$checkData['id'] = $id;
		$checkData['field'] = 'department';
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		
		if($ifsection > 0)
		{
			$this->session->set_flashdata('editmsg', '<div class="alert alert-danger text-left">Department already added with staff</div>');
		}
		else{
			$this->department_model->deleteDepartment($id);
			$this->session->set_flashdata('editmsg', '<div class="alert alert-success text-left">Department deleted successfully</div>');
		}
        redirect('admin/department/department');
    }

}

?>