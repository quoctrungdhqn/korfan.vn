<?php
$CI =& get_instance();
$CI->load->model('News_model');
$CI->load->model('News_category_model');
$CI->load->model('Product_model');
$CI->load->model('Product_category_model');
$total_news = $CI->News_model->get_items_num();
$total_news_cat = $CI->News_category_model->get_items_num();
$total_products = $CI->Product_model->getProductsNum();
$total_products_cat = $CI->Product_category_model->getProductsCategoryNum();
?>

<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <li>
            <a href="<?php echo base_url() ?>admin/configuration/view"><i
                        class="glyphicon glyphicon-chevron-right"></i> Cấu hình website</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/menu/view"><i
                        class="glyphicon glyphicon-chevron-right"></i> Quản lý menu</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/news/view"><span
                        class="badge pull-right"><?php echo $total_news; ?></span> Quản lý bài viết</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/news_category/view"><span
                        class="badge pull-right"><?php echo $total_news_cat; ?></span> Danh mục bài viết</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/product/view"><span class="badge pull-right"><?php echo $total_products; ?></span>Quản lý sản
                phẩm</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/product_category/view"><span class="badge pull-right"><?php echo $total_products_cat; ?></span>
                Danh
                mục sản phẩm</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/slide/view"><span class="badge pull-right"></span><i
                        class="glyphicon glyphicon-chevron-right"></i> Quản lý slide</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/page/view"><span class="badge pull-right"></span><i
                        class="glyphicon glyphicon-chevron-right"></i> Quản lý trang</a>
        </li>

        <li>
            <a href="<?php echo base_url() ?>admin/custom/view"><i class="glyphicon glyphicon-chevron-right"></i>
                Module
                HTML</a>
        </li>
    </ul>
</div>
