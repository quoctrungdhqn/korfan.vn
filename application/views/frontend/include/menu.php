<?php
$CI =& get_instance();
$CI->load->helper('language');
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$CI->load->model('Pages_Model');
$CI->load->model('Slide_model');
$category = $CI->Product_category_model->getParents();

?>

<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->

<div id="main_navigation_wrap">

    <div class="container">

        <div class="row">

            <div class="col-xs-12">

                <!-- - - - - - - - - - - - - - Sticky container - - - - - - - - - - - - - - - - -->

                <div class="sticky_inner type_2">

                    <!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

                    <div class="nav_item size_3">

                        <button class="open_categories_sticky">Danh mục</button>

                        <!-- - - - - - - - - - - - - - Main navigation - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu cats dropdown">

                            <li class="has_megamenu animated_item"><a href="#">Medicine &amp; Health (1375)</a></li>
                            <li class="has_megamenu animated_item"><a href="#">Baby Needs (525)</a></li>
                            <li class="has_megamenu animated_item"><a href="#">Diet &amp; Fitness (135)</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

                    </div><!--/ .nav_item-->

                    <!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

                    <div class="nav_item">

                        <nav class="main_navigation">

                            <ul>

                                <li><a href="#">TRANG CHỦ</a></li>
                                <li><a href="#">SẢN PHẨM IN</a></li>
                                <li><a href="#">TIN TỨC NGÀNH IN</a></li>
                                <li><a href="#">LIÊN HỆ</a></li>

                            </ul>

                        </nav><!--/ .main_navigation-->

                    </div>

                </div><!--/ .sticky_inner -->

                <!-- - - - - - - - - - - - - - End of sticky container - - - - - - - - - - - - - - - - -->

            </div><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .main_navigation_wrap-->

<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->

</header>