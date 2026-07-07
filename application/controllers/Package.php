<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Package extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {		
        if (!$this->rbac->hasPrivilege('package_list', 'can_view')) {
            access_denied();
        }
        $app_ver = $this->config->item('app_ver');

        $this->session->set_userdata('top_menu', 'Software Subscription');
        $this->session->set_userdata('sub_menu', 'Package/index');
        $data['title'] = 'Package List';
		
        $data['result'] = $this->setting_model->getSetting();
		//echo $receiptnumber['receipt_sr_no']; die;
		
		$domain_api_url = CRM_URL .'api/Domain/get_domain_data/'.$data['result']->domain_api_key; 
		$api_data = call_api_get($domain_api_url);
		$data['domain_api_data'] = $api_data['data'];
		// echo '<pre>'; print_r($api_data); die;
		
		$plan_list_url = CRM_URL .'api/Subscriptions/get_subscription_list/'.$data['result']->domain_api_key;
		$api_data = call_api_get($plan_list_url);
		$data['plans_api_data'] = $api_data['data'];
		// echo '<pre>'; print_r($api_data); die;
		
		$company_details = fetch_crm_company(); 
		$data['company'] = $company_details['data']; 
		
        $this->load->view('layout/header', $data);
        $this->load->view('setting/packageList', $data);
        $this->load->view('layout/footer', $data);
    }
}
