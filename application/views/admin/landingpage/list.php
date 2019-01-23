<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý landing page
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý landing page
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
						<div class="body collapse in" style="margin: 0 0 15px">
							<a href="<?=site_url('admin/landingpage/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Danh sách landing page</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width=''>ID</th>
										<th width=''>Tiêu đề</th>
										<th width=''>Xem</th>
										<th width=''>Giá khóa học</th>
										<th width=''>Lượt xem</th>
										<th width=''>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width=''></td>
											<td width=''><input type="text" class="form-control" placeholder="Tiêu đề" name="name" value="<?=@$name?>"></td>
											<td width=''></td>
											<td width=''></td>
											<td></td>
											<td width='' style="text-align: center"><button type="submit" class="btn btn-fill btn-default">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) {} 
											foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><?=@$item->title?> <img src="<?=@base_url($item->thumb)?>" width="18px" height="18px" class="img-circle"></td>
											<td><a href="<?=@base_url($item->alias)?>" class="btn btn-sm btn-fill btn-primary" target="_blank">Xem</a></td>
											<td><?=@$item->total_price?> vnđ</td>
											<td><?=@$item->count_view?></td>
											<td style="text-align: center"><a href="<?=@base_url('admin/landingpage/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/landingpage/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
</div>