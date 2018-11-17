<?php
$CI       =& get_instance();
$CI->load->model('News_Model');
$CI->load->model('News_Category_Model');
//$artiles1 = $CI->News_model->get_all_items_cats('',4,0);
//$artiles2 = $CI->News_model->get_all_items_cats('',4,4);
$artiles1 = $CI->News_model->get_all_items_limit_cat(1015,4,0);
$artiles2 = $CI->News_model->get_all_items_cats(1015,4,4);
$link = $CI->News_Category_Model->getAllNew();
?>

<div class="container">
	<div class="row">
		<div class="row">
			<!--<div class="col-md-10" >
			<h2 class="text-center" >
			<a style="font-family: UTMSwissBold;font-size: 28px;text-transform: uppercase;" href="#">
			Kinh nghiệm du lịch
			</a>
			</h2>
			</div>-->

			<div class="col-md-4">


			</div>

			<div class="col-md-4">
				<?php foreach($link as $items): ?>
					<h2 class="text-center" >
						<a style="font-family: UTMSwissBold;font-size: 28px;text-transform: uppercase;" href="<?php echo base_url();?>danh-sach-bai-viet/<?php echo $items->alias;?>">
							<?php 
								//if($CI->session->userdata('languageTT') == 'vi')
									echo $items->title;
								//else
									//echo $items->title_en;
							?>
						</a>
					</h2>
				<?php endforeach; ?>
			</div>


			<div class="col-md-2">

			</div>

			<div class="col-md-2">
				<div class="controls pull-right hidden-xs">
					<a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
				data-slide="prev">
					</a>
					<a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
				data-slide="next">
					</a>
				</div>
			</div>


		</div>
		<div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner">

				<?php $i        = 0; ?>

				<div class="item active">

					<div class="row">
						<?php
						foreach($artiles1 as $item)
						{
							?>
							<div class="col-sm-3">
								<div class="col-item">
									<div class="thumbnail">
										<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>">
											<img src="<?php echo base_url(); ?>uploads/news/<?php echo $item->images; ?>" class="img-responsive" style="width: 100%; height:200px; overflow: hidden;cursor: move;" alt="<?php echo $item->title; ?>" />
										</a>
									</div>
									<div class="info">
										<div class="row">
											<div class="price col-md-6">
												<h3 class="media-heading">
												<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>">
													<?php
													
														$timestamp = strtotime($item->created);
														$day = date('d', $timestamp);
														$d=strtotime("today");
														$today_day = date('d',$d);
														$ngay = $today_day - $day;
														
														if($ngay == 0)
														{
													?>
														<span class="img_news"> </span>
													<?php 
														}
													?>
														<span><?php echo $item->title; ?></span>
															
													</a>
													
													

													<i>
													(Lượt xem: <?php echo number_format($item->hits); ?>)
													<!--<?php 
										if($CI->session->userdata('languageTT') == 'vi'){
									?>
										(Lượt xem: <?php echo number_format($item->hits); ?>) 
									<?php 
										}else{
									?>
										(Views: <?php echo number_format($item->hits); ?>)
										<?php }?>--></i>
												</h3>
												
												
											</div>
											
										</div>
										<div class="clearfix">
										</div>
									</div>
								</div>
							</div>

							<?php
						}
						?>
					</div>
				</div>




				<div class="item">

					<div class="row">
						<?php
						foreach($artiles2 as $item)
						{
							?>
							<div class="col-sm-3">
								<div class="col-item">
									<div class="thumbnail">
										<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>">
											<img src="<?php echo base_url(); ?>uploads/news/<?php echo $item->images; ?>" class="img-responsive" style="width: 100%; height:200px; overflow: hidden;cursor: move;" alt="<?php echo $item->title; ?>" />
										</a>
									</div>
									<div class="info">
										<div class="row">
											<div class="price col-md-6">
												<h3 class="media-heading">
													<a href="<?php echo base_url(); ?>bai-viet/<?php echo $item->alias; ?>">
														<?php //echo $item->title; ?>
														<?php
													
														$timestamp = strtotime($item->created);
														$day = date('d', $timestamp);
														$d=strtotime("today");
														$today_day = date('d',$d);
														$ngay = $today_day - $day;
														
														if($ngay == 0)
														{
													?>
														<span class="img_news"> </span>
													<?php 
														}
													?>
														<span><?php echo $item->title; ?></span>
															
													</a>
													<i>(Lượt xem: <?php echo number_format($item->hits); ?>)</i>
												</h3>
												
											</div>

										</div>

										<div class="clearfix">
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>