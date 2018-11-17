<div class="container">
	<div class="list-tour">
<?php
	$CI       =& get_instance();
	$CI->load->model('News_Model');
	$CI->load->model('News_Category_Model');
	$id1=$id;
	$link = $CI->News_Category_Model->getAllNew_TC($id1);
?>
		<?php 
			foreach($link as $items): ?>
			<h2>
				<a href="#">
					<!--</*?php echo @$name;?*/>-->
					<?php echo $items->title; ?>
				</a>
			</h2>
		<?php endforeach; ?>
		<?php
		foreach($list as $item)
		{

			?>
			<?php
			if($item->images != '')
			{
				$img = explode(',',$item->images);
			}
			?>

			<div class="col-md-2 no-pl_bv">
				<div class="box-item">
					<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>" class="thumbnail">
						<img class="img-responsive" style="width: 100%; height:150px; overflow: hidden;cursor: move;" alt="<?php echo $item->title; ?>" 
						src="<?php echo base_url(); ?>uploads/news/<?php echo @$img[0]; ?>" />
					</a>
					<h3 class="media-heading">
						<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>.html">
						
							<?php
													
								$timestamp = strtotime($item->created);
								
								$day = date('d', $timestamp);
								$mon = date('m', $timestamp);
								$year = date('y', $timestamp);
								
								$d=strtotime("today");
								$today_day = date('d',$d);
								
								$ngay = $today_day - $day;
								$thang = date('m',$d) - $mon; 
								$nam = date('y',$d) - $year;
														
								if($ngay == 0 && $thang == 0 && $nam == 0)
								{
							?>
								<span class="img_news"> </span>
							<?php 
								}
							?>
								<span><?php echo $item->title; ?></span>
						</a>
					</h3>
				</div>

			</div>

			<?php
		} ?>


	</div>

</div>