	<div class="section-block pages">
		<div class="container">
			<div class="penci-breadcrumb">
				<span><a class="crumb" href="<?=site_url()?>">Trang chủ</a></span>
				<i class="fa fa-angle-right"></i>
				<span>Kết quả tìm kiếm cho: <?=@$name?></span>
			</div>
			<div class="row clearfix">
				<div class="col-md-9" id="main">
					<div class="">
						<form id="header-search" action="<?=base_url('search/')?>" method="GET" class="pt-searchform form-inline my-2 my-lg-0">
							<input id="s_keyword" name="s_keyword" type="text" class="form-control mr-sm-2" value="" placeholder="Tìm kiếm..." tabindex="1">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
						</form><br>
						<div class="archive-box">
							<div class="title-bar"> <span>Kết quả tìm kiếm cho: <?=@$name?></span>
							</div>
						</div>
						
						<!-- List articles -->
						<ul class="penci-wrapper-data penci-grid clearfix">
							<?php if (($result == '') or ($result == null)) {?>
							<h5>Không tìm thấy kết quả phù hợp</h5>
							<?php } else { foreach ($result as $item) {?>
							<li class="list-post clearfix">
								<article id="post-904" class="item hentry">
									<div class="thumbnail">
										<a class="penci-image-holder penci-lazy" href="<?=base_url($item->alias)?>" title="This flagship coffee shop is about to disappear from the Bullring" style="display: inline-block; background-image: url('<?=@base_url($item->thumb)?>');">
										</a>
									</div>
									<div class="content-list-right content-list-center">
										<div class="header-list-style"> 
											<h2 class="entry-title grid-title"><a href="<?=base_url($item->alias)?>"><?=@$item->title?></a></h2>
											<div class="grid-post-box-meta">
											<span><i class="fa fa-calendar"></i> <time class="entry-date published"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></time></span></div>
										</div>
										<div class="item-content entry-content">
											<p><?=@$item->description?></p>
										</div>
									</div>
								</article>
							</li>
							<?php } } ?>
						</ul>
						
						<nav aria-label="Page navigation example"><ul class="pagination"><?php echo $page_links;?></ul></nav>
					</div>
				</div>
				
				<div class="col-sm-3">&nbsp;</div>
			</div>
		</div>
	</div>