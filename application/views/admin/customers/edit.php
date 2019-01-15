<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Cập nhật thông tin khách hàng
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/customers')?>">Quản lý khách hàng</a>
							</li>
							<li class="active">
								Cập nhật thông tin khách hàng
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>
	
    <!-- Main content -->
		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="col-md-12 col-lg-8">
					<div class="card">
						<div class="header">
							<h4 class="title">Sửa nội dung tin tức</h4>
						</div>
						<div class="content">
							<div class="form-group">
								<label class="col-sm-2 control-label">Họ Tên</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" value="<?=@$customer->name?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Email </label>
								<div class="col-md-10"><input type="email" class="form-control" name="email" required="" value="<?=@$customer->email?>"/></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Số điện thoại </label>
								<div class="col-md-10"><input type="text" class="form-control" name="phone" value="<?=@$customer->phone?>"/></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Địa chỉ</label>
								<div class="col-md-10"><input type="text" class="form-control" name="address" value="<?=@$customer->address?>"/></div>
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
		<!-- END PAGE CONTAINER-->
	</div>
	<!-- END PAGE -->
</div>
