<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('class1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('create_ticket', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
								<?php
									if (!empty($edit_ticket)) {
										echo "Edit Ticket";
									} else {
										echo "Create Ticket";
									}
									?>
							</h3>
                        </div> 
                        <form id="form1" action="<?php echo !empty($edit_ticket)
							? site_url('ticket/index/'.$edit_ticket['id'])
							: site_url('ticket/index'); ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>    
                                <?php echo $this->customlib->getCSRF(); ?>
								<input type="hidden" name="school_id" value="<?php echo $domain_api_data['id']; ?>">
								<input type="hidden" name="school_code_id" value="<?php echo $domain_api_data['code_year'].$domain_api_data['code_number']; ?>">
								<input type="hidden" name="school_name" value="<?php echo $domain_api_data['name']; ?>">
								<div class="form-group">
									<label>Ticket Type</label><small class="req"> *</small>
									<select autofocus="" id="" name="ticket_type" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
										foreach ($ticket_type as $t=>$val) {
										?>
											<option <?php
											if (
												$t == set_value(
													'ticket_type',
													isset($edit_ticket['ticket_type']) ? $edit_ticket['ticket_type'] : ''
												)
											) {
												echo "selected";
											}
											?> value="<?php echo $t ?>"><?php echo $val ?></option>
										<?php
											}
										?>
									</select>
									<span class="class_id_error text-danger"><?php echo form_error('ticket_type'); ?></span>
								</div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ticket Subject</label><small class="req"> *</small>
                                    <input autofocus="" id="ticket_subject" name="ticket_subject" placeholder="Ticket Subject" type="text" class="form-control"  value="<?php echo set_value(
																'ticket_subject',
																isset($edit_ticket['subject']) ? $edit_ticket['subject'] : ''
															); ?>" />
                                    <span class="text-danger"><?php echo form_error('ticket_subject'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ticket Body</label><small class="req"> *</small>
                                    <textarea id="ticket_body" name="ticket_body" placeholder="Ticket Body" type="text" class="form-control" rows="4"><?php
											echo set_value(
												'ticket_body',
												isset($edit_ticket['body']) ? $edit_ticket['body'] : ''
											);
										?></textarea>
                                    <span class="text-danger"><?php echo form_error('ticket_body'); ?></span>
                                </div>
                                <div class="form-group">
									<label>Files</label>
									<input type="file"
										   name="files[]"
										   multiple
										   class="filestyle form-control"
										   data-height="40"
										   id="ticketFiles">

									<br>

									<div class="row preview-wrapper" id="preview-container" class="row"></div>
								</div>
								<?php if (!empty($edit_ticket['files'])) { ?>

									<hr>

									<div class="row">

										<?php foreach ($edit_ticket['files'] as $file) { ?>

											<?php
											$file_url = CRM_URL . 'uploads/tickets/' . $file['file'];

											$ext = strtolower(pathinfo($file['file'], PATHINFO_EXTENSION));

											$image_ext = ['jpg','jpeg','png','gif','webp'];
											?>

											<div class="col-sm-4 col-md-3 col-xs-6 existing-file-<?php echo $file['id']; ?>">

												<div class="img_div_modal image_div">

													<div class="fadeoverlay">

														<div class="fadeheight">

															<?php if (in_array($ext, $image_ext)) { ?>

																<img src="<?php echo $file_url; ?>">

															<?php } else { ?>

																<img src="https://cdn-icons-png.flaticon.com/512/136/136521.png">

															<?php } ?>

														</div>

														<div class="overlay3">

															<a target="_blank"
															   href="<?php echo $file_url; ?>"
															   class="uploadcheckbtn">
																<i class="fa fa-eye"></i>
															</a>

															<a href="javascript:void(0)"
															   class="uploadclosebtn delete-file"
															   data-id="<?php echo $file['id']; ?>">
																<i class="fa fa-trash-o"></i>
															</a>

														</div>

														<p class="file-name">
															<?php echo basename($file['file']); ?>
														</p>

													</div>

												</div>

											</div>

										<?php } ?>

									</div>

								<?php } ?>
							</div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">
									<?php
									if (!empty($edit_ticket)) {
										echo "Update";
									} else {
										echo $this->lang->line('save');
									}
									?>
								</button>
                            </div>
                        </form>
                    </div>  
                </div> 
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('create_ticket', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Ticket List</h3>                   
                    </div>
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('ticket_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($ticketlist as $ticket) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"><?php echo $ticket['subject']; ?></td>
                                            <td>
												<?php

												if ($ticket['ticket_type'] == 0) {

													echo 'Normal';

												} elseif ($ticket['status'] == 1) {

													echo 'Priority';
												}

												?>
											</td>
                                            <td>
												<?php

												if ($ticket['status'] == 1) {

													echo '<span class="label label-warning">Pending</span>';

												} elseif ($ticket['status'] == 2) {

													echo '<span class="label label-primary">Open</span>';

												} elseif ($ticket['status'] == 3) {

													echo '<span class="label label-success">Close</span>';
												}

												?>
											</td>
											<td>
												<?php echo date('d-m-Y', strtotime($ticket['created_at'])); ?>
											</td>
                                            <td  class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('create_ticket', 'can_edit')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>ticket/index/<?php echo $ticket['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('create_ticket', 'can_delete')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>ticket/delete/<?php echo $ticket['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

        </div> 
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script>

$(document).on('click', '.delete-file', function () {

    if (!confirm('Delete this file?')) {
        return false;
    }

    var file_id = $(this).data('id');

    var button = $(this);

    $.ajax({
        url: '<?php echo CRM_URL; ?>api/Ticket/delete_ticket_file/' + file_id,
        type: 'GET',
        success: function (response) {

            $('.existing-file-' + file_id).remove();
        }
    });

});

</script>
<script>

let selectedFiles = [];

$('#ticketFiles').on('change', function (e) {

    selectedFiles = Array.from(e.target.files);

    renderPreviews();
});

function renderPreviews()
{
    $('#preview-container').html('');

    selectedFiles.forEach((file, index) => {

        let reader = new FileReader();

        reader.onload = function (e) {

            let image = e.target.result;

            let html = `
                <div class="col-sm-4 col-md-3 col-xs-6 preview-${index}">

                    <div class="img_div_modal image_div">

                        <div class="fadeoverlay">

                            <div class="fadeheight">

                                <img src="${image}">

                            </div>

                            <div class="overlay3">

                                <a href="javascript:void(0)"
                                   class="uploadclosebtn remove-file"
                                   data-index="${index}">
                                    <i class="fa fa-trash-o"></i>
                                </a>

                            </div>

                            <p class="file-name">
                                ${file.name}
                            </p>

                        </div>

                    </div>

                </div>
            `;

            $('#preview-container').append(html);
        };

        reader.readAsDataURL(file);
    });

    updateFileInput();
}

$(document).on('click', '.remove-file', function () {

    let index = $(this).data('index');

    selectedFiles.splice(index, 1);

    renderPreviews();
});

function updateFileInput()
{
    let dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    document.getElementById('ticketFiles').files = dataTransfer.files;
}

</script>