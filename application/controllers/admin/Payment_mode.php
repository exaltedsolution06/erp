<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment_mode extends Admin_Controller
{
	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('Paymentmode_model');
    }
	public function index()
    {
       if (!$this->rbac->hasPrivilege('payment_mode', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Academics');
		$this->session->set_userdata('sub_menu', 'admin/paymentmode');
		$data['title'] = 'Paymentmode List';	
		
        $pmode_result      = $this->Paymentmode_model->get();
        $data['paymentList'] = $pmode_result;
		
		$this->load->view('layout/header', $data);
		$this->load->view('admin/payment/paymentList', $data);
		$this->load->view('layout/footer', $data);
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('payment_mode', 'can_view')) {
            access_denied();
        }
        $data['title']    = 'Payment mode List';
        $payment         = $this->Paymentmode_model->get($id);
        $data['payment'] = $payment;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment/paymentShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('payment_mode', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Payment mode List';
        $this->Paymentmode_model->remove($id);
        $this->session->set_flashdata('msgdelete', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/payment_mode');
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('payment_mode', 'can_add')) {
            access_denied();
        }
        $data['title']        = 'Add Payment mode';
        $pmode_result      = $this->Paymentmode_model->get();
        $data['paymentList'] = $pmode_result;
		$this->form_validation->set_rules(
			'title',
			$this->lang->line('title'),
			'trim|required|xss_clean|callback_check_data_unique'
		);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/payment/paymentList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title'),
            );
            $this->Paymentmode_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/payment_mode');
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('payment_mode', 'can_edit')) {
            access_denied();
        }
        $data['title']        = 'Edit Payment mode';
        $pmode_result      = $this->Paymentmode_model->get();
        $data['paymentList'] = $pmode_result;
        $data['id']           = $id;
        $payment             = $this->Paymentmode_model->get($id);
        $data['payment']     = $payment;
		$this->form_validation->set_rules(
			'title',
			$this->lang->line('title'),
			'trim|required|xss_clean|callback_check_data_unique['.$id.']'
		);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/payment/paymentEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'       => $id,
                'title' => $this->input->post('title'),
            );
            $this->Paymentmode_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/payment_mode');
        }
    }
	/**
	* Custom validation callback to check uniqueness
	*/
	public function check_data_unique($title, $id)
	{
		$exists = $this->Paymentmode_model->check_data_exists($title, $id);

		if ($exists) {
			$this->form_validation->set_message(
				'check_data_unique',
				'Record already exists'
			);
			return false;
		}

		return true;
	}
}
