<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Modulepermission extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$truncate_permission_group = "TRUNCATE TABLE `permission_group`";
		$truncate_permission_group_sql = $this->db->query($truncate_permission_group);
		
		$truncate_permission_category = "TRUNCATE TABLE `permission_category`";
		$truncate_permission_category_sql = $this->db->query($truncate_permission_category);
		
		$truncate_roles_permissions = "TRUNCATE TABLE `roles_permissions`";
		$truncate_roles_permissions_sql = $this->db->query($truncate_roles_permissions);
		
		$modules = [
			[
				'module' => 'Software Subscription',
				'links' => [
					['name' => 'Package List', 			'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'School Registration', 	'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Subscription Details', 	'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Invoice Details', 		'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Set Master',
				'links' => [
					['name' => 'Add Section', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Class', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Category', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Create Account', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Head', 					'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Plan', 					'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Create Route',				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Route Plan', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Set Discount', 				'add' => false, 'view' => true, 'edit' => true, 'delete' => true],
					// ['name' => 'Fee Discount Assign', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Caste Category', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Payment Mode', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student House', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Vehicles', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Assign Vehicle', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Subjects', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Subject Group', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Class Timetable', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Teachers Timetable', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Assign Class Teacher', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Promote Students', 			'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Set Disable Reason', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Previous Session Balance', 	'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Change Session', 			'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Front Desk',
				'links' => [
					['name' => 'Setup Front Office', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Admission Enquiry', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Follow Up Admission Enq', 	'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Visitor Book', 				'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Phone Call Log', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Postal Dispatch', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Postal Receive', 			'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Complain', 					'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Front Desk All Reports', 				'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Admission Section',
				'links' => [
					['name' => 'New Admission', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Import Admission', 		'add' => true, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Online Admission', 		'add' => false, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student Full Details', 	'add' => false, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Discountinue Students', 'add' => true, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Bulk Delete', 			'add' => false, 'view' => true, 'edit' => false, 'delete' => true],
					['name' => 'Student Timeline', 		'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Admission All Reports', 			'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Fee Collection',
				'links' => [
					['name' => 'Collect Fee',        'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Collect Fee List',   'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Discount', 	 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Receipt Book',       'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Fee Register',       'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Fee Card',           'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Defaulter List',     'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Reminder Letter',    'add' => true,  'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Delete Fee List',    'add' => false, 'view' => true,  'edit' => false, 'delete' => true],
					['name' => 'Search Fee Slip',    'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Student Ledger',     'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Fee All Reports',        'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Staff Management',
				'links' => [
					['name' => 'Department',             'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Designation',            'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Staff',               'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Staff Attendance',        'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Payroll',                 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Approve Leave Request',   'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Apply Leave',              'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Leave Type',               'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Teachers Rateing',         'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Staff Timeline',           'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Disabled Staff',           'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Staff All Report',               'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Attendance Section',
				'links' => [
					['name' => 'Student Attendance',   'add' => true, 'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Attendance By Date',   'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Approve Leave',         'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Leave',             'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Attendance All Reports',           'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Online Exam Section',
				'links' => [
					['name' => 'Online Exam',            'add' => true, 'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Question Paper',     'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Questions',       'add' => true,  'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Online Exam All Reports',             'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Exam Section',
				'links' => [
					['name' => 'Create Terms',            'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Exam',                'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Link Exam',               'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish',                 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish Result',           'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students',  'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Subjects',          'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Enter Marks',              'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Marks',             'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Co-Scholastic Areas',      'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Skills',            'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish',                 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish Result',           'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students',  'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Grade',                'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Grade',             'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Exam Result',               'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Admit Card',        'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Admit Card',         'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Marksheet',         'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Marksheet',          'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Report Card',       'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Report Card',        'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Marks Grade',               'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Exam All Reports',               'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Lesson Plan',
				'links' => [
					['name' => 'Manage Lesson Plan',    'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Manage Syllabus Status','add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Lesson',                'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Topic',                 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Lesson All Report',             'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Homework Section',
				'links' => [
					['name' => 'Add Homework',          'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Homework Evaluation',  'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Homework All Report',            'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Download Section',
				'links' => [
					['name' => 'Upload Section',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Assignment',      'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Study Material',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Syllabus',        'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Other Download',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Download All Report',      'add' => true, 'view' => false, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Message Section',
				'links' => [
					['name' => 'Notice Board',    'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Update Events',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Update News',     'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send Email',      'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send SMS',        'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send Whatsapp',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Email / SMS Log', 'add' => true, 'view' => false, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Certificate Section',
				'links' => [
					['name' => 'Student Certificate',        'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate Certificate',       'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Student ID Card',             'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate ID Card',            'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Staff ID Card',               'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate Staff ID Card',      'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Certificate All Reports',                 'add' => true, 'view' => false,'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Library Management',
				'links' => [
					['name' => 'Book List',          'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Issue Return',       'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Student',        'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Staff Member',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Import Book',        'add' => true, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Library All Report',          'add' => true, 'view' => false,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Income Section',
				'links' => [
					['name' => 'Income Heads',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Income',     'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Search Income',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Income All Report',     'add' => true, 'view' => false,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Expense Section',
				'links' => [
					['name' => 'Add Expense',     'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Search Expense',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Expense Head',    'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Expense All Report',      'add' => true, 'view' => false,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Stock Management',
				'links' => [
					['name' => 'Item Category', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Item',      'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Item Stock','add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Issue Item',    'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Item Store',    'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Stock All Report',    'add' => true, 'view' => false,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Front Web',
				'links' => [
					['name' => 'Add Webs Links',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Sub-Links',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Banner Image',    'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Gallery Image',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Events',          'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'New Updates',     'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
				]
			],
			[
				'module' => 'Ticket Section',
				'links' => [
					['name' => 'Create Ticket', 'add' => true, 'view' => true, 'edit' => true,  'delete' => false],
					['name' => 'Track Ticket',  'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Closed Ticket', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Ticket All Report',    'add' => true,  'view' => false,'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'System Setting',
				'links' => [
					['name' => 'General Setting',       'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Session Setting',       'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Notification Setting',  'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'SMS Setting',           'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Email Setting',         'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Payment Method',        'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Print Header Setting',  'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Roles Permission',      'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'User',                  'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Modules',               'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Custom Fields',          'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'System Fields',          'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'File Types',             'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Set Captcha',            'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Date Backup',            'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
				]
			],
			[
				'module' => 'Multi Branch',
				'links' => [
					['name' => 'Add Branch',   'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Overview',     'add' => true, 'view' => true,  'edit' => true, 'delete' => true],
					['name' => 'Switch Branch','add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Multi Branch All Report',   'add' => true,  'view' => false, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Overall Reports',
				'links' => [
					['name' => 'Students Section',     'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Finance',              'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Attendance Section',   'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Exam Section',          'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Online Exam Section',   'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Lesson Plan',           'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Staff Management',      'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Library Management',    'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Stock Management',      'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Transport Section',     'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'User Log',               'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Audit Trail Report',    'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Dashboard Management',
				'links' => [
					['name' => 'Monthly Fees Collection Widget',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Monthly Expense Widget',           'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student Count Widget',              'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Staff Role Count Widget',           'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fees Awaiting Payment Widgets',     'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Converted Leads Widgets',           'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fees Overview Widgets',              'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Enquiry Overview Widgets',           'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Library Overview Widgets',           'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student Today Attendance Widgets',  'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Income Donut Graph',                 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Expense Donut Graph',                'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Staff Present Today Widgets',        'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student Present Today Widgets',      'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
				]
			],
			[
				'module' => 'Chat',
				'links' => [
					['name' => 'Monthly Fees Collection Widget',   'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
				]
			],
		];
		foreach($modules as $module_val){
			$permission_group_data = [
				'name' => $module_val['module'],
				'short_code' => $this->slugify($module_val['module']),
				'is_active' => 1,
				'system' => 0,
			];
			$this->db->insert('permission_group', $permission_group_data);
			$perm_group_id = $this->db->insert_id(); // Get inserted ID
			
			foreach($module_val['links'] as $link_val){
				$permission_category_data = [
					'perm_group_id' => $perm_group_id,
					'name' => $link_val['name'],
					'short_code' => $this->slugify($link_val['name']),
					'enable_view' => $link_val['view'],
					'enable_add' => $link_val['add'],
					'enable_edit' => $link_val['edit'],
					'enable_delete' => $link_val['delete'],
				];
				$this->db->insert('permission_category', $permission_category_data);
			}
		}

		echo 'Success';
    }
	function slugify($string) {
		return strtolower(trim(preg_replace('/\s+/', '_', $string)));
	}
}
