<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Generatecertificate_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getcertificatebyid($certificate) {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('id', $certificate);
		$this->db->where('session_id', $this->current_session);
        $query = $this->db->get();
        return $query->result();
    }

	public function addCertificateGenerate($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        
		$this->db->insert('certificate_generates', $data);
		$insert_id = $this->db->insert_id();
		$message = INSERT_RECORD_CONSTANT . " On certificate_generates id " . $insert_id;
		$action = "Insert";
		$record_id = $insert_id;
		$this->log($message, $record_id, $action);
		//======================Code End==============================

		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === false) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;
		} else {
			//return $return_value;
		}
		return $insert_id;
    }
	public function check_student_id($id='')
	{
        //=======================Code Start===========================
		$this->db->where('student_id', $id);
		$this->db->where('session_id', $this->current_session);
		$query = $this->db->get('certificate_generates');
       
		//======================Code End==============================
		
		if($query->num_rows() > 0)
		{
			return false; 
		}
		else{
			return true; 
		}
	}
	public function get_generated_certificates_count($from_date = null, $to_date = null)
	{
		$this->db->where('session_id', $this->current_session);
		
		if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(created_date) >=', $from_date);
            $this->db->where('DATE(created_date) <=', $to_date);
        }
		
		$query = $this->db->get('certificate_generates');
		return $query->num_rows();
	}
	public function get_generated_certificates($limit, $offset,$from_date = null, $to_date = null)
    {
		$this->db->select('
            certificate_generates.*,
            certificate_generates.id as certificate_id,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            student_session.route_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(student_session.fee_category_id, 0) as category_id,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            student_session.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
        ');
		$this->db->from('certificate_generates');
        $this->db->join('students', 'students.id = certificate_generates.student_id');
		$this->db->join(
			'student_session',
			'student_session.student_id = students.id 
			 AND student_session.session_id = '.$this->current_session
		);
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
		
		
		$this->db->where('certificate_generates.session_id', $this->current_session);
				
		if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(certificate_generates.created_date) >=', $from_date);
            $this->db->where('DATE(certificate_generates.created_date) <=', $to_date);
        }
		
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
		
		//echo $this->db->last_query();die;
        return $query->result();

    }
    public function print_delete($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
		$this->db->where('session_id', $this->current_session);
        $this->db->delete('certificate_generates');
        $message = DELETE_RECORD_CONSTANT . " On certificate_generates id " . $id;
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
}

?>