<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('add_branch', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_branch'); ?></h3>
                        </div> 
                        <form action="<?php echo site_url('admin/branch/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>  
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('branch_name'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="branch_name" name="branch_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('branch_name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('branch_url'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="branch_url" name="branch_url" placeholder="" type="text" class="form-control"  value="<?php echo set_value('branch_url'); ?>" />
                                    <span class="text-danger"><?php echo form_error('branch_url'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('db_host'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="db_host" name="db_host" placeholder="" type="text" class="form-control"  value="<?php echo set_value('db_host'); ?>" />
                                    <span class="text-danger"><?php echo form_error('db_host'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('db_name'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="db_name" name="db_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('db_name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('db_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('db_username'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="db_username" name="db_username" placeholder="" type="text" class="form-control"  value="<?php echo set_value('db_username'); ?>" />
                                    <span class="text-danger"><?php echo form_error('db_username'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('db_password'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="db_password" name="db_password" placeholder="" type="text" class="form-control"  value="<?php echo set_value('db_password'); ?>" />
                                    <span class="text-danger"><?php echo form_error('db_password'); ?></span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>  
                </div>   
            <?php } ?>  
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('add_branch', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('branch_list'); ?></h3>
                    </div>
					 
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('branch_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('branch'); ?></th>
                                        <th><?php echo $this->lang->line('branch_url'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($branchlist as $section) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $section['branch_name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $section['branch_url'] ?></td>
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('branch', 'can_edit')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/branch/edit/<?php echo $section['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('branch', 'can_delete')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/branch/delete/<?php echo $section['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
