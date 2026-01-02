<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Script extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$session_id = $this->setting_model->getCurrentActiveSession();
		if($session_id){
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
		
		// Remove index exists in 'staff' table
		$index_exists_sql = "
			SHOW INDEX FROM `staff`
			WHERE Key_name = 'employee_id'
		";
		$index_exists = $this->db->query($index_exists_sql);
		if ($index_exists->num_rows() > 0) {
			// Drop the index
			$drop_index_sql = "ALTER TABLE `staff` DROP INDEX `employee_id`";
			$this->db->query($drop_index_sql);
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
		
		//Set session_id = NULL for Super Admin in 'staff' table
		$checks_sql = "
			SELECT staff.id
			FROM staff
			INNER JOIN staff_roles ON staff_roles.staff_id = staff.id
			INNER JOIN roles ON roles.id = staff_roles.role_id
			WHERE roles.name = 'Super Admin'
			  AND staff.session_id IS NOT NULL
			LIMIT 1
		";
		$check = $this->db->query($checks_sql);
		if ($check->num_rows() > 0) {
			$update_sql = "
				UPDATE staff
				INNER JOIN staff_roles ON staff_roles.staff_id = staff.id
				INNER JOIN roles ON roles.id = staff_roles.role_id
				SET staff.session_id = NULL
				WHERE roles.name = 'Super Admin'
			";
			$this->db->query($update_sql);
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
		
		// transfer category_id, route_id, school_house_id from student to student to student_session table
		$this->db->query('FLUSH TABLES');
		$this->db->close();
		$this->db->initialize();
		$this->load->dbforge();
		$altered = false;
		if (
			$this->db->field_exists('hostel_room_id', 'student_session') &&
			!$this->db->field_exists('school_house_id', 'student_session')
		) {
			$fields = [
				'hostel_room_id' => [
					'name' => 'school_house_id',
					'type' => 'INT',
					'constraint' => 11,
					'null' => FALSE,
				]
			];

			$this->dbforge->modify_column('student_session', $fields);
			$altered = true;
		}
		
		
		if (
			$this->db->field_exists('vehroute_id', 'student_session') &&
			!$this->db->field_exists('fee_category_id', 'student_session')
		) {
			$fields = [
				'vehroute_id' => [
					'name' => 'fee_category_id',
					'type' => 'INT',
					'constraint' => 11,
					'null' => TRUE,
					'default' => NULL,
				]
			];

			$this->dbforge->modify_column('student_session', $fields);
			$altered = true;
		}
		
		if($altered)	
		{
			$query = $this->db->select('id,category_id,route_id,school_house_id')->get('students');
			$studentArr = [];
			$studentDtlsArr = [];
			foreach($query->result_array() as $students)
			{
				$studentArr[] = $students;
				$qr = $this->db->where('student_id', $students['id'])->get('student_session');
				if($qr->num_rows() > 0)
				{
					$studentDtlsArr[] = $students;
					$data = [
						'route_id' =>$students['route_id'],
						'school_house_id' =>$students['school_house_id'],
						'fee_category_id' =>$students['category_id'],
					];
					$this->db->where('student_id', $students['id']);
					$this->db->update('student_session', $data);
				}
			}
		}
		
		if ($altered)
		{
			$this->load->dbforge();
	
			//$this->db->close();
			//$this->db->initialize();

			if ($this->db->field_exists('category_id', 'students')) {
				$this->dbforge->drop_column('students', 'category_id');
			}

			if ($this->db->field_exists('route_id', 'students')) {
				$this->dbforge->drop_column('students', 'route_id');
			}

			if ($this->db->field_exists('school_house_id', 'students')) {
				$this->dbforge->drop_column('students', 'school_house_id');
			}
			
			if ($this->db->field_exists('vehroute_id', 'students')) {
				$this->dbforge->drop_column('students', 'vehroute_id');
			}
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
		
		//For 'leave_types'.
		$session_exists = "SHOW COLUMNS FROM `leave_types` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `leave_types` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `leave_types` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);

		}
		
		//create table sch_settings_session		
		$this->load->dbforge();
		$base_fields = [
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'session_id' => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'       => FALSE,
			],
			'receipt_sr_no' => [
				'type'       => 'BIGINT',
				'constraint' => 20,
				'null'       => FALSE,
				'default'    => 0,
			],
			'staffid_auto_insert' => [
				'type'       => 'INT',
				'constraint' => 11,
				'default'    => 0,
			],
			'staffid_prefix' => [
				'type'       => 'VARCHAR',
				'constraint' => 100,
				'null'    => TRUE,
			],
			'staffid_start_from' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => TRUE,
			],
			'staffid_no_digit' => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'       => TRUE,
			],
			'staffid_update_status' => [
				'type'       => 'INT',
				'constraint' => 11,
				'default'    => 0,
			],
			'adm_auto_insert' => [
				'type'       => 'INT',
				'constraint' => 11,
				'default'    => 0,
			],
			'adm_prefix' => [
				'type'       => 'VARCHAR',
				'constraint' => 100,
				'null'    => TRUE,
			],
			'adm_start_from' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => TRUE,
			],
			'adm_no_digit' => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'       => TRUE,
			],
			'adm_update_status' => [
				'type'       => 'INT',
				'constraint' => 11,
				'default'    => 0,
			],
		];
		if ( ! $this->db->table_exists('sch_settings_session') )
		{
			$this->dbforge->add_field($base_fields);
			$this->dbforge->add_key('id', TRUE); // PRIMARY KEY
			$this->dbforge->create_table('sch_settings_session', TRUE);
		} else {
			foreach ($base_fields as $column => $definition) {
				if ( ! $this->db->field_exists($column, 'sch_settings_session') ) {
					// add_column requires single-column array
					$this->dbforge->add_column('sch_settings_session', [
						$column => $definition
					]);
				}
			}
		}
		// Check if row already exists for this session in 'sch_settings_session'
		$exists = $this->db
			->where('session_id', $session_id)
			->get('sch_settings_session')
			->row();
		if(!$exists) {
			// Fetch data from sch_settings
			$settings = $this->db
				->where('session_id', $session_id)
				->get('sch_settings')
				->row_array();
			if (!empty($settings)) {
				$insert_data = [
					'session_id'             => $session_id,

					// Staff ID settings
					'staffid_auto_insert'    => $settings['staffid_auto_insert'],
					'staffid_prefix'         => $settings['staffid_prefix'],
					'staffid_start_from'     => $settings['staffid_start_from'],
					'staffid_no_digit'       => $settings['staffid_no_digit'],
					'staffid_update_status'  => $settings['staffid_update_status'],

					// Admission ID settings
					'adm_auto_insert'        => $settings['adm_auto_insert'],
					'adm_prefix'             => $settings['adm_prefix'],
					'adm_start_from'         => $settings['adm_start_from'],
					'adm_no_digit'           => $settings['adm_no_digit'],
					'adm_update_status'      => $settings['adm_update_status'],

					// Receipt
					'receipt_sr_no'          => $settings['receipt_sr_no'] ?? '',
				];

				$this->db->insert('sch_settings_session', $insert_data);
			}
		}
		
		$drop_columns = [
			'receipt_sr_no',
			'staffid_auto_insert',
			'staffid_prefix',
			'staffid_start_from',
			'staffid_no_digit',
			'staffid_update_status',
			'adm_auto_insert',
			'adm_prefix',
			'adm_start_from',
			'adm_no_digit',
			'adm_update_status'
		];
		foreach ($drop_columns as $column) {
			if ($this->db->field_exists($column, 'sch_settings')) {
				$this->dbforge->drop_column('sch_settings', $column);
			}
		}
		
		//For 'sch_settings_session'.
		$session_exists = "SHOW COLUMNS FROM `sch_settings_session` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `leave_types` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `leave_types` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);

		}
		
		//create add new field session_id table receipt_sr_no		
		$this->load->dbforge();
		if ($this->db->table_exists('receipt_sr_no'))
		{
			if ( ! $this->db->field_exists('session_id', 'receipt_sr_no') )
			{
				$fields = [
					'session_id' => [
						'type'       => 'INT',
						'constraint' => 11,
						'null'       => FALSE,
						'after'      => 'id'  
					]
				];

				$this->dbforge->add_column('receipt_sr_no', $fields);
			}
		}
		
		//For 'receipts'.
		$session_exists = "SHOW COLUMNS FROM `receipts` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `receipts` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `receipts` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'deleted_receipts'.
		$session_exists = "SHOW COLUMNS FROM `deleted_receipts` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `deleted_receipts` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `deleted_receipts` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'contents'.
		$session_exists = "SHOW COLUMNS FROM `contents` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `contents` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `contents` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'send_notification'.
		$session_exists = "SHOW COLUMNS FROM `send_notification` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `send_notification` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `send_notification` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'front_cms_programs'.
		$session_exists = "SHOW COLUMNS FROM `front_cms_programs` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `front_cms_programs` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `front_cms_programs` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'certificates'.
		$session_exists = "SHOW COLUMNS FROM `certificates` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `certificates` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `certificates` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		

		//For 'books'.
		$session_exists = "SHOW COLUMNS FROM `books` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `books` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `books` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For ' libarary_members '.
		$session_exists = "SHOW COLUMNS FROM `libarary_members` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `libarary_members` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `libarary_members` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For ' book_issues '.
		$session_exists = "SHOW COLUMNS FROM `book_issues` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `book_issues` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `book_issues` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}

		//For 'id_card'.
		$session_exists = "SHOW COLUMNS FROM `id_card` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `id_card` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `id_card` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'staff_id_card'.
		$session_exists = "SHOW COLUMNS FROM `staff_id_card` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `staff_id_card` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `staff_id_card` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'income_head'.
		$session_exists = "SHOW COLUMNS FROM `income_head` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `income_head` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `income_head` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'income'.
		$session_exists = "SHOW COLUMNS FROM `income` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `income` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `income` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'expense_head'.
		$session_exists = "SHOW COLUMNS FROM `expense_head` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `expense_head` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			
			$update_sql = "UPDATE `expense_head` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		

		//For 'expenses'.
		$session_exists = "SHOW COLUMNS FROM `expenses` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `expenses` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `expenses` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		
		//For 'print_headerfooter'.
		$session_exists = "SHOW COLUMNS FROM `print_headerfooter` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `print_headerfooter` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `print_headerfooter` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
		}
		
		//For 'item_category'.
		$session_exists = "SHOW COLUMNS FROM `item_category` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item_category` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item_category` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		
		//For 'item'.
		$session_exists = "SHOW COLUMNS FROM `item` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		//For 'item_stock'.
		$session_exists = "SHOW COLUMNS FROM `item_stock` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item_stock` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item_stock` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		//For 'item_store'.
		$session_exists = "SHOW COLUMNS FROM `item_store` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item_store` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item_store` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		
		//For 'item_supplier'.
		$session_exists = "SHOW COLUMNS FROM `item_supplier` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item_supplier` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item_supplier` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		
		//For 'item_issue'.
		$session_exists = "SHOW COLUMNS FROM `item_issue` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `item_issue` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `item_issue` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		//For 'custom_fields'.
		$session_exists = "SHOW COLUMNS FROM `custom_fields` LIKE 'session_id'";
		$session_exists_sql = $this->db->query($session_exists);		
		if ($session_exists_sql->num_rows() == 0) {
			$add_sql = "ALTER TABLE `custom_fields` ADD `session_id` INT(11) NULL DEFAULT NULL AFTER `id`";
			$this->db->query($add_sql);
			$update_sql = "UPDATE `custom_fields` SET `session_id` = ?";
			$this->db->query($update_sql, [$session_id]);
        }
		
		echo 'Success';
		}else{
			echo 'You have no active session';
		}
    }
}
