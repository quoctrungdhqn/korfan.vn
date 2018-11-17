<?php
$CI       =&get_instance();
$CI->load->helper('language');
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$CI->load->model('Pages_Model');
$CI->load->model('Slide_model');
$category = $CI->Product_category_model->getParents();
//$child = $CI->Product_Category_Model->getCategoryChild('1032');

?>

<div class="container bg_menu">
	<div class="container-fluid">
		<div class="logo">
			<div class="row">
				<div class="col-sm-3">
					<a href="<?php echo base_url();?>">
						<img class="img-responsive" src="<?php echo base_url(); ?>templates/default/images/logo_1.png" alt="dulichthienduong">
					</a>
				</div>

				<div class="col-sm-9">
					<img class="img-responsive" src="<?php echo base_url(); ?>templates/default/images/bg_top.png" alt="">
				</div>

			</div>
		</div> <!-- end .logo -->

		<div class="menu">
			<nav class="navbar navbar-default yamm">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!--<a class="navbar-brand" href="#">Brand</a>-->
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">

							<li>
								<a href="<?php echo base_url(); ?>">
									<i class="fa fa-home" style="font-size:20px;">
									</i>
								</a>
							</li> <!-- end .icon_home -->

							<?php
				foreach($category as $items)
				{
					?>

					<li class="dropdown yamm-fw">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">
							<?php echo $items->name;?>
							<b class="caret">
							</b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="yamm-content">

									<div class="row">

										<?php
										$list_tour = $CI->Product_model->getAllProductLimitsByCat($items->id,6);
										foreach($list_tour as $item){

											?>
											<?php
											if($item->image != ''){
												$img1 = explode(',',$item->image);
											}
											?>

											<div class="col-sm-2">
												<div class="box-item">
													<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html" class="thumbnail">

														<img class="img-responsive" style="width: 100%; height:100px; " src="<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>" alt="<?php echo $item->title; ?>">
													</a>
													<h3 class="media-heading">
														<a href="<?php echo base_url(); ?>tour/<?php echo $item->alias; ?>.html">
															<?php echo $item->title; ?>
														</a>
													</h3>
													<div class="price">
														<b>
															Giá :
														</b>
														<font>
															<?php echo number_format(@$item->price)?> VNĐ
														</font>
													</div>
												</div>
											</div>

											<?php
										} ?>

									</div>
								</div>
							</li>
						</ul>
					</li>

					<?php
				} ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div> <!-- end .menu -->

		<div class="slide">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php $i  = 0; ?>
					<?php
					$slide = $CI->Slide_model->getSliders();
					foreach($slide as $item)
					{
						?>
						<?php
						if(@$item->image != ''){
							$img = explode(',', $item->image);

							?>

							<li data-target="#myCarousel" data-slide-to="0" class="<?php
							if($i == 0) echo 'active'; ?>">
							</li>
							<?php
							$i++;
						}
						?>
						<?php
					}
					?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php $i = 0; ?>
					<?php
					foreach($slide as $item)
					{
						?>

						<div class="item <?php
						if($i == 0) echo ' active'; ?>">
							<?php
							if(@$item->image != ''){
								$img = explode(',', $item->image);

								?>
								<img class="img-responsive" src="<?php echo base_url();?>uploads/slide/<?php echo $img[0]; ?>" alt="<?php echo $item->title; ?>">
								<?php
								$i++;
							}
							?>
						</div>
						<?php
					}
					?>

				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div> <!-- end .slide -->

	</div> <!-- end .contaier-fluid -->
</div> <!-- end .menu -->