<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>Login : <?php echo $name; ?></title>
        <!--favican-->
        <!-- <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon"> -->
        <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo(); ?>" rel="shortcut icon" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">

        <style type="text/css">
            /*.col-md-offset-3 { margin-left: 29%;}*/
            .bgoffsetbgno{background: transparent; border-right:0 !important; box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.29); border-radius: 4px;}
            .loginradius{border-radius: 4px;} 
            /* @media (max-width: 767px){.col-md-offset-3 {margin-left: 0;}}*/
            .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
                background: rgb(53, 170, 71);} 
				
			.password-group {
				position: relative;
			}

			.password-group .toggle-password {
				position: absolute;
				top: 50%;
				right: 15px;
				transform: translateY(-50%);
				cursor: pointer;
				color: #777;
				z-index: 10;
			}

			.password-group .toggle-password:hover {
				color: #333;
			}

			.password-group input {
				padding-right: 45px;
			}
        </style>

    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        $empty_notice = 0;
                        $offset = "";
                        $bgoffsetbg = "bgoffsetbg";
                        $bgoffsetbgno = "";
                        /*if (empty($notice)) {
                            $empty_notice = 1;
                            $offset = "col-md-offset-4";
                            $bgoffsetbg = "";
                            $bgoffsetbgno = "bgoffsetbgno";
                        }*/
                        ?>  
                        <div class="<?php echo $bgoffsetbg; ?>">   



                            <div class="col-lg-4 col-md-4 col-sm-12 nopadding <?php echo $bgoffsetbgno; ?> <?php echo $offset; ?>">
                                <div class="loginbg loginradius login390">  
                                    <div class="form-top">
                                        <!--<div class="form-top-left logowidth text-center">
                                            <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo(); ?>" />    
                                        </div>-->
                                        <!-- <div class="form-top-right"><i class="fa fa-key"></i></div> -->
										<div class="form-top-left text-center">
                                            <div class="logo-box">
												<img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo(); ?>" />    
											</div>
                                        </div>
                                    </div>

                                    <div class="form-bottom">
                                        <h3 class="font-white bolds"><?php echo $this->lang->line('admin_login'); ?></h3>
                                        <?php
                                        if (isset($error_message)) {
                                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                        }
                                        ?>
                                        <?php
                                        if ($this->session->flashdata('message')) {
                                            echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                                        };
                                        ?>
                                        <?php
                                        if ($this->session->flashdata('disable_message')) {
                                            echo "<div class='alert alert-danger'>" . $this->session->flashdata('disable_message') . "</div>";
                                        };
                                        ?>
                                        <form action="<?php echo site_url('site/login') ?>" method="post">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            <div class="form-group has-feedback">                                            
                                                <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" value="<?php echo set_value('username') ?>" class="form-username form-control" id="form-username">
                                                <span class="fa fa-envelope form-control-feedback"></span>
                                                <span class="text-danger"><?php echo form_error('username'); ?></span>
                                            </div>
                                            <div class="form-group has-feedback password-group">
                                                <input type="password" value="<?php echo set_value('password') ?>" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="form-password">
                                                <!--<span class="fa fa-lock form-control-feedback"></span>-->
												<span class="toggle-password">
													<i class="fa fa-eye" id="togglePassword"></i>
												</span>
                                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                                            </div>
                                            <?php if($is_captcha){ ?>
                                            <div class="form-group has-feedback row"> 
                                                <div class='col-lg-7 col-md-12 col-sm-6'>
                                                    <span id="captcha_image"><?php echo $captcha_image; ?></span>
                                                    <span title='Refresh Catpcha' class="fa fa-refresh catpcha" onclick="refreshCaptcha()"></span>
                                                </div>
                                                <div class='col-lg-5 col-md-12 col-sm-6'>
                                                    <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha'); ?>" class=" form-control" autocomplete="off" id="captcha"> 
                                                    <span class="text-danger"><?php echo form_error('captcha'); ?></span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <button type="submit" class="btn"><?php echo $this->lang->line('sign_in'); ?></button>
                                        </form>
                                        <a href="<?php echo site_url('site/forgotpassword') ?>" class="forgot"><i class="fa fa-key"></i> <?php echo $this->lang->line('forgot_password'); ?>?</a>
										<a href="<?php echo site_url('site/userlogin'); ?>" class="forgot pull-right"> <i class="fa fa-user"></i> User Login</a>
										<a href="<?php echo base_url(); ?>" target="_blank" class="forgot pull-right mr25"> <i class="fa fa-home"></i> Front Site</a>
                                    </div>
									<!--<span class="copyright_text">Designed and Maintained by <a href="https://easyskool.in/" class="color_black" target="_blank">easyskool.in</a></span>-->
                                </div>
                            </div>
                            
                                <!-- <div class="col-lg-1 col-sm-1"><div class="separatline"></div></div>  -->
                                <div class="col-lg-8 col-md-8 col-sm-12 nopadding-2">
									<div class="d-flex align-items-center text-wrap flex-column justify-content-center bg-position-sm-left bg-position-lg-center" style="background: url('https://demo.smart-school.in/uploads/school_content/login_image/1663064530-1070210809632059d2b8b0b!1662796232-1721792380631c41c80d038!login_bg3.jpg') no-repeat; background-size:cover">  
										<div class=" bg-shadow-remove ">
											<div class="d-flex justify-content-between">
												<h3 class="h3"><?php echo $this->lang->line('what_is_new_in'); ?> <?php echo $crm_name; ?></h3>
												<div class="d-flex align-center logowidth">
													<a href="<?= $crm_website_url ?>" target="_blank"><img src="<?php echo $crm_logo; ?>" /></a>
												</div>
											</div>
											<div class="loginright mCustomScrollbar1">
												<div class="messages"> 
												<marquee direction="up"
													 scrollamount="5"
													 height="390"
													 onmouseover="this.stop();"
													 onmouseout="this.start();">
												<?php 
												if(!empty($crm_school_update))
												{
													foreach($crm_school_update as $k=>$newlyupdates)  
													{
												?>
													<h4>Title : <?= $newlyupdates['title'] ?></h4>
													<p>Details : <?= $newlyupdates['details'] ?></p>
													<p>Release Date :  <?= date('d-m-Y',  strtotime($newlyupdates['release_date'])); ?></p>
													<div class="logdivider"></div>
												<?php 
													}
												}
												else{
												  echo $message;
												}
												?>
													<!--<h4>Title : UT-6 Starts from 16-Nov-2025</h4>
													<p>Details : In this section you can track all Income and Expense Related Reports</p>
													<p>Release Date : 15-04-2026</p>
													<div class="logdivider"></div>
													<h4>Title : UT-5 Starts from 17-Nov-2025</h4>
													<p>Details : In this section you can track all Income and Expense Related Reports</p>
													<p>Release Date : 15-03-2026</p>
													<div class="logdivider"></div>
													<h4>Title : UT-4 Starts from 18-Nov-2025</h4>
													<p>Details : In this section you can track all Income and Expense Related Reports</p>
													<p>Release Date : 15-03-2026</p>
													<div class="logdivider"></div>-->
													<?php
													
													?>
												</marquee>
												</div>  
											</div>
											<!-- <img src="<?php echo base_url(); ?>backend/usertemplate/assets/img/backgrounds/bg3.jpg" class="img-responsive" style="border-radius:4px;" /> -->
										</div>
									</div>
                                </div><!--./col-lg-6-->


                                
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
		<?php
		if (isset($error_message_popup)) {
		?>	
			<div class="modal fade" id="disable-reason" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Disable Reason</h4>
						</div> 
						<div class="modal-body">
							<p class="text-danger" style="color: #ff0000; letter-spacing: 1px;"><b><?php echo $error_message_popup; ?></b></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
						</div>
					</div>
				</div>
			</div>
			<script>
			$(document).ready(function () {
				$('#disable-reason').modal('show');
			});
			</script>
		<?php	
		}
		?>
    </body>
</html>
<script>
$(document).ready(function () {

    $('#togglePassword').click(function () {

        var password = $('#form-password');

        if (password.attr('type') === 'password') {
            password.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            password.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }

    });

});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function refreshCaptcha(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha){
                $("#captcha_image").html(captcha);
            }
        });
    }    
</script>