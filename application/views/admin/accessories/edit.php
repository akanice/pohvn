<div class="content">
	<div class="container-fluid">
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
									<input type="text" class="form-control" name="name" required="" value="<?=$accessory->name?>"/>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Giá</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="price" value="<?=$accessory->price?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mô tả</label>
                                <div class="col-md-10">
                                    <textarea class="form-control ckeditor" name="description" rows="10"><?=$accessory->description?></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-md-10">
                                    <input type="file" accept="image" class="form-control" name="image" required="" />
									<image src="<?=@base_url($accessory->image)?>" width="100px" height="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục</label>
                                <div class="col-md-10">
									<div class="">
										<select name="cities" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
											<?php foreach ($accessoriescategory as $c) {?>
												<option value="<?=@$c->id?>" <?php if($accessory->cat_id==$c->id){echo 'selected="selected" ';}?>><?=@$c->name?></option>
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
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>