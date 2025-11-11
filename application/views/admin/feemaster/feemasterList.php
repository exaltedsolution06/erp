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
        <h1><i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($type=='edit'){
            ?>
            <?php
            $fee_data = isset($feegroup_type[0]) ? $feegroup_type[0] : null;
            $class_ids = isset($fee_data['class_ids']) ? json_decode($fee_data['class_ids']) : [];
            $category_ids = isset($fee_data['category_ids']) ? json_decode($fee_data['category_ids']) : [];
            ?>

            

            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo 'Update Fees Plan' . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feemaster" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>

                                <!-- Hidden ID field for update -->
                                <?php if (!empty($fee_data['id'])): ?>
                                    <input type="hidden" name="update_id" value="<?= $fee_data['id'] ?>">
                                <?php endif; ?>

                                <div class="row">

                                    <!-- Fees Head -->
                                    <div class="col-sm-6">
                                        <label for="fee_groups_id">Select Fee Head</label> <small class="req">*</small>
                                        <select id="fee_groups_id" name="fee_head" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($fee_heads as $feegroup): ?>
                                                <option value="<?= $feegroup['id'] ?>" <?= (isset($fee_data['fee_group_id']) && $fee_data['fee_group_id'] == $feegroup['id']) ? 'selected' : '' ?>>
                                                    <?= $feegroup['fees_heading'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Amount -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="amount">Enter Fee Value</label><small class="req"> *</small>
                                            <input id="amount" name="amount" type="text" class="form-control" placeholder="Enter Fees Value"
                                                value="<?= isset($fee_data['amount']) ? $fee_data['amount'] : set_value('amount'); ?>" />
                                        </div>
                                    </div>

                                    <!-- Classes -->
                                    <div class="col-sm-6 border">
                                        <label>Select Classes</label> <small class="req">*</small><br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_classes">
                                            <label class="form-check-label" for="select_all_classes">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($classes as $class): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input class_data" type="checkbox" name="classes_id[]" id="class_<?= $class['id'] ?>"
                                                        value="<?= $class['id'] ?>" <?= in_array($class['id'], $class_ids) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="class_<?= $class['id'] ?>">
                                                        <?= $class['class'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- Categories -->
                                    <div class="col-sm-6">
                                        <label>Select Fee Category</label> <small class="req">*</small><br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_categories">
                                            <label class="form-check-label" for="select_all_categories">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($feegroupList as $feetype): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input category-checkbox" type="checkbox" name="feetype_id[]" id="category_<?= $feetype['id'] ?>"
                                                        value="<?= $feetype['id'] ?>" <?= in_array($feetype['id'], $category_ids) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="category_<?= $feetype['id'] ?>">
                                                        <?= $feetype['name'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </div><!-- /.row -->

                            </div><!-- /.box-body -->

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
                            <h3 class="box-title"><?php echo 'Add Fees Plan' . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feemaster"  id="feemasterform" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="row">


                                    <div class="col-sm-6">
                                        <label for="exampleInputEmail1">Select Fee Head</label> <small class="req">*</small>
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
                                            <label for="exampleInputEmail1">Enter Fee Value</label><small class="req"> *</small>
                                            <input id="amount" name="amount" type="text" class="form-control" placeholder="Enter Fees Value"  value="<?php echo set_value('amount'); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 border">
                                        <label>Select Classes</label> <small class="req">*</small><br>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="select_all_classes">
                                            <label class="form-check-label" for="select_all_classes">
                                                Select All
                                            </label>
                                        </div>
                                        <div style="height: 120px; overflow-y: auto; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                            <?php foreach ($classes as $feegroup): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input class-checkbox class_data" type="checkbox" name="classes_id[]" id="class_<?= $feegroup['id'] ?>" value="<?= $feegroup['id'] ?>">
                                                    <label class="form-check-label" for="class_<?= $feegroup['id'] ?>">
                                                        <?= $feegroup['class'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <label>Select Fee Category</label> <small class="req">*</small><br>
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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                        <div class="mailbox-messages">
                            <form method="get" action="">
                                <div class="row" style="margin-bottom: 15px;">
                                    <!-- Fees Head Filter -->
                                    <div class="col-md-2">
                                        <label>Fees Head</label>
                                        <select name="filter_fee_head" class="form-control">
                                            <option value="">All</option>
                                            <?php foreach ($fee_heads as $feegroup): ?>
                                                <option value="<?= $feegroup['id'] ?>" <?= isset($_GET['filter_fee_head']) && $_GET['filter_fee_head'] == $feegroup['id'] ? 'selected' : '' ?>>
                                                    <?= $feegroup['fees_heading'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Class Filter -->
                                    <div class="col-md-2">
                                        <label>Class</label>
                                        <select name="filter_class" class="form-control">
                                            <option value="">All</option>
                                            <?php foreach ($classes as $c): ?>
                                                <option value="<?= $c['id'] ?>" <?= isset($_GET['filter_class']) && $_GET['filter_class'] == $c['id'] ? 'selected' : '' ?>>
                                                    <?= $c['class'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Category Filter -->
                                    <div class="col-md-2">
                                        <label>Category</label>
                                        <select name="filter_category" class="form-control">
                                            <option value="">All</option>
                                            <?php foreach ($feegroupList as $cat): ?>
                                                <option value="<?= $cat['id'] ?>" <?= isset($_GET['filter_category']) && $_GET['filter_category'] == $cat['id'] ? 'selected' : '' ?>>
                                                    <?= $cat['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fees Amount</label>
                                        <input type="text" name="filter_amount" class="form-control" placeholder="Enter Amount" 
                                            value="<?= isset($_GET['filter_amount']) ? $_GET['filter_amount'] : '' ?>">
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-3" style="padding-top: 25px;">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="<?= base_url('admin/feemaster') ?>" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>

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
                                                        // Decode the class_ids JSON (just to be safe)
                                                        $class_ids = is_array($plan['class_ids']) ? $plan['class_ids'] : json_decode($plan['class_ids'], true);

                                                        // Create a map of class ID => name for easy lookup
                                                        $class_map = [];
                                                        foreach ($classes as $c) {
                                                            $class_map[$c['id']] = $c['class'];
                                                        }

                                                        // Replace class IDs with their names
                                                        $class_names = [];
                                                        if (!empty($class_ids)) {
                                                            foreach ($class_ids as $cid) {
                                                                if (isset($class_map[$cid])) {
                                                                    $class_names[] = $class_map[$cid];
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <?php echo !empty($class_names) ? implode(', ', $class_names) : '-'; ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        // Decode if necessary
                                                        $category_ids = is_array($plan['category_ids']) ? $plan['category_ids'] : json_decode($plan['category_ids'], true);

                                                        // Map category id to name
                                                        $category_map = [];
                                                        foreach ($feegroupList as $cat) {
                                                            $category_map[$cat['id']] = $cat['name'];
                                                        }

                                                        // Convert IDs to names
                                                        $category_names = [];
                                                        if (!empty($category_ids)) {
                                                            foreach ($category_ids as $cid) {
                                                                if (isset($category_map[$cid])) {
                                                                    $category_names[] = $category_map[$cid];
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                        <!-- In your table cell -->
                                                        <?php echo !empty($category_names) ? implode(', ', $category_names) : '-'; ?>

                                                    </td>
                                                    <td>
                                                        <a data-placement="left" href="<?php echo site_url('admin/feemaster/edit/' . $plan['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a data-placement="left" href="<?php echo site_url('admin/feemaster/delete/' . $plan['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
    document.getElementById('select_all_classes').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.class_data');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
    document.getElementById('select_all_categories').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.category-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>