<div class="content">
	<div class="container-fluid">
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
								<a href="<?=base_url('admin/news')?>">Quản lý tin tức</a>
							</li>
							<li class="active">
								Sửa nội dung tin tức
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
						<h4 class="title">Sửa nội dung tin tức <a href="<?=@base_url($news->alias)?>" class="btn btn-fill btn-sm btn-warning" target="_blank">Xem bài viết</a></h4>
					</div>
					<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?=@$news->title?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
										<div class="input-group-addon">
										<?=base_url()?>
										</div>
										<input type="text" class="form-control" name="alias" value="<?=@$news->alias?>"/>
									</div>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Loại bài viết</label>
                                <div class="col-sm-10">
									<select name="type" class="form-control">
										<option value="default" <?php if($news->type=='default'){echo 'selected="selected" ';}?>>Mặc định</option>
										<option value="landing" <?php if($news->type=='landing'){echo 'selected="selected" ';}?>>Landing Page</option>
										<option value="page" <?php if($news->type=='page'){echo 'selected="selected" ';}?>>Trang</option>
									</select>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mô tả ngắn</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description"><?=@$news->description?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="content" rows="10"><?=@$news->content?></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Thêm Tags</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Chọn tags..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="tags[]">
                                        <?php if ($tags) foreach($tags as $a){?>
											<option value="<?=$a->id?>" <?php if (($new_tags != '') and ($new_tags)) { if(in_array($a->id,$new_tags)) { echo 'selected'; }}?>><?=$a->name?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Box nội dung cuối trang</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Chọn box nội dung..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="box_content[]">
                                        <?php foreach($box_content as $a){?>
											<option value="<?=$a->id?>" <?php if (($new_box_content != '') and ($new_box_content)) { if(in_array($a->id,$new_box_content)) { echo 'selected'; }}?>><?=$a->name?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta title</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_title"><?=@$news->meta_title?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_description"><?=@$news->meta_description?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta keywords</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_keywords"><?=@$news->meta_keywords?></textarea>
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
			<div class="col-md-4 col-lg-4">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Hiển thị</label>
							<div class="col-sm-10">
								<select name="display" class="form-control">
									<option value="public" <?php if($news->display=='public'){echo 'selected="selected" ';}?>>Publish</option>
									<option value="draft" <?php if($news->display=='draft'){echo 'selected="selected" ';}?>>Draft</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Danh mục</label>
							<div class="col-sm-10">
								<div class="" style="overflow-y: scroll;height: 250px;border: 1px solid #eee;padding: 0 10px;">
									<?php foreach($newscategory as $cat_item) {?>
									<?php
										$indent = "";
										for ($i = 1; $i < $cat_item['level']; $i++) {
											$indent .= "--- ";
										}
									?>
									<label class="checkbox">
										<input type="checkbox" name="category[]" data-toggle="checkbox" value="<?=@$cat_item['id']?>" <?php if (in_array($cat_item['id'],$news->categoryid)) {echo 'checked';}?>> <?=@$indent.$cat_item['title'] ?>
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" style="width: 200px"/>
								<image src="<?=base_url($news->image)?>" height="100px">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
</div>
	<script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen({ });
        });
    </script>