<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Expense_model extends MY_Model
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
        if (!empty($text)) {
            $this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
			$this->db->join('staff', 'staff.id = balance_sheets.staff_id', 'left');
			$this->db->where('balance_sheets.session_id', $this->current_session);
            $this->db->like('staff.name', $text);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 1);
            $query = $this->db->get();
            return $query->result_array();
        } else {
			
            $this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
            $this->db->where('balance_sheets.date >=', $start_date);
            $this->db->where('balance_sheets.date <=', $end_date);
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 1);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function get($id = null)
    {
        $this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
        //$this->db->join('expense_head', 'expenses.exp_head_id = expense_head.id');
        $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
		$this->db->where('balance_sheets.session_id', $this->current_session);
		$this->db->where('balance_sheets.balance_type', 1);
		$this->db->where('balance_sheets.status', 0);
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
       
        $message   = DELETE_RECORD_CONSTANT . " On  expenses   id " . $id;
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

            return $return_value;
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
        
		if (isset($data['id']) && $data['id'] != '') {

			$this->db->where('id', $data['id']);
			$this->db->update('balance_sheets', $data);

			$message   = UPDATE_RECORD_CONSTANT . " On  expenses   id " . $data['id'];
			$action    = "Update";
			$record_id = $data['id'];
		} else {
			$this->db->insert('balance_sheets', $data);

			$record_id = $this->db->insert_id();
			$message   = INSERT_RECORD_CONSTANT . " On  expenses   id " . $record_id;
			$action    = "Insert";
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
		
    }

    public function check_Exits_group($data)
    {
        $this->db->select('*');
        $this->db->from('expenses');
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
        $this->db->select('expenses.id,expenses.session_id,expenses.invoice_no,expenses.amount,expenses.documents,expenses.note,expense_head.class,feetype.type')->from('expenses');
        $this->db->join('expense_head', 'expenses.class_id = expense_head.id');
        $this->db->join('feetype', 'expenses.feetype_id = feetype.id');
        $this->db->where('expenses.class_id', $class_id);
        $this->db->where('expenses.feetype_id', $type);
        $this->db->where('expenses.session_id', $this->current_session);
        $this->db->order_by('expenses.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalExpenseBydate($date)
    {
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where date=' . $this->db->escape($date);
        $query = $this->db->query($query);
        return $query->row();
    }

    public function getTotalExpenseBwdate($date_from, $date_to)
    {
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where session_id='.$this->current_session.' and date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);
        $query = $this->db->query($query);
        return $query->row();
    }
	
	public function getExpenseHeadData($start_date, $end_date)
    {
        $condition = "balance_sheets.balance_type=1 AND date_format(date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";

        $this->db->select('sum(balance_sheets.amount) as total,expense_head.exp_category')->from('balance_sheets');
        $this->db->join('expense_head', 'balance_sheets.head_id = expense_head.id');
        $this->db->where($condition)->group_by('expense_head.id');
        $r = $this->db->get()->result_array();
        return $r;
		
		//expense_head.exp_category
    }
	
    public function getExpenseHeadData_bck($start_date, $end_date)
    {
        $condition = "date_format(date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";

        $recorddata = $this->db->select('sum(amount) as total,exp_category')->from('expenses');
        $this->db->join('expense_head', 'expenses.exp_head_id = expense_head.id');
        $this->db->where($condition)->group_by('expense_head.id');
        $r = $this->db->get()->result_array();
        return $r;
    }
	public function getTotalExpenseBwdateYearly($date_from, $date_to)
    {
		//echo $date_from.'///'.$date_to; die;
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where session_id='.$this->current_session.' and date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);
        $query = $this->db->query($query);
        return $query->row();
    }
	public function getTotalExpenseBwdateWeekly($date_from, $date_to)
    {
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where session_id='.$this->current_session.' and date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);
        $query = $this->db->query($query);
        return $query->row();
    }
	
	public function search_all_report($text = null, $start_date = null, $end_date = null, $balance_type = null)
    {
        if (!empty($text)) {
            $this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
			//$this->db->join('staff', 'staff.id = balance_sheets.staff_id', 'left');
			$this->db->where('balance_sheets.session_id', $this->current_session);
            $this->db->like('balance_sheets.receipt_no', $text);
			$this->db->where('balance_sheets.status', 0);
			//$this->db->where('balance_sheets.balance_type', 1);
            $query = $this->db->get();
            return $query->result_array();
        }
		else if($balance_type == 0)
		{
			$this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 0);
            $query = $this->db->get();
            return $query->result_array();
		}
		else if($balance_type == 1)
		{
			$this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			$this->db->where('balance_sheets.balance_type', 1);
            $query = $this->db->get();
            return $query->result_array();
		}
		else {
            $this->db->select('balance_sheets.*, expense_head.exp_category')->from('balance_sheets');
            $this->db->join('expense_head', 'expense_head.id = balance_sheets.head_id', 'left');
            $this->db->where('balance_sheets.date >=', $start_date);
            $this->db->where('balance_sheets.date <=', $end_date);
			$this->db->where('balance_sheets.session_id', $this->current_session);
			$this->db->where('balance_sheets.status', 0);
			//$this->db->where('balance_sheets.balance_type', 1);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
	
	public function todays_expense()
	{
		$this->db->select('SUM(amount) as today_total_expense');
		$this->db->from(' balance_sheets');
		$this->db->where('balance_type',1);
		$this->db->where('DATE(date)',date('Y-m-d'));
		$this->db->where('session_id',$this->current_session);

		$query = $this->db->get();
		return $query->row()->today_total_expense;
	}
	 public function getExpenseAmountBetweenDate($start_date, $end_date)
    {
		$condition = "balance_sheets.balance_type=1 AND date_format(date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        $this->db->select('`balance_sheets`.*')->from('balance_sheets');
        $this->db->where($condition);
        $this->db->order_by('balance_sheets.date','ASC');
        $query        = $this->db->get();
        $result_value = $query->result();
		
        $return_array = array();
        if (!empty($result_value)) {
            foreach ($result_value as $key => $value) {
                $a                    = array();
				$a['amount']          = $value->amount;
				$a['date']            = $value->date;
				$a['description']     = $value->description;
				$a['inv_no']          = $value->receipt_no;
				$return_array[]       = $a;
			}
        }
        return $return_array;
    }

}
