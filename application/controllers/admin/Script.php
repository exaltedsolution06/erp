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
		
		//For 'vehicles'.
		$session_exists = "SHOW COLUMNS FROM `vehicles` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `vehicles` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `vehicles` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'vehicle_routes'.
		$session_exists = "SHOW COLUMNS FROM `vehicle_routes` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `vehicle_routes` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `vehicle_routes` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'subjects'.
		$session_exists = "SHOW COLUMNS FROM `subjects` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `subjects` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `subjects` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'department'.
		$session_exists = "SHOW COLUMNS FROM `department` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `department` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `department` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'staff_designation'.
		$session_exists = "SHOW COLUMNS FROM `staff_designation` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `staff_designation` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `staff_designation` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'staff'.
		$session_exists = "SHOW COLUMNS FROM `staff` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `staff` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `staff` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'class_teacher'.
		$session_exists = "SHOW COLUMNS FROM `class_teacher` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `class_teacher` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `class_teacher` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'staff_attendance'.
		$session_exists = "SHOW COLUMNS FROM `staff_attendance` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `staff_attendance` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `staff_attendance` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'exam_groups'.
		$session_exists = "SHOW COLUMNS FROM `exam_groups` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `exam_groups` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `exam_groups` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'coscholasticareas'.
		$session_exists = "SHOW COLUMNS FROM `coscholasticareas` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `coscholasticareas` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `coscholasticareas` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'template_admitcards'.
		$session_exists = "SHOW COLUMNS FROM `template_admitcards` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `template_admitcards` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `template_admitcards` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'template_marksheets'.
		$session_exists = "SHOW COLUMNS FROM `template_marksheets` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `template_marksheets` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `template_marksheets` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'template_reportcard'.
		$session_exists = "SHOW COLUMNS FROM `template_reportcard` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `template_reportcard` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `template_reportcard` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'grades'.
		$session_exists = "SHOW COLUMNS FROM `grades` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `grades` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `grades` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
    }
}
