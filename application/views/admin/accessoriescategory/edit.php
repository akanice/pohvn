<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý danh mục linh kiện
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								<a href="<?=base_url('admin/accessoriescategory')?>">Quản lý danh mục linh kiện</a>
							</li>
							<li class="">
								Sửa danh mục phụ kiện
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
					<div class="header">
						<h4 class="title">Sửa danh mục phụ kiện</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
								<label class="col-sm-2 control-label">Tên phụ kiện*:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" required="" value="<?=@$accessoriescategory->name?>"/>
								</div>
							</div>
                           <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
								</div>
							</div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>