<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Dashboard
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>"><i class="fa fa-home"></i> Trang chủ</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

        <div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Các bài viết mới đăng</h4>
						<p class="category">10 bài viết mới nhất (Click để sửa)</p>
					</div>
					<div class="content">
						<ul>
						<?php //print_r($news);?>
							<?php foreach ($news as $new) { ?>
							<li><a href="<?=base_url('admin/news/edit/'.$new->id)?>" target="_blank"><?=$new->title?></a> - <i class="fa fa-eye"></i> <?=$new->count_view;?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
</div>