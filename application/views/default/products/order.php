<?php
$CI      =& get_instance();
$CI->load->model('Product_Category_Model');
$CI->load->model('Product_Model');
$artiles = $CI->News_model->get_all_items_limit_cat(1015,5,0);
$category= $CI->Product_category_model->getAllProductsCategories();
?>

<h2>
	TOUR ĐÃ CHỌN
</h2>

<div class="form_tour">
	<form action="<?php echo base_url() ?>product/order/<?php echo $detail->id;?>" method="post" class="wow fadeInLeft">
		<div class="form-group">
			<input type="text" required class="form-control" readonly="readonly" name="tour" value="<?php echo $detail->title;?>" placeholder="Tour của bạn">
		</div>
		<div class="form-group">
			<input type="text" required class="form-control" name="name" placeholder="Tên của bạn">
		</div>
		<div class="form-group">
			<input type="email" required class="form-control" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input type="tel" required class="form-control" name="phone" placeholder="Số điện thoại">
		</div>
		<div class="form-group">
			<input type="text" required class="form-control" name="address" placeholder="Địa chỉ">
		</div>
		<input type="submit" name="btnSend" class="btn btn-info" value="ĐẶT TOUR NGAY" />
	</form>
</div> <!-- end .form_tour -->