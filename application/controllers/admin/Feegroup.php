<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FeeGroup extends Admin_Controller {

    function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/feegroup');
        $data['title'] = 'Add FeeGroup';
        $data['title_list'] = 'Recent FeeGroups';

        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists'))
                )
        );
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'session_id' => $this->current_session,
            );
            $this->feegroup_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/feegroup/index');
        }
        $feegroup_result = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup_result;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feegroup/feegroupList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
		
		
		// by ES
		$checkData['menu'] = 'feecategory';		
		$checkData['table'] = 'student_session';
		$checkData['id'] = $id;
		$checkData['field'] = 'fee_category_id';
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		
		if($ifsection > 0)
		{
			$this->session->set_flashdata('editmsg', '<div class="alert alert-danger text-left">Category already used in student</div>');
		}
		else{
			 $this->feegroup_model->remove($id);
			 $this->session->set_flashdata('editmsg', '<div class="alert alert-success text-left">Category deleted successfully</div>');
		}
		
        //$this->feegroup_model->remove($id);
        redirect('admin/feegroup/index');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feegroup');
        $data['id'] = $id;
        $feegroup = $this->feegroup_model->get($id);
		if(!$feegroup){
			redirect('admin/feegroup/index');
		}
        $data['feegroup'] = $feegroup;
        $feegroup_result = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/feegroup/feegroupEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
            );
            $this->feegroup_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/feegroup/index');
        }
    }

}

?>