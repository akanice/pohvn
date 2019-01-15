<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý đơn hàng
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/news')?>">Quản lý đơn hàng</a>
							</li>
							<li class="active">
								Cập nhật đơn hàng
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="col-md-12 col-lg-8">
					<div class="card">
						<div class="header">
							<h4 class="title">Cập nhật đơn hàng</h4>
						</div>
						<div class="content">
								<div class="form-group">
									<label class="col-sm-2 control-label">Mã đơn hàng</label>
									<div class="col-sm-10">
										<input type="text" value="<?=@$order->code?>" class="form-control" disabled>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Trạng thái đơn hàng</label>
									<div class="col-sm-10">
										<select name="status" class="form-control">
											<option value="pending" <?php if($order->status=='pending'){echo 'selected="selected" ';}?>>Mới</option>
											<option value="process" <?php if($order->status=='process'){echo 'selected="selected" ';}?>>Đang xử lý</option>
											<option value="confirmed" <?php if($order->status=='confirmed'){echo 'selected="selected" ';}?>>Đã thanh toán</option>
											<option value="closed" <?php if($order->status=='closed'){echo 'selected="selected" ';}?>>Đóng</option>
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
							<!-- END FORM-->
						</div>
					</div>
					<!-- END VALIDATION STATES-->
				</div>
			</form>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
</div>