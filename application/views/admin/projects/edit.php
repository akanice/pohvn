<aside class="right-side">
    <section class="content-header">
        <h1>
            Quản lý dự án
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?=site_url('admin/projects')?>">Quản lý dự án</a></li>
            <li class="active">Cập nhật dự án</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: -15px">
            <form role="form" method="POST" enctype="multipart/form-data">
				<div class="col-md-8 col-sm-6">
					<!-- general form elements -->
					<div class="box box-success box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Cập nhật dự án</h3>
						</div>
						<div class="box-body">
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Tên dự án *</label>
                                <div class="col-md-10"><input type="text" class="form-control" name="name" value="<?=$projects->name?>" required=""/></div>
                            </div>
							<div class="form-group row-fluid">
                                <label class="col-md-2">Thông tin khách hàng</label>
                                <div class="col-md-10"><textarea class="form-control" name="client_info"><?=$projects->short_des?></textarea></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Mô tả ngắn</label>
                                <div class="col-md-10"><textarea class="form-control" name="short_des"><?=$projects->short_des?></textarea></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Mô tả đầy đủ</label>
                                <div class="col-md-10"><textarea class="ckeditor form-control" name="description"><?=$projects->description?></textarea></div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" name="submit" value="Lưu lại">
                            <a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
                        </div>
                    </div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="box box-success box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Media và Meta Tags</h3>
						</div>
						<div class="box-body">
							<div class="form-group row-fluid">
                                <label class="col-md-4">Ảnh cover</label>
                                <div class="col-md-8">
                                    <input type="file" accept="image" class="" name="image"/>
                                    <img src="<?=base_url($projects->thumb)?>" style="width: 100px;"/>
                                </div>
                            </div>
							<div class="form-group row-fluid">
                                <label class="col-md-4">Bộ sưu tập</label>
                                <div class="col-md-8">
                                    Tích chọn để xóa ảnh
                                    <br/>
                                    <?php
                                    $projects->gallery = @json_decode($projects->gallery);
                                    if (!$projects->gallery) $projects->gallery = array();
                                    foreach ($projects->gallery as $i=>$img){
                                        ?>
                                        <input type="checkbox" name="deletePic[]" id="delete-<?=$i?>" value="<?=$i?>"/>
                                        <label for="delete-<?=$i?>">
                                            <img src="<?=base_url($img)?>" id="pic-<?=$i?>" style="width: 100px;"/>
                                        </label>
                                    <?php
                                    }?>
                                    <input type="file" accept="image" class="" name="gallery[]" multiple/>
                                </div>
                            </div>
							<div class="form-group row-fluid">
                                <label class="col-md-4">Thẻ meta title</label>
                                <div class="col-md-8"><textarea class="form-control" name="meta_title"><?=$projects->meta_title?></textarea></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-4">Thẻ meta description</label>
                                <div class="col-md-8"><textarea class="form-control" name="meta_description"><?=$projects->meta_description?></textarea></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-4">Thẻ meta keywords</label>
                                <div class="col-md-8"><textarea class="form-control" name="meta_keywords"><?=$projects->meta_keywords?></textarea></div>
                            </div>
						</div>
					</div>
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Hiển thị</h3>
						</div>
						<div class="box-body">
							<div class="form-group row-fluid">
								<label class="col-md-6">Hiển thị trên website</label>
								<div class="col-md-6">
									<select class="form-control" name="display">
										<option value="1" <?php if($projects->display=='1'){echo 'selected="selected" ';}?>>Có</option>
										<option value="0" <?php if($projects->display=='0'){echo 'selected="selected" ';}?>>Không</option>
									</select>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" name="submit" value="Lưu lại">
							<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
						</div>
					</div>
				</div>
			</form>
        </div>
    </section>
</aside>
</div><!-- ./wrapper -->
<script src="<?=  base_url('assets/js/jquery-ui.min.js')?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen();
    });
</script>