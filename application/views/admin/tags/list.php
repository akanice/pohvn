<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý tag
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý tag
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
							<a href="<?=site_url('admin/tags/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý tin tức</h4>
							</div>
							<div class="widget-body table-responsive">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th>ID</th>
										<th>Tags</th>
										<th>Tag slug</th>
										<th>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td></td>
											<td><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
											<td></td>
											<td style="text-align: center"><button type="submit" class="btn btn-default btn-fill">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
									<tr class="odd gradeX">
										<td><?=@$item->id?></td>
										<td><?=@$item->name?></td>
										<td><?=@$item->alias?></td>
										<td style="text-align: center"><a href="<?=@base_url('admin/tags/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/tags/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
										<?php } ?>
									</tbody>
								</table>
							<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
						</div>
						<!-- END PAGE CONTAINER-->
					</div>
					<!-- END PAGE -->
				</div>
			</div>
		</div>
	</div>
</div>
