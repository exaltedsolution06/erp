<script src="<?php echo base_url(); ?>backend/plugins/ckeditor/ckeditor.js"></script>
<script src="https://ilikenwf.github.io/jquery.mjs.nestedSortable.js"></script>
<style type="text/css">
    ol {
        margin: 0;
        padding: 0;
        padding-left: 30px;
    }

    ol.sortable{
        margin: 0 0 0 0px;
        padding: 0;
        list-style-type: none;
    }
    ol.sortable ol {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }
    .sortable li {
        margin: 7px 0 0 0;
        padding: 0;
        position: relative;
    }




    .material-switch > input[type="checkbox"] {
        display: none;   
    }

    .material-switch > label {
        cursor: pointer;
        height: 0px;
        position: relative; 
        width: 40px;  
    }

    .material-switch > label::before {
        background: rgb(0, 0, 0);
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        content: '';
        height: 16px;
        margin-top: -8px;
        position:absolute;
        opacity: 0.3;
        transition: all 0.4s ease-in-out;
        width: 40px;
    }
    .material-switch > label::after {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        content: '';
        height: 24px;
        left: -4px;
        margin-top: -8px;
        position: absolute;
        top: -4px;
        transition: all 0.3s ease-in-out;
        width: 24px;
    }
    .material-switch > input[type="checkbox"]:checked + label::before {
        background: inherit;
        opacity: 0.5;
    }
    .material-switch > input[type="checkbox"]:checked + label::after {
        background: inherit;
        left: 20px;
    }
    .ui-sortable-handle a{color: #444;}
    .tooltip.top .tooltip-inner {
        background-color:#000;
        padding:5px 20px;
        opacity:100;
        border-radius:2px;

    }
    .tooltip.top .tooltip-arrow {
        border-top-color:#000;
        opacity:0.5;
    }
</style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-empire"></i> <?php echo $this->lang->line('front_cms'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
			<?php
            if ($this->rbac->hasPrivilege('add_webs_links', 'can_add')) {
                ?>
            <div class="col-md-8">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_menu_item'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="form1" action="<?php echo site_url('admin/front/menus/additem/' . urlencode($result['slug'])); ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <input type="hidden" name="menu_id" value="<?php echo $result['id'] ?>">
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
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('menu_item'); ?></label><small class="req"> *</small>
                                <input autofocus="" id="menu" name="menu" placeholder="" type="text" class="form-control"  value="<?php echo set_value('menu'); ?>" />
                                <span class="text-danger"><?php echo form_error('menu'); ?></span>
                            </div>
                            <!--<div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('external_url'); ?></label>
                                <div class="material-switch">
                                    <input id="ext_url" name="ext_url" type="checkbox" class="ext_url_chk"  value="1" <?php echo set_checkbox('ext_url', '1', (set_value('ext_url')) ? TRUE : FALSE); ?> />
                                    <label for="ext_url" class="label-success"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('open_in_new_tab'); ?></label>
                                <div class="material-switch">
                                    <input id="open_new_tab" name="open_new_tab" type="checkbox" class="chk"  value="1"  />
                                    <label for="open_new_tab" class="label-success"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('external_url_address'); ?></label>
                                <input id="ext_url_link" name="ext_url_link"  type="text" class="form-control"  value="<?php echo set_value('ext_url_link'); ?>" <?php echo (!set_value('ext_url')) ? 'disabled' : ''; ?>/>
                                <span class="text-danger"><?php echo form_error('ext_url_link'); ?></span>
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('page'); ?></label>
                                <select  id="page_id" name="page_id" class="form-control"  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($listPages as $page) {
                                        ?>
                                        <option value="<?php echo $page['id'] ?>"<?php if (set_value('page_id') == $page['id']) echo "selected=selected" ?>><?php echo $page['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>-->
							<div class="form-group">
                                <label for="exampleInputEmail1">Content Heading</label>
                                <input id="content_heading" name="content_heading"  type="text" class="form-control"  value="<?php echo set_value('content_heading'); ?>" />
                                <span class="text-danger"><?php echo form_error('content_heading'); ?></span>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <input id="editor1" name="menu_description"  type="text" class="form-control"  value="<?php echo set_value('menu_description'); ?>" />
                                <span class="text-danger"><?php echo form_error('menu_description'); ?></span>
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Image Position(Right)</label>
                                <div class="material-switch">
                                    <input id="image_position" name="image_position" type="checkbox"  value="1" <?php echo set_checkbox('image_position', '1', (set_value('image_position')) ? TRUE : FALSE); ?> />
                                    <label for="image_position" class="label-success"></label>
                                </div>
                            </div>
							<div class="dividerhr"></div>

                            <div class="formgroup10">
                                <label><?php echo $this->lang->line('gallery_image'); ?></label>
                                <button type="button" class="btn btn-primary btn-sm gallery_image pull-right" id="gallery_images"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add_image'); ?></button>
                                <div class="mediarow">
                                    <div class="row">
                                        <div class="gallery_content"></div> 
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
			<?php } ?>
            <!-- left column -->
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('add_webs_links', 'can_add')) {
                echo "4";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="holist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('menu_item_list'); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo site_url('admin/front/menus/update') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="mailbox-controls">
                                <div class="pull-right">
                                </div><!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <div class="download_label"><?php echo $this->lang->line('menu_item_list'); ?></div>

                                <div class="menu-box">
                                    <ol class="sortable">


                                        <?php if (empty($listdropdown_Menus)) {
                                            ?>

                                            <?php
                                        } else {
                                            $count = 1;

                                            foreach ($listdropdown_Menus as $menu) {
                                                ?>
                                                <li id="list_<?php echo $menu['id']; ?>">
                                                    <div>
                                                        <?php echo $menu['menu']; ?>


                                                        <span class="pull-right">
															<?php
															if ($this->rbac->hasPrivilege('add_webs_links', 'can_edit')) {
																?>
                                                            <a href="<?php echo site_url('admin/front/menus/edititem/' . $menu['slug'] . "/" . $top_menu) ?>" class="btn btn-xs" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
															<?php } ?>
															<?php
															if ($this->rbac->hasPrivilege('add_webs_links', 'can_delete')) {
																?>
                                                            <a href="#" class="btn btn-xs" title="<?php echo $this->lang->line('delete'); ?>" data-id="<?php echo $menu['id']; ?>" id="deleteItem" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-remove"></i></a>
															<?php } ?>
                                                        </span>

                                                    </div>

                                                    <?php
                                                    if (!empty($menu['submenus'])) {
                                                        ?>
                                                        <ol class="submenu-list">

                                                            <?php
                                                            foreach ($menu['submenus'] as $submenu_key => $submenu_value) {
                                                                ?>
                                                                <li id="list_<?php echo $submenu_value['id']; ?>">
                                                                    <div class="ui-sortable-handle">
                                                                        <?php echo $submenu_value['menu']; ?>

                                                                        <span class="pull-right">
																			<?php
																			if ($this->rbac->hasPrivilege('add_webs_links', 'can_edit')) {
																				?>
                                                                            <a href="<?php echo site_url('admin/front/menus/edititem/' . $submenu_value['slug'] . "/" . $top_menu) ?>" class="btn btn-xs" title="Edit Item"><i class="fa fa-pencil"></i></a> 
																			<?php } ?>
																			<?php
																			if ($this->rbac->hasPrivilege('add_webs_links', 'can_delete')) {
																				?>
                                                                            <a href="#" class="btn btn-xs" title="Delete Item" data-id="<?php echo $submenu_value['id']; ?>" id="deleteItem" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-remove"></i></a>
																			<?php } ?>
                                                                        </span>

                                                                    </div></li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ol>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                                <?php
                                            }
                                            $count++;
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div><!-- /.mail-box-messages -->
                        </div><!-- /.box-body -->

                    </form>
                </div>
            </div><!--/.col (left) -->
        </div>
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        var popup_target = 'gallery_image';
     
           CKEDITOR.replace('editor1',
                {
                    allowedContent: true
                });

        $('#mediaModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
        $(document).on('click', '.gallery_image', function (event) {
            $("#mediaModal").modal('toggle', $(this));
        });

        $('#mediaModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget) // Button that triggered the modal
            popup_target = a[0].id;
            var button = $(event.relatedTarget) // Button that triggered the modal
            console.log(popup_target);
            var $modalDiv = $(event.delegateTarget);
            $('.modal-media-body').html("");
            $.ajax({
                type: "POST",
                url: baseurl + "admin/front/media/getMedia",
                dataType: 'text',
                data: {},
                beforeSend: function () {

                    $modalDiv.addClass('modal_loading');
                },
                success: function (data) {
                    $('.modal-media-body').html(data);
                },
                error: function (xhr) { // if error occured
                    $modalDiv.removeClass('modal_loading');
                },
                complete: function () {
                    $modalDiv.removeClass('modal_loading');
                },
            });
        });

        $(document).on('click', '.img_div_modal', function (event) {
            $('.img_div_modal div.fadeoverlay').removeClass('active');
            $(this).closest('.img_div_modal').find('.fadeoverlay').addClass('active');

        });

        $(document).on('click', '.add_media', function (event) {
            var content_html = $('div#media_div').find('.fadeoverlay.active').find('img').data('img');
            var content_id = $('div#media_div').find('.fadeoverlay.active').find('img').data('fid');
            var is_image = $('div#media_div').find('.fadeoverlay.active').find('img').data('is_image');
            var content_type = $('div#media_div').find('.fadeoverlay.active').find('img').data('content_type');
            var content_name = $('div#media_div').find('.fadeoverlay.active').find('img').data('content_name');

            var vid_url = $('div#media_div').find('.fadeoverlay.active').find('img').data('vid_url');
            var content = "";
			if (popup_target === "gallery_images") {
                if (content_type === "image/gif" || content_type === "image/jpeg" || content_type === "image/png" || content_type === "video") {

                    insert_gallery(content_html, content_id, content_name, is_image);
                } else {
                    //error show  
                }


                $('#mediaModal').modal('hide');
            }

        });
    });

    function insert_gallery(content_image, content_id, content_name, is_image) {
        var output = '';
        output += "<div class='col-sm-4 col-md-3 col-xs-6 img_div_modal gallery_img div_record_" + content_id + "'>";
        output += "<div class='fadeoverlay'>";
        output += "<img class='img-responsive' data-fid='" + content_id + "' data-content_name='" + content_name + "' data-is_image='" + is_image + "' data-img='" + content_image + "' src='" + content_image + "'>";
        output += "<input type='hidden' value='" + content_id + "' name='gallery_images'>";
        if (is_image == 1) {
            output += "<i class='fa fa-picture-o videoicon'></i>";
        } else {
            output += "<i class='fa fa-youtube-play videoicon'></i>";
        }
        output += "<div class='overlay3'>";
        output += "<a href='#' class='uploadclosebtn delete_gallery_img' data-record_id='" + content_id + "' data-toggle='modal' data-target='#confirm-delete'><i class=' fa fa-trash-o'></i></a>";
        output += "<p class='processing'>Processing...</p>";
        output += "</div>";
        output += "<p class=''>" + content_name + "</p>";
        output += "</div>";
        output += "</div>";
        // $(output).appendTo(".gallery_content");
        $('.gallery_content').html(output);
    }

    $(document).on('click', '.delete_gallery_img', function () {
        $(this).closest('.gallery_img').remove();

    });

</script>



<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog pup100" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-media-title" id="myModalLabel"><?php echo $this->lang->line('media_manager'); ?></h4>
            </div>
            <div class="modal-body modal-media-body pupscroll">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="button" class="btn btn-primary add_media"><?php echo $this->lang->line('add'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.delmodal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.del_menuid', this).val("");
            $('.del_menuid', this).val(data.id);
        });


        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $('.del_menuid').val();


            $.ajax({
                type: "post",
                url: '<?php echo site_url("admin/front/menus/deleteMenuItem") ?>',
                dataType: 'JSON',
                data: {'id': id},
                beforeSend: function () {
                    $modalDiv.addClass('modalloading');
                },
                success: function (data) {
                    if (data.status == 1) {
                        successMsg(data.message);
                        location.reload(true);

                    } else {
                        errorMsg(data.message);
                    }
                },
                complete: function () {

                    $modalDiv.removeClass('modalloading');

                }
            });


        });


    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
            $('.ext_url_chk').change(function () {
            var c = this.checked ? 1 : 0;
            if (c) {
                $('#ext_url_link').prop("disabled", false);
            } else {
                $('#ext_url_link').prop("disabled", true);

            }
        });
        $('ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            maxLevels: 2,
            opacity: .6,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                var list = $(this).nestedSortable('toHierarchy');
                var urls = baseurl + "admin/front/menus/updateMenu";
                $.ajax({
                    url: urls,
                    type: 'post',
                    data: {order: list},

                    dataType: "html",
                    success: function (response) {

                    },
                    beforeSend: function () {

                    },
                    complete: function () {


                    }
                });
            }
        });
    });

</script>
<div class="delmodal modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to delete item, this action is irreversible!</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="del_menuid" class="del_menuid" value="">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('delete'); ?></a>
            </div>
        </div>
    </div>
</div>




