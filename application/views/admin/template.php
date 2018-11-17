<?php
date_default_timezone_set("Asia/Bangkok");

if ($this->session->userdata('loggedAdmin') == false) {
    redirect('access');
} else {
    $CI =& get_instance();
    $user = $CI->session->userdata('userLogged');
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo base_url(); ?>uploads/favicon.png">

    <title>
        Dashboard | Quản trị nội dung website
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/bootstrap-theme.min.css">

    <!-- Bootstrap Admin Theme -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/bootstrap-admin-theme-change-size.css">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/DT_bootstrap.css">
    <!-- Vendors -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/vendors/bootstrap-datepicker/css/datepicker.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/datepicker.fixes.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/vendors/uniform/themes/default/css/uniform.default.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/uniform.default.fixes.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/vendors/chosen.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/vendors/selectize/dist/css/selectize.bootstrap3.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url(); ?>templates/admin/css/style.css">

</head>
<body class="bootstrap-admin-with-small-navbar">
<?php echo $header; ?>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <?php echo $left; ?>
        <!-- content -->
        <div class="col-md-10">

            <div class="row">
                <?php echo $content; ?>

            </div>

        </div>
    </div>
</div>
<!-- Script -->
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.all.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/dist/sweetalert2.min.js"></script>
<footer>
    <a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>
</footer>
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function () {      // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0                       // Scroll to top of body
        }, 500);
    });
</script>
</body>
</html>