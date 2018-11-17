<div class="col-lg-12">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo $page_title; ?></div>
        </div>
        <form class="form-horizontal" role="form" action="<?php echo base_url() ?>admin/product_category/save_update/"
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
                                <a href="<?php echo base_url() ?>admin/product_category/view" class="btn btn-danger">Hủy</a>
                            </legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Tiêu đề </label>
                                <div class="col-lg-10">
                                    <input type="text" required="" class="form-control col-md-6" name="name"
                                          placeholder="Nhập tiêu đề ..." value="<?php echo @$catInfo->name ?>">
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Alias </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control col-md-6" name="alias"
                                           value="<?php /*echo @$catInfo->alias; */?>"
                                           placeholder="Alias tự sinh, không cần nhập">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Danh mục </label>
                                <div class="col-lg-10">
                                    <?php echo form_dropdown('parents', $select, @$catInfo->parents, 'class="form-control"'); ?>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Hình ảnh</label>
                                <div class="col-lg-10">
                                    <input class="form-control uniform_on" id="fileInput" name="images[]" multiple=""
                                           type="file">
                                    <p class="help-block">Chọn tên hình không dấu và không có khoảng trắng.</p>
                                    <?php
                            /*                                    if (@$catInfo->images != '') {
                                                                    $img = explode(',', $catInfo->images);
                                                                    */ ?>
                                        <p><img width="100" height="80"
                                                src="<?php /*echo base_url(); */ ?>uploads/country/thumb_<?php /*echo $img[0]; */ ?>"/>
                                        </p>
                                    <?php /*} */ ?>

                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Bật/Tắt</label>
                                <div class="col-lg-10">
                                    <input type="radio" name="state" id="state"
                                           value="1" <?php if (@$catInfo->state == '1') echo set_radio('state', '1', TRUE); ?> />
                                    Hiển thị&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="state" id="state2"
                                           value="0" <?php if (@$catInfo->state == '0') echo set_radio('state', '0', TRUE); ?> />
                                    Ẩn
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Mô tả chi tiết </label>
                                <br>
                                <br>
                                <div class="col-lg-12">
                                    <textarea class="tinymcefull" rows="15"
                                              name="detail"><?php echo @$catInfo->detail; ?></textarea>
                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="seo">
                        <fieldset>
                            <legend><?php echo $page_title; ?></legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">SEO title </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="seo_title" rows="3"
                                              placeholder="Nhập title SEO ..."><?php echo @$catInfo->seo_title; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">SEO keyword </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="seo_keyword" rows="3"
                                              placeholder="Nhập keyword SEO ..."><?php echo @$catInfo->seo_keyword; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">SEO description </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="seo_description" rows="3"
                                              placeholder="Nhập description SEO ..."><?php echo @$catInfo->seo_description; ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="<?php echo base_url() ?>admin/product_category/view" class="btn btn-danger">Hủy</a>
            </div>
            <input type="hidden" name="id" value="<?php echo (@$catInfo->id == null) ? 0 : @$catInfo->id ?>"/>
            <input type="hidden" name="old_image" value="<?php echo @$img[0]; ?>"/>
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