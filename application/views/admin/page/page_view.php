<?php
date_default_timezone_set("Asia/Bangkok");
?>
<?php $count = 1; ?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">
                Quản lý trang
                <a href="<?php echo base_url() ?>admin/page/edit" title="Thêm mới" class="btn btn-primary"><i
                            class="glyphicon glyphicon-plus"></i> Thêm mới</a>
            </div>
        </div>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="bootstrap-admin-panel-content">
            <table class="table table-striped table-bordered" id="example">
                <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th>Hiển thị</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $CI = &get_instance();
                $CI->load->model('Pages_Model');
                $list = $CI->Pages_Model->get_all_items();
                foreach ($list as $items):?>
                    <tr class="odd gradeX">
                        <td><?php echo $count; ?></td>
                        <td>
                            <a href="<?php echo base_url() ?>admin/page/edit/<?php echo $items->id ?>"><?php echo $items->title; ?></a>
                        </td>
                        <td><?php echo date("d/m/Y", strtotime($items->created)); ?></td>
                        <td>
                            <?php
                            if ($items->published == '1') {
                                echo "<a class='btn btn-success'><i class='glyphicon glyphicon-ok'></i> Bật</a>";
                            } else {
                                echo "<a class='btn btn-warning'><i class='glyphicon glyphicon-off'></i> Tắt</a>";
                            }
                            ?>
                        </td>
                        <td class="actions">
                            <a class="btn btn-sm btn-primary"
                               href="<?php echo base_url() ?>admin/page/edit/<?php echo $items->id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Sửa
                            </a>

                            <button class="btn btn-sm btn-danger" onclick="remove_page(<?php echo $items->id; ?>)">
                                <i class="glyphicon glyphicon-trash"></i>
                                Xóa
                            </button>
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

<script type="text/javascript">

    function remove_page(id) {
        if (id === null || id === 0) return;
        swal({
            title: 'Xác nhận xóa',
            text: "Bạn có muốn xóa trang này khỏi danh sách?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1467D2',
            cancelButtonColor: '#E5231E',
            confirmButtonText: 'Có, xóa!',
            cancelButtonText: 'Hủy',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    type: 'DELETE',
                    url: '<?php echo base_url() ?>admin/page/delete/' + id,
                    error: function () {
                        swal("Whoops!", "Đã xảy ra lỗi, vui lòng thử lại.", "error");
                    },
                    success: function () {
                        swal({
                            type: 'success',
                            title: 'Đã xóa!',
                            text: '',
                            timer: 2000
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });
    }

</script>


