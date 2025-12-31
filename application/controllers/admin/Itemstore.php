<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Itemstore extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');

        $this->load->helper('url');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('store', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Inventory');
        $this->session->set_userdata('sub_menu', 'itemstore/index');
        $data['title'] = 'Item Store List';
        $itemstore_result = $this->itemstore_model->get();
        $data['itemstorelist'] = $itemstore_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/itemstore/itemstoreList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('store', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Item Store List';
		
		$checkData['menu'] = 'itemstore'; 
		$checkData['table'] = 'item_stock';
		$checkData['id'] = $id;
		$checkData['field'] = 'store_id';
		$checkData['session_id'] = $this->current_session;
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		if($ifsection > 0)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Item store already used in Stock</div>');
		}
		else{
			$this->itemstore_model->remove($id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
		}
        //$this->itemstore_model->remove($id);
        redirect('admin/itemstore/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('store', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Item store';
        $itemstore_result = $this->itemstore_model->get();
        $data['itemstorelist'] = $itemstore_result;

        $this->form_validation->set_rules('name', $this->lang->line('item_store_name'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/itemstore/itemstoreList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'item_store' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
                'session_id' => $this->current_session,
            );
			
            $check = $this->itemstore_model->add($data);
			
			if($check)
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
			}
			else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Stock name and code already exists</div>');
			}
			
            redirect('admin/itemstore/index');
        }
    }

    function edit($id) {

        if (!$this->rbac->hasPrivilege('store', 'can_edit')) {
            access_denied();
        }

        $data['title'] = 'Edit Item Store';
        $itemstore_result = $this->itemstore_model->get();
        $data['itemstorelist'] = $itemstore_result;
        $data['id'] = $id;
        $store = $this->itemstore_model->get($id);
		if(!$store)
		{
			redirect('admin/itemstore/index');
		}
		
        $data['itemstore'] = $store;

        $this->form_validation->set_rules('name', $this->lang->line('item_store_name'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/itemstore/itemstoreEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'item_store' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
            );
            $this->itemstore_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/itemstore/index');
        }
    }

}

?>