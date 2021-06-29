<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý danh mục
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/newscategory')?>">Quản lý danh mục</a>
							</li>
							<li class="active">
								Sửa danh mục
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Sửa thông tin danh mục</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title" value="<?=@$newscategory->title?>" required=""/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Danh mục cha</label>
                                <div class="col-sm-9">
									<select class="input-large m-wrap form-control" name="parent_id">
										<option value="0" <?php if($newscategory->parent_id==0){echo 'selected="selected" ';}?>>--- Trống ---</option>
										<?php if (!empty($parents)) foreach($parents as $parent){?>
										<?php
											$indent = "";
											for ($i = 1; $i < $parent['level']; $i++) {
												$indent .= "|-- ";
											}
										?>
                                            <option value='<?=@$parent['id']?>' <?php if($newscategory->parent_id == $parent['id']){echo 'selected="selected" ';}?>><?=@$indent.$parent['title']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control ckeditor" name="description"><?=@$newscategory->description?></textarea>
                                </div>
							</div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Meta title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_title" value="<?=@$newscategory->meta_title?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Meta description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_description" value="<?=@$newscategory->meta_description?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Meta keywords</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_keywords" value="<?=@$newscategory->meta_keywords?>"/>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Banner top code</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control ckeditor" name="banner_top_display"><?=@$newscategory->banner_top_display?></textarea>
                                </div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Banner bottom code</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control ckeditor" name="banner_bottom_display"><?=@$newscategory->banner_bottom_display?></textarea>
                                </div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
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