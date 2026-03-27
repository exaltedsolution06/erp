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
        $this->load->library('pagination');
        $this->load->model('designtc_model');
        $this->sch_setting_detail = $this->setting_model->getSetting();

    }

    public function front_desk_reports() {
		if (!$this->rbac->hasPrivilege('front_desk_all_reports', 'can_view')) {
            access_denied();
        }
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
		if (!$this->rbac->hasPrivilege('certificate_section_report', 'can_view')) {
            access_denied();
        }
		
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/certificate-section');
        $this->session->set_userdata('subsub_menu', '');
        $data['title'] = 'Certificate Reports';
        
		$this->load->view('layout/header', $data);
		$this->load->view('admin/reports/certificate_section_reports', $data);
		$this->load->view('layout/footer', $data);
    }
	public function tc_reports() {
		if (!$this->rbac->hasPrivilege('certificate_section_report', 'can_view')) {
            access_denied();
        }
		
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'report/certificate-section');
        $this->session->set_userdata('subsub_menu', 'Reports/certificate/tc-certificate');
        $data['title'] = 'TC Certificate Report';
		$data['setting_result'] = $this->setting_model->getSetting();
		$from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');
		
		// paginate
        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->designtc_model->get_generated_certificates_count($from_date, $to_date);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('admin/report/tc_reports');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;

        // Pagination Bootstrap Styling (same as you already have)
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['certificate_data'] = $this->designtc_model->get_generated_certificates($config['per_page'], $page,$from_date, $to_date);
        $data['pagination_links'] = $this->pagination->create_links();
		
		if ($this->input->server('REQUEST_METHOD') == "GET") {
			// echo '<pre>';print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('admin/reports/tc_reports', $data);
			$this->load->view('layout/footer', $data);
        } else {

            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/tc_reports', $data);
                $this->load->view('layout/footer', $data);
            }
        }
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
		if (!$this->rbac->hasPrivilege('expense_section_report', 'can_view')) {
            access_denied();
        }
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
		if (!$this->rbac->hasPrivilege('ticket_section_report', 'can_view')) {
            access_denied();
        }
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
