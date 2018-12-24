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
								<a href="<?=base_url('admin/news')?>">Quản lý sản phẩm</a>
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
			<div class="col-md-12 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Sửa nội dung tin tức</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2">Tiêu đề</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?=@$news->title?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Loại bài viết</label>
                                <div class="col-sm-10">
									<select name="type" class="form-control">
										<option value="default" <?php if($news->language=='default'){echo 'selected="selected" ';}?>>Mặc định</option>
										<option value="landing" <?php if($news->language=='landing'){echo 'selected="selected" ';}?>>Landing Page</option>
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
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/>
                                    <image src="<?=base_url($news->image)?>" height="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục</label>
                                <div class="col-sm-10">
                                    <select class="input-large m-wrap form-control" name="category">
                                        <?php foreach ($newscategory as $c) {?>
                                            <option value="<?=@$c->id?>" <?php if($news->categoryid==$c->id){echo 'selected="selected" ';}?>><?=@$c->name?></option>
                                        <?php }
                                        ?>
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