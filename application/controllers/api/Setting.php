<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library('Api_auth');
        // $this->load->model('api/Settings_model');

        // $this->api_auth->check();
    }
	
    public function get_sch_setting()
    {
		$this->api_auth->check();
		
		$result = $this->setting_model->getSetting();
		$sessions = $this->session_model->get();
		$login_data = $this->staff_model->get_admin();
		
		echo json_encode([
			'status'=>true,
			'data'=>$result,
			'sessions'=>$sessions,
			'login_data'=>$login_data
		]);

    }
    public function get_school_details()
    {
		$this->api_auth->check();
		
		$form_type = $this->input->post('form_type', true);
		$session_id = $this->input->post('session_id', true);
		
		$html = '';
		if($form_type == 'strengths'){
			$total_male_students = 0;
			$total_female_students = 0;
			$tot_male_students = $this->studentsession_model->getTotalMaleStudentBySessionID($session_id);
			if (!empty($tot_male_students)) {
				$total_male_students = $tot_male_students->total_student;
			}
			
			$tot_female_students = $this->studentsession_model->getTotalFemaleStudentBySessionID($session_id);
			if (!empty($tot_female_students)) {
				$total_female_students = $tot_female_students->total_student;
			}
			
			$tot_roles = $this->role_model->get();
			$count_staff_male = 0;
			$count_staff_female = 0;
			foreach ($tot_roles as $key => $value) {
				if($value["is_superadmin"] != 1){
					$count_staff_male += $this->role_model->count_roles_by_sesssion_male($value["id"], $session_id);
					$count_staff_female += $this->role_model->count_roles_by_sesssion_female($value["id"], $session_id);
				}else{
					$count_staff_male += $this->role_model->count_superadmin_male($value["id"]);
					$count_staff_female += $this->role_model->count_superadmin_female($value["id"]);
				}
			}
			
			$html = '<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-male"></i></span>
									<div class="dash-widget-info">
										<h3>'.$total_male_students.'</h3>
										<span>Total Male</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-female"></i></span>
									<div class="dash-widget-info">
										<h3>'.$total_female_students.'</h3>
										<span>Total Female</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-users"></i></span>
									<div class="dash-widget-info">
										<h3>'.((int)$total_male_students + (int)$total_female_students).'</h3>
										<span>Total Students</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user-shield"></i></span>
									<div class="dash-widget-info">
										<h3>'.$count_staff_male.'</h3>
										<span>Total Male Staff</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user-shield"></i></span>
									<div class="dash-widget-info">
										<h3>'.$count_staff_female.'</h3>
										<span>Total Female Staff</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user-shield"></i></span>
									<div class="dash-widget-info">
										<h3>'.((int)$count_staff_male + (int)$count_staff_female).'</h3>
										<span>Total Staff</span>
									</div>
								</div>
							</div>
						</div>
					</div>';
					
			$male_total_present = $female_total_present = $staff_total_present = 0;
			$date = " and student_attendences.date='" . date('Y-m-d') . "'";
			$male_attendance_result = $this->stuattendence_model->get_male_attendancebydate($date, $session_id);
			foreach ($male_attendance_result as $key => $male_attendance_value) {
				$male_total_present += $male_attendance_value->present + $male_attendance_value->excuse + $male_attendance_value->late + $male_attendance_value->half_day;
			}
			$female_attendance_result = $this->stuattendence_model->get_female_attendancebydate($date, $session_id);
			foreach ($female_attendance_result as $key => $female_attendance_value) {
				$female_total_present += $female_attendance_value->present + $female_attendance_value->excuse + $female_attendance_value->late + $female_attendance_value->half_day;
			}
			$staff_attendance_result = $this->staffattendancemodel->get_staff_attendancebydate(date('Y-m-d'), $session_id);
			if ($staff_attendance_result) {
			$staff_total_present += $staff_attendance_result->present + $staff_attendance_result->late + $staff_attendance_result->half_day;
			}
			$html .= '<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-male"></i></span>
									<div class="dash-widget-info">
										<h3>'.$male_total_present.'</h3>
										<span>Todays Boys Present</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-female"></i></span>
									<div class="dash-widget-info">
										<h3>'.$female_total_present.'</h3>
										<span>Todays Girls Present</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user-shield"></i></span>
									<div class="dash-widget-info">
										<h3>'.$staff_total_present.'</h3>
										<span>Todays Staff Present</span>
									</div>
								</div>
							</div>
						</div>
					</div>';
		}
		if($form_type == 'income'){
			$today_income  = $this->income_model->income_by_session(true, $session_id);
			$total_income  = $this->income_model->income_by_session(false, $session_id);
			
			$html = '<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
									<div class="dash-widget-info">
										<h3>'.(format_amount($today_income ?? '0')).'</h3>
										<span>Today`s Income</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
									<div class="dash-widget-info">
										<h3>'.(format_amount($total_income ?? '0')).'</h3>
										<span>Total Income</span>
									</div>
								</div>
							</div>
						</div>
					</div>';
		}
		if($form_type == 'expense'){
			$today_expense  = $this->expense_model->expense_by_session(true, $session_id);
			$total_expense  = $this->expense_model->expense_by_session(false, $session_id);
			
			$html = '<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
									<div class="dash-widget-info">
										<h3>'.(format_amount($today_expense ?? '0')).'</h3>
										<span>Today`s Expense</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
									<div class="dash-widget-info">
										<h3>'.(format_amount($total_expense ?? '0')).'</h3>
										<span>Total Expense</span>
									</div>
								</div>
							</div>
						</div>
					</div>';
		}
		
		echo json_encode([
			'status'=>true,
			'html'=>$html
		]);

    }
    public function update_sch_setting()
    {
		$this->api_auth->check();
		
		$datas = $this->input->post();
		//echo "<pre>";print_r($datas);die;
        $update = $this->setting_model->add($datas);
		
        if($update)
        {
            echo json_encode([
                'status'=>true,
                'message'=>'Data updated',
                'data'=>$datas
            ]);
        }
        else
        {
            echo json_encode([
                'status'=>false,
                'message'=>'Update failed'
            ]);
        }
		
        /*$api_key = $this->input->post('api_key');

        if(!$api_key)
        {
            echo json_encode([
                'status'=>false,
                'message'=>'API key missing'
            ]);
            exit;
        }

        $this->db->where('id',1);
        $update = $this->db->update('sch_settings',[
            'domain_api_key'=>$api_key
        ]);

        if($update)
        {
            echo json_encode([
                'status'=>true,
                'message'=>'API key updated'
            ]);
        }
        else
        {
            echo json_encode([
                'status'=>false,
                'message'=>'Update failed'
            ]);
        }*/

    }
    public function update_login()
    {
		$this->api_auth->check();
		
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		
		/*
		|--------------------------------------------------------------------------
		| CHECK STAFF
		|--------------------------------------------------------------------------
		| Find staff where session_id IS NULL
		*/

		$staff = $this->db
			// ->where('email', $email)
			->where('session_id IS NULL', null, false)
			->get('staff')
			->row();

		/*
		|--------------------------------------------------------------------------
		| UPDATE STAFF
		|--------------------------------------------------------------------------
		*/

		if($staff){
			
			$checkEmail = $this->db
				->where('email', $email)
				->where('id !=', $staff->id)
				// ->where('session_id IS NULL', null, false)
				->get('staff')
				->row();
			if($checkEmail){

				$response = [
					'status' => false,
					'message' => 'Email already exists'
				];

			}else{	
				$updateData = [
					'email' => $email,
					
				];

				// Update password only if entered
				if(!empty($password)){
					$updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
				}

				$this->db
					->where('id', $staff->id)
					->update('staff', $updateData);

				$response = [
					'status' => true,
					'message' => 'Login Details Updated Successfully'
				];
			}

		}else{

			/*
			|--------------------------------------------------------------------------
			| INSERT STAFF
			|--------------------------------------------------------------------------
			*/
			$checkEmail = $this->db
				->where('email', $email)
				// ->where('session_id IS NULL', null, false)
				->get('staff')
				->row();
			if($checkEmail){

				$response = [
					'status' => false,
					'message' => 'Email already exists'
				];

			}else{	
				$insertData = [
					'email' => $email,
					'is_active' => 1
				];

				// Insert password only if entered
				if(!empty($password)){
					$insertData['password'] = password_hash($password, PASSWORD_DEFAULT);
				}

				$insert = $this->db->insert('staff', $insertData);
				$staff_id = $this->db->insert_id();
				$roleData = [
					'role_id' => 7,
					'staff_id' => $staff_id,
					'is_active' => 1,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->db->insert('staff_roles', $roleData);
				
				$response = [
					'status' => true,
					'message' => 'Login Details Added Successfully',
				];
			}
		}

		/*
		|--------------------------------------------------------------------------
		| JSON RESPONSE
		|--------------------------------------------------------------------------
		*/

		echo json_encode($response);
    }

}
