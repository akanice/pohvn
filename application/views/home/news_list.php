	<section class="newsgrid">
		<div class="container">
			<div class="row clearfix">
				<div class="col-sm-9">
					<div class="newslist">
						<?php if (($news == '') or ($news == null)) {?>
							<h5>Chưa có bài viết nào trong mục này</h5>
						<?php } else { foreach ($news as $item) {?>
						<div class="item">
							<h4 class="heading"><a href="<?=base_url('tin-tuc/chi-tiet/'.$item->cat_alias.'/'.$item->alias)?>"><?=$item->title?></a></h4>
							
							<div class="row clearfix">
								<div class="col-md-4">
									<a href="<?=base_url('tin-tuc/chi-tiet/'.$item->cat_alias.'/'.$item->alias)?>"><img src="<?=base_url($item->image)?>" alt="<?=$item->title?>" class="img-holder thumb"></a>
								</div>
								<div class="col-md-8">
									<div class="des">
										<?=@$item->description?>
									</div>
									<div class="time"><i class="fa fa-calendar"></i> <?=@date('D m-y',$item->create_time) ?></div>
									<div class="align-right readmore">
										<a href="<?=base_url('tin-tuc/chi-tiet/'.$item->cat_alias.'/'.$item->alias)?>" class="btn btn-more"><?=$this->lang->line("readmore");?> →</a>
									</div>
								</div>
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
				<div class="col-sm-3">
					<div class="leftmenu menuright">
						<h5 class="heading"><span><?=$this->lang->line("newscategory");?></span></h5>
						<div class="main-left-menu">
							<ul class="">
								<?php foreach ($new_cat as $item) {?>
								<li><a href="<?=base_url('tin-tuc/danh-muc/'.$item->alias)?>"><i class="fa fa-angle-double-right"></i> <?=$item->name?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="leftmenu menuright">
						<h5 class="heading"><span><?=$this->lang->line("latestnews");?></span></h5>
						<div class="main-left-menu">
							<ul class="">
								<?php foreach ($right_listnew as $item) {?>
								<li><a href="<?=base_url('tin-tuc/chi-tiet/'.$item->cat_alias.'/'.$item->alias)?>"><i class="fa fa-angle-double-right"></i> <?=$item->title?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>