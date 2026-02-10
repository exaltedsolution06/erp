<?php

class Module extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("module_model");
    }

    function index() {

        if (!$this->rbac->hasPrivilege('modules', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'System Settings/module');
        $permissionlist = $this->module_model->getPermission();
        $data["permissionList"] = $permissionlist;
        $studentpermissionList = $this->module_model->getStudentPermission();
        $data["studentpermissionList"] = $studentpermissionList;
        $parentpermissionList = $this->module_model->getParentPermission();
        $data["parentpermissionList"] = $parentpermissionList;
        $this->load->view("layout/header");
        $this->load->view("setting/permission", $data);
        $this->load->view("layout/footer");
    }

    public function changeStatus() {
		if (!$this->rbac->hasPrivilege('modules', 'can_edit')) {
			$response = array('status' => 2, 'msg' => 'Permission denied');
            echo json_encode($response);
        }else{
			$id = $this->input->post("id");
			$status = $this->input->post("status");

			if (!empty($id)) {

				$data = array('id' => $id, 'is_active' => $status);
				$result = $this->module_model->changeStatus($data);
				$response = array('status' => 1, 'msg' => 'Status change successfully');
				echo json_encode($response);
			}
        }
    }

    public function changeParentStatus() {
		if (!$this->rbac->hasPrivilege('modules', 'can_edit')) {
			$response = array('status' => 2, 'msg' => 'Permission denied');
            echo json_encode($response);
        }else{
			$id = $this->input->post("id");
			$status = $this->input->post("status");

			if (!empty($id)) {

				$data = array('id' => $id, 'is_active' => $status);
				$result = $this->module_model->changeParentStatus($data);


				$response = array('status' => 1, 'msg' => 'Status change successfully');
				echo json_encode($response);
			}
        }
    }

    public function changeStudentStatus() {
		if (!$this->rbac->hasPrivilege('modules', 'can_edit')) {
			$response = array('status' => 2, 'msg' => 'Permission denied');
            echo json_encode($response);
        }else{
			$id = $this->input->post("id");
			$status = $this->input->post("status");
			$role = $this->input->post('role');
			if (!empty($id)) {

				$data = array('id' => $id, $role => $status);
				$result = $this->module_model->changeStudentStatus($data);


				$response = array('status' => 1, 'msg' => 'Status change successfully');
				echo json_encode($response);
			}
        }
    }

}

?>