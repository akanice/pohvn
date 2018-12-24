	<section class="newsgrid">
		<div class="container">
			<div class="row clearfix">
				<div class="col-sm-9">
					<div class="newslist">
						<div class="item">
							<h4 class="heading"><?=$results[0]->title?></h4>
							<div class="time"><i class="fa fa-calendar"></i> <?=@date('D m-y',$results[0]->create_time) ?></div>
							<div class="row clearfix">
								<div class="col-md-12">
									<div class="des">
										<?=@$results[0]->content?>
									</div>
								</div>
							</div>
						</div>	
						<div class="related_news">
							<h4 class="heading"><?=$this->lang->line("similarpages");?></h4>
							<ul>
								<?php foreach ($related_pages as $item) {?>
								<li><a href="<?=base_url('pages/'.$item->alias)?>"><i class="fa fa-circle"></i> <?=$item->title?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="leftmenu menuright">
						<h5 class="heading"><span><?=$this->lang->line("latestpages");?></span></h5>
						<div class="main-left-menu">
							<ul class="">
								<?php foreach ($related_pages as $item) {?>
								<li><a href="<?=base_url('pages/'.$item->alias)?>"><i class="fa fa-angle-double-right"></i> <?=$item->title?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>