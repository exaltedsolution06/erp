<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Script extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$session_id = $this->setting_model->getCurrentActiveSession();
		
		//For 'sections'.
		$session_exists = "SHOW COLUMNS FROM `sections` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `sections` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `section`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `sections` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'classes'.
		$session_exists = "SHOW COLUMNS FROM `classes` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `classes` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `class`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `classes` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'fee_groups'.
		$session_exists = "SHOW COLUMNS FROM `fee_groups` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `fee_groups` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `fee_groups` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'account'.
		$session_exists = "SHOW COLUMNS FROM `account` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `account` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `account` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'fee_head'.
		$session_exists = "SHOW COLUMNS FROM `fee_head` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `fee_head` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `fee_head` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'fees_plan'.
		$session_exists = "SHOW COLUMNS FROM `fees_plan` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `fees_plan` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `fees_plan` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'route_head'.
		$session_exists = "SHOW COLUMNS FROM `route_head` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `route_head` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `route_head` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'route_plan'.
		$session_exists = "SHOW COLUMNS FROM `route_plan` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `route_plan` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `route_plan` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		//For 'school_houses'.
		$session_exists = "SHOW COLUMNS FROM `school_houses` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `school_houses` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `school_houses` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
    }
}
