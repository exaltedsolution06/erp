<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function get_all_branch() {
        return $this->db->get('branches')
                        ->result_array();
    }
}
