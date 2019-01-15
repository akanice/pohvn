<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php if ($new->title == '' or $new->title == null) {echo 'POH - 280 ngày Thai giáo';} else {echo $new->title;}?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="fb:admins" content=""/>
	<meta property="fb:app_id" content="" />
	<meta name="title" content="<?=@$new->title?>" />
	<meta name="copyright" content="Copyright © 2015 by poh.vn" />
	<meta name="keywords" content="<?=@$new->meta_keywords?>" />
	<meta name="description" content="<?=@$new->meta_description?>" />
	<meta name="og:title" content="<?php if ($new->meta_title == '' or $new->meta_title == null) {echo 'POH - Thai giáo';} else {echo $new->meta_title;}?>" />
	<meta name="og:keywords" content="<?=@$new->meta_keywords?>" />
	<meta name="og:description" content="<?=@$new->meta_description?>" />
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="<?=base_url('assets/img/favicon.ico')?>" rel="shortcut icon">
	<link href="<?=base_url('assets/css/front/bootstrap-submenu.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/landingpage.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/responsive.css')?>" rel="stylesheet">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=vietnamese" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;subset=vietnamese" rel="stylesheet">
</head>

<body>
	<header id="header" class="header-header-3" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<div id="navigation-sticky-wrapper" class="sticky-wrapper" style="height: 60px;">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button class="navbar-toggler" type="button" id="sidebarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>
				<!-- <button type="button" id="sidebarCollapse" class="btn btn-info"> -->
					<!-- <i class="fas fa-align-left"></i> -->
					<!-- <span>Toggle Sidebar</span> -->
				<!-- </button> -->

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="container d-flex flex-column flex-md-row justify-content-between">
						<?php 
						$this->menusmodel->setup_navmenu();
						$this->multi_menu->set_items($navmenu);
						echo $this->multi_menu->render(); ?>
					</div>
				</div>
			</nav>
			
			<!-- Sidebar mobile nav -->
			<nav id="sidebar_mobile">
				<div id="dismiss">
					<i class="fas fa-arrow-left"></i>
				</div>

				<div class="sidebar-header">
					<h3>Menu</h3>
				</div>
				
				<?php 
					$this->menusmodel->setup_mobilemenu();
					$this->multi_menu->set_items($navmenu);
					echo $this->multi_menu->render(); ?>
						
			</nav>
		</div>
	</header>
	
	<!--<div class="container">
		<div class="row clearfix">
			<div class="col-sm-12">-->
				<?=$new->content;?>
			<!--</div>
		</div>
	</div>-->
	
	<footer>
		<div class="container">
			<div class="col-sm-12">
				<div class="copyright center">
					<h6>© Copyright by CRTeam 2015</h6>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-submenu.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/script.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#sidebar_mobile").mCustomScrollbar({
				theme: "minimal"
			});

			$('#dismiss, .overlay').on('click', function () {
				$('#sidebar_mobile').removeClass('active');
				$('.overlay').removeClass('active');
			});

			$('#sidebarCollapse').on('click', function () {
				$('#sidebar_mobile').addClass('active');
				$('.overlay').addClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
			});
		});
	</script>
</body>