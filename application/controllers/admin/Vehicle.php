<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle extends Admin_Controller {

    function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {

        if (!$this->rbac->hasPrivilege('add_vehicles', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehicle/index');
        $data['title'] = 'Add Vehicle';
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        //$this->form_validation->set_rules('vehicle_no', $this->lang->line('vehicle_no'), 'trim|required|xss_clean');
		$this->form_validation->set_rules(
			'vehicle_no',
			$this->lang->line('vehicle_no'),
			'trim|required|xss_clean|callback_check_data_unique'
		);
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/index', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');


            $data = array(
				'session_id' => $this->current_session,
                'vehicle_no' => $this->input->post('vehicle_no'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );

            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/vehicle/index');
        }
    }

    function edit($id) {

        if (!$this->rbac->hasPrivilege('add_vehicles', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Vehicle';
        $data['id'] = $id;
        $editvehicle = $this->vehicle_model->get($id);
		
		if(!$editvehicle)
		{
			redirect('admin/vehicle/index');
		}

        $data['editvehicle'] = $editvehicle;
        $listVehicle = $this->vehicle_model->get();
		
        $data['listVehicle'] = $listVehicle;
       // $this->form_validation->set_rules('vehicle_no', $this->lang->line('vehicle_no'), 'trim|required|xss_clean');
		$this->form_validation->set_rules(
			'vehicle_no',
			$this->lang->line('vehicle_no'),
			'trim|required|xss_clean|callback_check_data_unique[' . $id . ']'
		);
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');
            $data = array(
                'id' => $this->input->post('id'),
				'session_id' => $this->current_session,
                'vehicle_no' => $this->input->post('vehicle_no'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );
            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/vehicle/index');
        }
    }

    function delete($id) {

        if (!$this->rbac->hasPrivilege('add_vehicles', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
		
		// by ES 
		$checkData['menu'] = 'addvehicle';
		$checkData['table'] = 'vehicle_routes';
		$checkData['id'] = $id;
		$checkData['field'] = 'vehicle_id';
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		
		if($ifsection > 0)
		{
			$this->session->set_flashdata('editmsg', '<div class="alert alert-danger text-left">Vehicle already assign in route</div>');
		}
		else{
			$this->vehicle_model->remove($id);
			$this->session->set_flashdata('editmsg', '<div class="alert alert-success text-left">Vehicle deleted successfully</div>');
		}
		
        //$this->vehicle_model->remove($id);
        redirect('admin/vehicle/index');
    }
	/**
	* Custom validation callback to check uniqueness
	*/
	public function check_data_unique($data, $id)
	{
		$exists = $this->vehicle_model->data_exists($data, $id);

		if ($exists) {
			$this->form_validation->set_message('check_data_unique', 'Record already exists');
			return false;
		} else {
			return true;
		}
	}

}

?>