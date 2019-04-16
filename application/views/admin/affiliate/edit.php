<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Thông tin affiliate
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/affiliate/users')?>">Thông tin affiliate</a>
							</li>
							<li class="active">
								Thành viên: <b><?=@$user_info->name?></b>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-8 col-lg-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Thông tin thành viên</h4>
					</div>
					<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Họ tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fullname" value="<?=@$user_info->name?>" readonly />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" value="<?=@$user_info->email?>" readonly />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" value="<?=@$user_info->phone?>" readonly />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fullname" value="<?=@$user_info->address?>" readonly />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Ngày đăng ký</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="create_time" value="<?=@date('d/m/Y', $user_info->create_time)?>" readonly />
                                </div>
                            </div>
                            
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
			</form>
			<div class="col-md-4 col-lg-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Thay đổi loại thành viên</h4>
					</div>
					<div class="content">
						<form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                                <label class="col-sm-2 control-label">Loại thành viên</label>
                                <div class="col-sm-10">
									<select name="role" class="form-control">
										<option value="normal" <?php if($user_info->role=='normal'){echo 'selected="selected" ';}?>>Bình thường</option>
										<option value="affiliate" <?php if($user_info->role=='affiliate'){echo 'selected="selected" ';}?>>Affiliate</option>
										<option value="deactive" <?php if($user_info->role=='deactive'){echo 'selected="selected" ';}?>>Khóa tài khoản</option>
									</select>
								</div>
							</div>
							<div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			</form>
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Các giao dịch</h4>
					</div>
					<div class="content table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>STT</th>
									<th>Đơn hàng thực hiện</th>
									<th>Nhận hoa hồng</th>
									<th>Số hoa hồng</th>
									<th>Ghi chú</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach ($user_transaction as $item) {?>
								<tr>
									<td><?=@$i?></td>
									<td><?=@$item->create_time?></td>
									<td><?=@$item->modify_time?></td>
									<td><?=@$item->amount?></td>
									<td><?=@$item->description?></td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
</div>