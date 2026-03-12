<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Income_model extends My_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function search($text = null, $start_date = null, $end_date = null)
    {
		//echo 'search';die;
        if (!empty($text)) {
            $this->db->select('balance_sheets.* ,income_head.income_category')->from('balance_sheets');
            $this->db->join('income_head', 'income_head.id = balance_sheets.head_id', 'left');
            $this->db->join('students', 'students.id = balance_sheets.student_id', 'left');

            $this->db->like('students.firstname', $text);
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 0); // for income
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select('balance_sheets.* ,income_head.income_category')->from('balance_sheets');
            $this->db->join('income_head', 'income_head.id = balance_sheets.head_id', 'left');
            $this->db->where('balance_sheets.date >=', $start_date);
            $this->db->where('balance_sheets.date <=', $end_date);
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 0); // for income
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function searchincomegroup($start_date = null, $end_date = null, $head_id = null)
    {
        $this->db->select('GROUP_CONCAT(income.id,"@",income.name,"@",income.invoice_no,"@",income.date,"@",income.amount) as income, income_head.income_category,sum(income.amount) as total_amount')->from('income');
        $this->db->join('income_head', 'income.inc_head_id = income_head.id');

        $this->db->where('income.date >=', $start_date);
        $this->db->where('income.date <=', $end_date);
        if ($head_id != null) {
            $this->db->where('income.inc_head_id', $head_id);
        }
        $this->db->group_by('income.inc_head_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getIncomeHeadsData($start_date, $end_date)
    {

        $condition = "balance_sheets.balance_type=0";

        $this->db->select('sum(balance_sheets.amount) as total,income_category')->from('balance_sheets');
        $this->db->join('income_head', 'balance_sheets.head_id = income_head.id');
        $this->db->where($condition)->group_by('income_head.id');
        $r = $this->db->get()->result_array();
        return $r;
    }
	
	public function getIncomeHeadsData_bck($start_date, $end_date)
    {

        $condition = "date_format(date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";

        $this->db->select('sum(amount) as total,income_category')->from('income');
        $this->db->join('income_head', 'income.inc_head_id = income_head.id');
        $this->db->where($condition)->group_by('income_head.id');
        $r = $this->db->get()->result_array();
        return $r;
    }

    public function get($id = null)
    {
        $this->db->select('balance_sheets.* ,income_head.income_category')->from('balance_sheets');
       //$this->db->join('income_head', 'balance_sheets.head_id = income_head.id');
        $this->db->join('income_head', 'income_head.id = balance_sheets.head_id', 'left');
		//$this->db->where('income_head.session_id', $this->current_session);
		$this->db->where('balance_sheets.session_id', $this->current_session);
		$this->db->where('balance_sheets.balance_type', 0); // for income
		
        if ($id != null) {
            $this->db->where('balance_sheets.id', $id);
        } else {
            $this->db->order_by('balance_sheets.id', 'DESC');
        }

        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
	public function get_bck($id = null)
    {
        $this->db->select('income.id,income.date,income.name,income.invoice_no,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id')->from('income');
        $this->db->join('income_head', 'income.inc_head_id = income_head.id');
		$this->db->where('income_head.session_id', $this->current_session);
		$this->db->where('income.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('income.id', $id);
        } else {
            $this->db->order_by('income.id', 'DESC');
        }

        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('balance_sheets');
        
        $message   = DELETE_RECORD_CONSTANT . " On  Income   id " . $id;
        $action    = "Delete";
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

            return $id;
        }
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data)
    {
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(false); # See Note 01. If you wish can remove as well
			
		/*$this->db->where('session_id', $this->current_session);
		$this->db->where('head_id', $data['inc_head_id']);
		$this->db->where('name', $data['name']);
		$check = $this->db->get('balance_sheets');
		if($check->num_rows() > 0)
		{
			return false;
		}
		else
		{*/
			
			//=======================Code Start===========================
			if (isset($data['id'])) {

				$this->db->where('id', $data['id']);
				$this->db->update('balance_sheets', $data);
				$message   = UPDATE_RECORD_CONSTANT . " On  Income   id " . $data['id'];
				$action    = "Update";
				$record_id = $data['id'];
			} else {
				$this->db->insert('balance_sheets', $data);
				$return_value = $this->db->insert_id();
				$message      = INSERT_RECORD_CONSTANT . " On  Income   id " . $return_value;
				$action       = "Insert";
				$record_id    = $return_value;
			}

			$this->log($message, $record_id, $action);

			//======================Code End==============================

			$this->db->trans_complete(); # Completing transaction
			/* Optional */

			if ($this->db->trans_status() === false) {
				# Something went wrong.
				$this->db->trans_rollback();
				return false;
			} else {

				return $record_id;
			}
		//}
    }

    public function check_Exits_group($data)
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('session_id', $this->current_session);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('class_id', $data['class_id']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getTypeByFeecategory($type, $class_id)
    {
        $this->db->select('income.id,income.session_id,income.amount,income.invoice_no,income.documents,income.note,income_head.class,feetype.type')->from('income');
        $this->db->join('income_head', 'income.class_id = income_head.id');
        $this->db->join('feetype', 'income.feetype_id = feetype.id');
        $this->db->where('income.class_id', $class_id);
        $this->db->where('income.feetype_id', $type);
        $this->db->where('income.session_id', $this->current_session);
        $this->db->order_by('income.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalExpenseBydate($date)
    {
        $query = 'SELECT sum(amount) as `amount` FROM `income` where date=' . $this->db->escape($date);
        $query = $this->db->query($query);
        return $query->row();
    }

    public function getTotalExpenseBwdate($date_from, $date_to)
    {
        $query = 'SELECT sum(amount) as `amount` FROM `income` where date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);

        $query = $this->db->query($query);
        return $query->row();
    }
	public function todays_income()
	{
		$this->db->select('SUM(amount) as today_total_income');
		$this->db->from(' balance_sheets');
		$this->db->where('balance_type',0);
		$this->db->where('DATE(date)',date('Y-m-d'));
		$this->db->where('session_id',$this->current_session);

		$query = $this->db->get();
		return $query->row()->today_total_income;
	}

}
