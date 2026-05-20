<style type="text/css">
    .wrapper {overflow: visible;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-gears"></i> School Registration</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-gear"></i> Registration Details</h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="tshadow mb25 bozero">   
										<h3 class="pagetitleh2">School Details </h3>
										<div class="table-responsive around10 pt0">  
											<table class="table table-hover table-striped tmb0">
												<tbody>
													<tr>
														<td class="col-md-4">School ID</td>
														<td class="col-md-5"><?php echo $domain_api_data['code_year'].$domain_api_data['code_number']; ?></td>
													</tr>
													<tr>
														<td class="col-md-4"><?php echo $this->lang->line('school_name'); ?></td>
														<td class="col-md-5"><?php echo $result->name; ?></td>
													</tr>
													<tr>
														<td class="col-md-4"><?php echo $this->lang->line('school_code'); ?></td>
														<td class="col-md-5"><?php echo $result->dise_code; ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Affiliate No.</td>
														<td class="col-md-5"><?php echo $domain_api_data['aff_no']; ?></td>
													</tr>
													<tr>
														<td class="col-md-4"><?php echo $this->lang->line('phone'); ?></td>
														<td class="col-md-5"><?php echo $result->phone; ?></td>
													</tr>
													<?php if(isset($result->alternate_no) && $result->alternate_no != ''){ ?>
													<tr>
														<td class="col-md-4">Alternate No.</td>
														<td class="col-md-5"><?php echo $result->alternate_no; ?></td>
													</tr>
													<?php } ?>
													<tr>
														<td class="col-md-4"><?php echo $this->lang->line('email'); ?></td>
														<td class="col-md-5"><?php echo $result->email; ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tshadow mb25 bozero">   
										<h3 class="pagetitleh2">Address Details </h3>
										<div class="table-responsive around10 pt0">  
											<table class="table table-hover table-striped tmb0">
												<tbody>
													<tr>
														<td class="col-md-4">Address</td>
														<td class="col-md-5"><?= $result->address ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Country</td>
														<td class="col-md-5"><?= $domain_api_data['school_country'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">State</td>
														<td class="col-md-5"><?= $domain_api_data['school_state'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">District</td>
														<td class="col-md-5"><?= $domain_api_data['school_district'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">City</td>
														<td class="col-md-5"><?= $domain_api_data['school_city'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Pin Code</td>
														<td class="col-md-5"><?= $domain_api_data['school_pin_code'] ?? '' ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
