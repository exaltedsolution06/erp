

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?><style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('income'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('add_income', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_income'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" action="<?php echo base_url() ?>admin/income/index"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('income_head'); ?></label><small class="req"> *</small>

                                    <select autofocus="" id="inc_head_id" name="inc_head_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($incheadlist as $inchead) {
                                            ?>
                                            <option value="<?php echo $inchead['id'] ?>"<?php
                                            if (set_value('inc_head_id') == $inchead['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $inchead['income_category'] ?></option>

                                            <?php
                                            //$count++;
                                        }
                                        ?>
                                    </select><span class="text-danger"><?php echo form_error('inc_head_id'); ?></span>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('student'); ?></label>

                                    <select autofocus="" id="student_id" name="student_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($student_list as $list) {
                                            ?>
                                            <option value="<?php echo $list['id'] ?>"<?php
                                            if (set_value('student_id') == $list['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $list['firstname'] ?></option>

                                            <?php
                                            //$count++;
                                        }
                                        ?>
                                    </select><span class="text-danger"><?php echo form_error('student_id'); ?></span>

                                </div>

                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                    <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_no'); ?></label>
                                    <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no'); ?>" />
                                    <span class="text-danger"><?php echo form_error('invoice_no'); ?></span>
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date'); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?><small class="req"> *</small></label>
                                    <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                    <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" data-height="40"  value="<?php echo set_value('documents'); ?>" />
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
            if ($this->rbac->hasPrivilege('add_income', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('income_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('income_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <!--<th><?php echo $this->lang->line('name'); ?>
                                        </th>-->
                                        <th><?php echo $this->lang->line('invoice_no'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
										<th><?php echo $this->lang->line('student_name'); ?>
                                        </th>
										<th><?php echo $this->lang->line('father_name'); ?>
                                        </th>
										<th><?php echo $this->lang->line('income_head'); ?>
                                        </th>
                                        
                                        <th><?php echo $this->lang->line('amount'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$tot_amt = 0;
                                    if (empty($incomelist)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($incomelist as $income) {
											$this->load->model('Student_model');
											$students = $this->Student_model->get($income['student_id']);
											//echo "<pre>";print_r($students);die;
                                            ?>
                                            <tr>
                                                
                                                <td class="mailbox-name">
                                                    <?php echo $income["receipt_no"] == null ? $income["id"] : $income["receipt_no"]; ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date('d-m-Y', strtotime($income['date'])); ?></td>
												<td class="mailbox-name">
                                                    <?php echo $students['firstname'];?>
                                                </td>
												<td class="mailbox-name">
                                                    <?php echo $students['father_name'];?>
                                                </td>
												<td class="mailbox-name">
                                                    <?php
                                                    $income_head = $income['income_category'];
                                                    echo !empty($income_head) ? "$income_head" : '--';
                                                    ?>
												</td>

                                                

                                                <?php
                                                $inc_head_id = $income['inc_head_id'];
                                                $arr1 = str_split($inc_head_id);
                                                ?>

                                                <td class="mailbox-name"><?php echo ($currency_symbol .' '. format_amount($income['amount'])); ?></td>
                                                <td class="mailbox-date pull-right">
													<a href="javascript:void(0)" data-id="<?php echo $income["id"]; ?>" class="btn btn-default btn-xs print_receipt" data-toggle="tooltip" title="" data-original-title="Print Receipt">
														<i class="fa fa-print"></i>
													</a>
													
                                                    <?php if ($income['documents']) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/income/download/<?php echo $income['documents'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    <?php }
                                                    ?>

                                                    <?php
                                                    if ($this->rbac->hasPrivilege('add_income', 'can_edit')) {
														if($income["receipt_no"] == null)
														{
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/income/edit/<?php echo $income['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php 
														}
													} ?>
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('add_income', 'can_delete')) {
														
														if($income["receipt_no"] == null)
														{
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/income/delete/<?php echo $income['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php 
														}
													} ?>
                                                </td>
                                            </tr>
                                            <?php
											$tot_amt = $tot_amt + $income['amount'];
                                        }
                                    }
                                    ?>

                                </tbody>
								
                            </table><!-- /.table -->
							
						</div><!-- /.mail-box-messages -->
						<span class="text-right"><h4><strong>Total income: <?php echo (isset($tot_amt) ? $currency_symbol . $tot_amt : 0); ?></h4></strong></span>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
	<div class="abc"></div>
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(document).on('click', '.print_receipt', function(){
		var id = $(this).data('id');
		var base_url = '<?php echo base_url() ?>';
		var balance_type = 0;
		//alert(id);
		$.ajax({
			type: "POST",
			url: base_url + "admin/income/printIncome",
            data: {'id': id, 'balance_type':balance_type},
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
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    customize: function (win) {
                        alert();
                    }
                }
            ]
        });
    });
</script>