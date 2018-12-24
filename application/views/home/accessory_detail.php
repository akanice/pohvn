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
							<li class="">
								<a class="has-link" title="Go to Home Page" href="<?=@base_url('linh-kien')?>">
									<span itemprop="title"><?=$this->lang->line("accessory");?></span>
								</a>
							</li>
							<li class="category5 last">
								<?=@$product_name?>
							</li>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<link href="<?=base_url('assets/css/magnify.css')?>" rel="stylesheet">	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.magnify.js')?>"></script>
	<section class="product-list">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-3">
					<div class="leftmenu">
						<h5 class="heading"><span><?=$this->lang->line("productcategory");?></span></h5>
						<div class="main-left-menu">
							<ul class="">
								<?php foreach ($prod_cat as $item) {?>
								<li><a href="<?=base_url('san-pham/'.$item->alias)?>"><i class="fa fa-hand-o-right"></i> <?=$item->name?></a></li>
								<?php } ?>
								<li><a href="<?=base_url('linh-kien')?>"><i class="fa fa-hand-o-right"></i> <?=$this->lang->line("accessories");?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9 product-detail">
					<div class="row clearfix productshow">
						<div class="col-md-5">
							<div class="thumb prod-image">
								<img src="<?=base_url($prod_detail[0]->thumb)?>" class="img-holder magnifier" data-magnify-src="<?=base_url($prod_detail[0]->image)?>">
							</div>
						</div>
						<div class="col-md-7">
							<div class="content">
								<span class="featured"></span>
								<h2 class="name"><?=$prod_detail[0]->name?></h2>
								<div class="sku"><?=$this->lang->line("productcode");?> (SKU): <span class="hl"><?=$prod_detail[0]->sku?></span></div>
								<div class="price"><?=$this->lang->line("price");?>: <span class="hl"><?=number_format($prod_detail[0]->price,0,',','.')?> VNĐ </span></div>
								<!--<div class="fb" style="width:64px"><img src="../img/fb-likebutton.png" class="img-holder"></div>-->
								<div class="privacy">
									<div><span><i class="fa fa-dollar"></i> <?=$this->lang->line("30dayschange");?> <i class="fa fa-check"></i></span></div>
									<div><span><i class="fa fa-truck"></i> <?=$this->lang->line("freedelivery");?> <i class="fa fa-check"></i></span></div>
									<div><span><i class="fa fa-calendar"></i> <?=$this->lang->line("guaranteebranch");?> <i class="fa fa-check"></i></span></div>
									<div><span><i class="fa fa-umbrella"></i> <?=$this->lang->line("qualityproduct");?> <i class="fa fa-check"></i></span></div>
								</div>
							</div>
						</div>
						<div class="col-md-12 productshow prod-info">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation"><a href="#tab3" aria-controls="home" role="tab" data-toggle="tab" class="tab-label"><?=$this->lang->line("comment");?></a></li>
								<li role="presentation" class="active"><a href="#tab1" aria-controls="featured" role="tab" data-toggle="tab" class="tab-label"><?=$this->lang->line("detaildescription");?></a></li>
							</ul>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="tab1">
									<?=$prod_detail[0]->description?>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="tab3">
									(Bình luận FB)
								</div>
							</div>
						</div>
					</div>
					<div class="product-related productshow">
						<h4 class="heading"><span><?=$this->lang->line("similarproduct");?></span></h4>
						<div class="row clearfix">
							<?php foreach ($prod_related as $item) {?>
							<div class="col-md-2">
								<div class="block item center">
									<a href="<?=base_url('linh-kien/chi-tiet/'.$item->alias)?>">
										<img src="<?=base_url($item->thumb)?>" class="img-holder thumb">
										<h5><?=$item->name?></h5>
										<p class="price"><?=number_format($item->price,0,',','.')?></p>
									</a>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
	var $j = jQuery.noConflict();
		$j(document).ready(function() {
			$j('.magnifier').magnify();
		});
	</script>