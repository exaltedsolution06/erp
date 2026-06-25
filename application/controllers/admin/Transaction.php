<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->sch_setting_detail = $this->setting_model->getSetting();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->load->model('Receipt_model');
		$this->load->model('fee_discount_model');
		$this->load->model('Paymentmode_model');
        $this->load->library('pagination');
    }

    function searchtransaction() {

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');

        $data['title'] = 'Search Expense';
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['search_type'] = $search_type = '';


        $search = $this->input->post('search_type');


        if (isset($_POST['search_type']) && $_POST['search_type'] != '') {

            $dates = $this->customlib->get_betweendate($_POST['search_type']);
            $data['search_type'] = $_POST['search_type'];
        } else {

            $dates = $this->customlib->get_betweendate('this_year');
            $data['search_type'] = $search_type = 'this_year';
        }

        $dateformat = $this->customlib->getSchoolDateFormat();

        $date_from = $dates['from_date'];
        $date_to = $dates['to_date'];

        $data['collection_title'] = $this->lang->line('collection') . " " . $this->lang->line('report') . " " . $this->lang->line('from') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($date_from)) . " To " . date($this->customlib->getSchoolDateFormat(), strtotime($date_to));
        $data['income_title'] = $this->lang->line('income') . " " . $this->lang->line('report') . " " . $this->lang->line('from') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($date_from)) . " To " . date($this->customlib->getSchoolDateFormat(), strtotime($date_to));
        $data['expense_title'] = $this->lang->line('expense') . " " . $this->lang->line('report') . " " . $this->lang->line('from') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($date_from)) . " To " . date($this->customlib->getSchoolDateFormat(), strtotime($date_to));
        $data['payroll_title'] = $this->lang->line('payroll') . " " . $this->lang->line('report') . " " . $this->lang->line('from') . " " . date($this->customlib->getSchoolDateFormat(), strtotime($date_from)) . " To " . date($this->customlib->getSchoolDateFormat(), strtotime($date_to));
        $date_from = date('Y-m-d', strtotime($date_from));
        $date_to = date('Y-m-d', strtotime($date_to));
        $expenseList = $this->expense_model->search("", $date_from, $date_to);

        $result = $this->payroll_model->getbetweenpayrollReport($date_from, $date_to);

        $incomeList = $this->income_model->search("", $date_from, $date_to);
        $feeList = $this->studentfeemaster_model->getFeeBetweenDate($date_from, $date_to);
        $data['expenseList'] = $expenseList;
        $data['incomeList'] = $incomeList;
        $data['feeList'] = $feeList;
        $data['payrollList'] = $result;



        $this->load->view('layout/header', $data);
        $this->load->view('admin/transaction/searchtransaction', $data);
        $this->load->view('layout/footer', $data);
    }

    function studentacademicreport() {

        if (!$this->rbac->hasPrivilege('receipt_book', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/studentacademicreport');
        $data['title'] = 'student fee';
        $data['title'] = 'student fee';

        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');
        $mode   = $this->input->get('mode');

        // paginate
        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->Receipt_model->get_receipt_count($from_date, $to_date, $mode);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('admin/transaction/studentacademicreport');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE; // keeps per_page in URL

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

        $data['receipt_data'] = $this->Receipt_model->get_receipt($config['per_page'], $page,$from_date, $to_date, $mode);
        $data['pagination_links'] = $this->pagination->create_links();

        // end paginate

        $class = $this->class_model->get();
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['classlist'] = $class;
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $feetype = $this->input->post('feetype');
        $feetype_arr = $this->input->post('feetype_arr');
        $data['section_list'] = $this->section_model->getClassBySection($this->input->post('class_id'));
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
		
		$data['routes'] = $this->db->where('session_id', $this->current_session)->order_by('id', 'DESC')->get('route_head')->result_array();
		$data['fee_heads'] = $this->db->where('session_id', $this->current_session)->order_by('id', 'DESC')->get('fee_head')->result_array();
		$data['p_modes'] = $this->Paymentmode_model->get();
		//echo '<pre>'; print_r($data['fee_heads']); echo '</pre>';die;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/transaction/studentAcademicReport', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>