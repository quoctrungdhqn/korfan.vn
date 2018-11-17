<?php $count = 1; ?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">
                <?php echo $page_title; ?>
                <a href="<?php echo base_url() ?>admin/product_category/edit" title="Thêm mới danh mục"
                   class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
            </div>
        </div>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="bootstrap-admin-panel-content">
            <table class="table table-striped table-bordered" id="example">
                <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Tiêu đề</th>
                    <th>Hiển thị</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $product): ?>
                    <tr class="odd gradeX">
                        <td><?php echo $count; ?></td>
                        <td>
                            <?php
                            if ($product->level != 0) {
                                echo anchor('admin/product_category/edit/' . $product->id,
                                    str_repeat('|---', $product->level) . $product->name,
                                    array('class' => 'edit-link'));
                            } else {

                                echo $product->name;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($product->state == '1') {
                                echo "<a class='btn btn-success'><i class='glyphicon glyphicon-ok'></i> Bật</a>";
                            } else {
                                echo "<a class='btn btn-warning'><i class='glyphicon glyphicon-off'></i> Tắt</a>";
                            }
                            ?>
                        </td>
                        <td class="actions">
                            <?php
                            if ($product->level != 0) {
                                ?>

                                <a class="btn btn-sm btn-primary"
                                   href="<?php echo base_url() ?>admin/product_category/edit/<?php echo $product->id; ?>">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Sửa
                                </a>

                                <button class="btn btn-sm btn-danger"
                                        onclick="remove_product_category(<?php echo $product->id; ?>)">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Xóa
                                </button>
                                <?php
                            } else {

                            }
                            ?>
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

    function remove_product_category(id) {
        if (id === null || id === 0) return;
        swal({
            title: 'Xác nhận xóa',
            text: "Bạn có muốn xóa danh mục này khỏi danh sách?",
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
                    url: '<?php echo base_url() ?>admin/product_category/delete/' + id,
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