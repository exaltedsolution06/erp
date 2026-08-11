<style type="text/css">
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         <i class="fa fa-dashboard"></i> <?php echo $this->lang->line('dashboard'); ?>
      </h1>
   </section>
   <section class="content">
      <?php
foreach ($unread_notifications as $notice_key => $notice_value) {
    ?>
      <div class="dashalert alert alert-success alert-dismissible" role="alert">
         <button type="button" class="alertclose close close_notice stualert" data-dismiss="alert" aria-label="Close" data-noticeid="<?php echo $notice_value->id; ?>"><span aria-hidden="true">&times;</span></button>
         <a href="<?php echo site_url('user/notification') ?>"><?php echo $notice_value->title; ?></a>
      </div>
      <?php
}
?>

      <!-- Student profile strip -->
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary student-profile-strip">
               <div class="box-body box-profile">
                  <div class="profile-strip-inner">
                     <div class="profile-strip-avatar">
                        <?php if ($sch_setting->student_photo) {?>
                        <img class="img-responsive img-circle" src="<?php
                        if (!empty($student['image'])) {
                            echo base_url() . $student['image'];
                        } else {
                            echo base_url() . "uploads/student_images/no_image.png";
                        }
                        ?>" alt="User profile picture">
                        <?php } ?>
                     </div>
                     <div class="profile-strip-info">
                        <h4>
                           <?php echo $this->customlib->getFullname($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?>
                           <span class="profile-strip-admno">(<?php echo $student['admission_no']; ?>)</span>
                        </h4>
                        <div class="profile-strip-meta">
                           <span class="profile-strip-badge"><i class="fa fa-graduation-cap"></i> Class: <b><?php echo $student['class'] . " - " . $student['section']; ?></b></span>
                           <?php if ($sch_setting->roll_no) {?>
                           <span class="profile-strip-badge"><i class="fa fa-hashtag"></i> <?php echo $this->lang->line('roll_no'); ?>: <b><?php echo $student['roll_no']; ?></b></span>
                           <?php }?>
                           <span class="profile-strip-badge"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('session'); ?>: <b><?php echo $session; ?></b></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--./Student profile strip -->

      <style type="text/css">
         .student-profile-strip { border-top: 3px solid #f39c12; border-radius: 4px; }
         .student-profile-strip .box-body { padding: 18px 22px; }
         .profile-strip-inner { display: flex; align-items: center; flex-wrap: wrap; gap: 18px; }
         .profile-strip-avatar { flex: 0 0 auto; }
         .profile-strip-avatar img { width: 68px; height: 68px; object-fit: cover; border: 3px solid #f4f4f4; box-shadow: 0 0 0 1px #e7e7e7; }
         .profile-strip-info { flex: 1 1 auto; min-width: 200px; }
         .profile-strip-info h4 { margin: 0 0 8px 0; font-weight: 600; color: #2c3e50; }
         .profile-strip-admno { font-size: 13px; font-weight: 400; color: #999; }
         .profile-strip-meta { display: flex; flex-wrap: wrap; gap: 10px; }
         .profile-strip-badge { background: #f7f7f7; border: 1px solid #eee; border-radius: 20px; padding: 4px 12px; font-size: 12.5px; color: #666; }
         .profile-strip-badge b { color: #333; }
         .profile-strip-badge i { color: #f39c12; margin-right: 4px; }
         @media (max-width: 480px) {
            .profile-strip-avatar img { width: 54px; height: 54px; }
            .profile-strip-info h4 { font-size: 16px; }
         }
      </style>


      <div class="row row-flex3">
         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('fees'); ?> <?php echo $this->lang->line('due'); ?></h5>
               <p class="text-uppercase mt10 clearfix">PREV AMT<span class="pull-right"><?php echo $currency_symbol . format_amount($prev_balance_amt); ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-purple" style="width: <?php echo $prev_balance_amt > 0 ? 100 : 0 ?>%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix">LEDG AMT<span class="pull-right"><?php echo $currency_symbol . format_amount($ledger_amt); ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-red" style="width: <?php echo $ledger_amt > 0 ? 100 : 0 ?>%"></div>
                  </div>
               </div>
               <a href="<?php echo site_url('user/user/my_profile'); ?>" class="btn btn-xs btn-default" style="margin-top:8px;"><?php echo $this->lang->line('view_detail'); ?></a>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('attendance'); ?> (<?php echo date('M Y'); ?>)</h5>
               <p class="text-uppercase mt10 clearfix"><?php echo $this->lang->line('present'); ?><span class="pull-right"><?php echo $attendance_present; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-aqua" style="width: <?php echo round($attendance_present_percent) ?>%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix">Late<span class="pull-right"><?php echo $attendance_late; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-warning" style="width: <?php echo round($attendance_late_percent) ?>%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix">AB<span class="pull-right"><?php echo $attendance_absent; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-red" style="width: <?php echo round($attendance_absent_percent) ?>%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix">Halfday<span class="pull-right"><?php echo $attendance_half_day; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-purple" style="width: <?php echo round($attendance_half_day_percent) ?>%"></div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('homework'); ?></h5>
               <p class="text-uppercase mt10 clearfix"><?php echo $this->lang->line('total'); ?><span class="pull-right"><?php echo $homework_total; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix"><?php echo $this->lang->line('pending'); ?><span class="pull-right"><?php echo $homework_pending; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-red" style="width: <?php echo round($homework_pending_percent) ?>%"></div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('library'); ?></h5>
               <p class="text-uppercase mt10 clearfix"><?php echo $this->lang->line('book'); ?> <?php echo $this->lang->line('issued'); ?><span class="pull-right"><?php echo $library_issued_count; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-aqua" style="width: <?php echo $library_issued_count > 0 ? 100 : 0 ?>%"></div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('result'); ?></h5>
               <p class="text-uppercase mt10 clearfix"><?php echo $this->lang->line('published'); ?><span class="pull-right"><?php echo $exam_result_count; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-purple" style="width: <?php echo $exam_result_count > 0 ? 100 : 0 ?>%"></div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 mb10">
            <div class="topprograssstart flex-card">
               <h5 class="pro-border"><?php echo $this->lang->line('notifications'); ?></h5>
               <p class="text-uppercase mt10 clearfix">Unread<span class="pull-right"><?php echo $unread_notification_count; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-red" style="width: <?php echo round($unread_notification_percent) ?>%"></div>
                  </div>
               </div>
               <p class="text-uppercase mt10 clearfix">Read<span class="pull-right"><?php echo $read_notification_count; ?></span>
               </p>
               <div class="progress-group">
                  <div class="progress progress-minibar">
                     <div class="progress-bar progress-bar-green" style="width: <?php echo round($read_notification_percent) ?>%"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--./row-flex3-->
   </section>
</div>
