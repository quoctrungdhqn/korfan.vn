<?php
$CI         =& get_instance();
$CI->load->model('Product_model');
$CI->load->model('Product_category_model');
$CI->load->model('News_model');
?>

<?php echo $header; ?>

<?php echo $menu; ?>

<div class="page_wrapper">

    <div class="container">

        <?php echo $slide; ?>

        <?php echo $advertising; ?>

        <?php echo $content; ?>

    </div><!--/ .container-->

</div>

<?php echo $bottom; ?>
