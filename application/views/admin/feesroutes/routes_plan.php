<style type="text/css">
    .liststyle1 {
        margin: 0;
        list-style: none;
        line-height: 28px;
    }
</style>

<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <?php  if($type=='edit'){
        ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo 'Update Route Plan' ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feesroutes/plan" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">

                                <?php if ($this->session->flashdata('msg')): ?>
                                    <?php echo $this->session->flashdata('msg'); ?>
                                <?php endif; ?>

                                <?php echo $this->customlib->getCSRF(); ?>

                                <?php
                                $route_id = isset($update_data[0]['id']) ? $update_data[0]['id'] : '';
                                $selected_fee_group_id = isset($update_data[0]['fee_group_id']) ? $update_data[0]['fee_group_id'] : '';
                                $amount = isset($update_data[0]['amount']) ? $update_data[0]['amount'] : '';

                                // Parse JSON-like string values into arrays
                                $class_ids = isset($update_data[0]['class_ids']) ? json_decode($update_data[0]['class_ids'], true) : [];
                                $category_ids = isset($update_data[0]['category_ids']) ? json_decode($update_data[0]['category_ids'], true) : [];
                                ?>

                                <!-- Hidden field for route ID -->
                                <input type="hidden" name="update_id" value="<?php echo $route_id; ?>">

                                <div class="row">

                                    <!-- Route Head -->
                                    <div class="col-sm-6">
                                        <label for="fee_groups_id">Route Head <small class="req">*</small></label>
                                        <select id="fee_groups_id" name="fee_head" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($fee_heads as $feegroup): ?>
                                                <option value="<?php echo $feegroup['id']; ?>" <?php echo ($feegroup['id'] == $selected_fee_group_id) ? 'selected' : ''; ?>>
                                                    <?= $feegroup['fees_heading']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Route Value -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="amount">Route Value <small class="req">*</small></label>
                                            <input id="amount" name="amount" type="text" class="form-control" placeholder="Enter Fees Value"
                                                value="<?php echo htmlspecialchars($amount); ?>" />
                                        </div>
                                    </div>

                                    <!-- Class Selection -->
                                    <div class="col-sm-6 border">
                                        <label>Choose Classes <small class="req">*</small></label>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_classes">
                                            <label class="form-check-label" for="select_all_classes">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($classes as $class): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input class-checkbox" type="checkbox" name="classes_id[]"
                                                        id="class_<?php echo $class['id']; ?>" value="<?php echo $class['id']; ?>"
                                                        <?php echo in_array($class['id'], $class_ids) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="class_<?php echo $class['id']; ?>">
                                                        <?php echo $class['class']; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- Category Selection -->
                                    <div class="col-sm-6">
                                        <label>Choose Category <small class="req">*</small></label> <br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_categories">
                                            <label class="form-check-label" for="select_all_categories">
                                                Select All
                                            </label>
                                        </div>

                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($feegroupList as $category): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input category-checkbox" type="checkbox" name="feetype_id[]"
                                                        id="category_<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>"
                                                        <?php echo in_array($category['id'], $category_ids) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="category_<?php echo $category['id']; ?>">
                                                        <?php echo $category['name']; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        <?php

        }else{

         ?>

        <div class="row">
            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_add')) {
                ?>
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo 'Route Plan' ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feesroutes/plan"  id="feemasterform" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="row">


                                    <div class="col-sm-6">
                                        <label for="exampleInputEmail1">Route Head</label> <small class="req">*</small>
                                        <select autofocus="" id="fee_groups_id" name="fee_head" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($fee_heads as $feegroup) {
                                                ?>
                                                <option value="<?php echo $feegroup['id'] ?>"><?= $feegroup['fees_heading'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Route Value</label><small class="req"> *</small>
                                            <input id="amount" name="amount" type="text" class="form-control" placeholder="Enter Fees Value"  value="<?php echo set_value('amount'); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 border">
                                        <label>Choose Classes</label> <small class="req">*</small><br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_classes">
                                            <label class="form-check-label" for="select_all_classes">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($classes as $feegroup): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input class-checkbox" type="checkbox" name="classes_id[]" id="class_<?= $feegroup['id'] ?>" value="<?= $feegroup['id'] ?>">
                                                    <label class="form-check-label" for="class_<?= $feegroup['id'] ?>">
                                                        <?= $feegroup['class'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <label>Choose Category</label> <small class="req">*</small><br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_categories">
                                            <label class="form-check-label" for="select_all_categories">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($feegroupList as $feetype): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input category-checkbox" type="checkbox" name="feetype_id[]" id="category_<?= $feetype['id'] ?>" value="<?= $feetype['id'] ?>">
                                                    <label class="form-check-label" for="category_<?= $feetype['id'] ?>">
                                                        <?= $feetype['name'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

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
            if ($this->rbac->hasPrivilege('fees_master', 'can_add')) {
                echo "12";
            } else {
                echo "12";
            }
            ?>">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Route Plan List</h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">

                        <form method="get" action="">
                            <div class="row mb-3">

                                <!-- Route Head Filter -->
                                <div class="col-md-3">
                                    <label>Route Head</label>
                                    <select name="fee_head" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($fee_heads as $head): ?>
                                            <option value="<?= $head['id'] ?>" <?= ($this->input->get('fee_head') == $head['id']) ? 'selected' : '' ?>>
                                                <?= $head['fees_heading'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Class Filter -->
                                <div class="col-md-3">
                                    <label>Class</label>
                                    <select name="class_id" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($classes as $class): ?>
                                            <option value="<?= $class['id'] ?>" <?= ($this->input->get('class_id') == $class['id']) ? 'selected' : '' ?>>
                                                <?= $class['class'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Category Filter -->
                                <div class="col-md-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($feegroupList as $cat): ?>
                                            <option value="<?= $cat['id'] ?>" <?= ($this->input->get('category_id') == $cat['id']) ? 'selected' : '' ?>>
                                                <?= $cat['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Value Filter -->
                                <div class="col-md-2">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class="form-control" placeholder="e.g. 900"
                                        value="<?= $this->input->get('amount') ?>">
                                </div>

                                <!-- Filter Button -->
                                <div class="col-md-1" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </div>
                            </div>
                        </form>

                        
                        <div class="mailbox-messages">
                            <div class="table-responsive">  
                                <table class="table table-striped table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Fees Head</th>
                                            <th>Fees Value</th>
                                            <th>Classes</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if (!empty($fees_plan)): ?>
                                            <?php foreach ($fees_plan as $plan): ?>
                                                
                                                <tr>
                                                    <td><?php echo $plan['fee_head_name']; ?></td>
                                                    <td><?php echo $plan['amount']; ?></td>
                                                    <td>
                                                        <?php
                                                        $class_ids = is_array($plan['class_ids']) ? $plan['class_ids'] : json_decode($plan['class_ids'], true);
                                                        $class_map = [];
                                                        foreach ($classes as $class) {
                                                            $class_map[$class['id']] = $class['class'];
                                                        }
                                                        $class_names = [];
                                                        foreach ($class_ids as $id) {
                                                            if (isset($class_map[$id])) {
                                                                $class_names[] = $class_map[$id];
                                                            }
                                                        }
                                                        echo implode(', ', $class_names);
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        // Decode if it's a JSON string
                                                        $category_ids = is_array($plan['category_ids']) ? $plan['category_ids'] : json_decode($plan['category_ids'], true);

                                                        // Map category ID to name
                                                        $category_map = [];
                                                        foreach ($feegroupList as $category) {
                                                            $category_map[$category['id']] = $category['name'];
                                                        }

                                                        // Translate IDs to names
                                                        $category_names = [];
                                                        foreach ($category_ids as $id) {
                                                            if (isset($category_map[$id])) {
                                                                $category_names[] = $category_map[$id];
                                                            }
                                                        }

                                                        // Output as comma-separated string
                                                        echo implode(', ', $category_names);
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a data-placement="left" href="<?php echo site_url('admin/feesroutes/edit1/' . $plan['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a data-placement="left" href="<?php echo site_url('admin/feesroutes/delete1/' . $plan['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4">No data found</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table><!-- /.table -->
                            </div>  
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->

                </div>

            </div><!--/.col (right) -->
            <!-- left column -->


        </div>

        <?php } ?>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
document.getElementById('select_all_categories').addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('.category-checkbox');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});

document.getElementById('select_all_classes').addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('.class-checkbox');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});
</script>