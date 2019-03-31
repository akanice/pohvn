<style type="text/css">
    .help-inline{
        color: #ff0000;
    }
</style>
<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý tin tức
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/options')?>">Quản lý tùy chỉnh</a>
							</li>
							<li class="active">
								Cập nhật
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
					<div class="content">
						<div class="body collapse in" style="margin: 0 0 15px">
							<a href="<?=site_url('admin/news/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Cập nhật thông tin tùy chỉnh</h4>
							</div>
							<div class="widget-body form">
								<!-- BEGIN FORM-->
								<form class="form-horizontal" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label class="control-label col-sm-2">Tên</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" disabled value="<?=@$option->name?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Mô tả</label>
										<div class="col-sm-10">
											<div class="notif"><?=@$option->description?></div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Giá trị</label>
										<?php if($option->type == "text"){?>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="value" value="<?=@$option->value?>"/>
											</div>
										<?php }elseif($option->type == "ckeditor"){?>
											<div class="col-sm-10">
												<textarea class="form-control" id="editor1" name="value" rows="10"><?=@$option->value?></textarea>
											</div>
										<?php }elseif ($option->type == 'advertise'){?>
										<div class="col-sm-10">
											<?php if($option->value->file != ""){?>
											<img src="<?=@base_url($option->value->file)?>">
											<?php }?>
											<input type="file" class="form-control" name="file"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Link</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="link" value="<?=@$option->value->link?>" placeholder="Link"/>
										</div>
										<?php }else{?>
										<div class="col-sm-10">
											<?php if($option->value != ""){?>
											<img src="<?=@base_url($option->value)?>">
											<?php }?>
											<input type="file" class="form-control" name="value"/>
										</div>
										<?php }?>
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
		</div>
	</div>
</div>