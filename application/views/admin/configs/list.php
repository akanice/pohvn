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
													<a href="<?=@base_url('admin/configs/editcathome')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>---  Bài viết nổi bật tại mỗi chuyên mục</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editfeaturednews')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>---  Slogan mỗi chuyên mục</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editslogancategory')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>---  Banner mỗi chuyên mục</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editbannercategory')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Bài viết trên Slider</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editHomeSlider')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
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
			
			<div class="col-md-6">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Affiliate</h4>
								<?php //print_r($result);?>
							</div>
							<div class="widget-body">
								<div class="item">
									<table class="table">
										<tbody>
											<tr>
												<td>Thời gian lưu cookies affiliate</td>
												<td><span class="color_green"><?=$cookie_time->value/(24*60*60); ?> ngày</span></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editcookietime')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
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
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Box content</h4>
								<?php //print_r($result);?>
							</div>
							<div class="widget-body">
								<div class="item">
									<table class="table">
										<tbody>
											<tr>
												<td><?php if ($box_content) foreach ($box_content as $item) {?>
													<a class="btn btn-xs btn-fill" href="<?=@base_url('admin/configs/editbox/'.$item->id)?>"><?=@$item->name?> <i class="fa fa-pencil"></i></a>
												<?php } ?></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editbox')?>" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-plus"></i> Thêm mới
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
        </div>
        <!-- END PAGE -->
    </div>