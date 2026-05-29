<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ticket extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ticket_model");
    }

    public function index($id = null)
	{
		if (!$this->rbac->hasPrivilege('create_ticket', 'can_view')) {
			access_denied();
		}

		$this->session->set_userdata('top_menu', 'Ticket');
		$this->session->set_userdata('sub_menu', 'Ticket/create');

		$data['title'] = 'Ticket List';

		$setting_result = $this->setting_model->getSetting();

		// ticket types
		$ticket_api_url = CRM_URL . 'api/Ticket/get_ticket_type/' . $setting_result->domain_api_key;
		$api_data = call_api_get($ticket_api_url);
		$data['ticket_type'] = $api_data['data'];

		// ticket list
		$list_url = CRM_URL . 'api/Ticket/ticket_list/' . $setting_result->domain_api_key;
		$ticket_result = call_api_get($list_url);
		$data['ticketlist'] = $ticket_result['data'];
		
		// Domain Data
		$domain_api_url = CRM_URL .'api/Domain/get_domain_data/'.$setting_result->domain_api_key; 
		$api_data = call_api_get($domain_api_url);
		$data['domain_api_data'] = $api_data['data'];
		// print_r($data['domain_api_data']);exit;

		// default edit data
		$data['edit_ticket'] = [];

		// if edit mode
		if ($id) {

			$details_url = CRM_URL . 'api/Ticket/ticket_details/' . $id;

			$ticket = call_api_get($details_url);

			$data['edit_ticket'] = $ticket['data'];
		}

		// validation
		$this->form_validation->set_rules('ticket_type', 'Ticket Type', 'required');
		$this->form_validation->set_rules('ticket_subject', 'Ticket Subject', 'required');
		$this->form_validation->set_rules('ticket_body', 'Ticket Body', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('layout/header', $data);
			$this->load->view('ticket/ticketList', $data);
			$this->load->view('layout/footer', $data);

		} else {

			$postData = [
				'school_id' => $this->input->post('school_id'),
				'school_code_id' => $this->input->post('school_code_id'),
				'school_name' => $this->input->post('school_name'),
				'ticket_type' => $this->input->post('ticket_type'),
				'subject'     => $this->input->post('ticket_subject'),
				'body'        => $this->input->post('ticket_body')
			];

			// EDIT
			if ($id) {

				$update_url = CRM_URL . 'api/Ticket/update_ticket/' . $id;

				call_api_post_with_file($update_url, $postData, $_FILES);

				$this->session->set_flashdata(
					'msg',
					'<div class="alert alert-success">Ticket Updated Successfully</div>'
				);

			} else {

				// CREATE
				$create_url = CRM_URL . 'api/Ticket/create_ticket';

				call_api_post_with_file($create_url, $postData, $_FILES);

				$this->session->set_flashdata(
					'msg',
					'<div class="alert alert-success">Ticket Created Successfully</div>'
				);
			}

			redirect('ticket/index');
		}
	}

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('create_ticket', 'can_view')) {
            access_denied();
        }
        $data['title']    = 'Ticket List';
        
		$setting_result = $this->setting_model->getSetting();
		
		// ticket types
		$ticket_api_url = CRM_URL . 'api/Ticket/get_ticket_type/' . $setting_result->domain_api_key;
		$api_data = call_api_get($ticket_api_url);
		$data['ticket_type'] = $api_data['data'];
		
		// ticket list
		$list_url = CRM_URL . 'api/Ticket/ticket_details/' . $id;
		$ticket_result = call_api_get($list_url);
		$data['ticket'] = $ticket_result['data'];
		// echo '<pre>';print_r($data['ticket']);exit;
		
        $this->load->view('layout/header', $data);
        $this->load->view('ticket/ticketShow', $data);
        $this->load->view('layout/footer', $data);
    }
	public function add_followup()
	{
		$post = $this->input->post();

		$api_url = CRM_URL . 'api/Ticket/save_followup';

		$postFields = [
			'id'        => $post['id'],
			'ticket_id' => $post['ticket_id'],
			'message'   => $post['message'],
			'user_type' => 1,
			'old_image' => $post['old_image']
		];

		if (!empty($_FILES['followup_image']['tmp_name'])) {

			$postFields['followup_image'] = new CURLFile(
				$_FILES['followup_image']['tmp_name'],
				$_FILES['followup_image']['type'],
				$_FILES['followup_image']['name']
			);
		}

		$response = call_api_post($api_url, $postFields);
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Followup saved Successfully</div>');
		echo json_encode($response);
	}

	public function get_followup()
	{
		$id = $this->input->post('id');

		$api_url = CRM_URL . 'api/Ticket/get_followup/'.$id;

		$response = call_api_get($api_url);

		echo json_encode($response['data']);
	}

	public function delete_followup()
	{
		$id = $this->input->post('id');

		$api_url = CRM_URL . 'api/Ticket/delete_followup/'.$id;

		$response = call_api_get($api_url);
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Followup deleted Successfully</div>');
		echo json_encode($response);
	}
	public function delete($id)
	{
		$delete_url = CRM_URL . 'api/Ticket/delete_ticket/' . $id;

		call_api_get($delete_url);

		/*$this->session->set_flashdata(
			'msgdelete',
			'<div class="alert alert-success">
				Ticket Deleted Successfullyh
			</div>'
		);*/
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Ticket Deleted Successfully</div>');

		redirect('ticket/index');
	}
}
