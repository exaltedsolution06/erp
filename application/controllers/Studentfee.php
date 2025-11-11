<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Studentfee extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Receipt_model');
        $this->load->library('smsgateway');
        $this->load->library('pagination');
        $this->load->library('mailsmsconf');
        $this->search_type        = $this->config->item('search_type');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }


    public function saveFee(){

        $data = $this->input->post(); 
       
       
        if (empty($data['receipt_no']) || empty($data['student_id'])) {
            
            echo json_encode(['status' => 'error', 'message' => 'Receipt number or student ID is missing']);
            return;
        }
        $last_id=[];
        if(!empty($data['pay'][0])){

            
            $data['months']=array_unique($data['months']);
            $total_month=count($data['months']);
            $paid=$data['pay'];
            foreach($paid as $key=>$value){
                if($value=='paid'){
                    foreach ($data['months'] as $keys => $month) {
                        // echo $key.'==Key';
                        $fee_head_type = $data['fee_head_type'][$key];
                        $student_id = $data['student_id'];
                        $fee_head = $data['fee_head'][$key];

                        // Check if the combination of student_id, month, and fee_head_type already exists
                        $existing_entry = $this->Receipt_model->check_existing_entry($student_id, $month, $fee_head_type,$fee_head);

                        if ($existing_entry) {
                            // If exists, return an error
                            // echo json_encode(['status' => 'error', 'message' => 'This record already exists']);
                            // return;
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">This record already exists</div>');
                            redirect('studentfee/addfee/'.$data['addfee']);
                        }

                        $insert_data = array(
                            'receipt_no'   => $data['receipt_no'],
                            'student_id'   => $data['student_id'],
                            'months'       => $month,
                            'fee_head'     => $data['fee_head'][$key],
                            'fee_head_type'  => $data['fee_head_type'][$key],
                            'fee_head_name'  => $data['fee_head_name'][$key],
                            'total'        => ($data['total'][$key]),
                            'month_total'   => $data['month_total'][$month][$key],
                            'rec_discount' => (int) ($data['rec_discount'][$key]),
                            'rec_amount'   => ($data['rec_amount'][$key]),
                            'balance_amount' => $data['total'][$key]-($data['rec_discount'][$key]+$data['rec_amount'][$key]),
                            'fees_received' => $data['fees_received'],
                            'late_fees'    => $data['late_fees'],
                            'ledger_amt'   => $data['ledger_amt'],
                            'total_fees'   => $data['total_fees'],
                            'discount_amt' => $data['discount_amt'],
                            'net_fees'     => $data['net_fees'],
                            'receipt_amt'  => $data['receipt_amt'],
                            'balance_amt'  => $data['balance_amt'],
                            'mode'         => $data['mode'],
                            'remarks'      => $data['remarks'],
                            'date_time'      => $data['date_time'],
                            'back_id'      => $data['back_id'],
                            'sr_no'        => $this->session->userdata('last_receipt_id'),
                             'create_by'     => $this->customlib->getUserData()['email'],
                             'total_month'  => $total_month,
                        );
                        // var_dump($insert_data);
                        // die;

                        // echo "<hr>";
                        
                        $insid=$this->Receipt_model->insert_receipt($insert_data);

                        // var_dump($insid); die;
                        array_push($last_id,$insid);
                    }
                }
            }


            // die;
            // $data['balance_amt']
            $this->Receipt_model->update_student($data['student_id'],$data['balance_amt']);
        }else{

          

            $insert_data = array(
                'receipt_no'   => $data['receipt_no'],
                'student_id'   => $data['student_id'],
                'months'       => '',
                'fee_head'     => '',
                'fee_head_type'  =>'', 
                'fee_head_name'  => 'Ledger Amount',
                'total'        => ($data['ledger_amt']),
                'rec_discount' => 0,
                'rec_amount'   => ($data['receipt_amt']),
                'balance_amount'   => $data['ledger_amt'],
                'fees_received' => $data['ledger_amt'],
                'late_fees'    => $data['late_fees'],
                'ledger_amt'   => $data['old_ledger_amt'],
                'total_fees'   => $data['total_fees'],
                'discount_amt' => $data['discount_amt'],
                'net_fees'     => $data['net_fees'],
                'receipt_amt'  => $data['ledger_amt'],
                'balance_amt'  => $data['balance_amt'],
                'mode'         => $data['mode'],
                'remarks'      => $data['remarks'],
                'date_time'      => $data['date_time'],
                'back_id'      => $data['back_id'],
                'sr_no'        => $this->session->userdata('last_receipt_id'),
                'create_by'     => $this->customlib->getUserData()['email'],
            );
            


           $id=$this->Receipt_model->insert_receipt($insert_data);
 
            array_push($last_id,$id);

            $this->Receipt_model->update_student($data['student_id'],(int)($data['balance_amt']));



        }



        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Fees Paid successfully</div>');
        redirect('studentfee/print/'.base64_encode(json_encode($last_id)));
    }




    public function print($id){
        


        $ids=json_decode(base64_decode($id));
        
        $this->db->select('GROUP_CONCAT(DISTINCT months) as month_names');
        $this->db->from('receipts');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();

        $data['month_names'] = $query->row()->month_names;
        $data['result'] = $this->setting_model->getSetting();


        $data_fees=$this->Receipt_model->get_receipts_by_ids($ids);

       
        $student_id=$data_fees[0]->student_id;

        // die;
        // $this->db->where('id', $student_id); 
        // $query = $this->db->get('students');
        // $student = $query->row(); 

        $student = $this->Receipt_model->getStudentsPrint($student_id); // Fetch student with ID 1

        
        $data['fees']=$data_fees;
        $data['student']=$student[0];
        $data['backid']=$data_fees[0]->back_id;


        // echo "<pre>";

        // var_dump($data['fees']);  


        // die;

        // $this->load->view('layout/header', $data);
        $this->load->view('studentfee/print', $data);
        // $this->load->view('layout/footer', $data);
    }















    public function index()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', $this->lang->line('fees_collection'));
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title']     = 'student fees';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeSearch', $data);
        $this->load->view('layout/footer', $data);
    }

    public function collection_report()
    {

        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }

        $data['collect_by'] = $this->studentfeemaster_model->get_feesreceived_by();
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['group_by']   = $this->customlib->get_groupby();

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/collection_report');






        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');


        // paginate
        // $config['base_url'] = base_url('studentfee/collection_report');
        // $config['total_rows'] = $this->Receipt_model->get_receipt_count();

        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->Receipt_model->get_receipt_count($from_date,$to_date);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('studentfee/collection_report');
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

        $data['receipt_data'] = $this->Receipt_model->get_receipt($config['per_page'], $page,$from_date,$to_date);
        $data['pagination_links'] = $this->pagination->create_links();


        // end paginate
        /*
       
        if (isset($_POST['search_type']) && $_POST['search_type'] != '') {

            $dates               = $this->customlib->get_betweendate($_POST['search_type']);
            $data['search_type'] = $_POST['search_type'];
        } else {

            $dates               = $this->customlib->get_betweendate('this_year');
            $data['search_type'] = '';
        }

        if (isset($_POST['collect_by']) && $_POST['collect_by'] != '') {

            $data['received_by'] = $received_by = $_POST['collect_by'];
        } else {

            $data['received_by'] = $received_by = '';
        }

        if (isset($_POST['group']) && $_POST['group'] != '') {

            $data['group_byid'] = $group = $_POST['group'];
        } else {

            $data['group_byid'] = $group = '';
        }

        $collect_by = array();
        $collection = array();
        $start_date = date('Y-m-d', strtotime($dates['from_date']));
        $end_date   = date('Y-m-d', strtotime($dates['to_date']));
        $data['collectlist'] = $this->studentfeemaster_model->getFeeCollectionReport($start_date, $end_date);

        $this->form_validation->set_rules('search_type', $this->lang->line('search') . " " . $this->lang->line('type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('collect_by', $this->lang->line('collect') . " " . $this->lang->line('by'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('group', $this->lang->line('group') . " " . $this->lang->line('by'), 'trim|required|xss_clean');









        if ($this->form_validation->run() == false) {

            $data['results'] = array();
        } else {

            $data['results'] = $this->studentfeemaster_model->getFeeCollectionReport($start_date, $end_date, $received_by, $group);

            if ($group != '') {

                if ($group == 'class') {

                    $group_by = 'class_id';
                } elseif ($group == 'collection') {

                    $group_by = 'received_by';
                } elseif ($group == 'mode') {

                    $group_by = 'payment_mode';
                }

                foreach ($data['results'] as $key => $value) {

                    $collection[$value[$group_by]][] = $value;
                }
            } else {

                $s = 0;
                foreach ($data['results'] as $key => $value) {

                    $collection[$s++] = array($value);
                }
            }

            $data['results'] = $collection;
        }*/



        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/collection_report', $data);
        $this->load->view('layout/footer', $data);
    }

    public function pdf()
    {
        $this->load->helper('pdf_helper');
    }

    public function search()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title']           = 'Student Search';
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $button                  = $this->input->post('search');
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class       = $this->input->post('class_id');
            $section     = $this->input->post('section_id');
            $search      = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {

                    } else {
                        $resultlist         = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
                    }
                } else if ($search == 'search_full') {
                    $resultlist         = $this->student_model->searchFullText($search_text);
                    $data['resultlist'] = $resultlist;
                }
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfeeSearch', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    public function feesearch()
    {
        if (!$this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/feesearch');
        $data['title']       = 'student fees';
        $class               = $this->class_model->get();
        $data['classlist']   = $class;
        $data['sch_setting'] = $this->sch_setting_detail;
        $feesessiongroup     = $this->feesessiongroup_model->getFeesByGroup();

        $data['feesessiongrouplist'] = $feesessiongroup;
        $data['fees_group']          = "";
        if (isset($_POST['feegroup_id']) && $_POST['feegroup_id'] != '') {
            $data['fees_group'] = $_POST['feegroup_id'];
        }

        $this->form_validation->set_rules('feegroup_id', $this->lang->line('fee_group'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['student_due_fee'] = array();
            $feegroup_id             = $this->input->post('feegroup_id');
            $feegroup                = explode("-", $feegroup_id);
            $feegroup_id             = $feegroup[0];
            $fee_groups_feetype_id   = $feegroup[1];
            $class_id                = $this->input->post('class_id');
            $section_id              = $this->input->post('section_id');
            $student_due_fee         = $this->studentfee_model->getDueStudentFees($feegroup_id, $fee_groups_feetype_id, $class_id, $section_id);
            if (!empty($student_due_fee)) {
                foreach ($student_due_fee as $student_due_fee_key => $student_due_fee_value) {
                    $amt_due                                                  = $student_due_fee_value['amount'];
                    $student_due_fee[$student_due_fee_key]['amount_discount'] = 0;
                    $student_due_fee[$student_due_fee_key]['amount_fine']     = 0;
                    $a                                                        = json_decode($student_due_fee_value['amount_detail']);
                    if (!empty($a)) {
                        $amount          = 0;
                        $amount_discount = 0;
                        $amount_fine     = 0;

                        foreach ($a as $a_key => $a_value) {
                            $amount          = $amount + $a_value->amount;
                            $amount_discount = $amount_discount + $a_value->amount_discount;
                            $amount_fine     = $amount_fine + $a_value->amount_fine;
                        }
                        if ($amt_due <= $amount) {
                            unset($student_due_fee[$student_due_fee_key]);
                        } else {

                            $student_due_fee[$student_due_fee_key]['amount_detail']   = $amount;
                            $student_due_fee[$student_due_fee_key]['amount_discount'] = $amount_discount;
                            $student_due_fee[$student_due_fee_key]['amount_fine']     = $amount_fine;
                        }
                    }
                }
            }

            $data['student_due_fee'] = $student_due_fee;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function reportbyname()
    {
		
        // receipts
     
				
        if (!$this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/reportbyname');
        $data['title']       = 'student fees';
        $data['title']       = 'student fees';
        $class               = $this->class_model->get();
        $data['classlist']   = $class;
        $data['sch_setting'] = $this->sch_setting_detail;
        // $data['get_receipt'] = $this->get_receipt
	
        // $data['receipt_data'] = $this->Receipt_model->get_receipt();

        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');


        // die;

        // paginate
        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->Receipt_model->get_receipt_count($from_date, $to_date);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('studentfee/reportbyname');
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

        $data['receipt_data'] = $this->Receipt_model->get_receipt($config['per_page'], $page,$from_date, $to_date);
        $data['pagination_links'] = $this->pagination->create_links();

        // end paginate





        // var_dump($data['receipt_data']);
        // die;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
          
          
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByName', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $data['student_due_fee'] = array();
                $class_id                = $this->input->post('class_id');
                $section_id              = $this->input->post('section_id');
                $student_id              = $this->input->post('student_id');
                $student                 = $this->student_model->get($student_id);
                $data['student']         = $student;

                $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
                $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee']      = $student_due_fee;
                $data['class_id']             = $class_id;
                $data['section_id']           = $section_id;
                $data['student_id']           = $student_id;
                $category                     = $this->category_model->get();
                $data['categorylist']         = $category;
				
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    public function reportbyclass()
    {
        $data['title']     = 'student fees';
        $data['title']     = 'student fees';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_fees_array      = array();
            $class_id                = $this->input->post('class_id');
            $section_id              = $this->input->post('section_id');
            $student_result          = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['student_due_fee'] = array();
            if (!empty($student_result)) {
                foreach ($student_result as $key => $student) {
                    $student_array                      = array();
                    $student_array['student_detail']    = $student;
                    $student_session_id                 = $student['student_session_id'];
                    $student_id                         = $student['id'];
                    $student_due_fee                    = $this->studentfee_model->getDueFeeBystudentSection($class_id, $section_id, $student_session_id);
                    $student_array['fee_detail']        = $student_due_fee;
                    $student_fees_array[$student['id']] = $student_array;
                }
            }
            $data['class_id']           = $class_id;
            $data['section_id']         = $section_id;
            $data['student_fees_array'] = $student_fees_array;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title']      = 'studentfee List';
        $studentfee         = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function deleteFee()
    {

        if (!$this->rbac->hasPrivilege('collect_fees', 'can_delete')) {
            access_denied();
        }
        $invoice_id  = $this->input->post('main_invoice');
        $sub_invoice = $this->input->post('sub_invoice');
        if (!empty($invoice_id)) {
            $this->studentfee_model->remove($invoice_id, $sub_invoice);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    public function deleteStudentDiscount()
    {

        $discount_id = $this->input->post('discount_id');
        if (!empty($discount_id)) {
            $data = array('id' => $discount_id, 'status' => 'assigned', 'payment_id' => "");
            $this->feediscount_model->updateStudentDiscount($data);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    public function getcollectfee()
    {
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $record              = $this->input->post('data');
        $record_array        = json_decode($record);

        $fees_array = array();
        foreach ($record_array as $key => $value) {
            $fee_groups_feetype_id = $value->fee_groups_feetype_id;
            $fee_master_id         = $value->fee_master_id;
            $fee_session_group_id  = $value->fee_session_group_id;
            $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[]          = $feeList;
        }
        $data['feearray'] = $fees_array;
        $result           = array(
            'view' => $this->load->view('studentfee/getcollectfee', $data, true),
        );

        $this->output->set_output(json_encode($result));
    }


    public function addfee($id) 
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_add')) {
            access_denied();
        }

     

        $data['back_id']=$id;
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['title'] = 'Student Detail';

        $student         = $this->student_model->getByStudentSession($id);
        
        $data['student'] = $student;
        $data['update_ids']=$id;
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($id);
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($id);

        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee']      = $student_due_fee;
        $category                     = $this->category_model->get();
        $data['categorylist']         = $category;

        $class_section                = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"]        = $class_section;
        $session                      = $this->setting_model->getCurrentSession();
        $studentlistbysection         = $this->student_model->getStudentClassSection($student["class_id"], $session);
        $data["studentlistbysection"] = $studentlistbysection;

        $last_receipt_id = $this->Receipt_model->get_last_receipt_id();
        $this->session->set_userdata('last_receipt_id', $last_receipt_id);

        if(@$_GET['receipt_no'] ==''){
            $data['receipt_no']=$this->session_model->get($this->setting_model->getCurrentSession())['session']."/".$last_receipt_id;
        }else{
            $data['receipt_no']=$_GET['receipt_no'];
        }

        $data['data_list']=0;
        $data['addfee']=$id;


        // $data['last_receipt_id']=;
        // // Check if the combination of student_id, month, and fee_head_type already exists
        $existing_entry = $this->Receipt_model->get_pay_mounth($student['id']);
        $data['pay_mounth']=$existing_entry;

        
        
        $data['months_data']=[];
        
        if(!empty($_POST['months'])){
            
            
            
            
            $monthsPost =$_POST['months'];
            $class_id=$student['class_id'];
            $route_id=$student['vehroute_id'];
            
            $category_id=$student['category_id'];
            
            
            
            $this->db->from('fee_head');
            $this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
            $this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
            $this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
            if (!empty($monthsPost)) {
                $this->db->group_start(); // Start OR group
                foreach ($monthsPost as $m) {
                    $m_escaped = $this->db->escape_str($m); // Prevent injection or breaking SQL
                    $this->db->or_where("JSON_CONTAINS(fee_head.months, '\"$m_escaped\"')", null, false);
                }
                $this->db->group_end(); // End OR group
            }
            $query = $this->db->get();
            $data['data_list'] = $query->result();
               



            // route

            $this->db->from('route_head');
            $this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
            $this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
            $this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
            $this->db->where('route_head.id', $route_id);
            
            $query = $this->db->get();
            $data['route_data_list'] = $query->result();

        
            
            $data['months_data']=$monthsPost;
               
               
            // echo  json_encode($data);
               
            // die;
        }







        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentAddfee', $data);
        $this->load->view('layout/footer', $data);
    }

    public function deleteTransportFee()
    {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    public function delete($id)
    {
        $data['title'] = 'studentfee List';
        $this->studentfee_model->remove($id);
        redirect('studentfee/index');
    }

   
    public function create()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Add studentfee';
        $this->form_validation->set_rules('category', $this->lang->line('category'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">' . $this->lang->line('success_message') . '</div>');
            redirect('studentfee/index');
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_edit')) {
            access_denied();
        }
        $data['title']      = 'Edit studentfees';
        $data['id']         = $id;
        $studentfee         = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->form_validation->set_rules('category', $this->lang->line('category'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'       => $id,
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">' . $this->lang->line('update_message') . '</div>');
            redirect('studentfee/index');
        }
    }

    public function addstudentfee()
    {

        $this->form_validation->set_rules('student_fees_master_id', $this->lang->line('fee_master'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('fee_groups_feetype_id', $this->lang->line('student'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|trim|xss_clean|numeric|callback_check_deposit');
        $this->form_validation->set_rules('amount_discount', $this->lang->line('discount'), 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('amount_fine', $this->lang->line('fine'), 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('payment_mode', $this->lang->line('payment_mode'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'amount'                 => form_error('amount'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
                'fee_groups_feetype_id'  => form_error('fee_groups_feetype_id'),
                'amount_discount'        => form_error('amount_discount'),
                'amount_fine'            => form_error('amount_fine'),
                'payment_mode'           => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $staff_record = $this->staff_model->get($this->customlib->getStaffID());

            $collected_by             = " Collected By: " . $this->customlib->getAdminSessionUserName() . "(" . $staff_record['employee_id'] . ")";
            $student_fees_discount_id = $this->input->post('student_fees_discount_id');
            $json_array               = array(
                'amount'          => $this->input->post('amount'),
                'date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_discount' => $this->input->post('amount_discount'),
                'amount_fine'     => $this->input->post('amount_fine'),
                'description'     => $this->input->post('description') . $collected_by,
                'payment_mode'    => $this->input->post('payment_mode'),
                'received_by'     => $staff_record['id'],
            );
            $data = array(
                'student_fees_master_id' => $this->input->post('student_fees_master_id'),
                'fee_groups_feetype_id'  => $this->input->post('fee_groups_feetype_id'),
                'amount_detail'          => $json_array,
            );

            $action             = $this->input->post('action');
            $send_to            = $this->input->post('guardian_phone');
            $email              = $this->input->post('guardian_email');
            $parent_app_key     = $this->input->post('parent_app_key');
            $student_session_id = $this->input->post('student_session_id');
            $inserted_id        = $this->studentfeemaster_model->fee_deposit($data, $send_to, $student_fees_discount_id);
            $mailsms_array      = $this->feegrouptype_model->getFeeGroupByID($this->input->post('fee_groups_feetype_id'));
            $print_record       = array();
            if ($action == "print") {
                $receipt_data = json_decode($inserted_id);
                $data['sch_setting']    = $this->sch_setting_detail;
                $fee_record             = $this->studentfeemaster_model->getFeeByInvoice($receipt_data->invoice_id, $receipt_data->sub_invoice_id);
                $student                = $this->studentsession_model->searchStudentsBySession($student_session_id);
                $data['student']        = $student;
                $data['sub_invoice_id'] = $receipt_data->sub_invoice_id;
                $data['feeList']        = $fee_record;
                $print_record           = $this->load->view('print/printFeesByName', $data, true);
            }
            $mailsms_array->invoice        = $inserted_id;
            $mailsms_array->contact_no     = $send_to;
            $mailsms_array->email          = $email;
            $mailsms_array->parent_app_key = $parent_app_key;

            $this->mailsmsconf->mailsms('fee_submission', $mailsms_array);

            $array = array('status' => 'success', 'error' => '', 'print' => $print_record);
            echo json_encode($array);
        }
    }

    public function printFeesByName()
    {
        $data                   = array('payment' => "0");
        $record                 = $this->input->post('data');
        $invoice_id             = $this->input->post('main_invoice');
        $sub_invoice_id         = $this->input->post('sub_invoice');
        $student_session_id     = $this->input->post('student_session_id');
        $setting_result         = $this->setting_model->get();
        $data['settinglist']    = $setting_result;
        $student                = $this->studentsession_model->searchStudentsBySession($student_session_id);
        $fee_record             = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        $data['student']        = $student;
        $data['sub_invoice_id'] = $sub_invoice_id;
        $data['feeList']        = $fee_record;
        $data['sch_setting']    = $this->sch_setting_detail;
        $this->load->view('print/printFeesByName', $data);
    }

    public function printFeesByGroup()
    {
        $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
        $fee_master_id         = $this->input->post('fee_master_id');
        $fee_session_group_id  = $this->input->post('fee_session_group_id');
        $setting_result        = $this->setting_model->get();
        $data['settinglist']   = $setting_result;
        $data['feeList']       = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
        $data['sch_setting']   = $this->sch_setting_detail;
        $this->load->view('print/printFeesByGroup', $data);
    }

    public function printFeesByGroupArray()
    {

        $data['sch_setting'] = $this->sch_setting_detail;
        $record              = $this->input->post('data');
        $record_array        = json_decode($record);
        $fees_array          = array();
        foreach ($record_array as $key => $value) {
            $fee_groups_feetype_id = $value->fee_groups_feetype_id;
            $fee_master_id         = $value->fee_master_id;
            $fee_session_group_id  = $value->fee_session_group_id;
            $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[]          = $feeList;
        }
        $data['feearray'] = $fees_array;
        $this->load->view('print/printFeesByGroupArray', $data);
    }

    public function searchpayment()
    {
        if (!$this->rbac->hasPrivilege('search_fees_payment', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/searchpayment');
        $data['title'] = 'Edit studentfees';

        $this->form_validation->set_rules('paymentid', $this->lang->line('payment_id'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

        } else {
            $paymentid = $this->input->post('paymentid');
            $invoice   = explode("/", $paymentid);

            if (array_key_exists(0, $invoice) && array_key_exists(1, $invoice)) {
                $invoice_id             = $invoice[0];
                $sub_invoice_id         = $invoice[1];
                $feeList                = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
                $data['feeList']        = $feeList;
                $data['sub_invoice_id'] = $sub_invoice_id;
            } else {
                $data['feeList'] = array();
            }
        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/searchpayment', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addfeegroup()
    {
        $this->form_validation->set_rules('fee_session_groups', $this->lang->line('fee_group'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_session_groups' => form_error('fee_session_groups'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $student_session_id     = $this->input->post('student_session_id');
            $fee_session_groups     = $this->input->post('fee_session_groups');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids            = $this->input->post('student_ids');
            $delete_student         = array_diff($student_ids, $student_sesssion_array);

            $preserve_record = array();
            if (!empty($student_sesssion_array)) {
                foreach ($student_sesssion_array as $key => $value) {
                    $insert_array = array(
                        'student_session_id'   => $value,
                        'fee_session_group_id' => $fee_session_groups,
                    );
                    $inserted_id = $this->studentfeemaster_model->add($insert_array);

                    $preserve_record[] = $inserted_id;
                }
            }
            if (!empty($delete_student)) {
                $this->studentfeemaster_model->delete($fee_session_groups, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }

    public function geBalanceFee()
    {
        $this->form_validation->set_rules('fee_groups_feetype_id', $this->lang->line('fee_groups_feetype_id'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_fees_master_id', 'student_fees_master_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_session_id', 'student_session_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_groups_feetype_id'  => form_error('fee_groups_feetype_id'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data                   = array();
            $student_session_id     = $this->input->post('student_session_id');
            $fee_groups_feetype_id  = $this->input->post('fee_groups_feetype_id');
            $student_fees_master_id = $this->input->post('student_fees_master_id');
            $remain_amount_object   = $this->getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id);
            $discount_not_applied   = $this->getNotAppliedDiscount($student_session_id);
            $remain_amount          = json_decode($remain_amount_object)->balance;
            $remain_amount_fine     = json_decode($remain_amount_object)->fine_amount;

            $array = array('status' => 'success', 'error' => '', 'balance' => $remain_amount, 'discount_not_applied' => $discount_not_applied, 'remain_amount_fine' => $remain_amount_fine);
            echo json_encode($array);
        }
    }

    public function getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id)
    {
        $data                           = array();
        $data['fee_groups_feetype_id']  = $fee_groups_feetype_id;
        $data['student_fees_master_id'] = $student_fees_master_id;
        $result                         = $this->studentfeemaster_model->studentDeposit($data);
        $amount_balance                 = 0;
        $amount                         = 0;
        $amount_fine                    = 0;
        $amount_discount                = 0;
        $fine_amount                    = 0;
        $fee_fine_amount                = 0;
        $due_amt                        = $result->amount;
        if (strtotime($result->due_date) < strtotime(date('Y-m-d'))) {
            $fee_fine_amount = $result->fine_amount;
        }

        if ($result->is_system) {
            $due_amt = $result->student_fees_master_amount;
        }

        $amount_detail = json_decode($result->amount_detail);
        if (is_object($amount_detail)) {

            foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                $amount          = $amount + $amount_detail_value->amount;
                $amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                $amount_fine     = $amount_fine + $amount_detail_value->amount_fine;
            }
        }

        $amount_balance = $due_amt - ($amount + $amount_discount);
        $fine_amount    = abs($amount_fine - $fee_fine_amount);
        $array          = array('status' => 'success', 'error' => '', 'balance' => $amount_balance, 'fine_amount' => $fine_amount);
        return json_encode($array);
    }

    public function check_deposit($amount)
    {
        if (is_numeric($this->input->post('amount')) && is_numeric($this->input->post('amount_discount'))) {
            if ($this->input->post('amount') != "" && $this->input->post('amount_discount') != "") {
                if ($this->input->post('amount') < 0) {
                    $this->form_validation->set_message('check_deposit', $this->lang->line('deposit_amount_can_not_be_less_than_zero'));
                    return false;
                } else {
                    $student_fees_master_id = $this->input->post('student_fees_master_id');
                    $fee_groups_feetype_id  = $this->input->post('fee_groups_feetype_id');
                    $deposit_amount         = $this->input->post('amount') + $this->input->post('amount_discount');
                    $remain_amount          = $this->getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id);
                    $remain_amount          = json_decode($remain_amount)->balance;
                    if ($remain_amount < $deposit_amount) {
                        $this->form_validation->set_message('check_deposit', $this->lang->line('deposit_amount_can_not_be_greater_than_remaining'));
                        return false;
                    } else {
                        return true;
                    }
                }
                return true;
            }
        } elseif (!is_numeric($this->input->post('amount'))) {

            $this->form_validation->set_message('check_deposit', $this->lang->line('amount') . " " . $this->lang->line('field_must_contain_only_numbers'));

            return false;
        } elseif (!is_numeric($this->input->post('amount_discount'))) {

            return true;
        }

        return true;
    }

    public function getNotAppliedDiscount($student_session_id)
    {
        return $this->feediscount_model->getDiscountNotApplied($student_session_id);
    }

    public function addfeegrp()
    {

        $staff_record = $this->session->userdata('admin');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('row_counter[]', $this->lang->line('fees_list'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('collected_date', $this->lang->line('date'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'row_counter'    => form_error('row_counter'),
                'collected_date' => form_error('collected_date'),
            );
            $array = array('status' => 0, 'error' => $data);
            echo json_encode($array);
        } else {
            $collected_array = array();
            $collected_by    = " Collected By: " . $this->customlib->getAdminSessionUserName();

            $send_to            = $this->input->post('guardian_phone');
            $email              = $this->input->post('guardian_email');
            $parent_app_key     = $this->input->post('parent_app_key');
            $student_session_id = $this->input->post('student_session_id');

            $total_row = $this->input->post('row_counter');
            foreach ($total_row as $total_row_key => $total_row_value) {

                $this->input->post('student_fees_master_id_' . $total_row_value);
                $this->input->post('fee_groups_feetype_id_' . $total_row_value);

                $json_array = array(
                    'amount'          => $this->input->post('fee_amount_' . $total_row_value),
                    'date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('collected_date'))),
                    'description'     => $this->input->post('fee_gupcollected_note') . $collected_by,
                    'amount_discount' => 0,
                    'amount_fine'     => $this->input->post('fee_groups_feetype_fine_amount_' . $total_row_value),
                    'payment_mode'    => $this->input->post('payment_mode_fee'),
                    'received_by'     => $staff_record['id'],
                );
                $collected_array[] = array(
                    'student_fees_master_id' => $this->input->post('student_fees_master_id_' . $total_row_value),
                    'fee_groups_feetype_id'  => $this->input->post('fee_groups_feetype_id_' . $total_row_value),
                    'amount_detail'          => $json_array,
                );

            }

            $deposited_fees = $this->studentfeemaster_model->fee_deposit_collections($collected_array);
            $fees_record    = json_decode($deposited_fees);

            foreach ($total_row as $total_row_key => $total_row_value) {
                $mailsms_array                 = $this->feegrouptype_model->getFeeGroupByID($this->input->post('fee_groups_feetype_id_' . $total_row_value));
                $mailsms_array->invoice        = json_encode($fees_record[$total_row_key]);
                $mailsms_array->contact_no     = $send_to;
                $mailsms_array->email          = $email;
                $mailsms_array->parent_app_key = $parent_app_key;
                $this->mailsmsconf->mailsms('fee_submission', $mailsms_array);
            }
            $array = array('status' => 1, 'error' => '');
            echo json_encode($array);
        }
    }













    // studentfeelist


    public function studentfeelist(){
        

        // if($_GET['type']=='delete'){
        //     $this->load->model('Receipt_model');
        //     if ($this->Receipt_model->delete_receipt($_GET['id'])) {
        //         $this->session->set_flashdata('success', 'Receipt deleted successfully.');
        //     } else {
        //         $this->session->set_flashdata('error', 'Failed to delete receipt.');
        //     }
        //     redirect('studentfee/studentfeelist');
        // }

        if ($_GET['type'] == 'delete' && !empty($_GET['receipt_no'])) {
            $receipt_no = $_GET['receipt_no'];


            $res_del=$this->db
                ->select('student_id,date_time,back_id,receipt_no,mode,fee_head,late_fees,ledger_amt,total_fees,discount_amt,net_fees,receipt_amt,balance_amt,remarks,fee_head_name,SUM(balance_amount) as balance_amount,(total) as total, SUM(rec_discount) as rec_discount, SUM(rec_amount) as rec_amount')
                ->where_in('receipt_no', $receipt_no)
                ->group_by('fee_head')
                ->get('receipts')
                ->row();


            var_dump($res_del);
            if($res_del->fee_head_name=='Ledger Amount'){
                $receipt_amt=$res_del->receipt_amt;
                $this->db->where('student_id', $res_del->student_id);
                $query = $this->db->get('student_session');

                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $current_discount = (int)$row->fees_discount;

                    // Step 2: Add ₹100 to current discount
                    $new_discount = $current_discount + $receipt_amt;

                    // Step 3: Update the `fees_discount`
                    $this->db->where('student_id', $res_del->student_id);
                    $this->db->update('student_session', array('fees_discount' => $new_discount));

                    if ($this->db->affected_rows() > 0) {
                        
                    }
                }
            }
           
            $this->load->model('Receipt_model');

            // Step 1: Get all receipts with the same receipt_no
            $receiptList = $this->Receipt_model->get_receipts_by_receipt_no($receipt_no);

            // Step 2: Backup each receipt row
            foreach ($receiptList as $receipt) {
                $this->Receipt_model->backup_receipt_data($receipt);
            }

            // Step 3: Delete from original receipts table
            $this->Receipt_model->delete_receipts_by_receipt_no($receipt_no);

            $this->session->set_flashdata('success', 'Receipts with Receipt No: ' . $receipt_no . ' backed up and deleted successfully.');
            redirect('studentfee/studentfeelist');
            
        }






        if (!$this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            access_denied();
        }
        // $this->session->set_userdata('top_menu', 'Reports');
        // $this->session->set_userdata('sub_menu', 'Reports/finance');
        // $this->session->set_userdata('subsub_menu', 'Reports/finance/studentfeelist');

         $this->session->set_userdata('top_menu', $this->lang->line('fees_collection'));
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeelist');





        $data['title']       = 'student fees';
        $data['title']       = 'student fees';
        $class               = $this->class_model->get();
        $data['classlist']   = $class;
        $data['sch_setting'] = $this->sch_setting_detail;
        // $data['get_receipt'] = $this->get_receipt
	
        // $data['receipt_data'] = $this->Receipt_model->get_receipt();

        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');


        // die;

        // paginate
        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->Receipt_model->get_receipt_count($from_date, $to_date);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('studentfee/studentfeelist');
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

        $data['receipt_data'] = $this->Receipt_model->get_receipt($config['per_page'], $page,$from_date, $to_date);
        $data['pagination_links'] = $this->pagination->create_links();

        // end paginate





        // var_dump($data['receipt_data']);
        // die;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
          
          
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportFees_List', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportFees_List', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $data['student_due_fee'] = array();
                $class_id                = $this->input->post('class_id');
                $section_id              = $this->input->post('section_id');
                $student_id              = $this->input->post('student_id');
                $student                 = $this->student_model->get($student_id);
                $data['student']         = $student;

                $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
                $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee']      = $student_due_fee;
                $data['class_id']             = $class_id;
                $data['section_id']           = $section_id;
                $data['student_id']           = $student_id;
                $category                     = $this->category_model->get();
                $data['categorylist']         = $category;
				
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportFees_List', $data);
                $this->load->view('layout/footer', $data);
            }
        }




    }


// studentfee_deletedlist



    public function studentfee_deletedlist(){
        

       



        if (!$this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            access_denied();
        }
        // $this->session->set_userdata('top_menu', 'Reports');
        // $this->session->set_userdata('sub_menu', 'Reports/finance');
        // $this->session->set_userdata('subsub_menu', 'Reports/finance/studentfeelist');

         $this->session->set_userdata('top_menu', $this->lang->line('fees_collection'));
        $this->session->set_userdata('sub_menu', 'studentfee/studentfee_deletedlist');





        $data['title']       = 'student fees';
        $data['title']       = 'student fees';
        $class               = $this->class_model->get();
        $data['classlist']   = $class;
        $data['sch_setting'] = $this->sch_setting_detail;
        // $data['get_receipt'] = $this->get_receipt
	
        // $data['receipt_data'] = $this->Receipt_model->get_receipt();

        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');


        // die;

        // paginate
        $per_page_input = $this->input->get('per_page');
        $total_rows = $this->Receipt_model->get_deleted_receipt_count($from_date, $to_date);

        $per_page = (!empty($per_page_input) && $per_page_input != 'all') ? (int)$per_page_input : 10;
        $per_page = ($per_page_input == 'all') ? $total_rows : $per_page;

        $config['base_url'] = base_url('studentfee/studentfee_deletedlist');
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

        $data['receipt_data'] = $this->Receipt_model->get_deleted_receipt($config['per_page'], $page,$from_date, $to_date);
        $data['pagination_links'] = $this->pagination->create_links();

        // end paginate





        // var_dump($data['receipt_data']);
        // die;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
          
          
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfee_deletedlist', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfee_deletedlist', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $data['student_due_fee'] = array();
                $class_id                = $this->input->post('class_id');
                $section_id              = $this->input->post('section_id');
                $student_id              = $this->input->post('student_id');
                $student                 = $this->student_model->get($student_id);
                $data['student']         = $student;

                $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
                $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee']      = $student_due_fee;
                $data['class_id']             = $class_id;
                $data['section_id']           = $section_id;
                $data['student_id']           = $student_id;
                $category                     = $this->category_model->get();
                $data['categorylist']         = $category;
				
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfee_deletedlist', $data);
                $this->load->view('layout/footer', $data);
            }
        }






    }















}
