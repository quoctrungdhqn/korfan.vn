<div class="container footer">
	<div class="container-fluid">
		<div class="row">
		<div class="col-sm-4">
			<h3>Thông tin liên hệ</h3>
			<p>
				Phone:  01699873335 - 0918.389.417 (Khải)
			</p>
			<p>
				Email: buiphankhai1979@gmail.com
			</p>
		</div>
		<div class="col-sm-4">
			<h3>Thời gian làm việc</h3>
			<p>7h - 17h00<br>Từ Thứ 2 - Chủ nhật</p>
		</div>
		<div class="col-sm-4">
			<h3>Liên kết</h3>

			<ul class="soc">
				<li>
					<a class="soc-twitter" href="#">
					</a>
				</li>
				<li>
					<a class="soc-facebook" href="#">
					</a>
				</li>
				<li>
					<a class="soc-google" href="#">
					</a>
				</li>
			</ul>

		</div>
	</div>
	</div> <!-- end .container-fluid -->
</div> <!-- end .footer -->

<div class="container footer_bottom">
	<p class="text-center">© 2016 Firerox. All rights reserved. Designed & developed by Firerox Design</p>
</div> <!-- end .footer_bottom -->

<div class="float_left_ads" style="top:0px">
	<img class="img-responsive" src="<?php echo base_url(); ?>templates/default/images/cau-doi-tet-2017-left_1.png" alt="dulic">
</div>

<div class="float_right_ads" style="top:0px">
	<img class="img-responsive" src="<?php echo base_url(); ?>templates/default/images/cau-doi-tet-2017-right_1.png" alt="dulich1">
</div>



<script src="<?php echo base_url(); ?>templates/default/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>templates/default/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>templates/default/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>templates/default/js/jquery.responsiveTabs.min.js"></script>
<script src="<?php echo base_url(); ?>templates/default/js/scrolltopcontrol.js"></script>
<script>
	$('#responsiveTabsDemo').responsiveTabs({
		startCollapsed: 'accordion'
	});
</script>

<script>
    $(document).ready(function ()
    {
        $("#bs-example-navbar-collapse-1 .nav li").removeClass("active");//this will remove the active class from
        //previously active menu item

        //$(".navigation .nav li:eq(0)").addClass("active");
		$("img").addClass("img-responsive");
		$("table").addClass("table table-responsive");
    });
</script>

<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items:3,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true
    });
    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })
</script>

<script>
	function myFunction(x) {
		x.classList.toggle("change");
	}
</script>
<!--<script>
    $(document).ready(function()
    {

        $(window).scroll(function ()
        {
            //if you hard code, then use console
            //.log to determine when you want the
            //nav bar to stick.
            console.log($(window).scrollTop())
            if ($(window).scrollTop() > 80)
            {
                $('.menu').addClass('navbar-fixed-top');
            }
            if ($(window).scrollTop() < 80)
            {
                $('.menu').removeClass('navbar-fixed-top');
            }
        });
    });
</script>-->
   
	</body>
</html>