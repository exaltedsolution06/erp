<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usermodulepermission extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$truncate_permission_student = "TRUNCATE TABLE `permission_student`";
		$truncate_permission_student_sql = $this->db->query($truncate_permission_student);
		
		$modules = [
			[
				'module' => 'Dashboard',
				'short_code' => 'dashboard',
			],
			[
				'module' => 'My Profile',
				'short_code' => 'my_profile',
			],
			[
				'module' => 'Fees',
				'short_code' => 'fees',
			],
			[
				'module' => 'Class Timetable',
				'short_code' => 'class_timetable',
			],
			[
				'module' => 'Syllabus Status',
				'short_code' => 'syllabus_status',
			],
			[
				'module' => 'Homework Section',
				'short_code' => 'homework',
			],
			[
				'module' => 'Online Exam',
				'short_code' => 'online_examination',
			],
			[
				'module' => 'Apply Leave',
				'short_code' => 'apply_leave',
			],
			[
				'module' => 'Download Section',
				'short_code' => 'download_center',
			],
			[
				'module' => 'Attendance Section',
				'short_code' => 'attendance',
			],
			[
				'module' => 'Exam Section',
				'short_code' => 'examinations',
			],
			[
				'module' => 'Notice Board',
				'short_code' => 'notice_board',
			],
			[
				'module' => 'Teacher Review',
				'short_code' => 'teachers_rating',
			],
			[
				'module' => 'Library Management',
				'short_code' => 'library',
			],
			[
				'module' => 'Transport Route',
				'short_code' => 'transport_routes',
			],
			[
				'module' => 'Hostel Room',
				'short_code' => 'hostel_rooms',
			],
		];
		foreach($modules as $module_val){
			$system = 0;
			$permission_student_data = [
				'name' => $module_val['module'],
				'short_code' => $module_val['short_code'],
				'system' => $system,
				'student' => 1,
				'parent' => 1,
				'group_id' => 0,
			];
			$this->db->insert('permission_student', $permission_student_data);
			$perm_group_id = $this->db->insert_id(); // Get inserted ID
		}

		echo 'Success';
    }
}
