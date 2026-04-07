<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

    public function __construct() {
        parent::__construct();

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');

        $this->load->model('Api_model');
    }

    public function index() {
        //echo json_encode($this->Api_model->get_all_branch());
		
		$result = $this->Api_model->get_all_branch();
		
		echo json_encode([
			'status'=>true,
			'data'=>$result
		]);
    }
}
