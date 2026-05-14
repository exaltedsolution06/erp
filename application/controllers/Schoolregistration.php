<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Schoolregistration extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {		
        if (!$this->rbac->hasPrivilege('school_registration', 'can_view')) {
            access_denied();
        }
        $app_ver = $this->config->item('app_ver');

        $this->session->set_userdata('top_menu', 'Software Subscription');
        $this->session->set_userdata('sub_menu', 'Schoolregistration/index');
        $data['title'] = 'School Registration';
        $data['app_ver'] = $app_ver;
        $timezoneList = $this->customlib->timezone_list();
        $session_result = $this->session_model->get();
        $language_result = $this->language_model->getEnable_languages();
        $data['sessionlist'] = $session_result;
        $month_list = $this->customlib->getMonthList();
        $days_list = $this->customlib->getDayList();
        $data['daysList'] = $days_list;
        $data['languagelist'] = $language_result;
        $data['timezoneList'] = $timezoneList;
        $data['monthList'] = $month_list;
        $dateFormat = $this->customlib->getDateFormat();
        $currency = $this->customlib->getCurrency();
        $data['dateFormatList'] = $dateFormat;
        $data['currencyList'] = $currency;
        $digit = $this->customlib->getDigits();
        $data['digitList'] = $digit;
        $currencyPlace = $this->customlib->getCurrencyPlace();
        $data['currencyPlace'] = $currencyPlace;
        $data['result'] = $this->setting_model->getSetting();
        $data['session_setting'] = $this->setting_model->get_session_setting();
		//echo $receiptnumber['receipt_sr_no']; die;
		
		$domain_api_url = CRM_URL .'api/Domain/get_domain_data/'.$data['result']->domain_api_key; 
		$api_data = call_api_get($domain_api_url);
		$data['domain_api_data'] = $api_data['data'];
		// echo '<pre>'; print_r($api_data); die;
		
        $this->load->view('layout/header', $data);
        $this->load->view('setting/schoolRegistration', $data);
        $this->load->view('layout/footer', $data);
    }
}
