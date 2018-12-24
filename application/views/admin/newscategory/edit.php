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
									<select class="input-large m-wrap form-control" name="language">
										<option value="0" <?php if($newscategory->parent_id==0){echo 'selected="selected" ';}?>>--- Trống ---</option>
										<?php foreach ($categories as $c) {?>
                                        <option value="<?=$c->id?>" <?php if($newscategory->parent_id==$c->id){echo 'selected="selected" ';}?>><?=$c->title?>
											<?php if(!empty($c->sub_cat)) { 
												echo '</option>';
												foreach ($c->sub_cat as $sub)  {?>
													<option value="<?=$sub->id?>" <?php if($newscategory->parent_id==$sub->id){echo 'selected="selected" ';}?>>--- <?=$sub->title?></option>
											<?php } }?>
										<?php } ?>
                                    </select>
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