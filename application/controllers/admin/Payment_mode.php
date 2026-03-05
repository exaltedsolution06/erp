<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment_mode extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('payment_mode', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Academics');
		$this->session->set_userdata('sub_menu', 'admin/paymentmode');
		$data['title'] = 'Paymentmode List';		
		
        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment/payment-mode', $data);
        $this->load->view('layout/footer', $data);
    }
}
