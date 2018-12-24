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
                                <span itemprop="title"><?php if(isset($current_category)) {echo ($current_category->name);} else {echo 'tìm kiếm';}?></span>
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
				<?php if (isset($prod_catchild)) {?>
					<?php if (($prod_catchild == '') or ($prod_catchild == null)) {?>
						<div style="display: none"></div>
					<?php } else { ?>
					<div class="leftmenu">
						<h5 class="heading"><span><?=$this->lang->line("productcategory_child");?></span></h5>
						<div class="main-left-menu" id="leftmenu">
							<ul class="">
								<?php if(count($prod_catchild)>0) foreach ($prod_catchild as $item) {?>
								<li><a href="<?=base_url('san-pham/'.$item->alias)?>"><i class="fa fa-hand-o-right"></i> <?=$item->name?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php } }?>
					<div class="leftmenu">
						<h5 class="heading"><span><?=$this->lang->line("productcategory");?></span></h5>
						<div class="main-left-menu" id="leftmenu-2">
							<ul class="">
								<?php foreach ($prod_cat as $item) {?>
								<li><a href="<?=base_url('san-pham/'.$item->alias)?>"><i class="fa fa-hand-o-right"></i> <?=$item->name?></a></li>
								<?php } ?>
								<li><a href="<?=base_url('linh-kien')?>"><i class="fa fa-hand-o-right"></i> <?=$this->lang->line("accessories");?></a></li>
							</ul>
						</div>
					</div>
					<?php if (isset($current_category->quotation_file) && ($current_category->quotation_file != '')) {?>
					<div class="leftmenu">
						<h5 class="heading"><span>Download báo giá</span></h5>
						<div class="main-left-menu" id="leftmenu-3">
							<div class="inner">
								<b>Báo giá cho:</b> <?=@$current_category->name?><br><br>
								<div class="center"><a href="<?=@base_url($current_category->quotation_file)?>" class="btn btn-download"><i class="fa fa-file-pdf-o"></i> Tải xuống</a></div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-9 product-grid">
					<div class="row clearfix productshow">
						<?php if ($products == '' or $products == null) { ?>
						<div class="col-md-12"><h5><?=$this->lang->line("noproduct");?></h5></div>
						<?php } else {
							foreach ($products as $item) { ?>
							<div class="col-md-4 col-sm-6">
								<div class="block item">
								<a href="<?=base_url('san-pham/chi-tiet/'.$item->alias)?>">
									<img src="<?=base_url($item->thumb)?>" class="img-holder thumb">
									<h5><?=$item->name?></h5>
									<p class="price"><?=number_format($item->reg_price,0,',','.')?> VNĐ</p>
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
	