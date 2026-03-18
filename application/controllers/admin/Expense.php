<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Expense extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Customlib');
        $this->config->load('app-config');
		$this->current_session = $this->setting_model->getCurrentSession();
		$this->load->model('Income_model');
    }

    public function index()
    {

        if (!$this->rbac->hasPrivilege('add_expense', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'expense/index');
        $data['title']      = 'Add Expense';
        $data['title_list'] = 'Recent Expenses';
        $this->form_validation->set_rules('exp_head_id', $this->lang->line('expense_head'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('staff_id', $this->lang->line('staff'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('documents', $this->lang->line('documents'), 'callback_handle_upload');
        if ($this->form_validation->run() == false) {

        } else {
			
			// check expense less than income 
			$expense_amt = $this->input->post('amount');
			$total_income = $this->Income_model->get_total_income($data);
			$total_expense = $this->expense_model->get_total_expense($data);
			//echo $total_expense; die;
			$bal_amt = $total_income - ($total_expense + $expense_amt);
			//echo $bal_amt; die;
			if($bal_amt > 0)
			{
				if (!empty($_FILES['documents']['name'])) {
					$config['upload_path'] = 'uploads/expense/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['file_name'] = $_FILES['documents']['name'];

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('documents')) {
						$uploadData = $this->upload->data();
						$picture = $uploadData['file_name'];
					} else {
						$picture = '';
					}
				} else {
					$picture = null;
				}
				
				
				$data = array(
					'session_id' => $this->current_session,
					'balance_type' =>1,
					'head_id' => $this->input->post('exp_head_id'),
					'staff_id' => $this->input->post('staff_id'),
					'date' => date('Y-m-d H:i:s', strtotime($this->input->post('date'))),
					'amount' => $this->input->post('amount'),
					'attatchment' => $picture,
					'description' => $this->input->post('description')
				);

				$insert_id = $this->expense_model->add($data);

				
				if($insert_id)
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
				}
				else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Name w.r.t Expense Head already exists</div>');
				}
			}
			else
			{
				$remaining_bal = $total_income - $total_expense;
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">' . $this->lang->line('expense_check') . ' ('. $remaining_bal .')' .'</div>');
			}
            redirect('admin/expense/index');
        }
		
		
		$staffList = $this->staff_model->get();
		//echo "<pre>";print_r($staffList);die;
		 $data['staffList'] = $staffList;
		
        $expense_result      = $this->expense_model->get();
		//echo "<pre>";print_r($expense_result);die;
        $data['expenselist'] = $expense_result;
        $expnseHead          = $this->expensehead_model->get();
        $data['expheadlist'] = $expnseHead;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/expense/expenseList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function download($documents)
    {
        $this->load->helper('download');
        $filepath = "./uploads/school_expense/" . $this->uri->segment(6);
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(6);
        force_download($name, $data);
    }

    public function handle_upload()
    {

        $image_validate = $this->config->item('file_validate');
        $result = $this->filetype_model->get();
        if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {

            $file_type         = $_FILES["documents"]['type'];
            $file_size         = $_FILES["documents"]["size"];
            $file_name         = $_FILES["documents"]["name"];
            $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->file_extension)));
            $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->file_mime)));
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($files = filesize($_FILES['documents']['tmp_name'])) {

                if (!in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $result->file_size) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', "File Type / Extension Error Uploading  Image");
                return false;
            }

            return true;
        }
        return true;
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('add_expense', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Fees Master List';
        $expense         = $this->expense_model->get($id);
        $data['expense'] = $expense;
        $this->load->view('layout/header', $data);
        $this->load->view('expense/expenseShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function getByFeecategory()
    {
        $feecategory_id = $this->input->get('feecategory_id');
        $data           = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }

    public function getStudentCategoryFee()
    {
        $type     = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data     = $this->expense_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('add_expense', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->expense_model->remove($id);
        redirect('admin/expense/index');
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('add_expense', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Fees Master';
        $this->form_validation->set_rules('expense', $this->lang->line('fees_master'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('expense/expenseCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'expense' => $this->input->post('expense'),
            );
            $this->expense_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('expense/index');
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('add_expense', 'can_edit')) {
            access_denied();
        }
        $data['title']       = 'Edit Fees Master';
        $data['id']          = $id;
        $expense             = $this->expense_model->get($id);
		if(!$expense){
			redirect('admin/expense/index');
		}
        $data['expense']     = $expense;
        $data['title_list']  = 'Fees Master List';
        $expense_result      = $this->expense_model->get();
        $data['expenselist'] = $expense_result;
        $expnseHead          = $this->expensehead_model->get();
        $data['expheadlist'] = $expnseHead;
		$staffList = $this->staff_model->get();
		$data['staffList'] = $staffList;
		 
        $this->form_validation->set_rules('exp_head_id', $this->lang->line('expense_head'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('documents', $this->lang->line('documents'), 'callback_handle_upload');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('staff_id', $this->lang->line('staff'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/expense/expenseEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
			
            if (!empty($_FILES['documents']['name'])) {
				$config['upload_path'] = 'uploads/expense/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['documents']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('documents')) {
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];
				} else {
					$picture = '';
				}
			} else {
				$picture = null;
			}
			
			
            $data = array(
				'id' => $this->input->post('id'),
                'session_id' => $this->current_session,
                'balance_type' =>1,
                'head_id' => $this->input->post('exp_head_id'),
                'staff_id' => $this->input->post('staff_id'),
                'date' => date('Y-m-d H:i:s', strtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'attatchment' => $picture,
                'description' => $this->input->post('description')
            );
            $insert_id = $this->expense_model->add($data);
            /*if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
                $fileInfo = pathinfo($_FILES["documents"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["documents"]["tmp_name"], "./uploads/school_expense/" . $img_name);
                $data_img = array('id' => $id, 'documents' => 'uploads/school_expense/' . $img_name);
                $this->expense_model->add($data_img);
            }*/
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/expense/index');
        }
    }

    public function expenseSearch()
    {
        if (!$this->rbac->hasPrivilege('search_expense', 'can_view')) {
            access_denied();
        }
        $data['searchlist']  = $this->customlib->get_searchtype();
        $data['search_type'] = '';
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'expense/expensesearch');
        $data['title'] = 'Search Expense';
       
       
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                 $this->form_validation->set_rules('search_type', $this->lang->line('search')." ".$this->lang->line('type'), 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {

                } else {

                     $search              = $this->input->post('search_type');
                $data['search_type'] = $_POST['search_type'];

                if (isset($_POST['search_type']) && $_POST['search_type'] != '') {

                    if ($_POST['search_type'] == 'all') {

                        $dates = $this->customlib->get_betweendate('this_year');
                    } else {
                        $dates = $this->customlib->get_betweendate($_POST['search_type']);
                    }
                } else {
                    $dates               = $this->customlib->get_betweendate('this_year');
                    $data['search_type'] = '';
                }
				
                $dateformat = $this->customlib->getSchoolDateFormat();

                $date_from         = date('Y-m-d', strtotime($dates['from_date']));
                $date_to           = date('Y-m-d', strtotime($dates['to_date']));
                $data['exp_title'] = 'Expense Result From ' . date($dateformat, strtotime($date_from)) . " To " . date($dateformat, strtotime($date_to));
                $date_from         = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_from));
                $date_to           = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_to));

                $resultList         = $this->expense_model->search("", $date_from, $date_to);
                $data['resultList'] = $resultList;
                }
				//echo "<pre>";print_r($resultList);die;

               
            } else {
                $data['exp_title'] = 'Expense Result';
                $this->form_validation->set_rules('search_text', $this->lang->line('search_text'), 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {

                } else {

                    $search_text        = $this->input->post('search_text');
                    $resultList         = $this->expense_model->search($search_text, "", "");
                    $data['resultList'] = $resultList;
                }
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/expense/expenseSearch', $data);
            $this->load->view('layout/footer', $data);
       
    }
	
	public function all_report()
	{
		if (!$this->rbac->hasPrivilege('income_expense_report', 'can_view')) {
            access_denied();
        }
		
		$data['searchlist']  = $this->customlib->get_searchtype();
		$data['search_type'] = '';
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'expense/all_report');
        $data['title'] = 'Search Expense';
		
		$search = $this->input->post('search');
		
		if ($search == "search_filter") {
			 $this->form_validation->set_rules('search_type', $this->lang->line('search')." ".$this->lang->line('type'), 'trim|required|xss_clean');
			if ($this->form_validation->run() == false) {

			} else {

				 $search              = $this->input->post('search_type');
			$data['search_type'] = $_POST['search_type'];

			if (isset($_POST['search_type']) && $_POST['search_type'] != '') {

				if ($_POST['search_type'] == 'all') {

					$dates = $this->customlib->get_betweendate('this_year');
				} else {
					$dates = $this->customlib->get_betweendate($_POST['search_type']);
				}
			} else {
				$dates               = $this->customlib->get_betweendate('this_year');
				$data['search_type'] = '';
			}
			
			$dateformat = $this->customlib->getSchoolDateFormat();

			$date_from         = date('Y-m-d', strtotime($dates['from_date']));
			$date_to           = date('Y-m-d', strtotime($dates['to_date']));
			$data['exp_title'] = 'Expense Result From ' . date($dateformat, strtotime($date_from)) . " To " . date($dateformat, strtotime($date_to));
			$date_from         = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_from));
			$date_to           = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_to));

			$resultList         = $this->expense_model->search_all_report("", $date_from, $date_to, "");
			$data['resultList'] = $resultList;
			}
			$data['credit_or_debit'] = '';
			//echo "<pre>";print_r($resultList);die;

		   
		}
		else if($search == "search_credit_debit")
		{
			
			$this->form_validation->set_rules('credit_debit', $this->lang->line('credit_debit'), 'trim|required|xss_clean');
			if ($this->form_validation->run() == false) {

			} else {
				
				$search_balance = $this->input->post('credit_debit');
				if($search_balance == 0)
				{
					$resultList         = $this->expense_model->search_all_report("","","",$search_balance);
				}
				
				if($search_balance == 1)
				{
					$resultList         = $this->expense_model->search_all_report("","","",$search_balance);
				}
				$data['credit_or_debit'] = 1;
				$data['resultList'] = $resultList;
			}
		}
		else {
			
			$data['exp_title'] = 'Expense Result';
			$this->form_validation->set_rules('search_text', $this->lang->line('search_text'), 'trim|required|xss_clean');
			if ($this->form_validation->run() == false) {

			} else {
				
				$search_text        = $this->input->post('search_text');
				$resultList         = $this->expense_model->search_all_report($search_text, "", "","");
				$data['resultList'] = $resultList;
				$data['credit_or_debit'] = '';
				//echo "<pre>";print_r($resultList);die;
			}
		}
		
		
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/incomeexpensereport/incomeexpenseSearch', $data);
        $this->load->view('layout/footer', $data);
	}

}
