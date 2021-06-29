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
				<?php } ?>
				
			</div>
			<div class="row clearfix">
				<div class="col-md-7 col-sm-12" id="main">
					<div class="main-content">
						<div class="title-bar">
							<h1><?=@$new->title?></h1>
						</div>
						<div class="grid-post-box-meta"> <span class="author-italic author vcard">đăng bởi <a class="url fn n" href="#"><?=@$author->name?></a></span> <span><time class="entry-date published"><?php echo date_format(date_create($new->create_time),"d/m/Y"); ?></time></span></div>
						<br>
						<!-- Article content -->
						<div class="article-content">
							<?=@$new->content?>
							
							<?php if ($extra_data && $extra_data != '') {?><div class="extra_box"><?php foreach ($extra_data as $item) {?>
							<?=@$item->value?>
							<?php } ?></div><?php } ?>
						</div>
						<hr />
						<div class="share-socials">
							<div class="sharethis-inline-share-buttons" data-url=""></div>
						</div>
						<hr />
						<div class="share_article_url">
                             Chia sẻ link bài viết: 
                            <input class="form-control" type="text" value="" readonly="" style="cursor:text" id="share_link_input">
                            <div class="tooltip">
                                <button class="btn btn-calculate btn-full" onclick="copyClipboard()" onmouseout="outFunc()">
									<span class="tooltiptext" id="myTooltip">Sao chép tới clipboard</span>Sao chép
                                </button>
                            </div>
						</div>
						<hr />
						<!--<h6><b>Bình luận</b></h6>
						<div class="fb-comments">
							<div class="fb-comments" data-href="<?=@current_url()?>" data-width="" data-numposts="8"></div>
						</div>-->
						<hr />
						<?php if ($tag_data && $tag_data != '') {?><div class="tags">Tags:<?php foreach ($tag_data as $item) {?>
						<a href="<?=@base_url('tags/'.$item->alias)?>"><i class="fa fa-tags"></i> <?=@$item->name?></a>
						<?php } ?></div><?php } ?>
						<hr />
						<div class="related-articles">
							<div class="box-sidebar menu-sidebar">
							<h3 class="sidebar-heading">Bài viết cùng chuyên mục</h3>
							<ul>
								<?php foreach ($related_news as $item) { ?>
								<li class="clearfix">
									<div class="fleft article-thumb">
										<a href="<?=@base_url($item[0]->alias)?>" class="image-holder fix-size" style="background-image:url('<?=@base_url($item[0]->thumb)?>');display:inline-block"></a>
									</div>
									<div class="article-title">
										<a href="<?=@base_url($item[0]->alias)?>"><h4 class="article-title"><?=@$item[0]->title?></h4></a>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
						</div>
					</div>	
				</div>
				<div class="col-md-3 col-sm-12">
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
						<div class="box-sidebar menu-sidebar related-childcat">
							<h3 class="sidebar-heading">Cùng chuyên mục</h3>
							<ul>
								<li class="first-line"><a href="<?=@base_url('category/'.$biggest_cat->alias);?>"><i class="fa fa-folder-open"></i> <?=@$biggest_cat->title?></a></li>
								<?php foreach ($related_childcat as $item) { ?>
								<li><a href="<?=@base_url('category/'.$item->alias);?>"><i class="fa fa-angle-right"></i> <?=@$item->title?></a></li>
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
	
	<script src="<?=base_url('assets/js/jquery-1.11.1.min.js')?>"></script>
	<script>
	$(document).ready(function() {
		$('.article-content img').each(function() {
			if ($(this).attr("alt") == '') {
				$(this).attr("alt", "<?=@$new->title?>");
			}
		})
	}); 
	</script>