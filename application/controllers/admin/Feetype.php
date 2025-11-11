<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feetype extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

    function index() {
        // $this->session->set_flashdata('msg', '');
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'feetype/index');
        $data['title'] = 'Add Feetype';
        $data['title_list'] = 'Recent FeeType';

        /*$this->form_validation->set_rules(
                'code', $this->lang->line('code'), array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists'))
                )
        );
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/feetype/index');
        }*/
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
        $data['fee_heads'] = $this->db->order_by('id', 'DESC')->get('fee_head')->result_array();
        $section_result      = $this->account_model->get();
        $data['account'] = $section_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feetype/feetypeList', $data);
        $this->load->view('layout/footer', $data);
    }





    // submit_fee_head

    /*public function submit_fee_head(){
        $this->form_validation->set_rules('fees_heading', 'Fees Heading', 'required');
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');
        $this->form_validation->set_rules('account_name', 'Account Name', 'required');

        $months = $this->input->post('months[]');
        $frequency = $this->input->post('frequency');
        $update_id = $this->input->post('update_id');

      
        if ($this->form_validation->run() == FALSE) {
            if(!empty($update_id)){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">All field required</div>');
                redirect('admin/feetype/edit/'.$update_id);
            }else{
                 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">All field required</div>');
                redirect('admin/feetype/index');
            }

        } else {
            // Validate months based on frequency
            $monthCount = is_array($months) ? count($months) : 0;

            if ($frequency == 'Annual' && $monthCount != 1) {
                if(!empty($update_id)){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 1 month for Annual frequency</div>');
                     redirect('admin/feetype/edit/'.$update_id);
                }else{
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 1 month for Annual frequency</div>');
                    redirect('admin/feetype/index');
                }

                return;
            } elseif ($frequency == 'Quarterly' && $monthCount != 3) {
                if(!empty($update_id)){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 3 months for Quarterly frequency.</div>');
                     redirect('admin/feetype/edit/'.$update_id);
                }else{
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select exactly 3 months for Quarterly frequency.</div>');
                    redirect('admin/feetype/index');
                }
                return;
            } elseif ($frequency == 'Monthly' && $monthCount != 12) {
                if(!empty($update_id)){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select all 12 months for Monthly frequency.</div>');
                     redirect('admin/feetype/edit/'.$update_id);
                }else{
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Please select all 12 months for Monthly frequency.</div>');
                    redirect('admin/feetype/index');
                }
                return;
            }
            // Save data
            $data = [
                'fees_heading' => $this->input->post('fees_heading'),
                'frequency' => $this->input->post('frequency'),
                'account_name' => $this->input->post('account_name'),
                'months' => json_encode($this->input->post('months[]'))
            ];

            if(!empty($update_id)){
                $this->db->where('id', $update_id);
                $this->db->update('fee_head', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Fees update successfully!</div>');
            }else{
                $this->db->insert('fee_head', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Fees added successfully!</div>');
            }
            redirect('admin/feetype');
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

		if ($this->form_validation->run() == FALSE) {
			$error = validation_errors();
			if (empty($error)) {
				$error = 'All fields are required.';
			}

			$msg = '<div class="alert alert-danger text-left">' . $error . '</div>';
			$this->session->set_flashdata('msg', $msg);
			
			// 🔹 Keep old data (so form repopulates)
			$this->session->set_flashdata('old_input', $this->input->post());
			
			redirect(!empty($update_id) ? 'admin/feetype/edit/' . $update_id : 'admin/feetype/index');
			return;
		}

		// --- Validate months selection ---
		$months = $this->input->post('months'); // ✅ Correct way to read array input
		$frequency = $this->input->post('frequency');
		$monthCount = is_array($months) ? count($months) : 0;
		$msg = '';

		if ($frequency == 'Annual' && $monthCount != 1) {
			$msg = '<div class="alert alert-danger text-left">Please select exactly 1 month for Annual frequency.</div>';
		} elseif ($frequency == 'Quarterly' && $monthCount != 4) {
			$msg = '<div class="alert alert-danger text-left">Please select exactly 3 months for Quarterly frequency.</div>';
		} elseif ($frequency == 'Monthly' && ($monthCount < 1 || $monthCount > 12)) {
			$msg = '<div class="alert alert-danger text-left">Please select between 1 and 12 months for Monthly frequency.</div>';
		}

		if (!empty($msg)) {
			$this->session->set_flashdata('msg', $msg);
			$this->session->set_flashdata('old_input', $this->input->post());
			redirect(!empty($update_id) ? 'admin/feetype/edit/' . $update_id : 'admin/feetype/index');
			return;
		}

		// --- Prepare data ---
		$data = [
			'fees_heading' => $this->input->post('fees_heading'),
			'frequency' => $frequency,
			'account_name' => $this->input->post('account_name'),
			'months' => json_encode($months)
		];

		// --- Insert or update ---
		if (!empty($update_id)) {
			$this->db->where('id', $update_id);
			$this->db->update('fee_head', $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Fees updated successfully!</div>');
		} else {
			$this->db->insert('fee_head', $data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Fees added successfully!</div>');
		}
		// ✅ Reset all old input (so form clears on reload)
		$this->session->unset_userdata('old_input');
		redirect('admin/feetype');
	}

	/**
	 * Custom validation callback to check uniqueness of fees_heading
	 */
	public function check_data_unique($fees_heading, $id)
	{
		$exists = $this->feetype_model->data_exists($fees_heading, $id);

		if ($exists) {
			$this->form_validation->set_message('check_data_unique', 'This Fees Heading already exists. Please use a different name.');
			return false;
		} else {
			return true;
		}
	}




    function delete($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_delete')) {
        //     access_denied();
        // }
        $data['title'] = 'Fees Master List';
        $this->feetype_model->remove($id);
        redirect('admin/feetype/index');
    }

    function edit($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_edit')) {
        //     access_denied();
        // }
       $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'feetype/index');
        $data['id'] = $id;
        $feetype = $this->feetype_model->get($id);

       
        $data['feetype'] = $feetype;
         $section_result      = $this->account_model->get();
        $data['account'] = $section_result;
        $feegroup_result = $this->feetype_model->get();
        $data['feetypeList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists'))
                )
        );
        $this->form_validation->set_rules('code', $this->lang->line('code'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $data['type']='edit';
            $this->load->view('admin/feetype/feetypeList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'type' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/feetype/index');
        }
    }

}

?>