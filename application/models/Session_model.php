<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Session_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $this->db->select()->from('sessions');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getAllSession() {
        $sql = "SELECT sessions.*, IFNULL(sch_settings.session_id, 0) as `active` FROM `sessions` LEFT JOIN sch_settings ON sessions.id=sch_settings.session_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getPreSession($session_id) {
        $sql = "select * from sessions where id in (select max(id) from sessions where id < $session_id)";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getStudentAcademicSession($student_id = null) {
        $this->db->select('sessions.*')->from('sessions');
        $this->db->join('student_session', 'sessions.id = student_session.session_id');
        $this->db->where('student_session.student_id', $student_id);
        $this->db->group_by('student_session.session_id');
        $this->db->order_by('sessions.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('sessions');
        $message = DELETE_RECORD_CONSTANT . " On sessions id " . $id;
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
            $this->db->update('sessions', $data);
            $message = UPDATE_RECORD_CONSTANT . " On sessions id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
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
        } else {
            $this->db->insert('sessions', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On sessions id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
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

	// Added by ES
    public function getbatch_id() {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('status', 0);
        $query = $this->db->get('move_students');
		$result = $query->row_array();
		if($result['batch_id'] != ''){
			return $result['batch_id'];
		}else{
			$this->db->where('current_session_id', $this->current_session);
			$this->db->where('status', 0);
			$query = $this->db->get('move_students_category');
			$result = $query->row_array();
			return $result['batch_id'];
		}
    }
    public function getAddedListExists($current_class_id) {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('current_class_id', $current_class_id);
        $query = $this->db->get('move_students');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
    public function add_to_list($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
		$this->db->insert('move_students', $data);
		$insert_id = $this->db->insert_id();
		$message = INSERT_RECORD_CONSTANT . " On move_students id " . $insert_id;
		$action = "Insert";
		$record_id = $insert_id;
		$this->log($message, $record_id, $action);
		//======================Code End==============================

		$this->db->trans_complete(); # Completing transaction
		/* Optional */

		if ($this->db->trans_status() === false) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;
		} else {
			return true;
		}
    }
    public function addedListData() {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('status', 0);
        $query = $this->db->get('move_students');
		return $query->result_array();
    }
    public function getAddedCategoryExists($current_category_id) {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('current_category_id', $current_category_id);
        $this->db->where('status', 0);
        $query = $this->db->get('move_students_category');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
    public function add_to_list_category($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
		$this->db->insert('move_students_category', $data);
		$insert_id = $this->db->insert_id();
		$message = INSERT_RECORD_CONSTANT . " On move_students_category id " . $insert_id;
		$action = "Insert";
		$record_id = $insert_id;
		$this->log($message, $record_id, $action);
		//======================Code End==============================

		$this->db->trans_complete(); # Completing transaction
		/* Optional */

		if ($this->db->trans_status() === false) {
			# Something went wrong.
			$this->db->trans_rollback();
			return false;
		} else {
			return true;
		}
    }
    public function addedListCatData() {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('status', 0);
        $query = $this->db->get('move_students_category');
		return $query->result_array();
    }
	public function getTransferStudentExists() {
        $this->db->where('current_session_id', $this->current_session);
        $this->db->where('status', 0);
        $query = $this->db->get('move_students');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
	public function transfer_batch_next_session() {
        $this->db->trans_start();

		// Update 'move_students' table
		$this->db->where('current_session_id', $this->current_session);
		$this->db->where('status', 0);
		$this->db->update('move_students', ['status' => 1]);

		// Update 'move_students_category' table
		$this->db->where('current_session_id', $this->current_session);
		$this->db->where('status', 0);
		$this->db->update('move_students_category', ['status' => 1]);

		$this->db->trans_complete();

		return $this->db->trans_status();
    }
}
