<?php

class Api_auth {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    // Required API key
    public function check()
    {

        $headers = $this->CI->input->request_headers();

        if(!isset($headers['Api-Key']))
        {
            api_response(false,'API Key required');
        }

        $api_key = $headers['Api-Key'];

        $check = $this->CI->db
            ->where('domain_api_key',$api_key)
            ->get('sch_settings')
            ->row();

        if(!$check)
        {
            api_response(false,'Invalid API Key');
        }

        return true;

    }

    // Optional API key
    public function optional()
    {

        $headers = $this->CI->input->request_headers();

        if(isset($headers['Api-Key']))
        {

            $api_key = $headers['Api-Key'];

            $check = $this->CI->db
                ->where('domain_api_key',$api_key)
                ->get('sch_settings')
                ->row();

            if(!$check)
            {
                api_response(false,'Invalid API Key');
            }

        }

        return true;

    }

}