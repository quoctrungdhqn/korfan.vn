<?php
date_default_timezone_set("Asia/Bangkok");
?>

<div class="col-lg-12">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title"><?php echo $page_title; ?></div>
        </div>
        <form class="form-horizontal" role="form"
              action="<?php echo base_url(); ?>admin/user/save_update" method="post" name="form-view"
              enctype="multipart/form-data">
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Thông tin cá nhân</a></li>
                    <li role="presentation"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Thông
                            tin đăng nhập</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <fieldset>
                            <legend>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                <a href="<?php echo base_url(); ?>admin/user/view" class="btn btn-danger">Hủy</a>
                            </legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Họ đệm</label>
                                <div class="col-lg-10">
                                    <input type="text" required="" class="form-control col-md-6" name="firstname"
                                           placeholder="Nhập họ đệm"
                                           value="<?php echo @$userInfo->firstname ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Tên </label>
                                <div class="col-lg-10">
                                    <input type="text" required="" class="form-control col-md-6" name="lastname"
                                           placeholder="Nhập tên"
                                           value="<?php echo @$userInfo->lastname ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="email" id="email"
                                           placeholder="Nhập email"
                                           value="<?php echo @$userInfo->email ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Điện thoại</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Nhập điện thoại"
                                           value="<?php echo @$userInfo->phone ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Nhóm người dùng </label>
                                <div class="col-lg-10">
                                    <?php echo form_dropdown('userGroup', $groupsList, @$userInfo->userGroup, 'class="form-control custom-select"') ?></div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Hình ảnh</label>
                                <div class="col-lg-10">
                                    <input class="form-control uniform_on" id="fileInput" name="images[]"
                                           type="file" <?php echo ($formType == 'add') ? 'required' : '' ?>>
                                    <p class="help-block">* Lưu ý: Chọn hình với tên không dấu và không có khoảng
                                        trắng.</p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput"></label>
                                <div class="col-lg-10">
                                    <?php
                                    if (@$userInfo->avatar != '') {
                                        ?>
                                        <img class="img-responsive" style="max-width: 200px; max-height: 200px"
                                             src="<?php echo base_url(); ?><?php echo @$userInfo->avatar; ?>"/>
                                        <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Địa chỉ </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="address"
                                           value="<?php echo @$userInfo->address ?>"
                                           placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="fileInput">Bật/Tắt</label>
                                <div class="col-lg-10">
                                    <input type="radio" checked name="state" id="state" value="1"
                                           class="custom-control-input" <?php if (@$userInfo->state == '1')
                                        echo set_radio('state', '1', TRUE); ?> />
                                    <span class="custom-control-indicator"></span>
                                    Hiển thị
                                    <input type="radio" name="state" id="state2" value="0"
                                           class="custom-control-input" <?php if (@$userInfo->state == '0') echo
                                    set_radio('state', '0', TRUE); ?> />
                                    <span class="custom-control-indicator"></span>
                                    Ẩn
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="detail">
                        <fieldset>
                            <legend><?php echo $page_title; ?></legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="typeahead">Tên đăng nhập </label>
                                <div class="col-lg-10">
                                    <input type="text" required="" class="form-control col-md-6" name="username"
                                           placeholder="Nhập tên đăng nhập"
                                           value="<?php echo @$userInfo->username ?>" <?php echo ($formType == 'add') ? 'required' : 'disabled' ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"
                                       for="typeahead" <?php echo ($formType == 'add') ? 'required' : '' ?>><?php echo $label_password; ?></label>
                                <div class="col-lg-10">
                                    <input type="password" id="inputPassword"
                                           placeholder="<?php echo $placeholder_password ?>"
                                           class="form-control col-md-6"
                                           name="password" <?php echo ($formType == 'add') ? 'required' : '' ?>>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="<?php echo base_url(); ?>admin/user/view" class="btn btn-danger">Hủy</a>
            </div>
            <input type="hidden" name="oldImage" value="<?php echo @$userInfo->avatar ?>" id="oldImage"/>
            <input type="hidden" name="id" value="<?php echo (@$userInfo->id == null) ? 0 : @$userInfo->id ?>" id="id"/>
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