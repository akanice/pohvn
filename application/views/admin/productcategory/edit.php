<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý danh mục sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/productcategory')?>">Quản lý danh mục sản phẩm</a>
							</li>
							<li class="active">
								Sửa danh mục sản phẩm
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
						<h4 class="title">Tạo mới danh mục sản phẩm</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?=@$productcategory->name?>" required="" />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục cha</label>
                                <div class="col-sm-10">
                                    <select class="input-large m-wrap form-control" name="parent">
                                        <option value="0">--Mặc định--</option>
                                        <?php if (!empty($parents)) foreach($parents as $parent){?>
										<?php
											$indent = "";
											for ($i = 1; $i < $parent['level']; $i++) {
												$indent .= "--- ";
											}
										?>
                                            <option value='<?=@$parent['id']?>' <?php if($product_category->parent_id == $parent['id']){echo 'selected="selected" ';}?>><?=@$indent.$parent['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_title" value="<?=@$productcategory->meta_title?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_description" value="<?=@$productcategory->meta_description?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_keyword" value="<?=@$productcategory->meta_keyword?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/><br>
                                    <image src="<?=@site_url($productcategory->thumb)?>" width="100px" height="100px">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">File Báo giá</label>
                                <div class="col-sm-10">
                                    <input type="file" accept=".pdf,.doc,.docs" class="form-control" name="quotation_file" placeholder="pdf, doc, docs"/><br>
									<?php if (isset($productcategory->quotation_file) && ($productcategory->quotation_file != '')) {?>
									<div><b>Filename:</b> <?=$productcategory->quotation_file_name;?><br>
									<a href="<?=base_url($productcategory->quotation_file)?>" download="" class="btn btn-success btn-fill btn-wd">Tải xuống file</a><hr>
									<?php } ?>
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