<?php
$CI =& get_instance();
$CI->load->model('Product_model');
$CI->load->model('Video_model');
?>
<div class="container">
<div class="row">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->

			<ol class="carousel-indicators">
				<?php $i  = 0; ?>
				<?php
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

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
				</span>
				<span class="sr-only">
					Previous
				</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true">
				</span>
				<span class="sr-only">
					Next
				</span>
			</a>
		</div>
	</div>

	<div class="row search">
		<form action="<?php echo base_url();?>home/search_keyword" method = "post">
			<div class="col-md-2">
				<select class="form-control" id="sel1">
					<option>
						Khởi hành
					</option>
					<option>
						2
					</option>
					<option>
						3
					</option>
					<option>
						4
					</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="sel1">
					<option>
						Nơi đến
					</option>
					<option>
						2
					</option>
					<option>
						3
					</option>
					<option>
						4
					</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="sel1">
					<option>
						Thời gian
					</option>
					<option>
						2
					</option>
					<option>
						3
					</option>
					<option>
						4
					</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="sel1">
					<option>
						Giá
					</option>
					<option>
						2
					</option>
					<option>
						3
					</option>
					<option>
						4
					</option>
				</select>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<input type="text" placeholder="Từ khóa" class="form-control" name="tour_name">
				</div>
			</div>
			<div class="col-md-2">
				<input type="submit" class="btn btn-info" value="TÌM TOUR" name="submit">
			</div>
		</form>
	</div>

	<div class="list-tour">
			<?php
			foreach($results as $rows)
			{

				?>
				<?php
				if($rows->image != '')
				{
					$img1 = explode(',',$rows->image);
				}
				?>

				<div class="col-md-3 no-pl">
					<div class="box-item">
						<a href="<?php echo base_url(); ?>tour/<?php echo $rows->alias; ?>.html" class="thumbnail">
							<img class="img-responsive" style="width: 100%; height:200px; overflow: hidden;cursor: move;" alt="<?php echo $rows->title; ?>" title="<?php echo $rows->title; ?>"
							src="<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>" onerror="this.src='<?php echo base_url(); ?>uploads/product/<?php echo @$img1[0]; ?>';" />
						</a>
						<h3 class="media-heading">
							<a href="<?php echo base_url(); ?>tour/<?php echo $rows->alias; ?>.html">
								<?php echo $rows->title; ?>
							</a>
						</h3>
						<div class="duration">
							<b>
								Thời gian :
							</b> <?php echo $rows->thoigian; ?>
						</div>
						<div class="price">
							<b>
								Giá :
							</b>
							<font>
								<?php echo number_format(@$rows->price)?> ₫
							</font>
						</div>
					</div>

				</div>

				<?php
			} ?>
		</div>

</div>