<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý slider
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/sliders')?>">Quản lý sản phẩm</a>
							</li>
							<li class="active">
								Sửa sản phẩm
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
						<h4 class="title">Sửa thông tin Slider</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?=@$slider->name?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/>
                                    <image src="<?=@site_url($slider->image)?>" height="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hiển thị</label>
                                <div class="col-sm-10 col-md-3 col-lg-3">
                                    <select class="input-large m-wrap form-control" name="show">
                                        <option value="0" <?php if($slider->show=="0"){echo 'selected="selected" ';}?>>Không</option>
                                        <option value="1" <?php if($slider->show=="1"){echo 'selected="selected" ';}?>>Có</option>
                                    </select>
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