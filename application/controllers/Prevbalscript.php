<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prevbalscript extends Admin_Controller
{

    protected $balance_group;
	
    public function __construct()
    {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->balance_group = $this->config->item('ci_balance_group');
    }


    public function index(){
		$this->db->set('previous_session_balance', 'amount', false);
		$this->db->update('student_fees_master');
		
		$pre_session = $this->session_model->getPreSession($this->current_session);
		if($pre_session->id){
			$student_list = $this->studentfeemaster_model->getBalanceMasterRecordBySessId($pre_session->id, $this->balance_group);
			foreach ($student_list as $row) {
				$this->db
					->where([
						'session_id' => $this->current_session,
						'student_id' => $row->student_id
					])
					->update('student_session', [
						'previous_session_balance' => $row->amount,
						'previous_student_session_id' => $row->student_session_id
					]);
			}
		}
		echo 'success';
    }

}
