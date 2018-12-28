<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Cài đặt hiển thị website
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Cài đặt hiển thị website
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Trang chủ</h4>
								<?php //print_r($result);?>
							</div>
							<div class="widget-body">
								<div class="item">
									<table class="table">
										<tbody>
											<tr>
												<td>Các chuyên mục hiển thị trang chủ</td>
												<td><?php if ($cat_display) foreach ($cat_display as $item) {?>
													<a class="btn btn-xs btn-fill" href="<?=@base_url('admin/newscategory/edit/'.$item->id)?>"><?=@$item->title?> <i class="fa fa-pencil"></i></a>
												<?php } ?>
												</td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editcathome')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link" data-original-title="Sửa">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Bài viết nổi bật tại mỗi chuyên mục</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editfeaturednews')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link" data-original-title="Sửa">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Bài viết trên Slider</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editHomeSlider')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link" data-original-title="Sửa">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>