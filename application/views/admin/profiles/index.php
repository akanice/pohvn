<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Thông tin cá nhân
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Cập nhật thông tin cá nhân
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
						<?php if (isset($notice)) {?>
						<div class="alert alert-success">
							<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
								<i class="pe-7s-close"></i>
							</button>
							<span>
								<b><?=@$notice?></span>
						</div>
						<?php } ?>
						<h4 class="title"></h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Họ tên</label>
							<div class="col-sm-10">
								<input type="text" class="form-control editfield" name="name" value="<?=@$profiles->name?>" disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Loại bài viết</label>
							<div class="col-sm-10">
								<select name="group" class="form-control" disabled>
									<option value="" <?php if($profiles->group=='admin'){echo 'selected="selected" ';}?>>Administrator</option>
									<option value="" <?php if($profiles->group=='mod'){echo 'selected="selected" ';}?>>Moderator</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control editfield" name="email" value="<?=@$profiles->email?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mật khẩu</label>
							<div class="col-sm-10">
								<input type="password" class="form-control editfield" name="password" id="password" disabled placeholder="********" />
								<span class="help-inline "><?php echo form_error('password'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button class="btn btn-info btn-fill btn-wd" id="editfiled">Sửa thông tin cá nhân</button>
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
<script>
	$("#editfiled").click(function(event){
	   event.preventDefault();
	   $('.editfield').removeAttr("disabled");
	});
</script>