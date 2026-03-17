<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {

    public function update_api_key()
    {

        $api_key = $this->input->post('api_key');

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
        }

    }

}