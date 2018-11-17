<?php
date_default_timezone_set("Asia/Bangkok");
?>
<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">Sản phẩm mới đăng</div>
            <div class="pull-right"><span class="badge"><?php echo count($product_no_limit); ?></span></div>
        </div>
        <div class="bootstrap-admin-panel-content">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($product) > 0) {
                    $i = 0; ?>
                    <?php foreach ($product as $item) {
                        $i++; ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <a href="<?php echo base_url() . 'admin/product/edit/' . $item->id; ?>"><?php echo $item->title; ?></a>
                            </td>
                            <td>
                                <?php

                                if ($item->image != '') {

                                    $img = explode(',', $item->image);

                                    ?>

                                    <img width="100" height="80"
                                         src="<?php echo base_url(); ?>uploads/products/<?php echo $img[0]; ?>"/>

                                <?php } else {
                                    ?>
                                    <img width="150" height="120" src="<?php echo base_url(); ?>uploads/no_image.png"/></a>

                                <?php } ?>

                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary"
                                   href="<?php echo base_url() ?>admin/product/edit/<?php echo $item->id; ?>">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Sửa
                                </a>

                                <a class="btn btn-sm btn-danger" onclick="remove_product(<?php echo $item->id; ?>)">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">Bài viết mới đăng</div>
            <div class="pull-right"><span class="badge"><?php echo count($news_no_limit); ?></span></div>
        </div>
        <div class="bootstrap-admin-panel-content">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($news) > 0) {
                    $i = 0; ?>
                    <?php foreach ($news as $item) {
                        $i++; ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a target="_blank"
                                   href="<?php echo base_url() ?>news/detail/<?php echo $item->alias; ?>.html"><?php echo $item->title; ?></a>
                            </td>
                            <td><?php echo date("d/m/Y", strtotime($item->created)); ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary"
                                   href="<?php echo base_url() ?>admin/news/edit/<?php echo $item->id; ?>">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Sửa
                                </a>

                                <a class="btn btn-sm btn-danger" onclick="remove_news(<?php echo $item->id; ?>)">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
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
<script>
    function remove_news(id) {
        if (id === null || id === 0) return;

        swal({
            title: 'Xác nhận xóa',
            text: "Bạn có muốn xóa bài viết này khỏi danh sách?",
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
                    url: '<?php echo base_url() ?>admin/news/delete/' + id,
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

    function remove_product(id) {
        if (id === null || id === 0) return;

        swal({
            title: 'Xác nhận xóa',
            text: "Bạn có muốn xóa sản phẩm này khỏi danh sách?",
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
                    url: '<?php echo base_url() ?>admin/product/delete/' + id,
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