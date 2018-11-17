<?php
if ($this->session->userdata('loggedAdmin') == false) {
    redirect('access');
} else {
    $CI =& get_instance();
    $user = $CI->session->userdata('userLogged');
}
?>
<!-- small navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">

                    <ul style="font-weight: bold" class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/configuration/view">Cấu hình <i
                                        class="glyphicon glyphicon-cog"></i></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>" target="_blank">Xem trang chủ <i
                                        class="glyphicon glyphicon-share-alt"></i></a>
                        </li>
                        <li class="dropdown">
                            <a role="button" class="dropdown-toggle" data-hover="dropdown"> <i
                                        class="glyphicon glyphicon-user"></i> <?php echo $user->firstname . ' ' . $user->lastname ?>
                                <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>admin/user/edit/<?php echo $user->id; ?>">Thông
                                        tin cá nhân</a></li>

                                <li role="presentation" class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>users/logout">Thoát</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- main / large navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small"
     role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".main-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() ?>admin/dashboard">
                        <img height="40px" style="margin: 5px"
                             src="<?php echo base_url() ?>templates/admin/images/logo_dashboard.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse main-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">Quản lý sản phẩm <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li role="presentation" class="dropdown-header">Quản lý sản phẩm</li>
                                <li><a href="<?php echo base_url() ?>admin/product/edit">Thêm sản phẩm</a></li>
                                <li><a href="<?php echo base_url() ?>admin/product/view">Danh sách sản phẩm</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation" class="dropdown-header">Quản lý danh mục sản phẩm</li>
                                <li><a href="<?php echo base_url() ?>admin/product_category/edit">Thêm mới danh mục</a>
                                </li>
                                <li><a href="<?php echo base_url() ?>admin/product_category/view">Danh sách danh mục</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">Quản lý bài viết <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li role="presentation" class="dropdown-header">Quản lý bài viết</li>
                                <li><a href="<?php echo base_url() ?>admin/news/edit">Thêm bài viết</a></li>
                                <li><a href="<?php echo base_url() ?>admin/news/view">Danh sách bài viết</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation" class="dropdown-header">Quản lý danh mục bài viết</li>
                                <li><a href="<?php echo base_url() ?>admin/news_category/edit">Thêm mới danh mục</a>
                                </li>
                                <li><a href="<?php echo base_url() ?>admin/news_category/view">Danh sách danh mục</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">Quản lý thành viên <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li role="presentation" class="dropdown-header">Quản lý thành viên</li>
                                <li><a href="<?php echo base_url() ?>admin/user/edit">Thêm thành viên</a></li>
                                <li><a href="<?php echo base_url() ?>admin/user/view">Danh sách thành viên</a></li>

                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </div><!-- /.container -->
</nav>