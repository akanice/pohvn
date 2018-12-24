<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý trang
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý trang
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
							<a href="<?=site_url('admin/pages/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý trang</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width='5%'>ID</th>
										<th width='35%'>Tên</th>
										<th width='35%'>Alias</th>
										<th width='25%'>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width='5%'></td>
											<td width='25%'><input type="text" class="form-control" placeholder="Tên" name="title" value="<?=@$title?>"></td>
											<td width='20%'></td>
											<td width='30%' style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><?=@$item->title?></td>
											<td><?=@$item->alias?></td>
											<td style="text-align: center"><a href="<?=@base_url('admin/pages/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/pages/delete/'.$item->id)?>"><i class="fa fa-trash"></i> Xóa</a></td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div style="padding-left: 400px"><?php echo $page_links?></div>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
        <!-- END PAGE -->
		</div>
