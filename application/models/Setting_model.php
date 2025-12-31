<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends MY_Model {

    public function __construct() {
        parent::__construct();
		$this->current_session = $this->getCurrentSession();
    }

    public function getMysqlVersion() {
        $mysqlVersion = $this->db->query('SELECT VERSION() as version')->row();
        return $mysqlVersion;
    }

    public function getSqlMode() {

        $sqlMode = $this->db->query('SELECT @@sql_mode as mode')->row();
        return $sqlMode;
    }

    public function get($id = null) {

        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.languages,sch_settings.class_teacher,sch_settings.is_rtl,sch_settings.cron_secret_key, sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.biometric,sch_settings.biometric_device,sch_settings.time_format,sch_settings.phone,languages.language,sch_settings.attendence_type,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.currency_place,sch_settings.start_month,sch_settings.start_week,sch_settings.session_id,sch_settings.fee_due_days,sch_settings.image,sch_settings.theme,sessions.session,sch_settings.online_admission,sch_settings.is_duplicate_fees_invoice,sch_settings.is_student_house,sch_settings.is_blood_group,sch_settings.admin_logo,sch_settings.admin_small_logo,sch_settings.mobile_api_url,sch_settings.app_primary_color_code,sch_settings.app_secondary_color_code,sch_settings.app_logo,sch_settings.student_profile_edit'
        );
        $this->db->from('sch_settings');
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        if ($id != null) {
            $this->db->where('sch_settings.id', $id);
        } else {
            $this->db->order_by('sch_settings.id');
        }
        $query = $this->db->get();

        if ($id != null) {
            return $query->row_array();
        } else {
            $session_array = $this->session->has_userdata('session_array');
            $result = $query->result_array();
            $result[0]['current_session'] = array(
                'session_id' => $result[0]['session_id'],
                'session' => $result[0]['session']
            );

            if ($session_array) {
                $session_array = $this->session->userdata('session_array');
                $result[0]['session_id'] = $session_array['session_id'];
                $result[0]['session'] = $session_array['session'];
            }

            return $result;
        }
    }

    public function get_studentlang($id) {
        $data = $this->db->select('users.lang_id')->from('users')->where('user_id', $id)->get()->row_array();
        return $data;
    }

    public function get_parentlang($id) {
        $data = $this->db->select('users.lang_id')->from('users')->where('id', $id)->get()->row_array();
        return $data;
    }

    public function get_stafflang($id) {
        $data = $this->db->select('staff.lang_id')->from('staff')->where('id', $id)->get()->row_array();
        return $data;
    }

    public function getSchoolDetail($id = null) {

        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.biometric,sch_settings.biometric_device,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.start_week,sch_settings.session_id,sch_settings.image,sch_settings.theme,sessions.session'
        );
        $this->db->from('sch_settings');
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        $this->db->order_by('sch_settings.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function getSetting() {

        $this->db->select('sch_settings.id,sch_settings.attendence_type,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.fee_due_days,sch_settings.class_teacher,sch_settings.cron_secret_key,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.biometric,sch_settings.biometric_device,sch_settings.phone,sch_settings.adm_prefix,sch_settings.adm_start_from,languages.language,sch_settings.adm_no_digit,sch_settings.adm_update_status,sch_settings.adm_auto_insert,sch_settings.staffid_prefix,sch_settings.staffid_start_from,sch_settings.staffid_auto_insert,sch_settings.staffid_no_digit,sch_settings.staffid_update_status,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_place,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.start_week,sch_settings.session_id,sch_settings.image,sch_settings.theme,sessions.session,online_admission,sch_settings.is_duplicate_fees_invoice,sch_settings.is_student_house,sch_settings.is_blood_group,sch_settings.roll_no,sch_settings.lastname,sch_settings.middlename,sch_settings.category,sch_settings.cast,sch_settings.religion,sch_settings.mobile_no,sch_settings.student_email,sch_settings.admission_date,sch_settings.student_photo,sch_settings.student_height,sch_settings.student_weight,sch_settings.measurement_date,sch_settings.father_name,sch_settings.father_phone,sch_settings.father_occupation,sch_settings.father_pic,sch_settings.mother_name,sch_settings.mother_phone,sch_settings.mother_occupation,sch_settings.mother_pic,sch_settings.guardian_phone,sch_settings.guardian_name,sch_settings.guardian_relation,sch_settings.guardian_email,sch_settings.guardian_pic,sch_settings.guardian_occupation,sch_settings.guardian_address,sch_settings.current_address,sch_settings.permanent_address,sch_settings.route_list,sch_settings.hostel_id,sch_settings.bank_account_no,sch_settings.bank_name,sch_settings.ifsc_code,sch_settings.national_identification_no,sch_settings.local_identification_no,sch_settings.rte,sch_settings.previous_school_details,sch_settings.student_note,sch_settings.upload_documents,sch_settings.staff_designation,sch_settings.staff_department,sch_settings.staff_last_name,sch_settings.staff_father_name,sch_settings.staff_mother_name,sch_settings.staff_date_of_joining,sch_settings.staff_phone,sch_settings.staff_emergency_contact,sch_settings.staff_marital_status,sch_settings.staff_photo,sch_settings.staff_current_address,sch_settings.staff_permanent_address,sch_settings.staff_qualification,sch_settings.staff_work_experience,sch_settings.staff_note,sch_settings.staff_epf_no,sch_settings.staff_basic_salary,sch_settings.staff_contract_type,sch_settings.staff_work_shift,sch_settings.staff_work_location,sch_settings.staff_leaves,sch_settings.staff_account_details,sch_settings.staff_social_media,sch_settings.staff_upload_documents,sch_settings.admin_logo,sch_settings.admin_small_logo,sch_settings.mobile_api_url,sch_settings.main_domain_url,sch_settings.app_primary_color_code,sch_settings.app_secondary_color_code,sch_settings.app_logo,languages.short_code as `language_code`,sch_settings.student_profile_edit,sch_settings.my_question');
		//,sch_settings.receipt_sr_no
        $this->db->from('sch_settings');
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        $this->db->order_by('sch_settings.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('sch_settings');
        $message = DELETE_RECORD_CONSTANT . " On settings id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function add($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sch_settings', $data);
            $message = UPDATE_RECORD_CONSTANT . " On settings id " . $data['id'];
            $action = "Update";
            $record_id = $insert_id = $data['id'];
            $this->log($message, $record_id, $action);
        } else {
            $this->db->insert('sch_settings', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On settings id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);

            // return $insert_id;
        }
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $insert_id;
        }
    }
 
    public function getCurrentSession() {
        $session_result = $this->get();

        return $session_result[0]['session_id'];
    }

    public function getOnlineAdmissionStatus() {
        $setting_result = $this->get();

        if ($setting_result[0]['online_admission']) {
            return true;
        }
        return false;
    }

    public function getCurrentSessionName() {
        $session_result = $this->get();
        return $session_result[0]['session'];
    }

    public function getCurrentSchoolName() {
        $session_result = $this->get();
        return $session_result[0]['name'];
    }

    public function getStartMonth() {
        $session_result = $this->get();
        return $session_result[0]['start_month'];
    }

    public function getCurrentSessiondata() {
        $session_result = $this->get();
        return $session_result[0];
    }

    public function getCurrency() {
        $session_result = $this->get();
        return $session_result[0]['currency'];
    }

    public function getCurrencySymbol() {
        $session_result = $this->get();
        return $session_result[0]['currency_symbol'];
    }

    public function getCurrentActiveSession() {
		$query = $this->db->select('session_id')->get('sch_settings');
        $session = $query->row_array();
        return $session['session_id'];
    }

    public function getDateYmd() {
        return date('Y-m-d');
    }

    public function getDateDmy() {
        return date('d-m-Y');
    }

    public function add_cronsecretkey($data, $id) {

        $this->db->where("id", $id)->update("sch_settings", $data);
    }

    public function getLanguage() {

        $query = $this->db->select('languages.language,languages.short_code')->where('id', $this->session->userdata['admin']['language']['lang_id'])->get('languages');
        return $query->row_array();
    }

    
    public function getuserLanguage() {

        $query = $this->db->select('languages.language,languages.short_code')->where('id', $this->session->userdata['student']['language']['lang_id'])->get('languages');
        return $query->row_array();
    }

    public function getAdminlogo() {
        $query = $this->db->select('admin_logo')->get('sch_settings');
        $logo = $query->row_array();
        echo $logo['admin_logo'];
    }

    public function getAdminsmalllogo() {
        $query = $this->db->select('admin_small_logo')->get('sch_settings');
        $logo = $query->row_array();
        echo $logo['admin_small_logo'];
    }

    public function get_appname() {

        $query = $this->db->select('name')->get('sch_settings');
        $name = $query->row_array();
        echo $name['name'];
    }
	
	public function get_main_domain_url() {
        $row = $this->db
            ->select('main_domain_url')
            ->get('sch_settings')
            ->row();

        return $row ? rtrim($row->main_domain_url, '/') : '';
    }
	
    public function check_haederimage($type) {
        $check = $this->db->select('*')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', $type)->get()->row_array();


        if (empty($check['header_image'])) {
            return 0;
        } else {
            return 1;
        }
    }

    public function add_printheader($data) {
		
		//echo '<pre>'; print_r($data); echo '</pre>';die;
		
		$query = $this->db->where('session_id', $this->current_session)->where('print_type', $data['print_type'])->get('print_headerfooter');
        if ($query->num_rows() > 0) {
            $this->db->where('session_id', $this->current_session)->where('print_type', $data['print_type']);
			$this->db->update('print_headerfooter', $data);
        } else {
			$data['session_id'] = $this->current_session;
			$this->db->insert('print_headerfooter', $data);
        }
    }

    public function get_printheader($type='') {
        return $this->db->select('*')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', $type)->get()->row_array();
    }

    public function get_receiptheader() {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'student_receipt')->get()->row_array();
        echo $image['header_image'];
    }

    public function get_receiptheader_return() {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'student_receipt')->get()->row_array();
        return $image['header_image'];
    }
	
	public function get_header_return($type='') {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', $type)->get()->row_array();
        return $image['header_image'];
    }
	

    public function unlink_receiptheader($type='') {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', $type)->get()->row_array();
        return $image['header_image'];
    }

    public function get_receiptfooter() {
        $image = $this->db->select('footer_content')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'student_receipt')->get()->row_array();
        echo $image['footer_content'];
    }

    public function get_receiptfooter_return() {
        $image = $this->db->select('footer_content')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'student_receipt')->get()->row_array();
        return $image['footer_content'];
    }
	
	 public function get_footer_return($type='') {
        $image = $this->db->select('footer_content')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', $type)->get()->row_array();
        return $image['footer_content'];
    }

    public function get_payslipheader() {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'staff_payslip')->get()->row_array();
        echo $image['header_image'];
    }

    public function unlink_payslipheader() {
        $image = $this->db->select('header_image')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'staff_payslip')->get()->row_array();
        return $image['header_image'];
    }

    public function get_payslipfooter() {
        $image = $this->db->select('footer_content')->from('print_headerfooter')->where('session_id', $this->current_session)->where('print_type', 'staff_payslip')->get()->row_array();
        echo $image['footer_content'];
    }
	public function check_receipt_no($current_session_id='')
	{
		$query = $this->db->where('session_id', $current_session_id)->get('receipt_sr_no');
		$num_rows = $query->num_rows();

        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
	}
	public function check_setting_receipt_no($data)
	{
		$session_result = $this->get();
		$current_session_id = $session_result[0]['current_session']['session_id'];
		
		$receipt_status = $data['receipt_status'];
		$receipt_start_sequence = $data['receipt_start_sequence'];
		$receipt_start_sequence_existing = $data['receipt_start_sequence_existing'];
		
		$num_rows = '';
		if($receipt_status == 1 && ($receipt_start_sequence_existing == '' || $receipt_start_sequence != $receipt_start_sequence_existing)) { 
			$query = $this->db->where('session_id', $current_session_id)->get('receipt_sr_no');
			$num_rows = $query->num_rows();
		}
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
	}
	public function check_sch_setting_receipt_no()
	{
		$session_result = $this->get();
		$current_session_id = $session_result[0]['current_session']['session_id'];
        //$receipt_sr_no = $this->db->select('receipt_sr_no')->from('sch_settings')
        //->get()->row_array();
		
		$receipt_sr_no = $this->db->select('receipt_sr_no')->from('sch_settings_session')->where('session_id', $current_session_id)->get()->row_array();
        

		if (!empty($receipt_sr_no) && !empty($receipt_sr_no['receipt_sr_no'])) {
			return $receipt_sr_no['receipt_sr_no'];
		} else {
			return false;
		}
	}
	public function get_last_receipt_id($current_session_id='')
	{
		$this->db->select_max('sr_no'); 
		$this->db->limit(1);
		$query = $this->db->where('session_id', $current_session_id)->get('receipt_sr_no');

        if ($query->num_rows() > 0) {
			$row = $query->row();
			$max_id = $row->sr_no;
			$next_id = $max_id +1;
            return $next_id;
        } else {
            return 1; // Or 0, depending on your logic
        }
	}
	public function insert_receipt_sr_no($recpt = '', $session_id='')
	{
		$data['sr_no'] = $recpt;
		$data['session_id'] = $session_id;
		$this->db->insert('receipt_sr_no', $data);
		
		
			$this->db->select_max('id'); 
			$this->db->limit(1);
			$query = $this->db->get('sch_settings');

			/*if ($query->num_rows() > 0) {
				$row = $query->row();
				$max_id = $row->id;

				$this->db->where('id', $max_id);
				$this->db->update('sch_settings', [
					'receipt_sr_no' => $data['sr_no']
				]);
			}*/
	}
	public function truncate_receipt($id)
	{
		$this->db->truncate('receipt_sr_no');
		$this->db->truncate('receipts');
		$this->db->truncate('deleted_receipts');
		$this->db->where('id', $id);
		$this->db->update('sch_settings', [
			'receipt_sr_no' => null
		]);
	}
	
	public function checkDeleteList($checkData = null)
    {
		//echo "<pre>";print_r($checkData);die;
		$session_result = $this->get();
		$current_session_id = $session_result[0]['current_session']['session_id'];
		if($checkData['menu'] == 'feeplan')
		{
			//echo "<pre>";print_r($checkData);
			$this->db->select('distinct(student_session.student_id) as student_id,student_session.fee_category_id');
			$this->db->from('student_session');
			$this->db->join('students', 'students.id = student_session.student_id');
			$this->db->where_in('student_session.class_id', $checkData['class']);
			$this->db->where('student_session.session_id', $current_session_id);
			$this->db->order_by('student_session.student_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo "<pre>";print_r($result);die;
			$existsStudent = 0;
			foreach($result as $res)
			{
				$this->db->where('student_id', $res['student_id']);
				$this->db->where_in('fee_category_id', $checkData['categories']);
				$qr = $this->db->get('student_session');
				if($qr->num_rows() > 0)
				{
					$existsStudent++;
				}
			}
			return $existsStudent;
		}
		if($checkData['menu'] == 'routeplan')
		{
			
			//echo "<pre>";print_r($checkData);
			$this->db->select('distinct(student_session.student_id) as student_id,student_session.class_id');
			$this->db->from('student_session');
			$this->db->join('students', 'students.id = student_session.student_id');
			$this->db->where_in('student_session.class_id', $checkData['class']);
			$this->db->where('student_session.session_id', $current_session_id);
			$this->db->order_by('student_session.student_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo "<pre>";print_r($result);die; category_id
			
			$existsStudent = 0;
			foreach($result as $res)
			{
				$this->db->where('student_id', $res['student_id']);
				$this->db->where('route_id', $checkData['route_id']);
				$this->db->where_in('fee_category_id', $checkData['categories']);
				$qr = $this->db->get('student_session');
				if($qr->num_rows() > 0)
				{
					$existsStudent++;
				}
			}
			return $existsStudent;
		}
		if($checkData['menu'] == 'subjectgroup')
		{
			$this->db->select('
				exam_group_class_batch_exam_students.exam_group_class_batch_exam_id AS exam_id,
				exam_group_class_batch_exam_students.student_id,
				exam_group_class_batch_exam_subjects.subject_id,
				student_session.class_id,
				student_session.section_id
			');
			$this->db->from('exam_group_class_batch_exam_students');
			$this->db->join(
				'exam_group_class_batch_exam_subjects',
				'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exam_students.exam_group_class_batch_exam_id'
			);
			$this->db->join(
				'student_session',
				'student_session.student_id = exam_group_class_batch_exam_students.student_id'
			);
			$this->db->group_by([
				'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id',
				'exam_group_class_batch_exam_students.student_id',
				'exam_group_class_batch_exam_subjects.subject_id',
				'student_session.class_id',
				'student_session.section_id'
			]);

			$qr = $this->db->get();
			//echo "<pre>"; print_r($qr->result_array()); 
			$count =0;
			foreach($qr->result_array() as $res)
			{
				if($res['class_id'] == $checkData['subject_array'][0]['class_id'] && $res['section_id'] == $checkData['subject_array'][0]['section_id'])
				{
					$count++;
				}
			}
			return $count;
		}
		if($checkData['menu'] == 'createexam')
		{
			//echo "<pre>";print_r($checkData);die;
			$this->db->where($checkData['field'], $checkData['id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'coscholasticareas')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'scholasticAssessment')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'incomehead')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'expensehead')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'itemcategory')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'stockitem')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'itemstore')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		if($checkData['menu'] == 'itemsupplier')
		{
			$this->db->where($checkData['field'], $checkData['id']);
			$this->db->where('session_id', $checkData['session_id']);
			$query = $this->db->get($checkData['table']);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else{
				return false;
			}
		}
		else{
			//echo "<pre>";print_r($checkData);die;
			$this->db->where($checkData['field'], $checkData['id']);
			$query = $this->db->get($checkData['table']);
			if ($query->num_rows() > 0) {
            return true;
			} else {
				return false;
			}
		}
		
        
    }
	
	public function getNameById($table = null, $field = null, $id = null)
    {
        $this->db->where($field, $id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
	
	public function checkDeleteListStudent($checkData = null)
	{
		$hasStudent = $this->db->where($checkData['field'], $checkData['id'])->get($checkData['tableStudent'])->num_rows() > 0 ? 1 : 0;
		return $hasStudent;
	}
	public function checkDeleteListSubject($checkData = null)
	{
			$hasSubject = $this->db->where($checkData['field'], $checkData['id'])->get($checkData['tableSubject'])->num_rows() > 0 ? 1 : 0;
			return $hasSubject;
	}
	public function addSettingSession($data)
	{
		$session_result = $this->get();
		$current_session_id = $session_result[0]['current_session']['session_id'];
		//echo "<pre>";print_r($data);die;
		
        //=======================Code Start===========================
		$query = $this->db->where('session_id', $current_session_id)->get('sch_settings_session');
		if($query->num_rows()== 0)
		{
			//echo "<pre>";print_r($data);die;
			if($data['receipt_sr_no'] != '')
			{
				$this->db->trans_start(); # Starting Transaction
				$this->db->trans_strict(false); # See Note 01. If you wish can remove as well
				$this->db->insert('sch_settings_session', $data);
				$this->db->trans_complete();
			}
			return true;
		}
		else{
			return false;
		}
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
	}
	public function getReceiptNo()
	{
		$session_result = $this->get();
		$current_session_id = $session_result[0]['current_session']['session_id'];
		$qr = $this->db->select('receipt_sr_no')->where('session_id', $current_session_id)->get('sch_settings_session');
		if($qr->num_rows() > 0)
		{
			return $qr->row_array();
		}
		else{
			return null;
		}
	}

}
