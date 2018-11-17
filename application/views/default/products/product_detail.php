<?php
$CI      =& get_instance();
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$artiles = $CI->News_model->get_all_items_limit_cat(1015,15,0);
$category= $CI->Product_category_model->getAllProductsCategories();
?>
<div class="info_detail">

	<h2>
		<?php
			echo $detail->title;
		?>
	</h2>

	<?php
	$img     = explode(',',$detail->image);
	?>
	<div class="info_detail_1">
		<div class="row">
			<div class="col-sm-4">
				<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>uploads/product/<?php echo $img[0]; ?>" alt="<?php echo $detail->title;?>">
			</div>

			<div class="col-sm-8">
				<div class="detail_tours" style="margin-bottom: 5px;">
					<span style="text-transform: uppercase; font-weight: bold; font-size: 18px;WW">Thông tin chi tiết</span> </br>

					<b>Thời gian: </b> <?php echo $detail->thoigian;?> </br>
					<b>Phương tiện: </b> <?php echo $detail->phuongtien; ?> </br>
					<b>Khởi hành: </b> <?php echo $detail->khoihanh; ?> </br>
					<b>Liên hê: </b> <?php echo $detail->dienthoai;?> </br>
					<b>Bảng giá từ: </b> <?php echo number_format($detail->price)?> VNĐ </br>
				</div>

				<a style="color: #fff !important;" href="<?php echo base_url()?>product/order/<?php echo $detail->id;?>" class="btn btn-info">
					ĐẶT TOUR NGAY
				</a>

			</div>

		</div>

		<div id="responsiveTabsDemo">
			<ul>
				<li><a href="#tab-1"> Chương trình Tour </a></li>
				<li><a href="#tab-2"> Giá </a></li>
				<li><a href="#tab-3"> Điều khoản </a></li>
				<li><a href="#tab-4"> Liên hệ </a></li>
			</ul>

			<div id="tab-1">
				<p style="text-align: justify;"><?php echo $detail->detail; ?></p>
			</div>
			<div id="tab-2">
				<p>
					<?php echo $detail->gia; ?>
				</p>
			</div>
			<div id="tab-3">
				<p>
					<?php echo $detail->dieukhoan; ?>
				</p>
			</div>
			<div id="tab-4">
				<p>
					<?php echo $detail->lienhe; ?>
				</p>
			</div>
		</div>

	</div> <!-- end .info_detail_1 -->

	<h2>Tour liên quan</h2>

	<div class="tour_lienquan_1">
		<div class="row">
			<?php
			foreach($relative_product as $item):
				if($item->image != '')
				{
					$img1 = explode(',',$item->image);
				}
				?>

				<div class="col-sm-4 thongtintour">

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
								if(strlen($str)>80) { //Đếm kí tự chuỗi $str, 250 ở đây là chiều dài bạn cần quy định
									$strCut = @substr($str, 0, 80); //Cắt 250 kí tự đầu
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
	</div> <!-- end .tour_lienquan_1 -->

</div> <!-- end .detail_info -->
