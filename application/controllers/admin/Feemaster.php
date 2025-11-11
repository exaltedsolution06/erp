<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feemaster extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    /*function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['title'] = 'Feemaster List';
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
 
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup();
        $data['feemasterList'] = $feegroup_result;

        $this->form_validation->set_rules('feetype_id', $this->lang->line('feetype'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|numeric');

        $this->form_validation->set_rules(
            'fee_groups_id', $this->lang->line('feegroup'), array('required',array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists')))
        );
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if(!empty($this->input->post('update_id'))){

                 if (!empty($this->input->post('fee_head')) and !empty($this->input->post('amount')) and !empty($this->input->post('classes_id')) and !empty($this->input->post('feetype_id')) ) {
                        $id=$this->input->post('update_id');
                        $data = [
                            'fee_group_id' => $this->input->post('fee_head'),
                            'amount' => $this->input->post('amount'),
                            'class_ids' => json_encode($this->input->post('classes_id')),
                            'category_ids' => json_encode($this->input->post('feetype_id'))
                        ];
                        $this->db->where('id', $id);
                        $this->db->update('fees_plan', $data);
                        $this->session->set_flashdata('msg', '<div class="alert alert-success">Fee Master update successfully.</div>');
                        redirect('admin/feemaster');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger">All field required.</div>');
                        redirect('admin/feemaster/edit/'.$this->input->post('update_id'));
                    }                
                die;
            }
            if (!empty($this->input->post('fee_head')) and !empty($this->input->post('amount')) and !empty($this->input->post('classes_id')) and !empty($this->input->post('feetype_id')) ) {               
                $data = [
                    'fee_group_id' => $this->input->post('fee_head'),
                    'amount' => $this->input->post('amount'),
                    'class_ids' => json_encode($this->input->post('classes_id')),
                    'category_ids' => json_encode($this->input->post('feetype_id'))
                ];
                $this->db->insert('fees_plan', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Fee Master created successfully.</div>');
                redirect('admin/feemaster');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">All field required.</div>');
                redirect('admin/feemaster');
            }
        }    
        $filter_amount = $this->input->get('filter_amount');
        $filter_fee_head = $this->input->get('filter_fee_head');
        $filter_class = $this->input->get('filter_class');
        $filter_category = $this->input->get('filter_category');
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('fee_head')->result_array();
        $data['classes'] = $this->db->order_by('id', 'DESC')->get('classes')->result_array();
        // $data['fees_plan'] = $this->db->order_by('id', 'DESC')->get('fees_plan')->result_array();
        $this->db->select('fees_plan.*, fee_head.fees_heading as fee_head_name');
        $this->db->from('fees_plan');
        $this->db->join('fee_head', 'fee_head.id = fees_plan.fee_group_id', 'left');
        if (!empty($filter_fee_head)) {
            $this->db->where('fees_plan.fee_group_id', $filter_fee_head);
        }
        if (!empty($filter_class)) {
            $this->db->like('fees_plan.class_ids', $filter_class); // class_ids is stored as JSON string
        }
        if (!empty($filter_category)) {
            $this->db->like('fees_plan.category_ids', $filter_category); // category_ids is also JSON string
        }
        if (!empty($filter_amount)) {
            $this->db->like('fees_plan.amount', $filter_amount);
        }
        $this->db->order_by('fees_plan.id', 'DESC');
        $data['fees_plan'] = $this->db->get()->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/feemasterList', $data);
        $this->load->view('layout/footer', $data);
    }*/
	
	public function index()
	{
		$this->session->set_userdata('top_menu', 'Academics');
		$this->session->set_userdata('sub_menu', 'admin/feemaster');
		$data['title'] = 'Feemaster List';

		$data['feegroupList'] = $this->feegroup_model->get();
		$data['feetypeList']  = $this->feetype_model->get();
		$data['feemasterList'] = $this->feesessiongroup_model->getFeesByGroup();
		$data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('fee_head')->result_array();
		$data['classes']   = $this->db->order_by('id', 'DESC')->get('classes')->result_array();

		// Handle form submission
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$update_id    = $this->input->post('update_id');
			$fee_group_id = trim($this->input->post('fee_head'));
			$classes      = $this->input->post('classes_id');
			$feetypes     = $this->input->post('feetype_id');
			$amount       = trim($this->input->post('amount'));

			// Ensure arrays
			$classes  = is_array($classes) ? $classes : (empty($classes) ? [] : [$classes]);
			$feetypes = is_array($feetypes) ? $feetypes : (empty($feetypes) ? [] : [$feetypes]);

			// Basic validation
			if (empty($fee_group_id) || empty($classes) || empty($feetypes) || empty($amount)) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">All fields are required.</div>');
				if (!empty($update_id)) {
					redirect('admin/feemaster/edit/' . $update_id);
				} else {
					redirect('admin/feemaster');
				}
				return;
			}

			// Normalize JSON for saving
			sort($classes);
			sort($feetypes);
			$class_json   = json_encode($classes);
			$feetype_json = json_encode($feetypes);

			// Duplicate check (if any class overlaps in same fee_group)
			$this->db->where('fee_group_id', $fee_group_id);
			if (!empty($update_id)) {
				$this->db->where('id !=', $update_id);
			}
			$existing_records = $this->db->get('fees_plan')->result_array();

			$is_duplicate = false;
			$duplicate_classes = [];

			foreach ($existing_records as $record) {
				$existing_classes = json_decode($record['class_ids'], true);
				if (!is_array($existing_classes)) {
					continue;
				}

				// Check if any class overlaps
				$overlap = array_intersect($classes, $existing_classes);
				if (!empty($overlap)) {
					$is_duplicate = true;
					$duplicate_classes = array_merge($duplicate_classes, $overlap);
				}
			}

			if ($is_duplicate) {
				$duplicate_list = implode(', ', array_unique($duplicate_classes));
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Duplicate entry! The following class(es) already exist under this Fees Head</b>.</div>');
				if (!empty($update_id)) {
					redirect('admin/feemaster/edit/' . $update_id);
				} else {
					redirect('admin/feemaster');
				}
				return;
			}

			// Prepare data for insert/update
			$data_insert = [
				'fee_group_id' => $fee_group_id,
				'amount'       => $amount,
				'class_ids'    => $class_json,
				'category_ids' => $feetype_json
			];

			// Update or insert
			if (!empty($update_id)) {
				$this->db->where('id', $update_id);
				$this->db->update('fees_plan', $data_insert);
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Record updated successfully.</div>');
			} else {
				$this->db->insert('fees_plan', $data_insert);
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Record created successfully.</div>');
			}

			redirect('admin/feemaster');
		}

		// Load listing
		/*$this->db->select('fees_plan.*, fee_head.fees_heading as fee_head_name');
		$this->db->from('fees_plan');
		$this->db->join('fee_head', 'fee_head.id = fees_plan.fee_group_id', 'left');
		$this->db->order_by('fees_plan.id', 'DESC');
		$data['fees_plan'] = $this->db->get()->result_array();*/
		
		$filter_amount = $this->input->get('filter_amount');
        $filter_fee_head = $this->input->get('filter_fee_head');
        $filter_class = $this->input->get('filter_class');
        $filter_category = $this->input->get('filter_category');
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('fee_head')->result_array();
        $data['classes'] = $this->db->order_by('id', 'DESC')->get('classes')->result_array();
        // $data['fees_plan'] = $this->db->order_by('id', 'DESC')->get('fees_plan')->result_array();
        $this->db->select('fees_plan.*, fee_head.fees_heading as fee_head_name');
        $this->db->from('fees_plan');
        $this->db->join('fee_head', 'fee_head.id = fees_plan.fee_group_id', 'left');
        if (!empty($filter_fee_head)) {
            $this->db->where('fees_plan.fee_group_id', $filter_fee_head);
        }
        if (!empty($filter_class)) {
            $this->db->like('fees_plan.class_ids', $filter_class); // class_ids is stored as JSON string
        }
        if (!empty($filter_category)) {
            $this->db->like('fees_plan.category_ids', $filter_category); // category_ids is also JSON string
        }
        if (!empty($filter_amount)) {
            $this->db->like('fees_plan.amount', $filter_amount);
        }
        $this->db->order_by('fees_plan.id', 'DESC');
        $data['fees_plan'] = $this->db->get()->result_array();
		

		$this->load->view('layout/header', $data);
		$this->load->view('admin/feemaster/feemasterList', $data);
		$this->load->view('layout/footer', $data);
	}
    function delete($id) {
        // if (!$this->rbac->hasPrivilege('fees_master', 'can_delete')) {
        //     access_denied();
        // }
        $data['title'] = 'Fees Master List';
        // $this->feegrouptype_model->remove($id);
        $this->db->where('id', $id);
        // $this->db->where('is_system', 0);
        $this->db->delete('fees_plan');
        redirect('admin/feemaster/index');
    }

    function deletegrp($id) {
        $data['title'] = 'Fees Master List';
        $this->feesessiongroup_model->remove($id);
        redirect('admin/feemaster');
    }

    function edit($id) {
         $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['id'] = $id;
        $feegroup_type = $this->db->where('id',$id)->order_by('id', 'DESC')->get('fees_plan')->result_array();


       
        $data['feegroup_type'] = $feegroup_type;

        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('fee_head')->result_array();
        $data['classes'] = $this->db->order_by('id', 'DESC')->get('classes')->result_array();
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup();
        $data['feemasterList'] = $feegroup_result;
        $this->form_validation->set_rules('feetype_id', $this->lang->line('feetype'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required');
        $this->form_validation->set_rules(
                'fee_groups_id', $this->lang->line('feegroup'), array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
                )
        );

        if(isset($_POST['account_type'] ) && $_POST['account_type'] =='fix'){
            $this->form_validation->set_rules('fine_amount', $this->lang->line('fine') . " " . $this->lang->line('amount'), 'required|numeric');
            $this->form_validation->set_rules('due_date', $this->lang->line('due_date'), 'trim|required|xss_clean');

        }elseif(isset($_POST['account_type']) && ($_POST['account_type']=='percentage')){
            $this->form_validation->set_rules('fine_percentage', $this->lang->line('percentage'), 'required|numeric');
            $this->form_validation->set_rules('fine_amount', $this->lang->line('fine') . " " . $this->lang->line('amount'), 'required|numeric');
             $this->form_validation->set_rules('due_date', $this->lang->line('due_date'), 'trim|required|xss_clean');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $data['type']='edit';
            $this->load->view('admin/feemaster/feemasterList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $insert_array = array(
                'id' => $this->input->post('id'),
                'feetype_id' => $this->input->post('feetype_id'),
                'due_date' => $this->customlib->dateFormatToYYYYMMDD($this->input->post('due_date')),
                'amount' => $this->input->post('amount'),
                'fine_type' => $this->input->post('account_type'),
                'fine_percentage' => $this->input->post('fine_percentage'),
                'fine_amount' => $this->input->post('fine_amount'),
            );
            
            $feegroup_result = $this->feegrouptype_model->add($insert_array);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/feemaster/index');
        }
    }

    function assign($id) {
        if (!$this->rbac->hasPrivilege('fees_group_assign', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['id'] = $id;
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup($id);
        $data['feegroupList'] = $feegroup_result;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting'] = $this->sch_setting_detail;

        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;

        $category = $this->category_model->get();
        $data['categorylist'] = $category;


        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['category_id'] = $this->input->post('category_id');
            $data['gender'] = $this->input->post('gender');
            $data['rte_status'] = $this->input->post('rte');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $resultlist = $this->studentfeemaster_model->searchAssignFeeByClassSection($data['class_id'], $data['section_id'], $id, $data['category_id'], $data['gender'], $data['rte_status']);
            $data['resultlist'] = $resultlist;
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/assign', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>