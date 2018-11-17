<div class="col-lg-12">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo $page_title; ?></div>
        </div>
        <form class="form-horizontal" role="form" action="<?php echo base_url() ?>admin/slide/save_update/"
              method="post" name="form-view" enctype="multipart/form-data">
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="typeahead">Tiêu đề </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control col-md-6" name="title" placeholder="Nhập tiêu đề ..."
                                       value="<?php echo @$info->title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="typeahead">Link </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control col-md-6" name="link"
                                       value="<?php echo @$info->link; ?>" placeholder="Nhập link ...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="fileInput">Hình ảnh</label>
                            <div class="col-lg-10">
                                <input class="form-control uniform_on" id="fileInput" name="image[]" multiple=""
                                       type="file" <?php echo ($formType == 'add') ? 'required' : '' ?>>
                                <p class="help-block">Chọn hình với tên không dấu và không có khoảng trắng.</p>
                                <p class="help-block">Kích thước chuẩn 1170*500.</p>
                                <?php
                                if (@$info->image != '') {
                                    $img = explode(',', $info->image);
                                    ?>
                                    <p><img width="400" height="150"
                                            src="<?php echo base_url(); ?>uploads/slide/thumb_<?php echo $img[0]; ?>"/>
                                    </p>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="<?php echo base_url() ?>admin/slide/view" class="btn btn-danger">Hủy</a>
            </div>
            <input type="hidden" name="id" value="<?php echo (@$info->id == null) ? 0 : @$info->id ?>"/>
            <input type="hidden" name="oldImage" value="<?php echo @$img[0]; ?>"/>
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