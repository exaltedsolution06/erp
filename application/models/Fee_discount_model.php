<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fee_discount_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get_all_fees($student_session_id) {
        $this->db->select()->from('fee_discounts');
        if ($student_session_id != null) {
            $this->db->where('student_session_id', $student_session_id);
            $this->db->where('fee_type', 0);
        }
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        
		return $query->result_array();
    }
	public function get_already_taken_fees($student_session_id) {

		$this->db->select("receipts.fee_head, receipts.months");
		$this->db->from('receipts');
		$this->db->join('student_session', "student_session.student_id = receipts.student_id", "left");

		if ($student_session_id != null) {
			$this->db->where('student_session.id', $student_session_id);
			$this->db->where('receipts.fee_head_type', 'fees');
		}

		$query = $this->db->get();
		$rows = $query->result_array();

		// ---- Convert to final useful array ---- //
		$result = [];

		foreach ($rows as $r) {
			$fee_head = $r['fee_head'];
			$month    = $r['months'];

			if (!isset($result[$fee_head])) {
				$result[$fee_head] = [];
			}

			// Avoid duplicates
			if (!in_array($month, $result[$fee_head])) {
				$result[$fee_head][] = $month;
			}
		}

		return $result;
	}

	public function get_all_routes($student_session_id) {
        $this->db->select()->from('fee_discounts');
        if ($student_session_id != null) {
            $this->db->where('student_session_id', $student_session_id);
            $this->db->where('fee_type', 1);
        }
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        
		return $query->result_array();
    }
	public function get_already_taken_route_fees($student_session_id) {

		$this->db->select("receipts.fee_head, receipts.months");
		$this->db->from('receipts');
		$this->db->join('student_session', "student_session.student_id = receipts.student_id", "left");

		if ($student_session_id != null) {
			$this->db->where('student_session.id', $student_session_id);
			$this->db->where('receipts.fee_head_type', 'route');
		}

		$query = $this->db->get();
		$rows = $query->result_array();

		// ---- Convert to final useful array ---- //
		$result = [];

		foreach ($rows as $r) {
			$fee_head = $r['fee_head'];
			$month    = $r['months'];

			if (!isset($result[$fee_head])) {
				$result[$fee_head] = [];
			}

			// Avoid duplicates
			if (!in_array($month, $result[$fee_head])) {
				$result[$fee_head][] = $month;
			}
		}

		return $result;
	}
	public function discount_exists($student_session_id)
	{
		$this->db->select('id');
		$this->db->from('fee_discounts');
		$this->db->where('student_session_id', $student_session_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return ($query->num_rows() > 0);
	}

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($student_session_id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('student_session_id', $student_session_id);
        $this->db->delete('fee_discounts');
        $message = DELETE_RECORD_CONSTANT . " On  fee discounts student session id " . $student_session_id;
        $action = "Delete";
        $record_id = $student_session_id;
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
