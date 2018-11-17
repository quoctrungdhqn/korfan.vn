<div class="col-lg-12">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">
                <?php echo $pageTitle; ?>
                <a href="<?php echo base_url() ?>admin/menu/edit" title="Thêm mới menu"
                   class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
            </div>
        </div>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="bootstrap-admin-panel-content">
            <div class="box-body table-responsive">
                <ul>
                    <?php
                    function getSubcategory($parent_id)
                    {
                        $CI =& get_instance();
                        $query = $CI->db->get_where('cp_menus', array('parent' => $parent_id));
                        $result = $query->result_array();
                        foreach ($result as $row) {
                            echo '<ul>';
                            echo '<a href="' . base_url() . 'admin/menu/edit/' . $row['id'] . '" >' . "|---|--- " . $row['name'] .
                                '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor: pointer" onclick="remove_menu(' . $row['id'] . ')"><i class="glyphicon glyphicon-remove"></i><a><br><br>';
                            getSubcategory($row['id']);
                            echo '</ul>';
                        }
                    }

                    foreach ($list_menu as $row) {
                        // Tra lai tat ca cac Menu cha
                        echo '<b><a href="' . base_url() . 'admin/menu/edit/' . $row['id'] . '" >' . "|--- " . $row['name'] .
                            '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor: pointer" onclick="remove_menu(' . $row['id'] . ')"><i class="glyphicon glyphicon-remove"></i><a></b><br><br>';
                        // Neu ton tai cac Menu con thi se duoc hien thi
                        getSubcategory($row['id']);
                    }
                    ?>
                </ul>
            </div>
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
    function remove_menu(id) {
        if (id === null || id === 0) return;
        swal({
            title: 'Xác nhận xóa',
            text: "Bạn có muốn xóa menu này khỏi danh sách?",
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
                    url: 'delete/' + id,
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
