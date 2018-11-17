<html lang="vi">
<head>
    <!-- Basic page needs
    ============================================ -->
    <title><?php
        if (@$config->seo_title != '') {

            echo @$config->seo_title;
            echo @$config->name;
        } else {
            echo @$config->title;
            echo @$title->value;
        }
        ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="vi"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php
    if (@$config->seo_title != '') {

        echo @$config->seo_title;
        echo @$config->name;
    } else {
        echo @$config->title;
        echo @$title->value;
    }
    ?>"/>
    <meta property="og:description"
          content="<?php
          if (@$config->seo_description) {

              echo @$config->seo_description;
          } else {
              echo @$description->value;
          }
          ?>"/>
    <meta name="description" content="<?php
    if (@$config->seo_description) {

        echo @$config->seo_description;
    } else {
        echo @$description->value;
    }
    ?>">
    <meta name="keywords" content="<?php
    if (@$config->seo_keyword) {

        echo @$config->seo_keyword;
    } else {
        echo @$keyword->value;
    }
    ?>">

    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>uploads/favicon.png">

    <!-- Google web fonts
    ============================================ -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>

    <!-- Libs CSS
    ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/css/fontello.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/css/bootstrap.min.css">

    <!-- Theme CSS
    ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/js/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/js/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/js/arcticmodal/jquery.arcticmodal.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/frontend/css/style.css">

    <!-- JS Libs
    ============================================ -->
    <script src="<?php echo base_url(); ?>templates/frontend/js/modernizr.js"></script>
</head>
<body class="front_page">


<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

<div class="wide_layout">

    <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

    <header id="header" class="type_5">

        <!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->

        <div class="bottom_part">

            <div class="container">

                <div class="row">

                    <div class="main_header_row">

                        <div class="col-sm-3">

                            <!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

                            <a href="index.html" class="logo">

                                <img src="<?php echo base_url(); ?>templates/frontend/images/logo.png" alt="">

                            </a>

                            <!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

                        </div><!--/ [col]-->

                        <div class="col-sm-5">

                            <div class="call_us">

                                <span></span> <b></b>

                            </div>
                            <!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->

                            <form class="clearfix search">

                                <input type="text" name="" tabindex="1" placeholder="Nhập sản phẩm cần tìm..."
                                       class="alignleft">

                                <button class="button_blue def_icon_btn alignleft"></button>

                            </form><!--/ #search-->

                            <!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->

                        </div><!--/ [col]-->

                        <div class="col-sm-4">
                            <ul class="c_info_list">
                                <li class="c_info_location">8901 Marmora Road, Glasgow</li>
                                <li class="c_info_phone">800-599-65-80</li>
                                <li class="c_info_mail"><a href="mailto:#">info@companyname.com</a></li>

                            </ul><!--/ .clearfix-->

                        </div><!--/ [col]-->

                    </div><!--/ .main_header_row-->

                </div><!--/ .row-->

            </div><!--/ .container-->

        </div><!--/ .bottom_part -->

        <!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->




