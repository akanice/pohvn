	<div class="section-block pages page-article">
		<div class="container">
			<div class="penci-breadcrumb">
				<span><a class="crumb" href="<?=base_url()?>">Trang chủ</a></span>
				<i class="fa fa-angle-right"></i>
				<?php if (isset($category)) {$space='';?>
				<span>
					<?php foreach ($category as $n) {?>
						<?=$space;?><a class="crumb" href="<?=base_url('category/'.$n->alias)?>"><?=@$n->title?></a>
					<?php $space=', ';} ?>
				</span>
				<i class="fa fa-angle-right"></i>
				<?php } ?>
				<span><?=@$new->title?></span>
			</div>
			<div class="row clearfix">
				<div class="col-md-7" id="main">
					<div class="main-content">
						<div class="title-bar">
							<h1><?=@$new->title?></h1>
						</div>
						<div class="grid-post-box-meta"> <span class="author-italic author vcard">by <a class="url fn n" href="#"><?=@$author->name?></a></span> <span><time class="entry-date published"><?=@date('d/m/Y', $new->create_time)?></time></span></div>
						
						<!-- Article content -->
						<div class="article-content">
							<?=@$new->content?>
						</div>
						<hr />
						<div class="share-socials">
							
						</div>
						<hr />
						<div class="related-articles">
						
						</div>
					</div>	
				</div>
				<div class="col-sm-3">
					<div class="sidebar sidebar-1">
						<div class="box-sidebar menu-sidebar">
							<h3 class="sidebar-heading">Nhiều người đọc nhất</h3>
							<ul>
								<?php foreach ($most_viewed as $item) { ?>
								<li class="clearfix">
									<div class="fleft article-thumb">
										<a href="<?=@base_url($item->alias)?>" class="image-holder fix-size" style="background-image:url('<?=@base_url($item->thumb)?>');display:inline-block"></a>
									</div>
									<div class="article-title">
										<a href="<?=@base_url($item->alias)?>"><h4 class="article-title"><?=@$item->title?></h4></a>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
						<div class="box-sidebar menu-sidebar">
							<h3 class="sidebar-heading">Nhiều người  quan tâm nhất</h3>
							<ul>
								<?php foreach ($related_news as $item) { ?>
								<li class="clearfix">
									<div class="fleft article-thumb">
										<a href="<?=@base_url($item->alias)?>" class="image-holder fix-size" style="background-image:url('<?=@base_url($item->thumb)?>');display:inline-block"></a>
									</div>
									<div class="article-title">
										<a href="<?=@base_url($item->alias)?>"><h4 class="article-title"><?=@$item->title?></h4></a>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-none .-sm-block d-sm-none d-md-block">
					<div class="sidebar sidebar-2">
						<div style="background: #ccc;height: 400px;width:100%"></div>
					</div>
				</div>
			</div>
		</div>
	</div>