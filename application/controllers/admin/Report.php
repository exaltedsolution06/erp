<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
} 

class Report extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Enc_lib');
        $this->sch_setting_detail = $this->setting_model->getSetting();

    }

    public function front_desk_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/front-desk');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/front_desk_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function student_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/student-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/student_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function fee_collection_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/fee-collection');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/fee_collection_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function attendance_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/attendance-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/attendance_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function exam_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/exam-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/exam_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function online_exam_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/online-exam');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/online_exam_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function lesson_plan_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/lesson-plan');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/lesson_plan_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function staff_management_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/staff-management');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/staff_management_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function message_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/message-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/message_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function certificate_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/certificate-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/certificate_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function library_management_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/library-management');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/library_management_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function homework_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/homework-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/homework_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function download_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/download-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/download_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function income_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/income-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/income_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function expense_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/expense-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/expense_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function stock_management_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/stock-management');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/stock_management_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function ticket_section_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/ticket-section');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/ticket_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function multi_branch_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/multi-branch');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/multi_branch_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function subscription_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/subscription');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/subscription_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function audit_trail_reports() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/audit-trail');
        $data['title'] = 'Upcoming';
        $data['message'] = "<div class='alert alert-success'>Comming soon.....</div>";
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/audit_trail_reports', $data);
		$this->load->view('layout/footer', $data);
    }
}
