<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Companyinfo extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {
		
        if (!$this->rbac->hasPrivilege('company_info', 'can_view')) {
            access_denied();
        }
        $app_ver = $this->config->item('app_ver');

        $this->session->set_userdata('top_menu', 'Software Subscription');
        $this->session->set_userdata('sub_menu', 'Companyinfo/index');
        $data['title'] = 'Company Info';
        
		$company_details = fetch_crm_company(); 
		$data['company'] = $company_details['data']; 
		// echo '<pre>'; print_r($company_details); die;
		
        $this->load->view('layout/header', $data);
        $this->load->view('setting/companyInfo', $data);
        $this->load->view('layout/footer', $data);
    }
}
