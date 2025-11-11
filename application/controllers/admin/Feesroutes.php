<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feesroutes extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('account_model');
    }

    function index()
    {
        // $this->session->set_flashdata('msg', '');
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'feetype/setroute');
        $data['title'] = 'Add Feetype';
        $data['title_list'] = 'Recent FeeType';
		// Restore input after error
		$old_input = $this->session->flashdata('old_input');
		if (!empty($old_input)) {
			$data['old_input'] = $old_input;
			$data['selected_months'] = isset($old_input['months']) ? $old_input['months'] : [];
		}
		// Clear old input if not coming from a failed validation
		if (!$this->session->flashdata('msg') || strpos($this->session->flashdata('msg'), 'alert-danger') === false) {
			$this->session->unset_userdata('old_input');
			//$this->session->unset_userdata('selected_months');
		}


        $feegroup_result = $this->feetype_model->get();
        $data['feetypeList'] = $feegroup_result;
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('route_head')->result_array();
		$section_result      = $this->account_model->get();
        $data['account'] = $section_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feesroutes/routes', $data);
        $this->load->view('layout/footer', $data);
    }





    // submit_fee_head

   /* public function submit_fee_head()
    {

        $this->form_validation->set_rules('fees_heading', 'Fees Heading', 'required');
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');


        $months = $this->input->post('months[]');
        $frequency = $this->input->post('frequency');
        $update_id = $this->input->post('update_id');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">All field required</div>');
            if(!empty($update_id)){
                 redirect('admin/feesroutes/edit/'.$update_id);
            }else{
                 redirect('admin/feesroutes/index');
            }
           
        } else {
            // Validate months based on frequency
            $monthCount = is_array($months) ? count($months) : 0;

            if ($frequency == 'Annual' && $monthCount != 1) {

                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 1 month for Annual frequency</div>');
                if(!empty($update_id)){
                    redirect('admin/feesroutes/edit/'.$update_id);
                }else{
                    redirect('admin/feesroutes/index');
                }
                return;
            } elseif ($frequency == 'Quarterly' && $monthCount != 3) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 3 months for Quarterly frequency.</div>');
                if(!empty($update_id)){
                    redirect('admin/feesroutes/edit/'.$update_id);
                }else{
                    redirect('admin/feesroutes/index');
                }
                return;
            } 
            // Save data
            $data = [
                'fees_heading' => $this->input->post('fees_heading'),
                'frequency' => $this->input->post('frequency'),
                'account_name' => '',
                'months' => json_encode($this->input->post('months[]'))
            ];

            if(!empty($update_id)){

                $this->db->where('id', $update_id);
                $this->db->update('route_head', $data);

                $this->session->set_flashdata('msg', '<div class="alert alert-success">Route set successfully!</div>');
                redirect('admin/feesroutes');
            }else{
                 $this->db->insert('route_head', $data);
                 $this->session->set_flashdata('msg', '<div class="alert alert-success">Route set successfully!</div>');
                redirect('admin/feesroutes');
            }
            

            
        }


    }*/
	public function submit_fee_head()
	{
		$update_id = $this->input->post('update_id');

		// --- Validation rules ---
		$this->form_validation->set_rules(
			'fees_heading',
			$this->lang->line('fees_heading'),
			'trim|required|xss_clean|callback_check_data_unique[' . $update_id . ']'
		);
		$this->form_validation->set_rules('frequency', 'Frequency', 'required');
		$this->form_validation->set_rules('account_name', 'Account Name', 'required');

		// --- If validation fails ---
		if ($this->form_validation->run() == FALSE) {
			$error = validation_errors();
			if (empty($error)) {
				$error = 'All fields are required.';
			}

			$msg = '<div class="alert alert-danger text-left">' . $error . '</div>';
			$this->session->set_flashdata('msg', $msg);

			// 🔹 Keep old data (so form repopulates)
			$this->session->set_flashdata('old_input', $this->input->post());

			redirect(!empty($update_id) ? 'admin/feesroutes/edit/' . $update_id : 'admin/feesroutes/index');
			return;
		}

		// --- Frequency and months validation ---
		$months = $this->input->post('months');
		$frequency = $this->input->post('frequency');
		$monthCount = is_array($months) ? count($months) : 0;
		$msg = '';

		if ($frequency == 'Annual' && $monthCount != 1) {
			$msg = '<div class="alert alert-danger text-left">Please select exactly 1 month for Annual frequency.</div>';
		} elseif ($frequency == 'Quarterly' && $monthCount != 4) {
			$msg = '<div class="alert alert-danger text-left">Please select exactly 4 months for Quarterly frequency.</div>';
		} elseif ($frequency == 'Monthly' && ($monthCount < 1 || $monthCount > 12)) {
			$msg = '<div class="alert alert-danger text-left">Please select between 1 and 12 months for Monthly frequency.</div>';
		}

		if (!empty($msg)) {
			$this->session->set_flashdata('msg', $msg);
			$this->session->set_flashdata('old_input', $this->input->post());
			redirect(!empty($update_id) ? 'admin/feesroutes/edit/' . $update_id : 'admin/feesroutes/index');
			return;
		}

		// --- Prepare data ---
		$data = [
			'fees_heading' => $this->input->post('fees_heading'),
			'frequency'    => $frequency,
			'account_name' => $this->input->post('account_name'),
			'months'       => json_encode($months)
		];

		// --- Insert or Update ---
		if (!empty($update_id)) {
			$this->db->where('id', $update_id);
			$this->db->update('route_head', $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Route updated successfully!</div>');
		} else {
			$this->db->insert('route_head', $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Route added successfully!</div>');
		}
		 // ✅ Reset all old input (so form clears on reload)
		$this->session->unset_userdata('old_input');

		redirect('admin/feesroutes');
	}



	/**
	 * Custom validation callback to check uniqueness of fees_heading
	 */
	public function check_data_unique($fees_heading, $id)
	{
		$exists = $this->feetype_model->data_route_exists($fees_heading, $id);

		if ($exists) {
			$this->form_validation->set_message('check_data_unique', 'This Route Heading already exists. Please use a different name.');
			return false;
		} else {
			return true;
		}
	}


    
    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->db->where('id',$id);
        $this->db->delete('route_head');
        redirect('admin/feesroutes/index');
    }



    function edit($id) {
        
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'feetype/setroute');
        $data['id'] = $id;
        $feetype = $this->db->where('id',$id)->order_by('id', 'DESC')->get('route_head')->result_array();
        $data['feedata'] = $feetype;
		$section_result      = $this->account_model->get();
        $data['account'] = $section_result;
        $data['type']='edit';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feesroutes/routes', $data);
        $this->load->view('layout/footer', $data);

    }























    // --------------------------- 2



    public function plan()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/setplan');
        $data['title'] = 'Route Plan';
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup();
        $data['feemasterList'] = $feegroup_result;

        /*$this->form_validation->set_rules('feetype_id', $this->lang->line('feetype'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|numeric');

        $this->form_validation->set_rules(
            'fee_groups_id',
            $this->lang->line('feegroup'),
            array(
                'required',
                array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
            )
        );*/
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //if (!empty($this->input->post('fee_head')) and !empty($this->input->post('amount')) and !empty($this->input->post('classes_id')) and !empty($this->input->post('feetype_id'))) {
                $update_id		= $this->input->post('update_id');
				$fee_group_id 	= trim($this->input->post('fee_head'));
				$classes      	= $this->input->post('classes_id');
				$feetypes     	= $this->input->post('feetype_id');
				$amount       	= trim($this->input->post('amount'));
				
                /*$data = [
                    'fee_group_id' => $this->input->post('fee_head'),
                    'amount' => $this->input->post('amount'),
                    'class_ids' => json_encode($this->input->post('classes_id')),
                    'category_ids' => json_encode($this->input->post('feetype_id'))
                ];*/
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
				$existing_records = $this->db->get('route_plan')->result_array();

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
						redirect('admin/feesroutes/edit1/' . $update_id);
					} else {
						redirect('admin/feesroutes/plan');
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
			
			
                if(!empty($update_id)){
                    $this->db->where('id',$update_id);
                    $this->db->update('route_plan', $data_insert);
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Record updated successfully.</div>');
                }else{
                    $this->db->insert('route_plan', $data_insert);
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Record created successfully.</div>');
                }
				redirect('admin/feesroutes/plan');
               /* if(!empty($update_id)){
                    $this->session->set_flashdata('msg', '<div class="alert alert-success">Fee Master update successfully.</div>');
                    redirect('admin/feesroutes/plan');
                }else{
                    $this->session->set_flashdata('msg', '<div class="alert alert-success">Fee Master created successfully.</div>');
                    redirect('admin/feesroutes/plan');
                }*/
				
            /*} else {
                if(!empty($update_id)){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">All field required.</div>');
                    redirect('admin/feesroutes/edit1/'.$update_id);
                }else{
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">All field required.</div>');
                    redirect('admin/feesroutes/plan');
                }
                
            }*/
        }
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('route_head')->result_array();
        $data['classes'] = $this->db->order_by('id', 'DESC')->get('classes')->result_array();
        // $data['fees_plan'] = $this->db->order_by('id', 'DESC')->get('fees_plan')->result_array();
        $this->db->select('route_plan.*, route_head.fees_heading as fee_head_name');
        $this->db->from('route_plan');
        $this->db->join('route_head', 'route_head.id = route_plan.fee_group_id', 'left');
        if ($this->input->get('fee_head')) {
            $this->db->where('fee_group_id', $this->input->get('fee_head'));
        }
        if ($this->input->get('class_id')) {
            $class_id = $this->input->get('class_id');
            $this->db->like('class_ids', $class_id); // assumes JSON string, can be refined
        }
        if ($this->input->get('category_id')) {
            $cat_id = $this->input->get('category_id');
            $this->db->like('category_ids', $cat_id);
        }
        if ($this->input->get('amount')) {
            $this->db->where('amount', $this->input->get('amount'));
        }
        $this->db->order_by('route_plan.id', 'DESC');
        $data['fees_plan'] = $this->db->get()->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feesroutes/routes_plan', $data);
        $this->load->view('layout/footer', $data);
    }




    

    
    function delete1($id) {
        $data['title'] = 'Fees Master List';
        $this->db->where('id',$id);
        $this->db->delete('route_plan');
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Fee Master Delete successfully.</div>');
                
        redirect('admin/feesroutes/plan');
    }



    function edit1($id) {
        
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'feetype/setroute');
        $data['id'] = $id;
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('route_head')->result_array();
        $data['classes'] = $this->db->order_by('id', 'DESC')->get('classes')->result_array();
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $feetype = $this->db->where('id',$id)->order_by('id', 'DESC')->get('route_plan')->result_array();
        $data['update_data'] = $feetype;
        $data['type']='edit';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feesroutes/routes_plan', $data);
        $this->load->view('layout/footer', $data);

    }










    


















}

?>