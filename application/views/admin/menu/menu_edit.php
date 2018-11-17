<div class="col-lg-12">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo $pageTitle; ?></div>
        </div>
        <form class="form-horizontal" role="form" action="<?php echo base_url() ?>admin/menu/save_update"
              method="post" name="form-view" enctype="multipart/form-data">
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Thông tin chi tiết</a></li>
                    <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">Thông tin
                            SEO web</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <fieldset>
                            <legend>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                <a href="<?php echo base_url() ?>admin/menu/view" class="btn btn-danger">Hủy</a>
                            </legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Tên menu </label>
                                <div class="col-lg-10">
                                    <input type="text" required="" class="form-control col-md-6" name="name"
                                           placeholder="Nhập tên menu ..." value="<?php echo @$list->name ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Menu cha </label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="parent">
                                        <option value="">
                                            Là menu cha
                                        </option>

                                        <?php

                                        function Menu($parentid = 0, $space = "", $trees = array())
                                        {
                                            if (!$trees) {
                                                $trees = array();
                                            }
                                            $CI =& get_instance();
                                            $CI->load->model("menu_model");
                                            if ($parentid > 0) {
                                                $row = $CI->menu_model->getSubcategory($parentid);
                                            } else {
                                                $row = $CI->menu_model->getParents();
                                            }
                                            foreach ($row as $rs) {
                                                $trees[] = array('id' => $rs['id'],
                                                    'name' => $space . $rs['name'],
                                                );
                                                $trees = Menu($rs['id'], $space . '|---&nbsp;', $trees);
                                            }
                                            return $trees;
                                        }

                                        $menu = Menu(0);

                                        foreach ($menu as $k => $row) {
                                            ?>

                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Loại menu </label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="id_menutype">
                                        <?php /*foreach ($menu_type as $items) { */ ?>
                                            <option <?php /*if (@$list->id_menutype == $items->id) echo "selected='selected'" */ ?>
                                                    value="<?php /*echo $items->id */ ?>"><?php /*echo $items->name */ ?></option>
                                        <?php /*} */ ?>
                                    </select>
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Loại menu </label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="menu_type">
                                        <option value="0">Chọn kiểu menu</option>
                                        <option value="1">Danh mục sản phẩm</option>
                                        <option value="2">Danh mục bài viết</option>
                                        <option value="3">Trang tĩnh</option>
                                        <option value="4">Link tùy chọn</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead"></label>
                                <div class="col-lg-10">
                                    <div class="san-pham">
                                        <?php echo form_dropdown('slug', $select, @$list->alias, 'class="form-control" id="san-pham"'); ?>
                                    </div>
                                    <div class="bai-viet">
                                        <select name="slug" id="bai-viet" class="form-control">
                                            <?php
                                            foreach ($news_category as $items) {
                                                if ($items->alias !== 'root') { ?>
                                                    <option value="tin-tuc/<?php echo $items->alias ?>"><?php echo $items->title; ?></option>
                                                    <?php
                                                }
                                            } ?>

                                            <?php /*foreach ($news_category as $items) { */ ?><!--
                                                <option value="tin-tuc/<?php /*echo $items->alias */ ?>"><?php /*echo $items->title; */ ?></option>
                                            --><?php /*} */ ?>
                                        </select>
                                    </div>
                                    <div class="trang-tinh">
                                        <select name="slug" id="trang-tinh" class="form-control">
                                            <?php foreach ($pages as $items) { ?>
                                                <option value="pages/<?php echo $items->alias ?>"><?php echo $items->title; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="link-ngoai">
                                        <input id="link-ngoai" type="text" value="<?php echo @$list->alias ?>"
                                               class="form-control" placeholder="Nhập link ..."
                                               name="slug">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Thứ tự menu </label>
                                <div class="col-lg-10">
                                    <input type="text" value="<?php echo @$list->number ?>" class="form-control"
                                           placeholder="Nhập thứ tự menu ..." name="number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Bật/Tắt</label>
                                <div class="col-lg-10">
                                    <input type="radio" name="state" id="state"
                                           value="1" <?php if (@$list->state == '1') echo set_radio('state', '1', TRUE); ?> />
                                    Hiển thị&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="state" id="state2"
                                           value="0" <?php if (@$list->state == '0') echo set_radio('state', '0', TRUE); ?> />
                                    Ẩn
                                </div>
                            </div>

                        </fieldset>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="seo">
                        <fieldset>
                            <legend><?php echo $pageTitle; ?></legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">SEO keyword </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="seo_keyword" rows="3"
                                              placeholder="Nhập keyword SEO ..."><?php echo @$list->seo_keyword; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">SEO description </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="seo_description" rows="3"
                                              placeholder="Nhập description SEO ..."><?php echo @$list->seo_description; ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="<?php echo base_url() ?>admin/menu/view" class="btn btn-danger">Hủy</a>
            </div>
            <input type="hidden" name="id" value="<?php echo (@$list->id == null) ? 0 : @$list->id ?>"
                   id="avatar_images"/>
            <input type="hidden" name="ids" value=""/>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/js/bootstrap-admin-theme-change-size.js"></script>

<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/vendors/chosen.jquery.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#myTab a:first').tab('show');
        $('.datepicker').datepicker();
        $('.uniform_on').uniform();
        $('.chzn-select').chosen();
        $('.selectize-select').selectize();
    });
