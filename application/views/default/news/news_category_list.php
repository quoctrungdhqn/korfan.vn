<?php
$CI          =& get_instance();
$CI->load->model('Custom_model');
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$artiles = $CI->News_model->get_all_items(1015,15,0);
$category= $CI->Product_category_model->getAllProductsCategories();
?>

<div class="container">
	<div class="list-tour">

		<h2>
			<a href="#">
				<?php echo @$name;?>
			</a>
		</h2>

		<?php
		foreach($list as $item)
		{

			?>
			<?php
			if($item->image != '')
			{
				$img1 = explode(',',$item->image);
			}
			?>

			<div class="col-md-3 no-pl">
				<div class="box-item">
					<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html" class="thumbnail">
						<img class="img-responsive" style="width: 100%; height:200px; overflow: hidden;cursor: move;" alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>"
						src="<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>" onerror="this.src='<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>';" />
					</a>
					<h3 class="media-heading">
						<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html">
							<?php echo $item->title; ?>
						</a>
					</h3>
					<div class="duration">
						<b>
							Thời gian :
						</b> <?php echo $item->thoigian; ?>
					</div>
					<div class="price">
						<b>
							Giá :
						</b>
						<font>
							<?php echo number_format(@$item->price)?> ₫
						</font>
					</div>
				</div>

			</div>

			<?php
		} ?>


	</div>

</div>
