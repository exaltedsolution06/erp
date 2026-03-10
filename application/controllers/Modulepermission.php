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
					['name' => 'Package List', 			'short_code' => 'package_list', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Quick Session Change', 			'short_code' => 'quick_session_change', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'School Registration', 	'short_code' => 'school_registration', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Subscription Details', 	'short_code' => 'subscription_details', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Invoice Details', 		'short_code' => 'invoice_details', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Set Master',
				'links' => [
					['name' => 'Add Section', 				'short_code' => 'add_section', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Class', 				'short_code' => 'add_class', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Category', 				'short_code' => 'fee_category', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Create Account', 			'short_code' => 'create_account', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Head', 					'short_code' => 'fee_head', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Fee Plan', 					'short_code' => 'fee_plan', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Create Route',				'short_code' => 'create_route', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Route Plan', 				'short_code' => 'route_plan', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Set Discount', 				'short_code' => 'set_discount', 'add' => false, 'view' => true, 'edit' => true, 'delete' => true],
					// ['name' => 'Fee Discount Assign', 		'short_code' => '', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Caste Category', 			'short_code' => 'caste_category', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Payment Mode', 				'short_code' => 'payment_mode', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student House', 			'short_code' => 'student_house', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Vehicles', 				'short_code' => 'add_vehicles', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Assign Vehicle', 			'short_code' => 'assign_vehicle', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Subjects', 				'short_code' => 'add_subjects', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Subject Group', 			'short_code' => 'subject_group', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Class Timetable', 			'short_code' => 'class_timetable', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Teachers Timetable', 		'short_code' => 'teachers_timetable', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Assign Class Teacher', 		'short_code' => 'assign_class_teacher', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Promote Students', 			'short_code' => 'promote_students', 'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Set Disable Reason', 		'short_code' => 'set_disable_reason', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Previous Session Balance', 	'short_code' => 'previous_session_balance', 'add' => false, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Change Session', 			'short_code' => 'change_session', 'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Front Desk',
				'links' => [
					['name' => 'Setup Front Office', 		'short_code' => 'setup_front_office', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Admission Enquiry', 		'short_code' => 'admission_enquiry', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Follow Up Admission Enq', 	'short_code' => 'follow_up_admission_enq', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Visitor Book', 				'short_code' => 'visitor_book', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Phone Call Log', 			'short_code' => 'phone_call_log', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Postal Dispatch', 			'short_code' => 'postal_dispatch', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Postal Receive', 			'short_code' => 'postal_receive', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Complain', 					'short_code' => 'complain', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'All Reports', 				'short_code' => 'front_desk_all_reports', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Admission Section',
				'links' => [
					['name' => 'New Admission', 		'short_code' => 'new_admission', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Import Admission', 		'short_code' => 'import_admission', 'add' => true, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Online Admission', 		'short_code' => 'online_admission', 'add' => false, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Student Full Details', 	'short_code' => 'student_full_details', 'add' => false, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Discountinue Students', 'short_code' => 'discountinue_students', 'add' => true, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Bulk Delete', 			'short_code' => 'bulk_delete', 'add' => false, 'view' => true, 'edit' => false, 'delete' => true],
					['name' => 'Student Timeline', 		'short_code' => 'student_timeline', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'All Reports', 'short_code' => 'admission_all_reports', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Fee Collection',
				'links' => [
					['name' => 'Collect Fee',       'short_code' => 'collect_fee', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Collect Fee List',   'short_code' => 'collect_fee_list', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Discount', 	 'short_code' => 'assign_discount', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Receipt Book',       'short_code' => 'receipt_book', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Fee Register',       'short_code' => 'fee_register', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Fee Card',           'short_code' => 'fee_card', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Defaulter List',     'short_code' => 'defaulter_list', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Reminder Letter',    'short_code' => 'reminder_letter', 'add' => true,  'view' => true,  'edit' => true, 'delete' => true],
					['name' => 'Delete Fee List',    'short_code' => 'delete_fee_list', 'add' => false, 'view' => true,  'edit' => true, 'delete' => true],
					['name' => 'Search Fee Slip',    'short_code' => 'search_fee_slip', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Student Ledger',     'short_code' => 'student_ledger', 'add' => false,  'view' => true,  'edit' => false,  'delete' => false],
					['name' => 'All Reports',    'short_code' => 'fee_all_reports', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Staff Management',
				'links' => [
					['name' => 'Department',             'short_code' => 'department', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Designation',            'short_code' => 'designation', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Staff',               'short_code' => 'staff', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Staff Attendance',        'short_code' => 'staff_attendance', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Payroll',                 'short_code' => 'staff_payroll', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Approve Leave Request',   'short_code' => 'approve_leave_request', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Apply Leave',              'short_code' => 'apply_leave', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Leave Type',               'short_code' => 'leave_types', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Teachers Rateing',         'short_code' => 'teachers_rating', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Staff Timeline',           'short_code' => 'staff_timeline', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Disabled Staff',           'short_code' => 'disabled_staff', 'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'All Report',               'short_code' => 'staff_management_report', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Attendance Section',
				'links' => [
					['name' => 'Student Attendance',   'short_code' => 'student_attendance', 'add' => true, 'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Attendance By Date',   'short_code' => 'attendance_by_date', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Approve Leave',         'short_code' => 'approve_leave', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Leave',             'short_code' => 'add_leave', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'All Reports',           'short_code' => 'attendance_section_reports', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Online Exam Section',
				'links' => [
					['name' => 'Online Exam',            'short_code' => 'online_exam', 'add' => true, 'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Question Paper',     'short_code' => 'question_paper', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students', 'short_code' => 'online_assign_view_student', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Questions',       'short_code' => 'import_question', 'add' => true,  'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'All Reports',             'short_code' => 'online_exam_report', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Exam Section',
				'links' => [
					['name' => 'Create Terms',            'short_code' => 'create_terms', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Exam',                'short_code' => 'add_exam', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Link Exam',               'short_code' => 'link_exam', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish',                 'short_code' => 'publish', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish Result',           'short_code' => 'publish_result', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students',  'short_code' => 'exam_assign_view_student', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Subjects',          'short_code' => 'exam_subject', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Enter Marks',              'short_code' => 'exam_marks', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Marks',             'short_code' => 'marks_import', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Co-Scholastic Areas',      'short_code' => 'co_scholastic_areas', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign Skills',            'short_code' => 'assign_skills', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish',                 'short_code' => 'co_publish', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Publish Result',           'short_code' => 'co_publish_result', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Assign / View Students',  'short_code' => 'co_assign_view_students', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Add Grade',                'short_code' => 'add_grade', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Import Grade',             'short_code' => 'import_grade', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Exam Result',               'short_code' => 'exam_result', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Admit Card',        'short_code' => 'design_admit_card', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Admit Card',         'short_code' => 'print_admit_card', 'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Marksheet',         'short_code' => 'design_marksheet', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Marksheet',          'short_code' => 'print_marksheet', 'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Design Report Card',       'short_code' => 'design_report_card', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Print Report Card',        'short_code' => 'print_report_card', 'add' => true, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'Marks Grade',               'short_code' => 'marks_grade', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'All Reports',               'short_code' => 'exam_section_reports', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Lesson Plan',
				'links' => [
					['name' => 'Manage Lesson Plan',    'short_code' => 'manage_lesson_plan', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Manage Syllabus Status','short_code' => 'manage_syllabus_status', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Lesson',                'short_code' => 'lesson', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Topic',                 'short_code' => 'topic', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'All Report',             'short_code' => 'lesson_plan_report', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Homework Section',
				'links' => [
					['name' => 'Add Homework',          'short_code' => 'add_homework', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Homework Evaluation',  'short_code' => 'homework_evaluation', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'All Report',            'short_code' => 'homework_section_report', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Download Section',
				'links' => [
					['name' => 'Upload Section',  'short_code' => 'upload_section', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Assignment',      'short_code' => 'assignment', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Study Material',  'short_code' => 'study_material', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Syllabus',        'short_code' => 'syllabus', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Other Download',  'short_code' => 'other_download', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'All Report',      'short_code' => 'download_section_report', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Message Section',
				'links' => [
					['name' => 'Notice Board',    'short_code' => 'notice_board', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Update Events',   'short_code' => 'update_events', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Update News',     'short_code' => 'update_news', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send Email',      'short_code' => 'send_email', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send SMS',        'short_code' => 'send_sms', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Send Whatsapp',   'short_code' => 'send_whatsapp', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Email / SMS Log', 'short_code' => 'email_sms_log', 'add' => true, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'All Report',      'short_code' => 'message_section_report', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Certificate Section',
				'links' => [
					['name' => 'Student Certificate',        'short_code' => 'student_certificate', 'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate Certificate',       'short_code' => 'generate_certificate', 'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Student ID Card',             'short_code' => 'student_id_card', 'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate ID Card',            'short_code' => 'generate_id_card', 'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Staff ID Card',               'short_code' => 'staff_id_card', 'add' => true, 'view' => true, 'edit' => true,  'delete' => true],
					['name' => 'Generate Staff ID Card',      'short_code' => 'generate_staff_id_card', 'add' => true, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'All Reports',                 'short_code' => 'certificate_section_report', 'add' => false, 'view' => true,'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Library Management',
				'links' => [
					['name' => 'Book List',          'short_code' => 'book_list', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Issue Return',       'short_code' => 'issue_return', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Student',        'short_code' => 'add_student', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Staff Member',   'short_code' => 'add_staff_member', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Import Book',        'short_code' => 'import_book', 'add' => true, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'All Report',          'short_code' => 'library_management_report', 'add' => false, 'view' => true,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Income Section',
				'links' => [
					['name' => 'Income Heads',   'short_code' => 'income_heads', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Income',     'short_code' => 'add_income', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Income Report',  'short_code' => 'search_income', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					// ['name' => 'All Report',     'short_code' => 'income_section_report', 'add' => false, 'view' => true,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Expense Section',
				'links' => [
					['name' => 'Expense Head',    'short_code' => 'expense_head', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Expense',     'short_code' => 'add_expense', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Expense Report',  'short_code' => 'search_expense', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					// ['name' => 'All Report',      'short_code' => 'expense_section_report', 'add' => false, 'view' => true,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Stock Management',
				'links' => [
					['name' => 'Item Category', 'short_code' => 'item_category', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Item',      'short_code' => 'item', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Add Item Stock','short_code' => 'item_stock', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Issue Item',    'short_code' => 'issue_item', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Item Store',    'short_code' => 'store', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'Item Supplier', 'short_code' => 'supplier', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					['name' => 'All Report',    'short_code' => 'stock_management_report', 'add' => false, 'view' => true,'edit' => false,'delete' => false],
				]
			],
			[
				'module' => 'Front Web',
				'links' => [
					['name' => 'Front Web Settings',  'short_code' => 'front_cms_setting', 'add' => false, 'view' => true, 'edit' => true, 'delete' => false],
					['name' => 'Add Webs Links',  'short_code' => 'add_webs_links', 'add' => true, 'view' => true, 'edit' => true, 'delete' => true],
					// ['name' => 'Add Sub-Links',   'short_code' => 'add_sub_links', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Media Manager',   'short_code' => 'media_manager', 'add' => true, 'view' => true, 'edit' => false, 'delete' => true],
					['name' => 'Banner Image',    'short_code' => 'banner_image', 'add' => true, 'view' => true, 'edit' => false, 'delete' => true],
					// ['name' => 'Gallery Image',   'short_code' => 'gallery_image', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					// ['name' => 'Events',          'short_code' => 'events', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					// ['name' => 'New Updates',     'short_code' => 'new_updates', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Ticket Section',
				'links' => [
					['name' => 'Create Ticket', 'short_code' => 'create_ticket', 'add' => false, 'view' => true, 'edit' => false,  'delete' => false],
					['name' => 'Track Ticket',  'short_code' => 'track_ticket', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Closed Ticket', 'short_code' => 'closed_ticket', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'All Report',    'short_code' => 'ticket_section_report', 'add' => false,  'view' => true,'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'System Setting',
				'links' => [
					['name' => 'General Setting',       'short_code' => 'general_setting', 'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Session Setting',       'short_code' => 'session_setting', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Notification Setting',  'short_code' => 'notification_setting', 'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'SMS Setting',           'short_code' => 'sms_setting', 'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Email Setting',         'short_code' => 'email_setting', 'add' => false, 'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Payment Method',        'short_code' => 'payment_methods', 'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Print Header Footer',  'short_code' => 'print_header_footer', 'add' => true,  'view' => true,  'edit' => true,  'delete' => false],
					['name' => 'Roles Permission',      'short_code' => 'roles_permissions', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'User',                  'short_code' => 'user_status', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Modules',               'short_code' => 'modules', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Custom Fields',          'short_code' => 'custom_fields', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'System Fields',          'short_code' => 'system_fields', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'File Types',             'short_code' => 'file_types', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Set Captcha',            'short_code' => 'set_captcha', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Data Backup',            'short_code' => 'data_backup', 'add' => true,  'view' => true,  'edit' => false,  'delete' => true],
				]
			],
			[
				'module' => 'Multi Branch',
				'links' => [
					['name' => 'Add Branch',   'short_code' => 'add_branch', 'add' => true,  'view' => true,  'edit' => true,  'delete' => true],
					['name' => 'Overview',     'short_code' => 'overview', 'add' => true, 'view' => true,  'edit' => true, 'delete' => true],
					['name' => 'Switch Branch','short_code' => 'switch_branch', 'add' => false, 'view' => true,  'edit' => false, 'delete' => false],
					['name' => 'All Report',   'short_code' => 'multi_branch_report', 'add' => false,  'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Overall Reports',
				'links' => [
					/*['name' => 'Students Section',     'short_code' => 'students_section', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Finance',              'short_code' => 'finance', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Attendance Section',   'short_code' => 'attendance_section', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Exam Section',          'short_code' => 'exam_section', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Online Exam Section',   'short_code' => 'online_exam_section', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Lesson Plan',           'short_code' => 'lesson_plan', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Staff Management',      'short_code' => 'staff_management', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Library Management',    'short_code' => 'library_management', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Stock Management',      'short_code' => 'stock_management', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Transport Section',     'short_code' => 'transport_section', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],*/
					['name' => 'User Log',               'short_code' => 'user_log', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Audit Trail Report',    'short_code' => 'audit_trail_report', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
					['name' => 'Income Expense Report',    'short_code' => 'income_expense_report', 'add' => false, 'view' => true, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Dashboard Management',
				'links' => [
					['name' => 'Monthly Fees Collection Widget',   'short_code' => 'monthly_fees_collection_widget', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Monthly Expense Widget',           'short_code' => 'monthly_expense_widget', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Student Count Widget',              'short_code' => 'student_count_widget', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Staff Role Count Widget',           'short_code' => 'staff_role_count_widget', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Fees Awaiting Payment Widgets',     'short_code' => 'fees_awaiting_payment_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Converted Leads Widgets',           'short_code' => 'converted_leads_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Fees Overview Widgets',              'short_code' => 'fees_overview_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Enquiry Overview Widgets',           'short_code' => 'enquiry_overview_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Library Overview Widgets',           'short_code' => 'library_overview_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Student Today Attendance Widgets',  'short_code' => 'student_today_attendance_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Income Donut Graph',                 'short_code' => 'income_donut_graph', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Expense Donut Graph',                'short_code' => 'expense_donut_graph', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Staff Present Today Widgets',        'short_code' => 'staff_present_today_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
					['name' => 'Student Present Today Widgets',      'short_code' => 'student_present_today_widgets', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
				]
			],
			[
				'module' => 'Chat',
				'links' => [
					['name' => '',   'short_code' => '', 'add' => false, 'view' => false, 'edit' => false, 'delete' => false],
				]
			],
		];
		/*foreach ($modules as &$module) {
			foreach ($module['links'] as &$link) {
				$link['short_code'] = strtolower(str_replace(' ', '_', trim($link['name'])));
			}
		}
		unset($module, $link);
		echo '<pre>'; print_r($modules); echo '</pre>';exit;*/
		foreach ($modules as $module_val) {
			$system = 0;
			if ($module_val['module'] == 'Dashboard Management' || $module_val['module'] == 'Chat') {
				$system = 1;
			}

			$short_code = $this->slugify($module_val['module']);

			// CHECK / INSERT / UPDATE GROUP
			$existing_group = $this->db
				->where('short_code', $short_code)
				->get('permission_group')
				->row();

			$permission_group_data = [
				'name'       => $module_val['module'],
				'short_code' => $short_code,
				'is_active'  => 1,
				'system'     => $system,
			];

			if ($existing_group) { // UPDATE
				$this->db->where('id', $existing_group->id)
						 ->update('permission_group', $permission_group_data);

				$perm_group_id = $existing_group->id;
			} else { // INSERT
				$this->db->insert('permission_group', $permission_group_data);
				$perm_group_id = $this->db->insert_id();
			}

			// LOOP PERMISSION CATEGORY (LINKS)
			foreach ($module_val['links'] as $link_val) {

				$existing_category = $this->db
					->where('short_code', $link_val['short_code'])
					->get('permission_category')
					->row();

				$permission_category_data = [
					'perm_group_id' => $perm_group_id,
					'name'          => $link_val['name'],
					'short_code'    => $link_val['short_code'],
					'enable_view'   => $link_val['view'],
					'enable_add'    => $link_val['add'],
					'enable_edit'   => $link_val['edit'],
					'enable_delete' => $link_val['delete'],
				];

				if ($existing_category) { // UPDATE
					$this->db->where('id', $existing_category->id)
							 ->update('permission_category', $permission_category_data);
				} else { // INSERT
					$this->db->insert('permission_category', $permission_category_data);
				}
			}
		}
		/*foreach($modules as $module_val){
			$system = 0;
			if($module_val['module'] == 'Dashboard Management' || $module_val['module'] == 'Chat'){
				$system = 1;
			}
			$permission_group_data = [
				'name' => $module_val['module'],
				'short_code' => $this->slugify($module_val['module']),
				'is_active' => 1,
				'system' => $system,
			];
			$this->db->insert('permission_group', $permission_group_data);
			$perm_group_id = $this->db->insert_id(); // Get inserted ID
			
			foreach($module_val['links'] as $link_val){
				$permission_category_data = [
					'perm_group_id' => $perm_group_id,
					'name' => $link_val['name'],
					'short_code' => $link_val['short_code'],
					'enable_view' => $link_val['view'],
					'enable_add' => $link_val['add'],
					'enable_edit' => $link_val['edit'],
					'enable_delete' => $link_val['delete'],
				];
				$this->db->insert('permission_category', $permission_category_data);
			}
		}*/

		echo 'Success';
    }
	function slugify($string) {
		return strtolower(trim(preg_replace('/\s+/', '_', $string)));
	}
}
