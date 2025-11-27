<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {

        $subject_condition = 0;
        $userdata = $this->customlib->getUserData();

        $role_id = $userdata["role_id"];


        if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if ($userdata["class_teacher"] == 'yes') {



                $my_classes = $this->teacher_model->my_classes($userdata['id']);


                if (!empty($my_classes)) {
                    $subject_condition = 0;
                } else {
                    $subject_condition = 1;
                    $my_subjects = $this->teacher_model->get_examsubjects($userdata['id']);
                }
            }
        }
        $this->db->select()->from('subjects');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            if ($subject_condition == 1) {
                $this->db->where_in('subjects.id', $my_subjects);
            }
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('subjects');
        $message = DELETE_RECORD_CONSTANT . " On subjects id " . $id;
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
            $this->db->update('subjects', $data);
            $message = UPDATE_RECORD_CONSTANT . " On subjects id " . $data['id'];
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
            $this->db->insert('subjects', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On subjects id " . $id;
            $action = "Insert";
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
            return $id;
        }
    }

    function check_data_exists($data) {
        $this->db->where('name', $data['name']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_code_exists($data) {
        $this->db->where('code', $data['code']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	public function check_combination_exists($name, $type, $type_one) {
		return $this->db->where('name', $name)
						->where('type', $type)
						->where('type_one', $type_one)
						->get('subjects')->num_rows() > 0;
	}
	
	public function check_combination_exists_edit($name, $type, $type_one, $id)
	{
		return $this->db
					->where('name', $name)
					->where('type', $type)
					->where('type_one', $type_one)
					->where('id !=', $id)
					->get('subjects')
					->num_rows() > 0;
	}

	public function get_exam_subjects($exam_group_class_batch_exam_id)
	{
		$this->db->distinct();
		$this->db->select('sgs.subject_id');
		$this->db->from('exam_group_class_batch_exam_students eg');
		$this->db->join('student_session ss', 'ss.id = eg.student_session_id');
		$this->db->join('class_sections cs', 'cs.class_id = ss.class_id AND cs.section_id = ss.section_id');
		$this->db->join('subject_group_class_sections sgcs', 'sgcs.class_section_id = cs.id');
		$this->db->join('subject_group_subjects sgs', 'sgs.subject_group_id = sgcs.subject_group_id');
		$this->db->where('eg.exam_group_class_batch_exam_id', $exam_group_class_batch_exam_id);

		$query = $this->db->get();

		return array_column($query->result_array(), 'subject_id');
	}
	
	public function get_exam_classes_c($exam_group_class_batch_exam_id)
	{
		$this->db->distinct();
		$this->db->select('ss.class_id');
		$this->db->from('exam_group_class_batch_exam_students eg');
		$this->db->join('student_session ss', 'ss.id = eg.student_session_id');
		$this->db->where('eg.exam_group_class_batch_exam_id', $exam_group_class_batch_exam_id);

		$query = $this->db->get();

		$class_ids = array_column($query->result_array(), 'class_id');

		if (empty($class_ids)) {
			return [];
		}
		
		// Step 2: Fetch class names based on class IDs
		$this->db->select('id, class');
		$this->db->from('classes');
		$this->db->where_in('id', $class_ids);

		return $this->db->get()->result();
	}
	public function get_exam_classes($exam_group_class_batch_exam_id, $subject_id)
	{
		/* ----------------------------------------------------
		   1. Get classes from exam group students
		---------------------------------------------------- */
		$this->db->distinct();
		$this->db->select('ss.class_id');
		$this->db->from('exam_group_class_batch_exam_students eg');
		$this->db->join('student_session ss', 'ss.id = eg.student_session_id');
		$this->db->where('eg.exam_group_class_batch_exam_id', $exam_group_class_batch_exam_id);

		$exam_classes = array_column($this->db->get()->result_array(), 'class_id');

		if (empty($exam_classes)) {
			return [];
		}

		/* ----------------------------------------------------
		   2. Get classes where this subject exists via subject group
		---------------------------------------------------- */
		$this->db->distinct();
		$this->db->select('cs.class_id');
		$this->db->from('subject_group_subjects sgs');
		$this->db->join('subject_group_class_sections sgcs', 'sgcs.subject_group_id = sgs.subject_group_id');
		$this->db->join('class_sections cs', 'cs.id = sgcs.class_section_id');
		$this->db->where('sgs.subject_id', $subject_id);

		$subject_group_classes = array_column($this->db->get()->result_array(), 'class_id');

		if (empty($subject_group_classes)) {
			return [];
		}

		/* ----------------------------------------------------
		   3. FINAL: Return only CLASS IDs present in BOTH
		---------------------------------------------------- */
		$final_class_ids = array_intersect($exam_classes, $subject_group_classes);

		if (empty($final_class_ids)) {
			return [];
		}

		/* ----------------------------------------------------
		   4. Fetch class names from classes table
		---------------------------------------------------- */
		$this->db->select('id, class');
		$this->db->from('classes');
		$this->db->where_in('id', $final_class_ids);

		return $this->db->get()->result();
	}

}
