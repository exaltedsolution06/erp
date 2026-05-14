<style type="text/css">
    .wrapper {overflow: visible;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-gears"></i> Company Info</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-gear"></i> Company Info</h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="tshadow mb25 bozero">   
										<h3 class="pagetitleh2">Basic Details </h3>
										<div class="table-responsive around10 pt0">  
											<table class="table table-hover table-striped tmb0">
												<tbody>
													<tr>
														<td class="col-md-4">Company Name</td>
														<td class="col-md-5"><?= $company['school_name'] ?? '' ?></td>
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
														<td class="col-md-4">Country</td>
														<td class="col-md-5"><?= $company['country'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">State</td>
														<td class="col-md-5"><?= $company['state'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">District</td>
														<td class="col-md-5"><?= $company['district'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">City</td>
														<td class="col-md-5"><?= $company['city'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Pin Code</td>
														<td class="col-md-5"><?= $company['pin_code'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Address</td>
														<td class="col-md-5"><?= $company['address'] ?? '' ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tshadow mb25 bozero">   
										<h3 class="pagetitleh2">Other Details </h3>
										<div class="table-responsive around10 pt0">  
											<table class="table table-hover table-striped tmb0">
												<tbody>
													<tr>
														<td class="col-md-4">PAN NO</td>
														<td class="col-md-5"><?= $company['pan_no'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">GST No</td>
														<td class="col-md-5"><?= $company['gst_no'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Contact No</td>
														<td class="col-md-5"><?= $company['contact_no'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Email ID</td>
														<td class="col-md-5"><?= $company['email'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Support No</td>
														<td class="col-md-5"><?= $company['support_no'] ?? '' ?></td>
													</tr>
													<tr>
														<td class="col-md-4">Relationship Manager No</td>
														<td class="col-md-5"><?= $company['relationship_manager_no'] ?? '' ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>							
						</div>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
