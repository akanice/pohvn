	<div class="section-block pages">
		<div class="container">
			<div class="penci-breadcrumb">
				<span><a class="crumb" href="http://soledad.pencidesign.com/soledad-magazine/">Trang chủ</a></span>
				<i class="fa fa-angle-right"></i>
				<span><?=@$news_category->title?></span>
			</div>
			<div class="row clearfix">
				<div class="col-md-9" id="main">
					<div class="">
						<div class="archive-box">
							<div class="title-bar"> <span>Chuyên mục:</span>
								<h1><?=@$news_category->title?></h1>
							</div>
						</div>
						
						<!-- List articles -->
						<ul class="penci-wrapper-data penci-grid clearfix">
							<?php 
							if ($news) {
                                    foreach ($news as $item) {?>
										<li class="list-post clearfix">
											<article id="post-904" class="item hentry">
												<div class="thumbnail">
													<a class="penci-image-holder penci-lazy" href="#" title="<?=@$item->title;?>" style="display: inline-block; background-image: url('<?=@base_url($item->thumb)?>');">
													</a>
												</div>
												<div class="content-list-right content-list-center">
													<div class="header-list-style"> <span class="cat"><a class="penci-cat-name" href="#" rel="category tag">
														<?php if (isset($item->categoryid) && ($item->categoryid != ''))
															$space='';foreach ($item->categoryid as $n) { 
															?>
														<?=$space?><a href="<?=base_url('category/').$n['alias']?>"><?=@$n['title']?></a> 
														<?php $space=', ';} ?>
													</a></span>
														<h2 class="entry-title grid-title"><a href="<?=@base_url($item->alias)?>"><?=@$item->title?></a></h2>
														<div class="grid-post-box-meta"> <span><time class="entry-date published"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></time></span></div>
													</div>
													<div class="item-content entry-content">
														<p><?=@$item->description?></p>
													</div>
												</div>
											</article>
										</li>
									<?php }
                                } ?>
						</ul>
						<nav aria-label="Page navigation example"><ul class="pagination"><?php echo $page_links;?></ul></nav>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="sidebar">
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
					</div>
				</div>
			</div>
		</div>
	</div>
