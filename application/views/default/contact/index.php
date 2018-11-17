<div class="sidebar-right" id="main">
<div class="wf-wrap">
<div class="wf-container-main">
<div id="content" class="content2" role="main">
<div class="panel panel-default mr">
<div class="panel-heading">
    <h3 class="panel-title">Liên hệ</h3>
  </div>
    <div class="panel-body">
						<address>
						<strong style="color: red; font-size:18px;">Công ty TNHH CNTT và giải pháp trực tuyến Hưng Thịnh</strong><br>

						Địa chỉ: 47 Đường 79 - Quận 7 - TP Hồ Chí Minh<br>

						<i class="icon-phone-sign"></i> Điện thoại: 0986 129 895<br>

						<i class="icon-envelope"></i> Email : cttornado@gmail.com<br>

						</address>
							
       <div class="col-12">

	  

			<div class="panel">

					

			<div class="panel-body">

			
			<?php echo $this->session->flashdata('message');?>
			

			<form  id="feedbackForm" role="form" method="POST" action="<?php echo base_url()?>contact/send">

			      <div class="form-group">

				<input type="text" placeholder="Họ tên" required="" name="name" id="name" class="form-control">

				<span style="display: none;" class="help-block">Họ tên .</span>

			      </div>

			      <div class="form-group">

				<input type="text" placeholder="Số điện thoại" required="" name="hotline" id="hotline" class="form-control">

				<span style="display: none;" class="help-block">Please enter your hotline.</span>

			      </div>

			      <div class="form-group">

				<input type="email" required="" placeholder="Địa chỉ email" name="email" id="email" class="form-control">

				<span style="display: none;" class="help-block">Please enter a valid e-mail address.</span>

			      </div>

			      <div class="form-group">

				<input type="text" required="" placeholder="Tiêu đề" name="title" id="title" class="form-control">

				<span style="display: none;" class="help-block">Please enter your title.</span>

			      </div>

			      <div class="form-group">

				<textarea placeholder="Nội dung " required="" name="message" id="message" class="form-control" cols="100" rows="10"></textarea>

				<span style="display: none;" class="help-block">Please enter a message.</span>

			      </div>

			        <div class="checkbox">

    <label>

      <input type="checkbox"> Check me out

    </label>

  </div>

			      <img alt="CAPTCHA Image" src="http://demo.bootstraptor.com/contact_bs3/library/vender/securimage/securimage_show.php?0.17121165022474327" id="captcha">

			      <a class="btn btn-info btn-sm" onclick="document.getElementById('captcha').src = 'http://demo.bootstraptor.com/contact_bs3/library/vender/securimage/securimage_show.php?' + Math.random(); return false" href="#">Show a Different Image</a><br>

			      <div style="margin-top: 10px;" class="form-group">

				<input type="text" placeholder="For security, please enter the code displayed in the box." id="captcha_code" name="captcha_code" class="form-control">

				<span style="display: none;" class="help-block">Please enter the code displayed within the image.</span>

			      </div>

			      

			      <span style="display: none;" class="help-block">Please enter a the security code.</span>

			      <input style="display: block; margin-top: 10px;" name="btnSend" value="Gửi" class="btn btn-danger" id="btnSend" type="submit" />

			    </form>

			<!-- END CONTACT FORM -->

			</div>

			</div>			

		</div>
</div>
</div>
</div>
</div>
</div>
</div>