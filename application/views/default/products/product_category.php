<?php
	$CI =& get_instance();
?>

<div class="list-tour">

		<h2>
			<a href="#">
				<?php
				//if($CI->session->userdata('languageTT') == 'vi')
				echo @$name;
				//else
				//echo @$name_en;
				?>
			</a>
		</h2>

		<div class="row">
			<?php
			foreach($list as $item) {

				?>
				<?php
				if ($item->image != '') {
					$img1 = explode(',', $item->image);
				}
				?>
				<div class="col-sm-4 thongtintour">

					<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html">
						<img style="height:180px; width: 100%;" class="img-responsive"
							 src="<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>"
							 alt="<?php echo $item->title; ?>">
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
								<b>Thời gian:</b> <?php echo $item->thoigian; ?> </p>
						</div> <!-- end .introTour -->

					</div> <!-- end .info_tour -->

				</div>
				<?php
			}
			?>
		</div>

</div>