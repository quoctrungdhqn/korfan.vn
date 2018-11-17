<html lang="vi">
<head>
	<h1 style="margin:0px !important;">
		<title>
			<?php
			if(@$config->seo_title != '')
			{

				echo @$config->seo_title;
				echo @$config->name;
			}

			else
			{
				echo @$config->title;
				echo @$title1->value;
			}
			?>
		</title>
	</h1>

	<meta name="keywords" content="<?php
	if(@$config->seo_keyword)
	{

		echo @$config->seo_keyword;
	}
	else
	{
		echo @$keyword->value;
	}
	?>" />
	<meta name="description" content="<?php
	if(@$config->seo_description)
	{

		echo @$config->seo_description;
	}
	else
	{
		echo @$description->value;
	}
	?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<link rel="icon" href="https://lh3.googleusercontent.com/LY3serD-LP_vLcI6rY_GeWyF_IRORR-Aqph1jyoHkdYEggnJw85-RE07VJ5q65HmlOOaGtNdHw=w1366-h768-rw-no" type="image/x-icon" />-->

	<link href="<?php echo base_url(); ?>templates/default/css/style.css" rel="stylesheet"/>
	<link href="<?php echo base_url(); ?>templates/default/css/responsive.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/default/css/font-awesome.min.css">
	<link href="<?php echo base_url(); ?>templates/default/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>templates/default/css/responsive-tabs.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>templates/default/css/yamm.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>templates/default/css/owl.carousel.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>templates/default/css/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>templates/default/css/owl.theme.green.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="container top-bar">
	<div class="container-fluid">
		<ul class="list-unstyled list-inline navbar-right">
			<li>
				<i class="fa fa-envelope" aria-hidden="true"></i>
				buiphankhai1979@gmail.com
			</li>

			<li>
				<i class="fa fa-phone-square" aria-hidden="true"></i>
				01699873335 - 0918389417
			</li>

			<li>
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				Nhơn lý
			</li>

		</ul>
	</div> <!-- end container-fluid -->
</div> <!-- end .top-bar -->





