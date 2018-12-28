<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php if ($title == '' or $title == null) {echo 'POH - Thai giáo';} else {echo $title;}?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="fb:admins" content="100000039015050"/>
	<meta property="fb:app_id" content="473175002856410" />
	<meta name="title" content="" />
	<meta name="copyright" content="Copyright © 2015 by nhatminhdev.com" />
	<meta name="keywords" content="<?=@$meta_keywords?>" />
	<meta name="description" content="<?=@$meta_description?>" />
	<meta name="og:title" content="<?php if ($title == '' or $title == null) {echo 'POH - Thai giáo';} else {echo $title;}?>" />
	<meta name="og:keywords" content="<?=@$meta_keywords?>" />
	<meta name="og:description" content="<?=@$meta_description?>" />
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="<?=base_url('assets/img/favicon.ico')?>" rel="shortcut icon">
	<link href="<?=base_url('assets/css/front/bootstrap-submenu.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/responsive.css')?>" rel="stylesheet">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=vietnamese" rel="stylesheet">
</head>

<body>
	<header id="header" class="header-header-3" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="inner-header">
			<div class="container align-left-logo has-banner">
				<div id="logo">
					<h1> <a href="#"><img src="/assets/img/POH_Official_Logo.png" alt=""></a></h1>
				</div>
				<div class="header-banner header-style-3"> <a href="#" target="_blank"><img src="http://max.soledad.pencidesign.com/soledad-magazine/wp-content/uploads/sites/7/2018/09/banner-header2.jpg" alt="Banner"></a></div>
			</div>
		</div>
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
						
						<form class="form-inline my-2 my-lg-0">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form>
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