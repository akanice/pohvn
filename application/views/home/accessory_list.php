	<section class="breadcrumb-bar">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12">
					<ul class="breadcrumbs">
						<div class="breadcrumbs-content">
							<li class="home">
								<a class="has-link" title="Go to Home Page" href="<?=site_url()?>">
									<span itemprop="title"><?=$this->lang->line("home");?></span>
								</a>
							</li>
							<li class="last">
								<span itemprop="title"><?=$this->lang->line("accessory");?></span>
							</li>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<section class="product-list">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-3">
					<div class="leftmenu">
						<h5 class="heading"><span><?=$this->lang->line("productcategory");?></span></h5>
						<div class="main-left-menu" id="leftmenu">
							<ul class="">
								<?php foreach ($access_cat as $item) {?>
								<li><a href="<?=base_url('linh-kien/danh-muc/'.$item->alias)?>"><i class="fa fa-hand-o-right"></i> <?=$item->name?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="leftmenu">
						<h5 class="heading"><span><?=$this->lang->line("productcategory");?></span></h5>
						<div class="main-left-menu" id="leftmenu">
							<ul class="">
								<?php foreach ($prod_cat as $item) {?>
								<li><a href="<?=base_url('san-pham/'.$item->alias)?>"><i class="fa fa-hand-o-right"></i> <?=$item->name?></a></li>
								<?php } ?>
								<li><a href="<?=base_url('linh-kien')?>"><i class="fa fa-hand-o-right"></i> <?=$this->lang->line("accessories");?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9 product-grid">
					<div class="row clearfix productshow">
						<?php if ($accessories == '' or $accessories == null) { ?>
						<div class="col-md-12"><h5><?=$this->lang->line("noproduct");?></h5></div>
						<?php } else {
							foreach ($accessories as $item) { ?>
							<div class="col-md-3">
								<div class="block item">
								<a href="<?=base_url('linh-kien/chi-tiet/'.$item->alias)?>">
									<img src="<?=base_url($item->thumb)?>" class="img-holder thumb">
									<h5><?=$item->name?></h5>
									<p class="price"><?=number_format($item->price,0,',','.')?> VNĐ</p>
								</a>
								</div>
							</div>
						<?php } } ?>
					</div>
					<nav class="center">
						<ul class="pagination-n">
							<?php echo $page_links?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
	