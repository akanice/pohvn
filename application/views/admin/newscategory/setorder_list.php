<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý thứ tự tin tức trong danh mục
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý thứ tự tin tức trong danh mục
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Thứ tự tin tức trong danh mục</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th>ID</th>
										<th>Tên danh mục</th>
										<th>Thứ tự bài viết ưu tiên</th>
									</tr>
									</thead>
									<tbody>
									<?php if($news_cat_data) foreach ($news_cat_data as $item){ //print_r($item['catdata']);?>
										<tr class="odd gradeX">
											<td><?=$item['catdata']['id']?></td>
											<td><?=@$item['catdata']['title']?> <a href="<?=@base_url('admin/newscategory/setorder/'.$item['catdata']['id'])?>"><i class="fa fa-pencil"></i> Sửa</a></td>
											<td>
												<?php if(!empty($item['newsdata'])) {
													foreach ($item['newsdata'] as $key=>$sub)  {?>
														<button class="btn btn-xs btn-fill"><?=($key+1).' - '.$sub;?></button>
												<?php } } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
</div>