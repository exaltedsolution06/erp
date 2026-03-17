<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library('Api_auth');
        // $this->load->model('api/Settings_model');

        // $this->api_auth->check();
    }
	
    public function get_sch_setting()
    {
		$this->api_auth->check();
		
		$result = $this->setting_model->getSetting();
		
		echo json_encode([
			'status'=>true,
			'data'=>$result
		]);

    }
    public function update_sch_setting()
    {
		$this->api_auth->check();
		
		$datas = $this->input->post();
        $update = $this->setting_model->add($datas);
		
        if($update)
        {
            echo json_encode([
                'status'=>true,
                'message'=>'Data updated',
                'data'=>$datas
            ]);
        }
        else
        {
            echo json_encode([
                'status'=>false,
                'message'=>'Update failed'
            ]);
        }
		
        /*$api_key = $this->input->post('api_key');

        if(!$api_key)
        {
            echo json_encode([
                'status'=>false,
                'message'=>'API key missing'
            ]);
            exit;
        }

        $this->db->where('id',1);
        $update = $this->db->update('sch_settings',[
            'domain_api_key'=>$api_key
        ]);

        if($update)
        {
            echo json_encode([
                'status'=>true,
                'message'=>'API key updated'
            ]);
        }
        else
        {
            echo json_encode([
                'status'=>false,
                'message'=>'Update failed'
            ]);
        }*/

    }

}