<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý quản trị viên
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý quản trị viên
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
							<a href="<?=site_url('admin/admins/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Danh sách quản trị viên</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
										<tr>
											<th width='5%'>ID</th>
											<th width=''>Email</th>
											<th width=''>Tên</th>
											<th width=''>Loại</th>
											<th width=''>Ngày tạo</th>
											<th width=''>Hành động</th>
										</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width=''></td>
											<td width=''><input type="text" class="form-control" placeholder="Email" name="email" value="<?=@$email?>"></td>
											<td width=''><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
											<td width=''>
												<select class="form-control" name="group">
													<option value="">--Chọn--</option>
													<option value="admin" <?php if($group=="admin"){echo 'selected="selected" ';}?>>Admin</option>
													<option value="mod" <?php if($group=="mod"){echo 'selected="selected" ';}?>>Mod</option>
												</select>
											</td>
											<td width=''></td>
											<td width='' style="text-align: center"><button type="submit" class="btn btn-default btn-fill">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><?=@$item->email?></td>
											<td><?=@$item->name?></td>
											<td><?=@$item->group?></td>
											<td><?=date("d/m/Y",@$item->create_time)?></td>
											<?php if($item->id!=1 && $item->id!=2){?>
												<td style="text-align: center"><a href="<?=@base_url('admin/admins/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/admins/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
											<?php }else{?>
											<td></td>
										</tr>
									<?php }} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
                <div style="padding-left: 400px"><?php echo $page_links?></div>
            </div>
        <!-- END PAGE CONTAINER-->
        </div>
    <!-- END PAGE -->
</div>