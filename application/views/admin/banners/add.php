<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý Banner
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/banners')?>">Quản lý Banner</a>
							</li>
							<li class="active">
								Thêm mới Banner
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>
		
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới Banner</h4>
					</div>
					<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Target URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Caption</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="description" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
			
			<div class="col-md-12 col-lg-4">
				<div class="card">
					<div class="header">
						<h4 class="title">Upload Image</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" required="" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- END PAGE CONTAINER-->
        </div>
		</form>
        <!-- END PAGE -->
    </div>