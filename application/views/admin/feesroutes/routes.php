<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<style>
     td i.fa-solid {
        font-size: 18px;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">




        <?php if($type=='edit'){
            //var_dump($feedata);
            ?>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Route</h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feesroutes/submit_fee_head" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">

                                <?php if ($this->session->flashdata('msg')): ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php endif; ?>

                                <?php if (isset($error_message)): ?>
                                    <div class='alert alert-danger'><?php echo $error_message; ?></div>
                                <?php endif; ?>

                                <?php echo $this->customlib->getCSRF(); ?>

                                <?php
                                // Set defaults
                                $fees_heading = isset($feedata[0]['fees_heading']) ? $feedata[0]['fees_heading'] : '';
                                $frequency = isset($feedata[0]['frequency']) ? $feedata[0]['frequency'] : '';
                                $account_name = isset($feedata[0]['account_name']) ? $feedata[0]['account_name'] : '';
                                $selected_months = [];

                                if (!empty($feedata[0]['months'])) {
                                    // Clean and parse: remove brackets and quotes
                                    $months_str = trim($feedata[0]['months'], '[]"');
                                    $selected_months = explode(',', str_replace('"', '', $months_str));
                                }
                                ?>

                                <!-- Hidden ID for update -->
                                <input type="hidden" name="update_id" value="<?php echo isset($feedata[0]['id']) ? $feedata[0]['id'] : ''; ?>">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="feesHeading" class="form-label">Enter Route Name</label>
                                            <input type="text" class="form-control" id="feesHeading" name="fees_heading"
                                                value="<?php echo htmlspecialchars($fees_heading); ?>" placeholder="Route Name">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="frequency" class="form-label">Select Fee Frequency</label>
                                        <select class="form-control" id="frequency" name="frequency" required>
                                            <option value="">--Select--</option>
                                            <?php
                                            $frequencies = ['Annual', 'Quarterly', 'Monthly'];
                                            foreach ($frequencies as $freq):
                                                $selected = ($freq == $frequency) ? 'selected' : '';
                                                echo "<option value=\"$freq\" $selected>$freq</option>";
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
									<div class="col-sm-4">
                                        <label for="accountName" class="form-label">Select Account Name</label>
                                        <!-- accouns -->
                                         <select class="form-control" id="account_name" name="account_name" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($account as $row){ 
												$selected_account = ($row['account'] == $account_name) ? 'selected' : '';
											?>
                                                <option <?php echo $selected_account; ?>>
                                                    <?=$row['account']?>
                                                </option>
                                            <?php } ?>
                                         </select>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 h5" style="margin: 20px 0px;text-align:center">
                                        <b>Select Months in which this Fees becomes due towards students</b>
                                    </div>

                                    <div class="col-sm-12">
                                        <?php
                                        $months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];
                                        foreach ($months as $month):
                                            $checked = in_array($month, $selected_months) ? 'checked' : '';
                                        ?>
                                            <div class="col-6 col-md-2 month-checkbox">
                                                <input class="form-check-input month-check" type="checkbox" name="months[]"
                                                    value="<?= $month ?>" id="<?= strtolower($month) ?>" <?= $checked ?>>
                                                <label for="<?= strtolower($month) ?>"><?= $month ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12" style="margin: 20px 0px;text-align:center">
                                        <b class="text-danger" id="errorList"></b>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">
                                        <?php echo $this->lang->line('update'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            
            
            <?php

        }else{

         ?>




        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('fees_type', 'can_add')) {
                ?>
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Route</h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feesroutes/submit_fee_head"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
								<?php 
									$old_input = $this->session->flashdata('old_input') ?? [];
									$selected_frequency = $old_input['frequency'] ?? '';

									// 👇 Add this
									if (!$this->session->flashdata('msg') || strpos($this->session->flashdata('msg'), 'alert-danger') === false) {
										// Clear month selection completely if not from an error
										$selected_months = [];
									}
								?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="feesHeading" class="form-label">Enter Route Name</label>
                                            <input type="text" class="form-control" id="feesHeading" name="fees_heading" value="<?php
												echo isset($old_input['fees_heading'])
													? htmlspecialchars($old_input['fees_heading'])
													: set_value('fees_heading');
											?>" placeholder="Route Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
										<label for="frequency" class="form-label">Select Fee Frequency</label>
										<select class="form-control" id="frequency" name="frequency" required>
											<option value="">--Select--</option>
											<option value="Annual" <?php echo $selected_frequency == 'Annual' ? 'selected' : set_select('frequency', 'Annual'); ?>>Annual</option>
											<option value="Quarterly" <?php echo $selected_frequency == 'Quarterly' ? 'selected' : set_select('frequency', 'Quarterly'); ?>>Quarterly</option>
											<option value="Monthly" <?php echo $selected_frequency == 'Monthly' ? 'selected' : set_select('frequency', 'Monthly'); ?>>Monthly</option>
										</select>
									</div>
									<div class="col-sm-4">
                                        <label for="accountName" class="form-label">Select Account Name</label>
                                        <!-- accouns -->
                                         <select class="form-control" id="account_name" name="account_name" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($account as $row){ 
												$isSelected = ($selected_account == $row['account']) ? 'selected' : '';
											?>
                                                <option value="<?= htmlspecialchars($row['account']) ?>" <?= $isSelected ?>>
													<?= htmlspecialchars($row['account']) ?>
												</option>
                                            <?php } ?>
                                         </select>
                                        
                                    </div>
                                    
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 h5" style="margin: 20px 0px 20px 0px;text-align:center">
                                         <b>Select Months in which this Fees becomes due towards students</b>
                                    </div>
									
	
                                    <div class="col-sm-12">
                                        <?php
                                            $months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
                                            foreach ($months as $month):
												$checked = in_array($month, $selected_months) ? 'checked' : '';
										?>
                                            <div class="col-6 col-md-2 month-checkbox">
                                                <input class="form-check-input month-check" type="checkbox" name="months[]" value="<?= $month ?>" id="<?= strtolower($month) ?>" <?php echo $checked; ?>>
                                                <label for="<?= strtolower($month) ?>"><?= $month ?></label>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12" style="margin: 20px 0px 20px 0px;text-align:center">
                                        <b class="text-danger" id="errorList"></b>
                                    </div>
                                </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('fees_type', 'can_add')) {
                echo "12";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Route List</h3>
                    </div>
                    <div class="box-body">
                        <div class="mt-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-3">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Route Id</th>
                                        <th>Route Name</th>
                                        <th>Frequency</th>
                                        <th>Account Name</th>                                        
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Action</th>


                                    </tr>
                                    </thead>
                                    <tbody id="feesTableBody">
                                        <?php foreach ($fee_heads as $fee): 
                                            $selected_months = json_decode($fee['months'], true); // decode stored months
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($fee['id']) ?></td>
                                            <td><?= htmlspecialchars($fee['fees_heading']) ?></td>
                                            <td><?= htmlspecialchars($fee['frequency']) ?></td>
											<td><?= htmlspecialchars($fee['account_name']) ?></td>
                                            <?php 
                                            $months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
                                            foreach ($months as $month): 
                                                $isChecked = in_array($month, $selected_months);
                                            ?>
                                                <!-- <td>
                                                    <input type="checkbox" disabled <?= in_array($month, $selected_months) ? 'checked' : '' ?>>
                                                </td> -->
                                                 <td class="text-left">
                                                    <i class="fa-solid <?= $isChecked ? 'fa-circle-check text-success' : 'fa-circle-xmark text-danger' ?>"></i>
                                                </td>
                                                <?php endforeach; ?>

                                                

                                                <td>
                                                    <a data-placement="left" href="<?php echo site_url('admin/feesroutes/edit/' . $fee['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a data-placement="left" href="<?php echo site_url('admin/feesroutes/delete/' . $fee['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                </td>

                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

                                            
        <?php } ?>












        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
document.addEventListener('DOMContentLoaded', function () {
    const frequencySelect = document.getElementById('frequency');
    const monthCheckboxes = document.querySelectorAll('.month-check');
    const errorBox = $("#errorList");

    const presetMonths = {
        Annual: ['apr'],
        Quarterly: ['apr', 'jul', 'oct', 'jan'],
        Monthly: ['apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'jan', 'feb', 'mar']
    };

    function checkMonths(monthIds) {
        monthCheckboxes.forEach(cb => cb.checked = false);
        monthIds.forEach(id => $('#' + id).prop('checked', true));
    }

    function validateCheckedMonths(changedBox) {
        const frequency = frequencySelect.value;
        const checkedCount = document.querySelectorAll('.month-check:checked').length;
        errorBox.html('');

        if (!frequency) {
            errorBox.html("Please select Frequency first.");
            changedBox.checked = false;
            return;
        }

        if (frequency === 'Annual' && checkedCount > 1) {
            errorBox.html("Only 1 month can be selected for Annual frequency.");
            changedBox.checked = false;
        } 
        else if (frequency === 'Quarterly' && checkedCount > 4) {
            errorBox.html("Only 4 months can be selected for Quarterly frequency.");
            changedBox.checked = false;
        } 
        else if (frequency === 'Monthly') {
            if (checkedCount > 12) {
                errorBox.html("Maximum 12 months can be selected for Monthly frequency.");
                changedBox.checked = false;
            } 
            else if (checkedCount < 1) {
                errorBox.html("At least 1 month must be selected for Monthly frequency.");
            }
        }
    }

    // On frequency change, reselect default months
    frequencySelect.addEventListener('change', function () {
        const frequency = this.value;
        errorBox.html('');

        if (presetMonths[frequency]) {
            checkMonths(presetMonths[frequency]);
        } else {
            monthCheckboxes.forEach(cb => cb.checked = false);
        }
    });

    // Manual checkbox change validation
    monthCheckboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            validateCheckedMonths(this);
        });
    });

    // 🟢 Auto-set if frequency is already selected (like after PHP error reload)
    const currentFrequency = frequencySelect.value;
    const anyChecked = document.querySelectorAll('.month-check:checked').length > 0;

    if (currentFrequency && !anyChecked && presetMonths[currentFrequency]) {
        // only auto-check if none are selected yet (fresh or after error)
        checkMonths(presetMonths[currentFrequency]);
    }
});
</script>




