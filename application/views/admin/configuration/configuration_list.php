<!-- bootstrap 3.0.2 -->
<link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- font Awesome -->
<link href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<!-- Ionicons -->
<link href="<?php echo base_url(); ?>assets/admin/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
<!-- DATA TABLES -->
<link href="<?php echo base_url(); ?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet"
      type="text/css"/>
<?php $count = 1; ?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">Cấu hình website
            </div>
        </div>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="bootstrap-admin-panel-content">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Mã cấu hình</th>
                    <th>Tiêu đề</th>
                    <th>Giá trị</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $config): ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $config->code; ?></td>
                        <td><?php echo $config->title; ?></td>
                        <td><?php echo $config->value; ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="<?php echo base_url(); ?>admin/configuration/edit/<?php echo $config->id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Sửa
                            </a>
                        </td>
                    </tr>
                    <?php $count++; endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/bootstrap.min.js">
</script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/js/twitter-bootstrap-hover-dropdown.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/bootstrap-admin-theme-change-size.js">
</script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>templates/admin/vendors/datatables/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/DT_bootstrap.js">
</script>
<!-- page script -->
<script type="text/javascript">
    $(function () {
        $("#example").dataTable();
    });
</script>
<script type="text/javascript">

    $(function () {
        $(".alert-success").fadeTo(1000, 500).slideUp(500, function () {
            $(".alert-success").alert('close');
        });
    });

    $(function () {
        $(".alert-danger").slideUp(0, function () {
            $(".alert-danger").alert('close');
            swal("Whoops!", "Đã xảy ra lỗi, vui lòng thử lại.", "error");
        });
    });
</script>


