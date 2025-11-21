<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fee_discount extends Admin_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('fee_discount_model');
		$this->load->model('Receipt_model');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }
	public function index()
    {
        if (!$this->rbac->hasPrivilege('fees_discount', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feediscount');
		
        $data['title']     = 'Fee Discount';
		
        $id=$_GET['id']??0;
		
		$data['student_data'] =$student_data= $this->student_model->getByStudentSession($id);
        $category                     = $this->category_model->get();
        $data['categorylist']         = $category;
		
		//echo $student_data['student_session_id']; die;
        $feeDiscountsArr              = $this->fee_discount_model->get_all_fees($id);
        $routeDiscountsArr              = $this->fee_discount_model->get_all_routes($id);
		
		//echo '<pre>'; print_r($feeDiscountsArr); echo '</pre>';die;

		$monthsPost = $months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
		$class_id=$student_data['class_id'];
		$route_id=$student_data['vehroute_id'];
		$category_id=$student_data['category_id'];
		// die;
		$this->db->from('fee_head');
		$this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
		$query = $this->db->get();
		$data['data_list'] = $query->result();
			//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		$data['data_list'] = $this->updateMonthlyFeeAmounts($data['data_list'], $feeDiscountsArr);
		
		//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		  
		// route
		$this->db->from('route_head');
		$this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
		$this->db->where('route_head.id', $route_id);
		$query = $this->db->get();
		$data['route_data_list'] = $query->result();
		$data['route_data_list'] = $this->updateMonthlyFeeAmounts($data['route_data_list'], $routeDiscountsArr);
		
		//echo '<pre>'; print_r($data['route_data_list']); echo '</pre>';die;
		
		$data['months_data']=$monthsPost;
		
		$data['remarks'] = $feeDiscountsArr[0]['remarks'];
		
		$data['src_name'] = '';
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
		//$data['src_name'] = $student_data['firstname'] ? $student_data['firstname'].' '.$student_data['middlename'].' '.$student_data['lastname'].' s/o '.$student_data['guardian_name'].' ('.$student_data['class'].'-'.$student_data['section'].')' : '';
		//echo '<pre>'; print_r($data); echo '</pre>'; die;
		$data['issubmit'] = '';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/fee_discount/fee-discount', $data);
        $this->load->view('layout/footer', $data);
    }
	
	public function submit()
    {
        // Get submitted values
        $fees = $this->input->post('fee');  // fee array
        $routes = $this->input->post('route');  // route array
		$remarks = $this->input->post('remarks');
		$student_session_id = $this->input->post('student_session_id');
		$student_id = $this->input->post('student_id');
		// For edit case, first remove then again insert
		$discount_exists              = $this->fee_discount_model->discount_exists($student_session_id);
		if($discount_exists) {
			$this->fee_discount_model->remove($student_session_id);
		}	
		// Loop each fee_type_id (e.g., 28, 29...)
		foreach ($fees as $fee_type_id => $months) {
			$data = [
				'student_session_id' => $student_session_id,
				'student_id'         => $student_id,
				'fee_type_id'        => $fee_type_id,
				'remarks'            => $remarks,
			];
			// Now map months to DB fields
			foreach ($months as $month_name => $value) {
				// Convert Apr → apr, May → may etc.
				$key = strtolower($month_name);
				// Build DB field: month_apr, month_may, ...
				$db_field = "month_" . $key;
				$data[$db_field] = $value;
			}
			// Insert row for this fee_type_id
			$this->db->insert('fee_discounts', $data);
		}
		// Loop each fee_type_id (e.g., 28, 29...)
		foreach ($routes as $fee_type_id => $months) {
			$data = [
				'student_session_id' => $student_session_id,
				'student_id'         => $student_id,
				'fee_type'         	 => 1,
				'fee_type_id'        => $fee_type_id,
				'remarks'            => $remarks,
			];
			// Now map months to DB fields
			foreach ($months as $month_name => $value) {
				// Convert Apr → apr, May → may etc.
				$key = strtolower($month_name);
				// Build DB field: month_apr, month_may, ...
				$db_field = "month_" . $key;
				$data[$db_field] = $value;
			}
			// Insert row for this fee_type_id
			$this->db->insert('fee_discounts', $data);
		}
        $this->session->set_flashdata('success', 'Record updated successfully.');
		
		//--- fetch data -----------------------------------
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feediscount');
		
        $data['title']     = 'Fee Discount';
		
		$id=$student_session_id ?? 0;
		
		$data['student_data'] =$student_data= $this->student_model->getByStudentSession($id);
        $category                     = $this->category_model->get();
        $data['categorylist']         = $category;
		
		//echo $student_data['student_session_id']; die;
        $feeDiscountsArr              = $this->fee_discount_model->get_all_fees($id);
        $routeDiscountsArr              = $this->fee_discount_model->get_all_routes($id);
		
		//echo '<pre>'; print_r($feeDiscountsArr); echo '</pre>';die;

		$monthsPost = $months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
		$class_id=$student_data['class_id'];
		$route_id=$student_data['vehroute_id'];
		$category_id=$student_data['category_id'];
		// die;
		$this->db->from('fee_head');
		$this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
		$query = $this->db->get();
		$data['data_list'] = $query->result();
			//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		$data['data_list'] = $this->updateMonthlyFeeAmounts($data['data_list'], $feeDiscountsArr);
		
		//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		  
		// route
		$this->db->from('route_head');
		$this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
		$this->db->where('route_head.id', $route_id);
		$query = $this->db->get();
		$data['route_data_list'] = $query->result();
		$data['route_data_list'] = $this->updateMonthlyFeeAmounts($data['route_data_list'], $routeDiscountsArr);
		
		//echo '<pre>'; print_r($data['route_data_list']); echo '</pre>';die;
		
		$data['months_data']=$monthsPost;
		
		$data['remarks'] = $feeDiscountsArr[0]['remarks'];
		
		$data['src_name'] = '';
		//$data['src_name'] = $student_data['firstname'] ? $student_data['firstname'].' '.$student_data['middlename'].' '.$student_data['lastname'].' s/o '.$student_data['guardian_name'].' ('.$student_data['class'].'-'.$student_data['section'].')' : '';
		//----------------------------------------
		$data['issubmit'] = 1;
		
        //redirect('admin/fee-discount');
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/fee_discount/fee-discount', $data);
        $this->load->view('layout/footer', $data);
    }
	function updateMonthlyFeeAmounts($defaultArray, $paidArray)
	{
		$monthMap = [
			"Apr" => "month_apr",
			"May" => "month_may",
			"Jun" => "month_jun",
			"Jul" => "month_jul",
			"Aug" => "month_aug",
			"Sep" => "month_sep",
			"Oct" => "month_oct",
			"Nov" => "month_nov",
			"Dec" => "month_dec",
			"Jan" => "month_jan",
			"Feb" => "month_feb",
			"Mar" => "month_mar"
		];

		foreach ($defaultArray as &$feeHead) {

			foreach ($paidArray as $paid) {

				if ($paid['fee_type_id'] == $feeHead->id) {

					$months = json_decode($feeHead->months, true);

					if (!is_array($months)) continue;

					$amounts = [];

					foreach ($months as $month) {

						$column = $monthMap[$month];

						$amounts[$month] = isset($paid[$column])
							? floatval($paid[$column])
							: floatval($feeHead->amount); // fallback
					}

					// Replace amount with month-wise array
					$feeHead->amount = $amounts;
				}
			}
		}

		return $defaultArray;
	}
	public function fees_reset($id='')
	{
		$student_session_id = $_GET['id'] ?? 0;
		$discount_exists = $this->fee_discount_model->discount_exists($student_session_id);
		if($discount_exists) {
			$this->fee_discount_model->remove($student_session_id);
			$this->session->set_flashdata('error', 'Fees Reset successfully.');
		}
		
		
		//--- fetch data -----------------------------------
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feediscount');
		
        $data['title']     = 'Fee Discount';
		
		$id=$student_session_id ?? 0;
		
		$data['student_data'] =$student_data= $this->student_model->getByStudentSession($id);
        $category                     = $this->category_model->get();
        $data['categorylist']         = $category;
		
		//echo $student_data['student_session_id']; die;
        $feeDiscountsArr              = $this->fee_discount_model->get_all_fees($id);
        $routeDiscountsArr              = $this->fee_discount_model->get_all_routes($id);
		
		//echo '<pre>'; print_r($feeDiscountsArr); echo '</pre>';die;

		$monthsPost = $months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
		$class_id=$student_data['class_id'];
		$route_id=$student_data['vehroute_id'];
		$category_id=$student_data['category_id'];
		// die;
		$this->db->from('fee_head');
		$this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
		$query = $this->db->get();
		$data['data_list'] = $query->result();
			//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		$data['data_list'] = $this->updateMonthlyFeeAmounts($data['data_list'], $feeDiscountsArr);
		
		//echo '<pre>'; print_r($data['data_list']); echo '</pre>';die;
		  
		// route
		$this->db->from('route_head');
		$this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
		$this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
		$this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
		$this->db->where('route_head.id', $route_id);
		$query = $this->db->get();
		$data['route_data_list'] = $query->result();
		$data['route_data_list'] = $this->updateMonthlyFeeAmounts($data['route_data_list'], $routeDiscountsArr);
		
		//echo '<pre>'; print_r($data['route_data_list']); echo '</pre>';die;
		
		$data['months_data']=$monthsPost;
		
		$data['remarks'] = $feeDiscountsArr[0]['remarks'];
		
		$data['src_name'] = '';
		//$data['src_name'] = $student_data['firstname'] ? $student_data['firstname'].' '.$student_data['middlename'].' '.$student_data['lastname'].' s/o '.$student_data['guardian_name'].' ('.$student_data['class'].'-'.$student_data['section'].')' : '';
		//----------------------------------------
		$data['issubmit'] = 1;
		
        //redirect('admin/fee-discount');
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/fee_discount/fee-discount', $data);
        $this->load->view('layout/footer', $data);
	}

}

?>