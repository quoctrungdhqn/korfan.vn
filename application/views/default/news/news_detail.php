<?php
$CI      =& get_instance();
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$artiles = $CI->News_model->get_all_items_limit_cat(1015,15,0);
$category= $CI->Product_category_model->getAllProductsCategories();
?>

<h2>
	<?php echo $list->title; ?>
</h2>

<div class="news_info">
	<!--<div class="time">
	<i class="fa fa-calendar" aria-hidden="true"></i>
	<i class="time"><?php /*echo date("d-m-y", strtotime($list->created));*/?></i>
	<i class="fa fa-eye" aria-hidden="true"></i>
	<i><?php /*echo number_format($list->hits); */?></i>
	</div> -->

	<?php
	echo $list->detail;
	?>

	<div class="fb-comments" data-numposts="5" data-mobile="true">
	</div>

</div> <!-- end .news_info -->

<h2>
	Bài viết liên quan
</h2>

<div class="baivietlienquan">
	<div class="row">
		<?php
		foreach($relative_product as $list): ?>
		<div class="col-sm-3 thongtintour">

			<a href="<?php echo base_url();?>bai-viet/<?php echo $list->alias; ?>.html">
				<img style="height:150px; width: 100%;" class="img-responsive" 
				src="<?php echo base_url();?>uploads/news/<?php echo $list->images; ?>" alt="<?php echo $list->title; ?>">
			</a>


			<div class="info_tour">
				<div class="title_tour" style="height: 55px; width: 100%;">
					<a href="<?php echo base_url();?>bai-viet/<?php echo $list->alias; ?>.html">
						<h3 style="border: none !important;" >
							<?php echo $list->title; ?>
						</h3>
					</a>
				</div>
			</div> <!-- end .info_tour -->

		</div>
		<?php endforeach; ?>
	</div>
</div> <!-- end .baivietlienquan -->

<div id="fb-root">
</div>


<div id="fb-root">
</div>
<script>
	(function(d, s, id)
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
</script>
