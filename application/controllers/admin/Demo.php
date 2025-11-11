 <?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Demo extends Admin_Controller {
  
    public $exam_type = array();
    private $sch_current_session = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->load->library('mailsmsconf');
        $this->exam_type = $this->config->item('exam_type');
        $this->sch_current_session = $this->setting_model->getCurrentSession();
        $this->attendence_exam = $this->config->item('attendence_exam');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

	public function index() {
		echo "ok";
	}









}