<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý linh kiện
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								<a href="<?=base_url('admin/accessories')?>">Quản lý linh kiện</a>
							</li>
							<li class="">
								Tạo mới phụ kiện
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
						<h4 class="title">Tạo mới phụ kiện</h4>
					</div>
					<div class="content">
                        <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
								<label class="col-sm-2 control-label">Tên phụ kiện*:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" required=""/>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Giá</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="price" required="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mô tả</label>
                                <div class="col-md-10">
                                    <textarea class="form-control ckeditor" name="description" rows="10"></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-md-10">
                                    <input type="file" accept="image" class="form-control" name="image" required="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục</label>
                                <div class="col-md-10">
									<div class="">
										<select name="cities" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
											<?php foreach ($accessoriescategory as $c) {?>
												<option value="<?=@$c->id?>"><?=@$c->name?></option>
											<?php } ?>
										</select>
									</div>
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