<!--<script>
    document.addEventListener('DOMContentLoaded', function () {
        const frequencySelect = document.getElementById('frequency');
        const monthCheckboxes = document.querySelectorAll('.month-check');
		const frequency = frequencySelect.value;
        function getCheckedCount() {
            return document.querySelectorAll('.month-check:checked').length;
        }
		alert(frequency);
		if (frequency === 'Monthly') {
			monthCheckboxes.forEach(checkbox => checkbox.checked = true);
		}else if (frequency === 'Quarterly') {
			$('#apr, #jul, #oct, #jan').prop('checked', true);
		}else if (frequency === 'Annual') {
			$('#apr').prop('checked', true);
		}
        
        function validateCheckedMonths(checkbox) {
            //const frequency = frequencySelect.value;
            const checkedCount = getCheckedCount();
			//alert(frequency);

            if (!frequency) {
                $("#errorList").html("Please select Frequency first.");
                checkbox.checked = false;
                return;
            }

            if (frequency === 'Annual' && checkedCount > 1) {
                $("#errorList").html("Only 1 month can be selected for Annual frequency.");
                checkbox.checked = false;
            } else if (frequency === 'Quarterly' && checkedCount > 3) {
                $("#errorList").html("Only 3 months can be selected for Quarterly frequency.");
                checkbox.checked = false;
            } else if (frequency === 'Monthly' && checkedCount > 12) {
                $("#errorList").html("All 12 months must be selected for Monthly frequency.");
                checkbox.checked = false;
            }
        }

        // Attach change event to all month checkboxes
        monthCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                $("#errorList").html('');
                validateCheckedMonths(checkbox);
            });
        });

        // Clear all checkboxes on frequency change
        frequencySelect.addEventListener('change', function () {
            $("#errorList").html('');
            monthCheckboxes.forEach(checkbox => checkbox.checked = false);
			
			//alert(frequency);
			if (frequency === 'Monthly') {
				monthCheckboxes.forEach(checkbox => checkbox.checked = true);
			}else if (frequency === 'Quarterly') {
				$('#apr, #jul, #oct, #jan').prop('checked', true);
			}else if (frequency === 'Annual') {
				$('#apr').prop('checked', true);
			}
        });
    });
</script>-->
