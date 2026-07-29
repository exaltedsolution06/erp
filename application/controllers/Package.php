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
	public function plan_details($id)
	{
		if (!$this->rbac->hasPrivilege('package_list', 'can_view')) {
			access_denied();
		}
		$this->session->set_userdata('top_menu', 'Software Subscription');
		$this->session->set_userdata('sub_menu', 'Package/index');
		$data['title'] = 'Plan Details';

		$data['result'] = $this->setting_model->getSetting();

		$domain_api_url = CRM_URL .'api/Domain/get_domain_data/'.$data['result']->domain_api_key;
		$api_data = call_api_get($domain_api_url);
		$data['domain_api_data'] = $api_data['data'];

		$plan_list_url = CRM_URL .'api/Subscriptions/get_subscription_list/'.$data['result']->domain_api_key;
		$api_data = call_api_get($plan_list_url);

		$data['plan'] = null;
		foreach ($api_data['data'] as $plan_val) {
			if ($plan_val['id'] == $id) {
				$data['plan'] = $plan_val;
				break;
			}
		}
		
		$plan_list_url = CRM_URL .'api/Subscriptions/get_service_list/'.$data['result']->domain_api_key;
		$api_data = call_api_get($plan_list_url);
		$data['services'] = $api_data['data'];
		if (!$data['plan']) {
			show_404();
		}

		$this->load->view('layout/header', $data);
		$this->load->view('setting/planDetails', $data);
		$this->load->view('layout/footer', $data);
	}
    public function invoice_details() {		
        if (!$this->rbac->hasPrivilege('invoice_details', 'can_view')) {
            access_denied();
        }
        $app_ver = $this->config->item('app_ver');

        $this->session->set_userdata('top_menu', 'Software Subscription');
        $this->session->set_userdata('sub_menu', 'Package/invoice-details');
        $data['title'] = 'Invoice List';
		
        $data['result'] = $this->setting_model->getSetting();
		//echo $receiptnumber['receipt_sr_no']; die;
		
		$domain_api_url = CRM_URL .'api/Domain/get_domain_data/'.$data['result']->domain_api_key; 
		$api_data = call_api_get($domain_api_url);
		$data['domain_api_data'] = $api_data['data'];
		// echo '<pre>'; print_r($data['domain_api_data']['id']); die;
		
		$invoice_list_url = CRM_URL .'api/Invoice/get_invoice_list/'.$data['domain_api_data']['id'];
		$api_data = call_api_get($invoice_list_url);
		$data['invoices'] = $api_data['data'];
		// echo '<pre>'; print_r($data['invoices']); die;
		
        $this->load->view('layout/header', $data);
        $this->load->view('setting/invoiceList', $data);
        $this->load->view('layout/footer', $data);
    }
	public function print_invoice($id)
    {
		$invoice_print_url = CRM_URL .'api/Invoice/print_invoice/'.$id;
		$api_data = call_api_get_html($invoice_print_url);
		echo $api_data;
    }
}
