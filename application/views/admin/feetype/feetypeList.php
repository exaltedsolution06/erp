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
            ?>
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Fees Head</h3>
                        </div>

                        <form id="form1" action="<?php echo base_url() ?>admin/feetype/submit_fee_head" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <input type="hidden" name="update_id" value="<?=$feetype['id']?>">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                } ?>
                                <?php echo $this->customlib->getCSRF(); ?>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="feesHeading" class="form-label">Enter Fee Head</label>
                                            <input type="text" class="form-control"  id="feesHeading" name="fees_heading" placeholder="Fee Head"
                                                value="<?php echo isset($feetype['fees_heading']) ? $feetype['fees_heading'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="frequency" class="form-label">Select Fee Frequency</label>
                                        <select class="form-control" id="frequency" name="frequency" required>
                                            <option value="">--Select--</option>
                                            <option value="Annual" <?php echo (isset($feetype['frequency']) && $feetype['frequency'] == 'Annual') ? 'selected' : ''; ?>>Annual</option>
                                            <option value="Quarterly" <?php echo (isset($feetype['frequency']) && $feetype['frequency'] == 'Quarterly') ? 'selected' : ''; ?>>Quarterly</option>
                                            <option value="Monthly" <?php echo (isset($feetype['frequency']) && $feetype['frequency'] == 'Monthly') ? 'selected' : ''; ?>>Monthly</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="accountName" class="form-label">Select Account Name</label>
                                        <!-- accouns -->
                                         <select class="form-control" id="account_name" name="account_name" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($account as $row){ ?>
                                                <option <?php echo $feetype['account_name'] == $row['account'] ? 'selected' : ''; ?>>
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
                                        $selected_months = isset($feetype['months']) ? json_decode($feetype['months']) : [];
                                        $months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];
                                        foreach ($months as $month): ?>
                                            <div class="col-6 col-md-2 month-checkbox">
                                                <input class="form-check-input month-check" type="checkbox" name="months[]" value="<?= $month ?>"
                                                    id="<?= strtolower($month) ?>" <?php echo in_array($month, $selected_months) ? 'checked' : ''; ?>>
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
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>

                </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            <?php
        }else{ ?>
            <div class="row">
                <?php
                if ($this->rbac->hasPrivilege('fees_type', 'can_add')) {
                ?>
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Fees Head</h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feetype/submit_fee_head"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
									$selected_account = $old_input['account_name'] ?? '';

									// 👇 Add this
									if (!$this->session->flashdata('msg') || strpos($this->session->flashdata('msg'), 'alert-danger') === false) {
										// Clear month selection completely if not from an error
										$selected_months = [];
									}
								?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="feesHeading" class="form-label">Enter Fee Head</label>
                                            <input type="text" class="form-control"  id="feesHeading" name="fees_heading" value="<?php
												echo isset($old_input['fees_heading'])
													? htmlspecialchars($old_input['fees_heading'])
													: set_value('fees_heading');
											?>" placeholder="Fee Head">
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
                        <h3 class="box-title titlefix">Fees Head List</h3>
                    </div>
                    <div class="box-body">
                        <div class="mt-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-3">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Fee Head</th>
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
                                                <a data-placement="left" href="<?php echo site_url('admin/feetype/edit/' . $fee['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a data-placement="left" href="<?php echo site_url('admin/feetype/delete/' . $fee['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
        <?php } ?>
            <!-- right column -->

        </div>
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

        function getCheckedCount() {
            return document.querySelectorAll('.month-check:checked').length;
        }
        
        function validateCheckedMonths(checkbox) {
            const frequency = frequencySelect.value;
            const checkedCount = getCheckedCount();

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
        });
    });
    
    // ---------

    function syncValues() {
        const source = document.getElementById('feesHeading').value;
        document.getElementById('account_name').value = source;
    }
</script>-->