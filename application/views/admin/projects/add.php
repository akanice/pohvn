<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới dự án</h4>
					</div>
					<div class="content">
						<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Tên dự án*:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="name" required=""/>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Thông tin khách hàng:</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="client_info"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Mô tả ngắn:</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="short_des"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Mô tả đầy đủ:</label>
									<div class="col-sm-10">
										<textarea class="ckeditor form-control" name="description"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Ảnh cover:</label>
									<div class="col-sm-10">
										<input type="file" accept="image" class="" name="image" style="width: 150px"/>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Bộ sưu tập:</label>
									<div class="col-sm-10">
										<input type="file" accept="image" class="" name="gallery[]" multiple style="width: 150px"/>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Thẻ meta title:</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="meta_title"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Thẻ meta description:</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="meta_description"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Thẻ meta keywords:</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="meta_keywords"></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label">Hiển thị:</label>
									<div class="col-sm-6">
										<select class="form-control" name="display">
											<option value="1" selected>Có</option>
											<option value="0">Không</option>
										</select>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
										<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- end row -->
	</div>
</div>