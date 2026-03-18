<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('expenses'); ?> <small><?php echo $this->lang->line('student_fee'); ?></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('add_expense', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_expense'); ?></h3>
                        </div><!-- /.box-header -->
						

                        <form id="form1" action="<?php echo base_url() ?>admin/expense/index"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('expense_head'); ?></label> <small class="req">*</small>

                                    <select autofocus="" id="exp_head_id" name="exp_head_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($expheadlist as $exphead) {
                                            ?>
                                            <option value="<?php echo $exphead['id'] ?>"<?php
                                            if (set_value('exp_head_id') == $exphead['id']) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $exphead['exp_category'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exp_head_id'); ?></span>
                                </div>
								
								<div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('staff'); ?></label> <small class="req">*</small>
									<select name="staff_id" class="form-control">
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php 
										foreach($staffList as $staff)
										{
										?>
											<option value="<?php echo $staff['id'];?>"><?php echo $staff['name'].' ('.$staff['user_type'].')' ;?></option>
										<?php 
										}
										?>
									</select>
                                    <span class="text-danger"><?php echo form_error('staff_id'); ?></span>
                                </div>

                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label> <small class="req">*</small>
                                    <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_no'); ?></label>
                                    <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no'); ?>" />
                                    <span class="text-danger"><?php echo form_error('invoice_no'); ?></span>
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label> <small class="req">*</small>
                                    <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                    <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control"  value="<?php echo set_value('documents'); ?>" />
                                    <span class="text-danger"><?php echo form_error('documents'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('add_expense', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('expense_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('expense_list'); ?></div>
                            <div class="table-responsive"> 
                                <table class="table table-hover table-striped table-bordered example">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('invoice_no'); ?>
                                            </th>
											<th><?php echo $this->lang->line('staff'); ?>
                                            </th>
											<th><?php echo $this->lang->line('expense_head'); ?>
                                            </th>
                                            <th><?php echo $this->lang->line('date'); ?>
                                            </th>
                                           
                                            <th><?php echo $this->lang->line('amount'); ?>
                                            </th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$tot_amt = 0;
                                        if (empty($expenselist)) {
                                            ?>

                                            <?php
                                        } else {
                                            foreach ($expenselist as $expense) {
												
												$staffDetls = $this->staff_model->get($expense['staff_id']);
                                                ?>
                                                <tr>
                                                    <td class="mailbox-name"><?php echo $expense["id"]; ?></td>
													<td class="mailbox-name"><?php echo $staffDetls['name'] .' ('.$staffDetls['user_type'] .')'; ?></td>
													 <td class="mailbox-name">
                                                        <?php echo $expense['exp_category'] ?>

                                                    </td>
                                                    <td class="mailbox-name">

                                                        <?php echo date('d-m-Y', strtotime($expense['date'])) ?></td>

                                                   
                                                    <td class="mailbox-name"><?php echo ($currency_symbol .' '.$expense['amount']); ?></td>
                                                    <td class="mailbox-date pull-right">
														<a href="javascript:void(0)" data-id="<?php echo $income["id"]; ?>" class="btn btn-default btn-xs print_receipt" data-toggle="tooltip" title="" data-original-title="Print Receipt">
															<i class="fa fa-print"></i>
														</a>
                                                        <?php if ($expense['documents']) {
                                                            ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/expense/download/<?php echo $expense['documents'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        <?php }
                                                        ?>
                                                        <?php
                                                        if ($this->rbac->hasPrivilege('add_expense', 'can_edit')) {
                                                            ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/expense/edit/<?php echo $expense['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('add_expense', 'can_delete')) {
                                                            ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/expense/delete/<?php echo $expense['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
												
												$tot_amt = $tot_amt + $expense['amount'];
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table><!-- /.table -->

                            </div>  
							
							<span class="text-right"><h4><strong>Total expense: <?php echo (isset($tot_amt) ? $currency_symbol . $tot_amt : 0); ?></h4></strong></span>

                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
	<div class="abc"></div>
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(document).on('click', '.print_receipt', function(){
		var id = $(this).data('id');
		var base_url = '<?php echo base_url() ?>';
		
		$.ajax({
			type: "POST",
			url: base_url + "admin/income/printIncome",
            data: {'id': id},
			dataType: "JSON", // serializes the form's elements.
			success: function (response)
			{
				// $(".abc").html(response.page);
				Popup(response.page);
			},
			error: function (xhr) { // if error occured
				alert("Error occured.please try again");
			},
			complete: function () {
				
			}
		});
	});
	function Popup(data)
	{

		var frame1 = $('<iframe />');
		frame1[0].name = "frame1";
		$("body").append(frame1);
		var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
		frameDoc.document.open();
	//Create a new HTML document.
		frameDoc.document.write('<html>');
		frameDoc.document.write('<head>');
		frameDoc.document.write('<title></title>');
		frameDoc.document.write('</head>');
		frameDoc.document.write('<body>');
		frameDoc.document.write(data);
		frameDoc.document.write('</body>');
		frameDoc.document.write('</html>');
		frameDoc.document.close();
		setTimeout(function () {
			window.frames["frame1"].focus();
			window.frames["frame1"].print();
			frame1.remove();
		}, 500);
		return true;
	}
    $(document).ready(function () {


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>