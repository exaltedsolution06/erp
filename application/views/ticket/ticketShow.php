<style>
.timeline-wrapper {
    position: relative;
    background: #fff;
    padding: 30px 20px;
    border-radius: 6px;
}

/* Center Vertical Line */
.timeline-line {
    position: absolute;
    left: 50%;
    top: 20px;
    bottom: 20px;
    width: 2px;
    background: #d9d9d9;
    transform: translateX(-50%);
}

/* Timeline Item */
.timeline-item {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    display: flex;
    /*align-items: center;*/
}

/* Left Side */
.timeline-item.left {
    justify-content: flex-start;
}

/* Right Side */
.timeline-item.right {
    justify-content: flex-end;
}

/* Card */
.timeline-card {
    width: 45%;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 12px;
    position: relative;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.timeline-card h4 {
    margin: 0 0 7px 0;
    font-size: 15px;
    font-weight: 600;
}

.timeline-card .date {
    display: block;
    color: #666;
    font-size: 14px;
}

/* Arrow */
.timeline-item.left .timeline-card::after {
    content: "";
    position: absolute;
    top: 15px;
    right: -8px;
    width: 15px;
    height: 15px;
    background: white;
    border-top: 1px solid #ddd;
    border-right: 1px solid #ddd;
    transform: rotate(45deg);
}

.timeline-item.right .timeline-card::after {
    content: "";
    position: absolute;
    top: 15px;
    left: -8px;
    width: 15px;
    height: 15px;
    background: white;
    border-left: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    transform: rotate(45deg);
}

/* Timeline Icon */
.timeline-icon {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 50px;
    background: #18c08f;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    z-index: 10;
}

/* Actions */
.date-actions {
    display: flex;
    justify-content: space-between;
}
.actions {
    display: flex;
}

.actions a {
    text-decoration: none;
    color: #666;
    margin-left: 10px;
    font-size: 14px;
}

.actions a:hover {
    color: #18c08f;
}

/* Mobile */
@media (max-width: 768px) {

    .timeline-line {
        left: 25px;
    }

    .timeline-item {
        justify-content: flex-start !important;
        padding-left: 60px;
    }

    .timeline-card {
        width: 100%;
    }

    .timeline-icon {
        left: 25px;
    }

    .timeline-item.left .timeline-card::after,
    .timeline-item.right .timeline-card::after {
        left: -8px;
        right: auto;
        border-left: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        border-top: none;
        border-right: none;
    }
}
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">                
                <div class="box box-primary">
					<div class="box-body box-profile">
						<h4><?php echo $ticket['subject']; ?></h4>
						<p><?php echo $ticket['body']; ?></p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item listnoback">
								<b>Created Date</b> <a class="pull-right text-aqua"><?= !empty($ticket['created_at']) ? date('d/m/Y', strtotime($ticket['created_at'])) : '' ?></a>
							</li> 
							<li class="list-group-item listnoback">
								<b>Type</b> <a class="pull-right text-aqua"><?= $ticket_type[$ticket['ticket_type']] ?></a>
							</li> 
							<li class="list-group-item listnoback">
								<b>Status</b> <a class="pull-right text-aqua">
									<?php

									if ($ticket['status'] == 1) {

										echo '<span class="label label-warning">Pending</span>';

									} elseif ($ticket['status'] == 2) {

										echo '<span class="label label-primary">Open</span>';

									} elseif ($ticket['status'] == 3) {

										echo '<span class="label label-success">Close</span>';
									}

									?>
								</a>
							</li> 
						</ul> 
						<?php if (!empty($ticket['files'])) { ?>
							<div class="row">
								<?php foreach ($ticket['files'] as $file) { ?>
									<?php
									$file_url = CRM_URL . 'uploads/tickets/' . $file['file'];
									$ext = strtolower(pathinfo($file['file'], PATHINFO_EXTENSION));
									$image_ext = ['jpg','jpeg','png','gif','webp'];
									?>
									<div class="col-sm-6 col-md-6 col-xs-6 existing-file-<?php echo $file['id']; ?>">
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
				</div> 
            </div> 
            <div class="col-md-9">
			<?php 
				if(!empty($ticket['ticket_followup'])){
			?>
					<?php if ($this->session->flashdata('msg')) { ?>
						<?php echo $this->session->flashdata('msg') ?>
					<?php } ?>    
				<div class="timeline-wrapper">
				<div style="max-height: 500px; overflow: auto;">
					<!-- Timeline Center Line -->
					<div class="timeline-line"></div>
					<?php
						foreach($ticket['ticket_followup'] as $row){
							$is_user = ($row['user_type'] == 1) ? 'right' : 'left';
					?>
					<!-- Item 2 -->
					<div class="timeline-item <?= $is_user ?>">
						<div class="timeline-icon">
							<?php if($row['user_type'] == 1){ ?>
							<i class="fas fa-user"></i>
							<?php } else { ?>							
							<img src="<?php echo CRM_URL ?>assets/img/favicon.png"></i>
							<?php } ?>
						</div>

						<div class="timeline-card">
							<h4><?= $row['message'] ?></h4>
							<?php if(!empty($row['image'])){ ?>
								<div style="margin-top:10px;">
									<a href="<?= CRM_URL . 'uploads/followups/' . $row['image'] ?>" target="_blank">
										<img src="<?= CRM_URL . 'uploads/followups/' . $row['image'] ?>"
											 style="max-width:100px;border-radius:8px;">
									</a>
								</div>
							<?php } ?>
							<div class="date-actions">
								<span class="date"><?php echo isset($row['created_at']) ? date('d/m/Y', strtotime($row['created_at'])) : '' ?></span>
								<?php if($row['user_type'] == 1){ ?>
									<div class="actions">
										<a href="javascript:void(0)" class="edit-followup" data-id="<?= $row['id'] ?>"><i class="fas fa-pen-to-square"></i> Edit</a>
										<a href="javascript:void(0)" class="delete-followup" data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i> Delete</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				</div>
				<?php if($ticket['status'] == 3){ ?>
				<div class="alert alert-danger" style="margin-top: 5px;" role="alert">
					Ticket Closed!
				</div>
				<?php } ?>
			<?php 
				}else{
			?>
				<h4 class="text-center">No Followup</h4>
			<?php } ?>
				<?php if($ticket['status'] != 3){ ?>
				<div class="text-right" style="margin-top: 10px;">
					<button type="button" class="btn btn-primary" id="addFollowupBtn"><i class="fa fa-plus"></i> Add Followup</button>
				</div>
				<?php } ?>				
            </div> 
        </div> 
    </section>
</div>
<?php if($ticket['status'] != 3){ ?>
<div class="modal fade" id="followupModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="followupForm" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">Followup</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" id="followup_id">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
					<input type="hidden" name="old_image" id="old_image">

                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control" name="message" id="message" required />
                    </div>
					<div class="form-group">
						<label>Upload Image</label>

						<input type="file"
							   class="filestyle form-control"
							   name="followup_image"
							   id="followup_image"
							   accept="image/*">
					</div>
					<div id="image_preview_div" style="display:none;margin-top:10px;">
						<img id="image_preview"
							 src=""
							 style="max-width:100px;border-radius:8px;">
					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<?php } ?>
<script>

var addUrl = "<?= base_url('ticket/add_followup') ?>";
var editUrl = "<?= base_url('ticket/get_followup') ?>";
var deleteUrl = "<?= base_url('ticket/delete_followup') ?>";

$(document).ready(function () {

    $('#addFollowupBtn').click(function () {

        $('#followupForm')[0].reset();

        $('#followup_id').val('');
        $('#old_image').val('');

        $('#image_preview_div').hide();
        $('#image_preview').attr('src', '');

        $('.modal-title').text('Add Followup');

        $('#followupModal').modal('show');
    });

});

/* EDIT */
$(document).on('click', '.edit-followup', function () {

    var id = $(this).data('id');

    $.ajax({
        url: editUrl,
        type: 'POST',
        data: { id: id },
        dataType: 'json',

        success: function (response) {

            $('#followup_id').val(response.id);
            $('#message').val(response.message);

            $('#old_image').val(response.image);

            if(response.image){

                $('#image_preview').attr(
                    'src',
                    "<?= CRM_URL . 'uploads/followups/' ?>" + response.image
                );

                $('#image_preview_div').show();

            } else {

                $('#image_preview_div').hide();
            }

            $('.modal-title').text('Edit Followup');

            $('#followupModal').modal('show');
        }
    });

});

/* IMAGE PREVIEW */
$('#followup_image').change(function(){

    let file = this.files[0];

    if(file){

        let reader = new FileReader();

        reader.onload = function(e){

            $('#image_preview').attr('src', e.target.result);

            $('#image_preview_div').show();
        };

        reader.readAsDataURL(file);
    }
});

/* SAVE */
$('#followupForm').submit(function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: addUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',

        success: function (response) {

            if (response.status == 1) {

                $('#followupModal').modal('hide');

                location.reload();

            } else {

                alert(response.message);
            }
        }
    });

});

/* DELETE */
$(document).on('click', '.delete-followup', function () {

    var id = $(this).data('id');

    if (!confirm('Are you sure?')) {
        return false;
    }

    $.ajax({
        url: deleteUrl,
        type: 'POST',
        data: { id: id },
        dataType: 'json',

        success: function (response) {

            if (response.status == 1) {

                location.reload();
            }
        }
    });

});

</script>

