<?php
$CI =& get_instance();
$CI->load->model('Product_model');
$CI->load->model('Product_category_model');
?>



<?php
//$category_1 = $CI->Product_category_model->getParents();
foreach($category as $items):
	?>

	<a href="<?php echo base_url();?>danh-muc-tour/<?php echo $items->alias;?>">
		<h2><?php echo $items->name; ?></h2>
	</a>

	<div class="row">
		<?php
		$list_tour = $CI->Product_model->getAllProductLimitsByCat($items->id, 3);
		foreach($list_tour as $item):
			if($item->image != '')
			{
				$img1 = explode(',',$item->image);
			}
			?>
			<div class="col-sm-4 thongtintour">

				<!--						<img class="img-responsive news_tour" src="--><?php //echo base_url(); ?><!--templates/default/images/New-Corner.png" alt="news icon">-->

				<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html">
					<img style="height:180px; width: 100%;" class="img-responsive" src="<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>" alt="<?php echo $item->title;?>">
				</a>



				<div class="info_tour">
					<div class="title_tour" style="height: 55px; width: 100%;">
						<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html">
							<h3>
								<?php
								$str = $item->title;
								$str = strip_tags($str); //Lược bỏ các tags HTML
								if(strlen($str)>80) { //Đếm kí tự chuỗi $str, 250 ở đây là chiều dài bạn cần quy định
									$strCut = @substr($str, 0, 150); //Cắt 250 kí tự đầu
									$str = @substr($strCut, 0, @strrpos($strCut, ' ')).'...';
								}
								echo $str;
								//echo $item->title;?>
							</h3>
						</a>
					</div>



                            <span class="price">
                                Giá từ: <span class="custom_sp"><?php echo number_format(@$item->price)?> VNĐ</span>
                            </span>

					<div class="introTour">
						<p class="khoihanh">
							<b>Khởi hành:</b>
							<?php
							$str = $item->khoihanh;
							$str = strip_tags($str); //Lược bỏ các tags HTML
							if(strlen($str)>20) { //Đếm kí tự chuỗi $str, 250 ở đây là chiều dài bạn cần quy định
								$strCut = @substr($str, 0, 20); //Cắt 250 kí tự đầu
								$str = @substr($strCut, 0, @strrpos($strCut, ' ')).'...';
							}
							echo $str;
							//echo $item->khoihanh; ?>
						</p>

						<p class="diemkh">
							<b>Phương tiện:</b>
							<?php
							$str = $item->phuongtien;
							$str = strip_tags($str); //Lược bỏ các tags HTML
							if(strlen($str)>80) { //Đếm kí tự chuỗi $str, 250 ở đây là chiều dài bạn cần quy định
								$strCut = @substr($str, 0, 80); //Cắt 250 kí tự đầu
								$str = @substr($strCut, 0, @strrpos($strCut, ' ')).'...';
							}
							echo $str;
							//echo $item->phuongtien; ?>
						</p>

						<p class="tg">
							<b>Thời gian:</b> <?php echo $item->thoigian; ?>
						</p>
					</div> <!-- end .introTour -->

				</div> <!-- end .info_tour -->

			</div>
			<?php
		endforeach;
		?>
	</div>

	<?php
endforeach;
?>

<h2>
	<a href="<?php echo base_url(); ?>an-tuong-du-lich">Video</a>
</h2>

<div class="video">
	<div class="owl-carousel owl-theme">
	<?php 
		$video = $CI->Video_model->getvideolimit(4,0);
		foreach ($video as $item):
	?>
        <div class="item">
			<iframe class="img-responsive" src="<?php echo $item->link; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
       <?php endforeach; ?>
    </div>
	

</div>

