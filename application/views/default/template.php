<?php
$CI         =& get_instance();
$CI->load->model('Product_model');
$CI->load->model('Product_category_model');
$CI->load->model('News_model');
?>

<?php echo $header; ?>

<?php echo $menu; ?>

<div class="container main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 left">
                <h2>Danh mục tour</h2>

                <div class="list_left">
                    <ul class="list-unstyled">
                        <?php
                            $list = $CI->Product_category_model->getParents();
                            foreach($list as $items):
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>danh-muc-tour/<?php echo $items->alias; ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <?php echo $items->name; ?>
                            </a>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>


                <h2>Dịch vụ</h2>

                <div class="list_left">
                    <ul class="list-unstyled">
                        <?php
                            $dichvu = $CI->News_model->get_all_items_cats(1020,10,0);
                            foreach($dichvu as $items):
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>bai-viet/<?php echo $items->alias; ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <?php echo $items->title; ?>
                            </a>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
				
				<h2>
                    Kinh nghiệm du lịch
                </h2>
                
                <div class="kn_dulich list_left">
                	<ul class="list-unstyled">
                	<?php
                		$artiles1 = $CI->News_model->get_all_items_limit_cat(1015,10,0);
                		foreach($artiles1 as $items):
                	?>
                		<li>
                			<a href="<?php echo base_url();?>bai-viet/<?php echo $items->alias; ?>.html">
                			<i class="fa fa-angle-double-right" aria-hidden="true"></i>
                				<?php echo $items->title; ?>
                			</a>
                		</li>
                	<?php
                		endforeach;
                	?>
                	</ul>
                </div> <!-- end .kn_dulich -->

                <h2>
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Hỗ trợ trực tuyến
                </h2>

                <div class="support">
                    <p><i class="fa fa-user" aria-hidden="true"></i> Mr. Khải</p>
                    <p><i class="fa fa-phone-square" aria-hidden="true"></i> 01699873335 - 0918.389.417</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i>buiphankhai1979@gmail.com</p>
                </div>

            </div> <!-- end .left -->

            <div class="col-sm-9 right">
                <?php echo $content; ?>
            </div> <!-- end .right -->

        </div>
    </div> <!-- end .container-fluid -->
</div> <!-- end .main -->



<?php echo $bottom; ?>
