<aside class="main-sidebar" id="alert2">
    <?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
        <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="input-group ">

                <input type="text"  name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    <?php } ?>
    <section class="sidebar" id="sibe-box">
        <?php $this->load->view('layout/top_sidemenu'); 
			$CI = get_instance();
			$session_sub_menu = $CI->session->userdata('sub_menu');
			//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
			$session_top_menu = $CI->session->userdata('top_menu');
			//echo '<pre>'; print_r($session_top_menu);echo '</pre>';die;
		?>
        <ul class="sidebar-menu verttop">
           <br>
		   <!-- 1st Menu start -->
            <?php
                $active="";
                if(set_Submenu('sections/index') 
					|| set_Submenu('classes/index') 
                    || set_Submenu('admin/feegroup')
                    || set_Submenu('account/index')
                    || set_Submenu('feetype/setroute')
                    || set_Submenu('feetype/index')
                    || set_Submenu('admin/feemaster')
                    || set_Submenu('vehicle/index')
                    || set_Submenu('feesroutes/index')
                    || set_Submenu('vehroute/index')
                    || set_Submenu('admin/setplan')
                    || set_Submenu('category/index')
                    || set_Submenu('admin/schoolhouse')
                    || set_Submenu('Academics/subject')
                    || set_Submenu('subjectgroup/index')
                    || set_Submenu('Academics/timetable')
                    || set_Submenu('Academics/timetable/mytimetable')
                    || set_Submenu('admin/teacher/assign_class_teacher')
                    || set_Submenu('stdtransfer/index')
                    
                ){
                    $active="active";
                }
            ?>
           <li class="treeview  <?=$active?>">
                <a href="#">
                    <i class="fa fa-cogs ftlayer"></i> <span>Set Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li class="<?php echo set_Submenu('sections/index'); ?>"><a href="<?php echo base_url(); ?>sections"><i class="fa fa-angle-double-right"></i> Add Section</a></li>
                    <li class="<?php echo set_Submenu('classes/index'); ?>"><a href="<?php echo base_url(); ?>classes/index"><i class="fa fa-angle-double-right"></i> Add Class</a></li>
                    <li class="<?php echo set_Submenu('admin/feegroup'); ?>"><a href="<?php echo base_url(); ?>admin/feegroup"><i class="fa fa-angle-double-right"></i> Fees Category</a></li>
                    <li class="<?php echo set_Submenu('account/index'); ?>"><a href="<?php echo base_url(); ?>account"><i class="fa fa-angle-double-right"></i> Create Account</a></li>
                    <li class="<?php echo set_Submenu('feetype/index'); ?>"><a href="<?php echo base_url(); ?>admin/feetype"><i class="fa fa-angle-double-right"></i> Fees Head</a></li>
					
                    <li class="<?php echo set_Submenu('admin/feemaster'); ?>"><a href="<?php echo base_url(); ?>admin/feemaster"><i class="fa fa-angle-double-right"></i> Fees Plan</a></li>
					<?php if ($this->rbac->hasPrivilege('route', 'can_view')) { ?>
                        <li class="<?php echo set_Submenu('feetype/setroute'); ?>"><a href="<?php echo base_url(); ?>admin/feesroutes/index"><i class="fa fa-angle-double-right"></i> Create Route</a></li>
					<?php } if ($this->rbac->hasPrivilege('route_plan', 'can_view')) { ?>
						<li class="<?php echo set_Submenu('admin/setplan'); ?>"><a href="<?php echo base_url(); ?>admin/feesroutes/plan"><i class="fa fa-angle-double-right"></i> Route Plan</a></li>
					<?php //} if ($this->rbac->hasPrivilege('student_categories', 'can_view')) { ?>
						<!--<li class="<?php echo set_Submenu('category/index'); ?>"><a href="<?php echo base_url(); ?>category"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_categories'); ?></a></li>-->
					<?php } if ($this->rbac->hasPrivilege('student_house', 'can_view')) { ?>
						<li class="<?php echo set_Submenu('admin/schoolhouse'); ?>"><a href="<?php echo base_url(); ?>admin/schoolhouse"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('house'); ?></a></li>
					<?php } if ($this->rbac->hasPrivilege('vehicle', 'can_view')) { ?>
                    <li class="<?php echo set_Submenu('vehicle/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('vehicles'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('assign_vehicle', 'can_view')) { ?>
						<li class="<?php echo set_Submenu('vehroute/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehroute"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assign_vehicle'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('subject', 'can_view')) { ?>
						<li class="<?php echo set_Submenu('Academics/subject'); ?>"><a href="<?php echo base_url(); ?>admin/subject"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('subjects'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('subject_group', 'can_view')) { ?>
						<li class="<?php echo set_Submenu('subjectgroup/index'); ?>"><a href="<?php echo base_url('admin/subjectgroup'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('class_timetable', 'can_view')) { ?>
                         <li class="<?php echo set_Submenu('Academics/timetable'); ?>"><a href="<?php echo base_url(); ?>admin/timetable/classreport"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('class_timetable'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('teachers_time_table', 'can_view')) { ?>
                        <li class="<?php echo set_Submenu('Academics/timetable/mytimetable'); ?>"><a href="<?php echo base_url(); ?>admin/timetable/mytimetable"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('teachers') . " " . $this->lang->line('timetable') ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_view')) { ?>
                        <li class="<?php echo set_Submenu('admin/teacher/assign_class_teacher'); ?>"><a href="<?php echo base_url(); ?>admin/teacher/assign_class_teacher"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assign_class_teacher'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('promote_student', 'can_view')) { ?>
                        <li class="<?php echo set_Submenu('stdtransfer/index'); ?>"><a href="<?php echo base_url(); ?>admin/stdtransfer"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('promote_students'); ?></a></li>
                    <?php } ?>
                </ul>
            </li>
			<!-- 1st Menu end -->
			<!-- 2nd Menu start -->
            <?php
                if ($this->module_lib->hasActive('front_office') or 1==1) { // Agar front office module active hai
                    if (
                        $this->rbac->hasPrivilege('admission_enquiry', 'can_view') ||
                        $this->rbac->hasPrivilege('visitor_book', 'can_view') ||
                        $this->rbac->hasPrivilege('phone_call_log', 'can_view') ||
                        $this->rbac->hasPrivilege('postal_dispatch', 'can_view') ||
                        $this->rbac->hasPrivilege('postal_receive', 'can_view') ||
                        $this->rbac->hasPrivilege('complain', 'can_view') ||
                        $this->rbac->hasPrivilege('setup_front_office', 'can_view') ||
                        $this->rbac->hasPrivilege('front_desk_reports', 'can_view')
                    ) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeFdMenu="";
					if(set_Submenu('admin/enquiry')
						|| set_Submenu('admin/visitors')
						|| set_Submenu('admin/generalcall')
						|| set_Submenu('admin/dispatch')
						|| set_Submenu('admin/receive')
						|| set_Submenu('admin/complaint')
						|| set_Submenu('admin/visitorspurpose')
						|| set_Submenu('report/front-desk')
					){
						$activeFdMenu="active";
					}
            ?>
				<li class="treeview <?php echo $activeFdMenu; ?>">
					<a href="#">
						<i class="fa fa-address-book ftlayer"></i> <span>Front Desk </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/enquiry'); ?>"><a href="<?php echo base_url(); ?>admin/enquiry"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('admission_enquiry'); ?> </a></li>
						<?php } if ($this->rbac->hasPrivilege('visitor_book', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/visitors'); ?>"><a href="<?php echo base_url(); ?>admin/visitors"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('visitor_book'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('phone_call_log', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/generalcall'); ?>"><a href="<?php echo base_url(); ?>admin/generalcall"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('phone_call_log'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('postal_dispatch', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/dispatch'); ?>"><a href="<?php echo base_url(); ?>admin/dispatch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('postal_dispatch'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('postal_receive', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/receive'); ?>"><a href="<?php echo base_url(); ?>admin/receive"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('postal_receive'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('complain', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/complaint'); ?>"><a href="<?php echo base_url(); ?>admin/complaint"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('complain'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('setup_front_office', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/visitorspurpose'); ?>"><a href="<?php echo base_url(); ?>admin/visitorspurpose"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('setup_front_office'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('front_desk_reports', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('report/front-desk'); ?>"><a href="<?php echo base_url(); ?>admin/report/front_desk_reports"><i class="fa fa-angle-double-right"></i> Front Desk Reports</a></li>
						<?php } ?>
					</ul>
				</li>
		<?php
				}
			}
		?>
		<!-- 2nd Menu end -->
		<!-- 3rd Menu start -->
        <?php
            if ($this->module_lib->hasActive('student_section') or 1==1) { // Agar student section module active hai
				if (
					$this->rbac->hasPrivilege('new_admission', 'can_view') ||
					$this->rbac->hasPrivilege('student_full_details', 'can_view') ||
					$this->rbac->hasPrivilege('discontinue_students', 'can_view') ||
					$this->rbac->hasPrivilege('bulk_delete', 'can_view') ||
					$this->rbac->hasPrivilege('student_section_reports', 'can_view')
				) {
				$activeSsMenu="";
				if(set_Submenu('student/create')
					|| set_Submenu('student/search')
					|| set_Submenu('student/disablestudentslist')
					|| set_Submenu('bulkdelete')
					|| set_Submenu('Reports/student_information')
				){
					$activeSsMenu="active";
				}
		?>
				<li class="treeview <?php echo $activeSsMenu; ?>">
					<a href="#">
						<i class="fa fa-user ftlayer"></i> <span>Student Section</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('student/create'); ?>"><a href="<?php echo base_url(); ?>student/create"><i class="fa fa-angle-double-right"></i> New Admission</a></li>
						<?php } if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('student/search'); ?>"><a href="<?php echo base_url(); ?>student/search"><i class="fa fa-angle-double-right"></i> Student Full Details</a></li>
						<?php } if ($this->rbac->hasPrivilege('disable_student', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('student/disablestudentslist'); ?>"><a href="<?php echo base_url(); ?>student/disablestudentslist"><i class="fa fa-angle-double-right"></i> Discontinue Students</a></li>
						<?php } if ($this->rbac->hasPrivilege('student', 'can_delete')) { ?>
							<li class="<?php echo set_Submenu('bulkdelete'); ?>"><a href="<?php echo site_url('student/bulkdelete'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('bulk') . " " . $this->lang->line('delete'); ?></a>
									</li>
						<?php } if ($this->rbac->hasPrivilege('student_section_reports', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Reports/student_information'); ?>"><a href="<?php echo base_url(); ?>report/studentinformation"><i class="fa fa-angle-double-right"></i> Students Section Reports</a></li>
						<?php } ?>
					</ul>
				</li>
		<?php
				}
			}
		?>
		<!-- 3rd Menu end -->
		<!-- 4th Menu start -->
		<?php
			if ($this->module_lib->hasActive('fee_collection') or 1==1) { // Agar Fee Collection module active hai
				if (
					$this->rbac->hasPrivilege('collect_fee', 'can_view') ||
					$this->rbac->hasPrivilege('collect_fee_list', 'can_view') ||
					$this->rbac->hasPrivilege('delete_fee_list', 'can_view') ||
					$this->rbac->hasPrivilege('fee_register', 'can_view') ||
					$this->rbac->hasPrivilege('defaulter_list', 'can_view') ||
					$this->rbac->hasPrivilege('fee_card', 'can_view') ||
					$this->rbac->hasPrivilege('fee_reminder', 'can_view') ||
					$this->rbac->hasPrivilege('student_ledger', 'can_view') ||
					$this->rbac->hasPrivilege('fee_collection_reports', 'can_view')
				) {
				$activeFcMenu="";
				if(set_Submenu('studentfee/index')
					|| set_Submenu('studentfee/studentfeelist')
					|| set_Submenu('studentfee/studentfee_deletedlist')
					|| set_Submenu('studentfee/searchpayment')
					|| set_Submenu('studentfee/feesearch')
					|| set_Submenu('admin/feediscount')
					|| set_Submenu('feesforward/index')
					|| set_Submenu('feesforward/index')
					|| set_Submenu('Reports/finance')
					|| set_Submenu('reports/studenttransportdetails')
					
				){
					$activeFcMenu="active";
				}
        ?>
				<li class="treeview <?php echo $activeFcMenu; ?>">
					<a href="#">
						<i class="fa fa-money ftlayer"></i> <span>Fee Collection </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if ($this->rbac->hasPrivilege('collect_fees', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>studentfee"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('collect_fees'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('collect_fee_list', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('studentfee/studentfeelist'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfeelist"><i class="fa fa-angle-double-right"></i> Collect Fees List </a></li>
						<?php } if ($this->rbac->hasPrivilege('delete_fee_list', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('studentfee/studentfee_deletedlist'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfee_deletedlist"><i class="fa fa-angle-double-right"></i> Deleted Fees List </a></li>
						<?php } if ($this->rbac->hasPrivilege('fee_register', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('studentfee/searchpayment'); ?>"><a href="<?php echo base_url(); ?>studentfee/searchpayment"><i class="fa fa-angle-double-right"></i> Fee Register</a></li>
						<?php } if ($this->rbac->hasPrivilege('defaulter_list', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('studentfee/feesearch'); ?>"><a href="<?php echo base_url(); ?>studentfee/feesearch"><i class="fa fa-angle-double-right"></i> Defaulter List</a></li>
						<?php } if ($this->rbac->hasPrivilege('fee_card', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('admin/feediscount'); ?>"><a href="<?php echo base_url(); ?>admin/feediscount"><i class="fa fa-angle-double-right"></i> Fee Card</a></li>
						<?php } if ($this->rbac->hasPrivilege('fee_reminder', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('feesforward/index'); ?>"><a href="<?php echo base_url('admin/feesforward'); ?>"><i class="fa fa-angle-double-right"></i> Fee Reminder</a></li>
						<?php } if ($this->rbac->hasPrivilege('student_ledger', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('feesforward/index'); ?>"><a href="<?php echo base_url('admin/feesforward'); ?>"><i class="fa fa-angle-double-right"></i> Student Ledger</a></li>
						<?php } if ($this->rbac->hasPrivilege('fee_collection_reports', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Reports/finance') || set_Submenu('reports/studenttransportdetails') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>report/finance"><i class="fa fa-angle-double-right"></i> Fee Collection Reports</a></li>
						<?php } ?>
					</ul>
				</li>
		<?php
				}
			}
		?>
		<!-- 4th Menu end -->
		<!-- 5th Menu start -->
		<?php
			if ($this->module_lib->hasActive('attendance') or 1==1) { // Agar Attendance module active hai
				if (
					$this->rbac->hasPrivilege('student_attendance', 'can_view') ||
					$this->rbac->hasPrivilege('attendance_by_date', 'can_view') ||
					$this->rbac->hasPrivilege('approve_leave', 'can_view') ||
					$this->rbac->hasPrivilege('attendance_section_reports', 'can_view')
				) {
				//$CI = get_instance();
				//$session_sub_menu = $CI->session->userdata('sub_menu');
				//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
				$activeAsMenu="";
				if(set_Submenu('stuattendence/index')
					|| set_Submenu('stuattendence/attendenceReport')
					|| set_Submenu('subjectattendence/index')
					|| set_Submenu('subjectattendence/reportbydate')
					|| set_Submenu('Attendance/approve_leave')
					|| set_Submenu('Reports/attendance')
				){
					$activeAsMenu="active";
				}
		?>
				<li class="treeview <?php echo $activeAsMenu; ?>">
					<a href="#">
						<i class="fa fa-calendar-check-o ftlayer"></i> <span>Attendance Section </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php 
							if (!is_subAttendence()) {
								if ($this->rbac->hasPrivilege('student_attendance', 'can_view')) { 
						?>
									<li class="<?php echo set_Submenu('stuattendence/index'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_attendance'); ?></a></li>
								<?php } if ($this->rbac->hasPrivilege('attendance_by_date', 'can_view')) { ?>
									<li class="<?php echo set_Submenu('stuattendence/attendenceReport'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/attendencereport"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('attendance_by_date'); ?></a></li>
						<?php 
								}
							} else {
								if ($this->rbac->hasPrivilege('student_attendance', 'can_view')) {
						?>
									<li class="<?php echo set_Submenu('subjectattendence/index'); ?>"><a href="<?php echo base_url(); ?>admin/subjectattendence"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('period') . " " . $this->lang->line('attendance'); ?></a></li>
								<?php } if ($this->rbac->hasPrivilege('attendance_by_date', 'can_view')) { ?>
									<li class="<?php echo set_Submenu('subjectattendence/reportbydate'); ?>"><a href="<?php echo site_url('admin/subjectattendence/reportbydate'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('period') . " " . $this->lang->line('attendance') . " " . $this->lang->line('by') . " " . $this->lang->line('date'); ?></a></li>
						<?php 
								}
							}
							if ($this->rbac->hasPrivilege('approve_leave', 'can_view')) {
						?>
							<li class="<?php echo set_Submenu('Attendance/approve_leave'); ?>"><a href="<?php echo base_url(); ?>admin/approve_leave"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('approve') . " " . $this->lang->line('leave'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('attendance_section_reports', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Reports/attendance'); ?>"><a href="<?php echo base_url(); ?>report/attendance"><i class="fa fa-angle-double-right"></i> Attendance Section Reports</a></li>
						<?php } ?>
					</ul>
				</li>
		<?php
				}
			}
		?>
		<!-- 5th Menu end -->
		<!-- 6th Menu start -->
		<?php
			if ($this->module_lib->hasActive('examination')) { // Agar Examination module active hai
				if (
					$this->rbac->hasPrivilege('create_terms', 'can_view') ||
					$this->rbac->hasPrivilege('co_scholastic_areas', 'can_view') ||
					$this->rbac->hasPrivilege('exam_schedule', 'can_view') ||
					$this->rbac->hasPrivilege('exam_result', 'can_view') ||
					$this->rbac->hasPrivilege('design_admit_card', 'can_view') ||
					$this->rbac->hasPrivilege('print_admit_card', 'can_view') ||
					$this->rbac->hasPrivilege('design_marksheet', 'can_view') ||
					$this->rbac->hasPrivilege('print_marksheet', 'can_view') ||
					$this->rbac->hasPrivilege('report_card', 'can_view') ||
					$this->rbac->hasPrivilege('marks_grade', 'can_view') ||
					$this->rbac->hasPrivilege('terms_grade', 'can_view') ||
					$this->rbac->hasPrivilege('exam_section_reports', 'can_view')
				) {
				//$CI = get_instance();
				//$session_sub_menu = $CI->session->userdata('sub_menu');
				//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
				$activeEsMenu="";
				if(set_Submenu('Examinations/examgroup')
					|| set_Submenu('Examinations/coscholasticareas')
					|| set_Submenu('Examinations/Examschedule')
					|| set_Submenu('Examinations/Examresult')
					|| set_Submenu('Examinations/admitcard')
					|| set_Submenu('Examinations/examresult/admitcard')
					|| set_Submenu('Examinations/marksheet')
					|| set_Submenu('Examinations/examresult/marksheet')
					|| set_Submenu('Examinations/examresult/reportcard')
					|| set_Submenu('Examinations/grade')
					|| set_Submenu('Examinations/termsgrade')
					|| set_Submenu('Reports/examinations')
				){
					$activeEsMenu="active";
				}
		?>
				<li class="treeview <?php echo $activeEsMenu; ?>">
					<a href="#">
						<i class="fa fa-pencil-square-o ftlayer"></i> <span>Exam Section </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if ($this->rbac->hasPrivilege('create_terms', 'can_view')) { ?>
							<li class="<?php if($this->uri->segment(2)=='examgroup'){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/examgroup'); ?>"><i class="fa fa-angle-double-right"></i>Create Terms</a></li>
						<?php } if ($this->rbac->hasPrivilege('co_scholastic_areas', 'can_view')) { ?>
							<li class="<?php if($this->uri->segment(2)=='coscholasticareas'){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/coscholasticareas'); ?>"><i class="fa fa-angle-double-right"></i> Co-Scholastic Areas</a></li>
						<?php } if ($this->rbac->hasPrivilege('exam_schedule', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/Examschedule'); ?>"><a href="<?php echo site_url('admin/exam_schedule'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_schedule'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('exam_result', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/Examresult'); ?>"><a href="<?php echo site_url('admin/examresult'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('design_admit_card', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/admitcard'); ?>"><a href="<?php echo base_url(); ?>admin/admitcard"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('design') . " " . $this->lang->line('admit') . " " . $this->lang->line('card'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('print_admit_card', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/examresult/admitcard'); ?>"><a href="<?php echo base_url(); ?>admin/examresult/admitcard"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('print') . " " . $this->lang->line('admit') . " " . $this->lang->line('card'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('design_marksheet', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/marksheet'); ?>"><a href="<?php echo site_url('admin/marksheet'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('design') . " " . $this->lang->line('marksheet') ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('print_marksheet', 'can_view')) { ?>
							<li class="<?php if($this->uri->segment(3)=='marksheet'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/examresult/marksheet"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('print') . " " . $this->lang->line('marksheet'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('report_card', 'can_view')) { ?>
							<li class="<?php if($this->uri->segment(3)=='reportcard'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/examresult/reportcard"><i class="fa fa-angle-double-right"></i>  Report Card</a></li>
						<?php } if ($this->rbac->hasPrivilege('marks_grade', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Examinations/grade'); ?>"><a href="<?php echo base_url(); ?>admin/grade"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('marks_grade'); ?></a></li>
						<?php } if ($this->rbac->hasPrivilege('terms_grade', 'can_view')) { ?>
							<li class="<?php if($this->uri->segment(2)=='termsgrade'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/termsgrade"><i class="fa fa-angle-double-right"></i> Terms Grade</a></li>
						<?php } if ($this->rbac->hasPrivilege('exam_section_reports', 'can_view')) { ?>
							<li class="<?php echo set_Submenu('Reports/examinations'); ?>"><a href="<?php echo base_url(); ?>report/examinations"><i class="fa fa-angle-double-right"></i> Exam Section Reports</a></li>
						<?php } ?>
					</ul>
				</li>
		<?php
				}
			}
		?>
		<!-- 6th Menu end -->
		<!-- 7th Menu start -->
		<?php
			if ($this->module_lib->hasActive('online_examination') or 1==1) { // Online Examination module active check
				if (
					$this->rbac->hasPrivilege('online_exam', 'can_view') ||
					$this->rbac->hasPrivilege('question_paper', 'can_view') ||
					$this->rbac->hasPrivilege('online_exam_report', 'can_view')
				) {
				//$CI = get_instance();
				//$session_sub_menu = $CI->session->userdata('sub_menu');
				//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeOeMenu="";
					if(set_Submenu('Online_Examinations/Onlineexam')
						|| set_Submenu('Online_Examinations/question')
						|| set_Submenu('Reports/online_examinations')
					){
						$activeOeMenu="active";
					}
        ?>
					<li class="treeview <?php echo $activeOeMenu; ?>">
						<a href="#">
							<i class="fa fa-laptop ftlayer"></i> <span>Online Exam Section </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('online_exam', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Online_Examinations/Onlineexam'); ?>"><a href="<?php echo base_url(); ?>admin/onlineexam"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('question_paper', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Online_Examinations/question'); ?>"><a href="<?php echo base_url(); ?>admin/question"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('question') . " " . $this->lang->line('bank'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('online_exam_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Reports/online_examinations'); ?>"><a href="<?php echo base_url(); ?>admin/onlineexam/report"><i class="fa fa-angle-double-right"></i> Online Exam Reports</a></li>
							<?php } ?>
						</ul>
					</li>
		<?php
				}
			}
		?>
		<!-- 7th Menu end -->
		<!-- 8th Menu start -->
        <?php
            if ($this->module_lib->hasActive('lesson_plan') or 1==1) { // Lesson Plan module active check
				if (
					$this->rbac->hasPrivilege('manage_lesson_plan', 'can_view') ||
					$this->rbac->hasPrivilege('manage_syllabus_status', 'can_view') ||
					$this->rbac->hasPrivilege('lesson', 'can_view') ||
					$this->rbac->hasPrivilege('topic', 'can_view') ||
					$this->rbac->hasPrivilege('lesson_plan_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeLpMenu="";
					if(set_Submenu('admin/syllabus')
						|| set_Submenu('admin/lessonplan')
						|| set_Submenu('admin/lessonplan/lesson')
						|| set_Submenu('admin/lessonplan/topic')
						|| set_Submenu('Reports/lesson_plan')
					){
						$activeLpMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeLpMenu; ?>">
						<a href="#">
							<i class="fa fa-book ftlayer"></i> <span>Lesson Plan </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('manage_lesson_plan', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/syllabus'); ?>"><a href="<?php echo base_url(); ?>admin/syllabus"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('manage_lesson_plan'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('manage_syllabus_status', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/lessonplan'); ?>"><a href="<?php echo base_url(); ?>admin/syllabus/status"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('manage_syllabus_status'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('lesson', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/lessonplan/lesson'); ?>"><a href="<?php echo base_url(); ?>admin/lessonplan/lesson"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('lesson'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('topic', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/lessonplan/topic'); ?>"><a href="<?php echo base_url(); ?>admin/lessonplan/topic"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('topic'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('lesson_plan_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Reports/lesson_plan'); ?>"><a href="<?php echo base_url(); ?>report/lesson_plan"><i class="fa fa-angle-double-right"></i> Lesson Plan Report</a></li>
							<?php } ?>
						</ul>
					</li>
		<?php
				}
			}
		?>
		<!-- 8th Menu end -->
		<!-- 9th Menu start -->
		<?php
			if ($this->module_lib->hasActive('human_resource') or 1==1) { // Human Resource module active check
				if (
					$this->rbac->hasPrivilege('department', 'can_view') ||
					$this->rbac->hasPrivilege('designation', 'can_view') ||
					$this->rbac->hasPrivilege('add_staff', 'can_view') ||
					$this->rbac->hasPrivilege('staff_attendance', 'can_view') ||
					$this->rbac->hasPrivilege('payroll', 'can_view') ||
					$this->rbac->hasPrivilege('approve_leave_request', 'can_view') ||
					$this->rbac->hasPrivilege('apply_leave', 'can_view') ||
					$this->rbac->hasPrivilege('leave_type', 'can_view') ||
					$this->rbac->hasPrivilege('teachers_rating', 'can_view') ||
					$this->rbac->hasPrivilege('disabled_staff', 'can_view') ||
					$this->rbac->hasPrivilege('staff_management_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeSmMenu="";
					if(set_Submenu('admin/department/department')
						|| set_Submenu('admin/designation/designation')
						|| set_Submenu('HR/staff')
						|| set_Submenu('admin/staff')
						|| set_Submenu('admin/staffattendance')
						|| set_Submenu('admin/payroll')
						|| set_Submenu('admin/leaverequest/leaverequest')
						|| set_Submenu('admin/staff/leaverequest')
						|| set_Submenu('admin/leavetypes')
						|| set_Submenu('HR/rating')
						|| set_Submenu('HR/staff/disablestafflist')
						|| set_Submenu('Reports/human_resource')
					){
						$activeSmMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeSmMenu; ?>">
						<a href="#">
							<i class="fa fa-users ftlayer"></i> <span>Staff Management </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('department', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/department/department'); ?>"><a href="<?php echo base_url(); ?>admin/department/department"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('department'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('designation', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/designation/designation'); ?>"><a href="<?php echo base_url(); ?>admin/designation/designation"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('designation'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('add_staff', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('HR/staff') || set_Submenu('admin/staff') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/staff"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('staff_directory'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('staff_attendance', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/staffattendance'); ?>"><a href="<?php echo base_url(); ?>admin/staffattendance"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('staff_attendance'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('payroll', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/payroll'); ?>"><a href="<?php echo base_url(); ?>admin/payroll"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('payroll'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('approve_leave_request', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/leaverequest/leaverequest'); ?>"><a href="<?php echo base_url(); ?>admin/leaverequest/leaverequest"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('approve_leave_request'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('apply_leave', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/staff/leaverequest'); ?>"><a href="<?php echo base_url(); ?>admin/staff/leaverequest"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('apply_leave'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('leave_type', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/leavetypes'); ?>"><a href="<?php echo base_url(); ?>admin/leavetypes"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('leave_type'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('teachers_rating', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('HR/rating'); ?>"><a href="<?php echo base_url(); ?>admin/staff/rating"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('teachers') . " " . $this->lang->line('rating'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('disabled_staff', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('HR/staff/disablestafflist'); ?>"><a href="<?php echo base_url(); ?>admin/staff/disablestafflist"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('disabled_staff'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('staff_management_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Reports/human_resource'); ?>"><a href="<?php echo base_url(); ?>report/staff_report"><i class="fa fa-angle-double-right"></i> Staff Management Report</a></li>
							<?php } ?>
						</ul>
					</li>
		<?php
				}
			}
		?>
		<!-- 9th Menu end -->
		<!-- 10th Menu start -->
		<?php
			if ($this->module_lib->hasActive('communication') or 1==1) { // Communication module active check
				if (
					$this->rbac->hasPrivilege('notice_board', 'can_view') ||
					$this->rbac->hasPrivilege('send_email', 'can_view') ||
					$this->rbac->hasPrivilege('send_sms', 'can_view') ||
					$this->rbac->hasPrivilege('send_whatsapp', 'can_view') ||
					$this->rbac->hasPrivilege('email_sms_log', 'can_view') ||
					$this->rbac->hasPrivilege('message_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeMsMenu="";
					if(set_Submenu('notification/index')
						|| set_Submenu('Communicate/mailsms/compose')
						|| set_Submenu('mailsms/compose_sms')
						|| set_Submenu('mailsms/send_whatsapp')
						|| set_Submenu('mailsms/index')
						|| set_Submenu('report/message-section')
					){
						$activeMsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeMsMenu; ?>">
						<a href="#">
							<i class="fa fa-envelope ftlayer"></i> <span>Message Section </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('notice_board', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('notification/index'); ?>"><a href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('notice_board'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('send_email', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Communicate/mailsms/compose'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/compose"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send') . " " . $this->lang->line('email') ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('send_sms', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('mailsms/compose_sms'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/compose_sms"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send') . " " . $this->lang->line('sms') ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('send_whatsapp', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('mailsms/send_whatsapp'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/send_whatsapp_msg"><i class="fa fa-angle-double-right"></i> Send WhatsApp</a></li>
							<?php } if ($this->rbac->hasPrivilege('email_sms_log', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('mailsms/index'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/index"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('email_/_sms_log'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('message_section_report', 'can_view')) { ?>								
								<li class="<?php echo set_Submenu('report/message-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/message_section_reports"><i class="fa fa-angle-double-right"></i> Message Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 10th Menu end -->
		<!-- 11th Menu start -->
		<?php
			if ($this->module_lib->hasActive('certificate') or 1==1) { // Certificate module active check
				if (
					$this->rbac->hasPrivilege('student_certificate', 'can_view') ||
					$this->rbac->hasPrivilege('generate_certificate', 'can_view') ||
					$this->rbac->hasPrivilege('student_id_card', 'can_view') ||
					$this->rbac->hasPrivilege('generate_student_id_card', 'can_view') ||
					$this->rbac->hasPrivilege('staff_id_card', 'can_view') ||
					$this->rbac->hasPrivilege('generate_staff_id_card', 'can_view') ||
					$this->rbac->hasPrivilege('certificate_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeCsMenu="";
					if(set_Submenu('admin/certificate')
						|| set_Submenu('admin/generatecertificate')
						|| set_Submenu('admin/studentidcard')
						|| set_Submenu('admin/generateidcard')
						|| set_Submenu('admin/staffidcard')
						|| set_Submenu('admin/generatestaffidcard')
						|| set_Submenu('report/certificate-section')
					){
						$activeCsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeCsMenu; ?>">
						<a href="#">
							<i class="fa fa-certificate ftlayer"></i> <span>Certifcate Section </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('student_certificate', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/certificate'); ?>"><a href="<?php echo base_url(); ?>admin/certificate/"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('certificate'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('generate_certificate', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/generatecertificate'); ?>"><a href="<?php echo base_url(); ?>admin/generatecertificate/"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('generate'); ?> <?php echo $this->lang->line('certificate'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('student_id_card', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/studentidcard'); ?>"><a href="<?php echo base_url('admin/studentidcard/'); ?>"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('icard'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('generate_student_id_card', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/generateidcard'); ?>"><a href="<?php echo base_url('admin/generateidcard/'); ?>"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('generate'); ?> <?php echo $this->lang->line('icard'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('staff_id_card', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/staffidcard'); ?>"><a href="<?php echo base_url('admin/staffidcard/'); ?>"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('staff'); ?> <?php echo $this->lang->line('icard'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('generate_staff_id_card', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/generatestaffidcard'); ?>"><a href="<?php echo base_url('admin/generatestaffidcard/'); ?>"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('generate'); ?> <?php echo $this->lang->line('staff'); ?> <?php echo $this->lang->line('icard'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('certificate_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/certificate-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/certificate_section_reports"><i class="fa fa-angle-double-right"></i> Certificate Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 11th Menu end -->
		<!-- 12th Menu start -->            
		<?php
			if ($this->module_lib->hasActive('library') or 1==1) { // Library module active check
				if (
					$this->rbac->hasPrivilege('book_list', 'can_view') ||
					$this->rbac->hasPrivilege('issue_return', 'can_view') ||
					$this->rbac->hasPrivilege('add_student', 'can_view') ||
					$this->rbac->hasPrivilege('add_staff_member', 'can_view') ||
					$this->rbac->hasPrivilege('library_management_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeLmMenu="";
					if(set_Submenu('book/getall')
						|| set_Submenu('member/index')
						|| set_Submenu('member/student')
						|| set_Submenu('Library/member/teacher')
						|| set_Submenu('Reports/library')
					){
						$activeLmMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeLmMenu; ?>">
						<a href="#">
							<i class="fa fa-book ftlayer"></i> <span>Library Management </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('book_list', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('book/getall'); ?>"><a href="<?php echo base_url(); ?>admin/book/getall"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('book_list'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('issue_return', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('member/index'); ?>"><a href="<?php echo base_url(); ?>admin/member"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('issue_return'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('add_student', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('member/student'); ?>"><a href="<?php echo base_url(); ?>admin/member/student"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_student'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('add_staff_member', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Library/member/teacher'); ?>"><a href="<?php echo base_url(); ?>admin/member/teacher"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_staff_member'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('library_management_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Reports/library'); ?>"><a href="<?php echo base_url(); ?>report/library"><i class="fa fa-angle-double-right"></i> Library Management Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 12th Menu end -->
		<!-- 13th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('homework') or 1==1) { // Homework module active check
				if (
					$this->rbac->hasPrivilege('add_homework', 'can_view') ||
					$this->rbac->hasPrivilege('homework_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeHsMenu="";
					if(set_Submenu('homework')
						|| set_Submenu('report/homework-section')
					){
						$activeHsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeHsMenu; ?>">
						<a href="#">
							<i class="fa fa-pencil-square-o ftlayer"></i> <span>Homework Section </span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('add_homework', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('homework'); ?>"><a href="<?php echo base_url(); ?>homework"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('add_homework'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('homework_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/homework-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/homework_section_reports"><i class="fa fa-angle-double-right"></i> Homework Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 13th Menu end -->
		<!-- 14th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('download') or 1==1) {
				if (
					$this->rbac->hasPrivilege('upload_section', 'can_view') ||
					$this->rbac->hasPrivilege('assignment', 'can_view') ||
					$this->rbac->hasPrivilege('study_material', 'can_view') ||
					$this->rbac->hasPrivilege('syllabus', 'can_view') ||
					$this->rbac->hasPrivilege('other_download', 'can_view') ||
					$this->rbac->hasPrivilege('download_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeDsMenu="";
					if(set_Submenu('admin/content')
						|| set_Submenu('content/assignment')
						|| set_Submenu('content/studymaterial')
						|| set_Submenu('content/syllabus')
						|| set_Submenu('content/other')
						|| set_Submenu('report/download-section')
					){
						$activeDsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeDsMenu; ?>">
						<a href="#">
							<i class="fa fa-download ftlayer"></i> <span>Download Section</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('upload_section', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('admin/content'); ?>"><a href="<?php echo base_url(); ?>admin/content"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('upload_content'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('assignment', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('content/assignment'); ?>"><a href="<?php echo base_url(); ?>admin/content/assignment"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assignments'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('study_material', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('content/studymaterial'); ?>"><a href="<?php echo base_url(); ?>admin/content/studymaterial"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('study_material'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('syllabus', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('content/syllabus'); ?>"><a href="<?php echo base_url(); ?>admin/content/syllabus"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('syllabus'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('other_download', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('content/other'); ?>"><a href="<?php echo base_url(); ?>admin/content/other"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('other_downloads'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('download_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/download-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/download_section_reports"><i class="fa fa-angle-double-right"></i> Download Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 14th Menu end -->
		<!-- 15th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('income') or 1==1) {
				if (
					$this->rbac->hasPrivilege('add_income', 'can_view') ||
					$this->rbac->hasPrivilege('search_income', 'can_view') ||
					$this->rbac->hasPrivilege('income_heads', 'can_view') ||
					$this->rbac->hasPrivilege('income_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeIsMenu="";
					if(set_Submenu('income/index')
						|| set_Submenu('income/incomesearch')
						|| set_Submenu('incomeshead/index')
						|| set_Submenu('report/income-section')
					){
						$activeIsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeIsMenu; ?>">
						<a href="#">
							<i class="fa fa-money ftlayer"></i> <span>Income Section</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('add_income', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_income'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('search_income', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('search_income'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('income_heads', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('incomeshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('income_head'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('income_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/income-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/income_section_reports"><i class="fa fa-angle-double-right"></i> Income Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 15th Menu end -->
		<!-- 16th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('expense') or 1==1) {
				if (
					$this->rbac->hasPrivilege('add_expense', 'can_view') ||
					$this->rbac->hasPrivilege('search_expense', 'can_view') ||
					$this->rbac->hasPrivilege('expense_head', 'can_view') ||
					$this->rbac->hasPrivilege('expense_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeEsMenu="";
					if(set_Submenu('expense/index')
						|| set_Submenu('expense/expensesearch')
						|| set_Submenu('expenseshead/index')
						|| set_Submenu('report/expense-section')
					){
						$activeEsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeEsMenu; ?>">
						<a href="#">
							<i class="fa fa-credit-card ftlayer"></i> <span>Expense Section</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('add_expense', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('add_expense'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('search_expense', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('search_expense'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('expense_head', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('expenseshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/expensehead"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('expense_head'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('expense_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/expense-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/expense_section_reports"><i class="fa fa-angle-double-right"></i> Expense Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 16th Menu end -->
		<!-- 17th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('stock') or 1==1) {
				if (
					$this->rbac->hasPrivilege('issue_item', 'can_view') ||
					$this->rbac->hasPrivilege('add_item_stock', 'can_view') ||
					$this->rbac->hasPrivilege('add_item', 'can_view') ||
					$this->rbac->hasPrivilege('item_category', 'can_view') ||
					$this->rbac->hasPrivilege('item_store', 'can_view') ||
					$this->rbac->hasPrivilege('item_supplier', 'can_view') ||
					$this->rbac->hasPrivilege('stock_management_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeStockMenu="";
					if(set_Submenu('issueitem/index')
						|| set_Submenu('Itemstock/index')
						|| set_Submenu('Item/index')
						|| set_Submenu('itemcategory/index')
						|| set_Submenu('itemstore/index')
						|| set_Submenu('itemsupplier/index')
						|| set_Submenu('Reports/inventory')
					){
						$activeStockMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeStockMenu; ?>">
						<a href="#">
							<i class="fa fa-cubes ftlayer"></i> <span>Stock Management</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('issue_item', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('issueitem/index'); ?>"><a href="<?php echo base_url(); ?>admin/issueitem"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('issue_item'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('add_item_stock', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Itemstock/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstock"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_item_stock'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('add_item', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Item/index'); ?>"><a href="<?php echo base_url(); ?>admin/item"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_item'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('item_category', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('itemcategory/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemcategory"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_category'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('item_store', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('itemstore/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstore"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_store'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('item_supplier', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('itemsupplier/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemsupplier"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_supplier'); ?></a></li>
							<?php } if ($this->rbac->hasPrivilege('stock_management_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('Reports/inventory'); ?>"><a href="<?php echo base_url(); ?>report/inventory"><i class="fa fa-angle-double-right"></i> Stock Management Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 18th Menu end -->
		<!-- 19th Menu start --> 
		<?php
			if ($this->module_lib->hasActive('ticket') or 1==1) {
				if (
					$this->rbac->hasPrivilege('create_ticket', 'can_view') ||
					$this->rbac->hasPrivilege('track_ticket', 'can_view') ||
					$this->rbac->hasPrivilege('closed_ticket', 'can_view') ||
					$this->rbac->hasPrivilege('ticket_section_report', 'can_view')
				) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					$activeTsMenu="";
					if(set_Submenu('issueitem/index')
						|| set_Submenu('Itemstock/index')
						|| set_Submenu('Item/index')
						|| set_Submenu('report/ticket-section')
					){
						$activeTsMenu="active";
					}
		?>
					<li class="treeview <?php echo $activeTsMenu; ?>">
						<a href="#">
							<i class="fa fa-ticket ftlayer"></i> <span>Ticket Section</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php if ($this->rbac->hasPrivilege('create_ticket', 'can_view')) { ?>
								<li class="<?php //echo set_Submenu('Ticket/create'); ?>"><a href="#<?php //echo base_url(); ?>ticket/create"><i class="fa fa-angle-double-right"></i> Create Ticket</a></li>
							<?php } if ($this->rbac->hasPrivilege('track_ticket', 'can_view')) { ?>
								<li class="<?php //echo set_Submenu('Ticket/track'); ?>"><a href="#<?php //echo base_url(); ?>ticket/track"><i class="fa fa-angle-double-right"></i> Track Ticket</a></li>
							<?php } if ($this->rbac->hasPrivilege('closed_ticket', 'can_view')) { ?>
								<li class="<?php //echo set_Submenu('Ticket/closed'); ?>"><a href="#<?php //echo base_url(); ?>ticket/closed"><i class="fa fa-angle-double-right"></i> Closed Ticket</a></li>
							<?php } if ($this->rbac->hasPrivilege('ticket_section_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/ticket-section'); ?>"><a href="<?php echo base_url(); ?>admin/report/ticket_section_reports"><i class="fa fa-angle-double-right"></i> Ticket Section Report</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php
				}
			}
		?>
		<!-- 19th Menu end -->
		<!-- 20th Menu start --> 
        <?php
            if ($this->module_lib->hasActive('system_settings') or 1==1) {
                if (
                    $this->rbac->hasPrivilege('general_setting', 'can_edit') ||
                    $this->rbac->hasPrivilege('session_setting', 'can_view') ||
                    $this->rbac->hasPrivilege('notification_setting', 'can_edit') ||
                    $this->rbac->hasPrivilege('sms_setting', 'can_edit') ||
                    $this->rbac->hasPrivilege('email_setting', 'can_edit') ||
                    $this->rbac->hasPrivilege('payment_methods', 'can_edit') ||
                    $this->rbac->hasPrivilege('print_header_footer', 'can_edit') ||
                    $this->rbac->hasPrivilege('roles_permissions', 'can_view') ||
                    $this->rbac->hasPrivilege('user_status', 'can_view') ||
                    $this->rbac->hasPrivilege('modules', 'can_view') ||
                    $this->rbac->hasPrivilege('custom_fields', 'can_view') ||
                    $this->rbac->hasPrivilege('system_fields', 'can_view') ||
                    $this->rbac->hasPrivilege('file_types', 'can_view') ||
                    $this->rbac->hasPrivilege('change_session', 'can_view')
                ) {
					$activeSsMenu="";
					if(set_Submenu('schsettings/index')
						|| set_Submenu('sessions/index')
						|| set_Submenu('notification/setting')
						|| set_Submenu('smsconfig/index')
						|| set_Submenu('emailconfig/index')
						|| set_Submenu('admin/paymentsettings')
						|| set_Submenu('admin/print_headerfooter')
						|| set_Submenu('admin/roles')
						|| set_Submenu('users/index')
						|| set_Submenu('System Settings/module')
						|| set_Submenu('System Settings/customfield')
						|| set_Submenu('System Settings/systemfield')
						|| set_Submenu('System Settings/filetype')
						|| set_Submenu('report/ticket-section')
					){
						$activeSsMenu="active";
					}
        ?>
                    <li class="treeview <?php echo $activeSsMenu; ?>">
                        <a href="#">
                            <i class="fa fa-gears ftlayer"></i> <span>System Setting</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('general_setting', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('schsettings/index'); ?>"><a href="<?php echo base_url(); ?>schsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('general_settings'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('session_setting', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('sessions/index'); ?>"><a href="<?php echo base_url(); ?>sessions"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('session_setting'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('notification_setting', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('notification/setting'); ?>"><a href="<?php echo base_url(); ?>admin/notification/setting"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('notification_setting'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('sms_setting', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('smsconfig/index'); ?>"><a href="<?php echo base_url(); ?>smsconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('sms_setting'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('email_setting', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('emailconfig/index'); ?>"><a href="<?php echo base_url(); ?>emailconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('email_setting'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('payment_methods', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('admin/paymentsettings'); ?>"><a href="<?php echo base_url(); ?>admin/paymentsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('payment_methods'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('print_header_footer', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('admin/print_headerfooter'); ?>"><a href="<?php echo base_url(); ?>admin/print_headerfooter"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('print_headerfooter'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('roles_permissions', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('admin/roles'); ?>"><a href="<?php echo base_url(); ?>admin/roles"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('roles_permissions'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('user_status', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('users/index'); ?>"><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('users'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('modules', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('System Settings/module'); ?>"><a href="<?php echo base_url(); ?>admin/module"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('modules'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('custom_fields', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('System Settings/customfield'); ?>"><a href="<?php echo base_url(); ?>admin/customfield"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('custom') . " " . $this->lang->line('fields'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('system_fields', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('System Settings/systemfield'); ?>"><a href="<?php echo base_url(); ?>admin/systemfield"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('system') . " " . $this->lang->line('fields'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('file_types', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('System Settings/filetype'); ?>"><a href="<?php echo site_url('admin/admin/filetype'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('file_types'); ?></a></li>
                            <?php } if ($this->rbac->hasPrivilege('change_session', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('System/change_session'); ?>"><a href="#<?php //echo base_url(); ?>system/change_session"><i class="fa fa-angle-double-right"></i> Change Session</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                }
            }
        ?>
		<!-- 20th Menu end -->
		<!-- 21th Menu start --> 
        <?php
            if ($this->module_lib->hasActive('multi_branch') or 1==1) {
                if (
                    $this->rbac->hasPrivilege('add_branch', 'can_view') ||
                    $this->rbac->hasPrivilege('overview', 'can_view') ||
                    $this->rbac->hasPrivilege('multi_branch_report', 'can_view')
                ) {
					$activeMbMenu="";
					if(set_Submenu('report/multi-branch')
					){
						$activeMbMenu="active";
					}
        ?>
                    <li class="treeview <?php echo $activeMbMenu; ?>">
                        <a href="#">
                            <i class="fa fa-newspaper-o ftlayer"></i> <span>Multi Branch</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('add_branch', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('MultiBranch/add'); ?>"><a href="#"><i class="fa fa-angle-double-right"></i> Add Branch</a></li>
                            <?php } if ($this->rbac->hasPrivilege('overview', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('MultiBranch/overview'); ?>"><a href="#"><i class="fa fa-angle-double-right"></i> Overview</a></li>
                            <?php } if ($this->rbac->hasPrivilege('multi_branch_report', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('report/multi-branch'); ?>"><a href="<?php echo base_url(); ?>admin/report/multi_branch_reports"><i class="fa fa-angle-double-right"></i> Multi Branch Report</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                }
            }
        ?>

		<!-- 21th Menu end -->
		<!-- 22th Menu start --> 

        <?php
            if ($this->module_lib->hasActive('software_subscription') or 1==1) {
                if (
                    $this->rbac->hasPrivilege('create_package', 'can_view') ||
                    $this->rbac->hasPrivilege('package_list', 'can_view') ||
                    $this->rbac->hasPrivilege('invoice_section', 'can_view') ||
                    $this->rbac->hasPrivilege('subscription_report', 'can_view')
                ) {
					$activeSoftwareMenu="";
					if(set_Submenu('report/subscription')
					){
						$activeSoftwareMenu="active";
					}
        ?>
                    <li class="treeview <?php echo $activeSoftwareMenu; ?>">
                        <a href="#">
                            <i class="fa fa-newspaper-o ftlayer"></i> <span>Software Subscription</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('create_package', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('SoftwareSubscription/create'); ?>"><a href="#"><i class="fa fa-angle-double-right"></i> Create Package</a></li>
                            <?php } if ($this->rbac->hasPrivilege('package_list', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('SoftwareSubscription/list'); ?>"><a href="#"><i class="fa fa-angle-double-right"></i> Package List</a></li>
                            <?php } if ($this->rbac->hasPrivilege('invoice_section', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('SoftwareSubscription/invoice'); ?>"><a href="#"><i class="fa fa-angle-double-right"></i> Invoice Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('subscription_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('report/subscription'); ?>"><a href="<?php echo base_url(); ?>admin/report/subscription_reports"><i class="fa fa-angle-double-right"></i> Subscription Report</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                }
            }
        ?>
		<!-- 22th Menu end -->
		<!-- 23th Menu start --> 
        <?php
            if ($this->module_lib->hasActive('overall_reports') or 1==1) {
                if (
                    $this->rbac->hasPrivilege('students_section', 'can_view') ||
                    $this->rbac->hasPrivilege('finance', 'can_view') ||
                    $this->rbac->hasPrivilege('attendance_section', 'can_view') ||
                    $this->rbac->hasPrivilege('exam_section', 'can_view') ||
                    $this->rbac->hasPrivilege('online_exam_section', 'can_view') ||
                    $this->rbac->hasPrivilege('lesson_plan', 'can_view') ||
                    $this->rbac->hasPrivilege('staff_management', 'can_view') ||
                    $this->rbac->hasPrivilege('library_management', 'can_view') ||
                    $this->rbac->hasPrivilege('stock_management', 'can_view') ||
                    $this->rbac->hasPrivilege('set_transport', 'can_view') ||
                    $this->rbac->hasPrivilege('user_log', 'can_view') ||
                    $this->rbac->hasPrivilege('audit_trail_report', 'can_view')
                ) {
					//$CI = get_instance();
					//$session_sub_menu = $CI->session->userdata('sub_menu');
					//echo '<pre>'; print_r($session_sub_menu);echo '</pre>';die;
					
					$activeOrMenu="";
					if(set_Submenu('audit/index')
						|| set_Submenu('Reports/userlog')
						|| set_Submenu('reports/studenttransportdetails')
						|| set_Submenu('Reports/inventory')
						|| set_Submenu('Reports/library')
						|| set_Submenu('Reports/human_resource')
						|| set_Submenu('Reports/lesson_plan')
						|| set_Submenu('Reports/online_examinations')
						|| set_Submenu('Reports/examinations')
						|| set_Submenu('Reports/attendance')
						|| set_Submenu('Reports/finance')
						|| set_Submenu('Reports/student_information')
					){
						$activeOrMenu="active";
					}
        ?>
                    <li class="treeview <?php echo $activeOrMenu; ?>">
                        <a href="#">
                            <i class="fa fa-bar-chart ftlayer"></i> <span>Overall Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('students_section', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/student_information'); ?>"><a href="<?php echo base_url(); ?>report/studentinformation"><i class="fa fa-angle-double-right"></i> Students Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('finance', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/finance'); ?>"><a href="<?php echo base_url(); ?>report/finance"><i class="fa fa-angle-double-right"></i> Finance</a></li>
                            <?php } if ($this->rbac->hasPrivilege('attendance_section', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/attendance'); ?>"><a href="<?php echo base_url(); ?>report/attendance"><i class="fa fa-angle-double-right"></i> Attendance Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('exam_section', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/examinations'); ?>"><a href="<?php echo base_url(); ?>report/examinations"><i class="fa fa-angle-double-right"></i> Exam Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('online_exam_section', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/online_examinations'); ?>"><a href="<?php echo base_url(); ?>admin/onlineexam/report"><i class="fa fa-angle-double-right"></i> Online Exam Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('lesson_plan', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/lesson_plan'); ?>"><a href="<?php echo base_url(); ?>report/lesson_plan"><i class="fa fa-angle-double-right"></i> Lesson Plan</a></li>
                            <?php } if ($this->rbac->hasPrivilege('staff_management', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/human_resource'); ?>"><a href="<?php echo base_url(); ?>report/staff_report"><i class="fa fa-angle-double-right"></i> Staff Management</a></li>
                            <?php } if ($this->rbac->hasPrivilege('library_management', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/library'); ?>"><a href="<?php echo base_url(); ?>report/library"><i class="fa fa-angle-double-right"></i> Library Management</a></li>
                            <?php } if ($this->rbac->hasPrivilege('stock_management', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/inventory'); ?>"><a href="<?php echo base_url(); ?>report/inventory"><i class="fa fa-angle-double-right"></i> Stock Management</a></li>
                            <?php } if ($this->rbac->hasPrivilege('set_transport', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('reports/studenttransportdetails'); ?>"><a href="<?php echo base_url(); ?>admin/route/studenttransportdetails"><i class="fa fa-angle-double-right"></i> Transport Section</a></li>
                            <?php } if ($this->rbac->hasPrivilege('user_log', 'can_view')) { ?>
                                <li class="<?php echo set_Submenu('Reports/userlog'); ?>"><a href="<?php echo base_url(); ?>admin/userlog"><i class="fa fa-angle-double-right"></i> User Log</a></li>
                            <?php } if ($this->rbac->hasPrivilege('audit_trail_report', 'can_view')) { ?>
								<li class="<?php echo set_Submenu('audit/index'); ?>"><a href="<?php echo base_url(); ?>admin/audit"><i class="fa fa-angle-double-right"></i> Audit Trail Report</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                }
            }
            ?>
		<!-- 23th Menu end -->
        </ul>
    </section>
</aside>