<style type="text/css">
    .help-inline{
        color: #ff0000;
    }
</style>
<div class="content">
	<div class="container-fluid">
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
							<li>
								<a href="<?=base_url('admin/admins')?>">Quản lý quản trị viên</a>
							</li>
							<li class="active">
								Thêm mới quản trị viên
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>
		
		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-8 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="email" required="" />
								<span class="help-inline "><?=@$error_email?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tên</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mật khẩu</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="password" required="" />
								<span class="help-inline "><?php echo form_error('password'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nhập lại mật khẩu</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="repassword" required="" />
								<span class="help-inline"><?php echo form_error('repassword'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Quyền</label>
							<div class="col-sm-5">
								<select class="form-control" name="group" required="">
									<option value="admin">Admin</option>
									<option value="mod">Mod</option>
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
                    </div>
                </div>
            </div>
			</form>
        </div>
    </div>
</div>