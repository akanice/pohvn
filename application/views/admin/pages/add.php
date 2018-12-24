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
							Quản lý trang
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/pages')?>">Quản lý trang</a>
							</li>
							<li class="active">
								Thêm mới trang
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
						<h4 class="title">Tạo mới trang</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" required=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alias</label>
                                <div class="col-sm-1">
									<input type="text" class="form-control" disabled value="pages/"/>
								</div>
								<div class="col-sm-9">
                                    <input type="text" class="form-control" name="alias"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ Meta Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ Meta Keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_keywords"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="content"></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Ngôn ngữ</label>
                                <div class="col-sm-10">
                                    <select class="input-large m-wrap" name="language">
                                        <option value="vietnamese">Tiếng Việt</option>
										<option value="english">Tiếng Anh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success" name="submit" value="Lưu lại">
                                <a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
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