</script>
<script src="<?php echo base_url(); ?>tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea.tinymcefull", theme: "modern",
        plugins: [
            "code",
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontselect | fontsizeselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true,
        relative_urls: false,
        external_filemanager_path: "<?php echo base_url(); ?>filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": "<?php echo base_url(); ?>filemanager/plugin.min.js"}
    });
</script>
<script>
    $('.san-pham').hide();
    $('.link-ngoai').hide();
    $('.bai-viet').hide();
    $('.trang-tinh').hide();

    $("[name='menu_type']").change(function () {

        if ($(this).val() === "0") {
            $('.san-pham').slideUp();
            $('.link-ngoai').slideUp();
            $('.bai-viet').slideUp();
            $('.trang-tinh').slideUp();
            $('#san-pham').removeAttr('name');
            $('#link-ngoai').removeAttr('name');
            $('#bai-viet').removeAttr('name');
            $('#trang-tinh').removeAttr('name');
        }
        if ($(this).val() === "1") {
            $('.san-pham').slideDown();
            $('.link-ngoai').slideUp();
            $('.bai-viet').slideUp();
            $('.trang-tinh').slideUp();
            $('#link-ngoai').removeAttr('name');
            $('#bai-viet').removeAttr('name');
            $('#trang-tinh').removeAttr('name');
        }
        if ($(this).val() === "2") {
            $('.bai-viet').slideDown();
            $('.link-ngoai').slideUp();
            $('.san-pham').slideUp();
            $('.trang-tinh').slideUp();
            $('#link-ngoai').removeAttr('name');
            $('#san-pham').removeAttr('name');
            $('#trang-tinh').removeAttr('name');
        }
        if ($(this).val() === "3") {
            $('.trang-tinh').slideDown();
            $('.link-ngoai').slideUp();
            $('.san-pham').slideUp();
            $('.bai-viet').slideUp();
            $('#link-ngoai').removeAttr('name');
            $('#san-pham').removeAttr('name');
            $('#bai-viet').removeAttr('name');
        }
        if ($(this).val() === "4") {
            $('.link-ngoai').slideDown();
            $('.san-pham').slideUp();
            $('.bai-viet').slideUp();
            $('.trang-tinh').slideUp();
            $('#san-pham').removeAttr('name');
            $('#bai-viet').removeAttr('name');
            $('#trang-tinh').removeAttr('name');
        }
    });
</script>
