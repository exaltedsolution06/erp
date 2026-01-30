<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Caste_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('caste_category', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Academics');
		$this->session->set_userdata('sub_menu', 'admin/castecategory');
		$data['title'] = 'Castecategory List';		
		
        $this->load->view('layout/header', $data);
        $this->load->view('admin/category/caste-category', $data);
        $this->load->view('layout/footer', $data);
    }
}
