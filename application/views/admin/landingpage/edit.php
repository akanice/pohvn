<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý landing page
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/landingpage')?>">Quản lý landing page</a>
							</li>
							<li class="active">
								Sửa nội dung landing page
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
						<h4 class="title">Sửa nội dung landing page</h4>
					</div>
					<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?=@$landingpage->title?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Loại bài viết</label>
                                <div class="col-sm-10">
									<select name="type" class="form-control" disabled>
										<option value="default" <?php if($landingpage->type=='default'){echo 'selected="selected" ';}?>>Mặc định</option>
										<option value="landing" <?php if($landingpage->type=='landing'){echo 'selected="selected" ';}?>>Landing Page</option>
									</select>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mô tả ngắn</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description"><?=@$landingpage->description?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="content" rows="10"><?php echo htmlspecialchars($landingpage->content)?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/>
                                    <image src="<?=base_url($landingpage->image)?>" height="100px">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta title</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_title"><?=@$landingpage->meta_title?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_description"><?=@$landingpage->meta_description?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta keywords</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meta_keywords"><?=@$landingpage->meta_keywords?></textarea>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Code Header</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="code_header"><?=@$landingpage_data->code_header?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Code Footer</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="code_footer"><?=@$landingpage_data->code_footer?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Menu hiển thị</label>
								<div class="col-sm-10">
									<select class="input-large m-wrap form-control" name="menu_id">
										<?php  foreach ($menus as $c) {?>
											<option value="<?=@$c->id?>" <?php if ($c->id == $landingpage_data->menu_id) {echo 'selected';}?>><?=@$c->name?></option>
										<?php }
										?>
									</select>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
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
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-12">Giá mặc định</label>
							<div class="col-sm-12"><input type="text" class="form-control" name="total_price" value="<?=@$landingpage_data->total_price?>" placeholder="VND"></div>
						</div>
						<hr />
						<div class="form-group">
							<label class="col-sm-12">Thêm mức giá / tuổi thai</label>
								<?php
								$c = 0;//print_r($pricingPackage);
								if ( count( $pricingPackage ) > 0 && is_array($pricingPackage)) {
									foreach( $pricingPackage as $packageDay ) {
										if ( isset( $packageDay->packitemfrom ) || isset( $packageDay->packdetails ) ) {
											printf( '
												<div class="package-item clearfix">
													<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage[%1$s][packitemfrom]" value="%2$s" /></div>
													<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage[%1$s][packitemto]" value="%3$s" /></div>
													<div class="col-sm-5"><input type="text" class="form-control" name="pricingPackage[%1$s][packdetails]" value="%4$s" /></div>
													<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>
												</div>
												',
													$c, $packageDay->packitemfrom,$packageDay->packitemto, $packageDay->packdetails, 'Xóa'
												);
											$c = $c +1;
										}
									}
								}
								?>
							<div id="output-package" class="clearfix"></div>
							<div class="col-sm-12"><a href="#" class="add_package btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div>
						</div>
						<hr />
						<div class="form-group">
							<label class="col-sm-3 control-label">Loại hoa hồng</label>
							<div class="col-sm-8">
								<select class="form-control" name="commission_type">
									<option value="percent" <?php if($landingpage_commission->type=='percent'){echo 'selected="selected" ';}?>>Phần trăm (%)</option>
									<option value="fixed" <?php if($landingpage_commission->type=='fixed'){echo 'selected="selected" ';}?>>Cố định</option>
								<select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Giá trị</label>
							<div class="col-sm-8"><input type="text" class="form-control" name="commission_value" placeholder="" value="<?=@$landingpage_commission->amount?>"></div>
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
        </div>
    </div>
	
<script type="text/javascript">
var $ =jQuery.noConflict();
//var $c = 0;
jQuery(document).ready(function($){
	var count = <?php echo $c-1; ?>;
	$(".add_package").click(function() {
		count = count + 1;
		$('#output-package').append('\
			<div class="package-item clearfix"> \
				<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage['+count+'][packitemfrom]" value="" /></div>\
				<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage['+count+'][packitemto]" value="" /></div>\
				<div class="col-sm-5"><input type="text" class="form-control" name="pricingPackage['+count+'][packdetails]" value="" /></div>\
				<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>\
			</div>');
		return false;
	});
	$(document.body).on('click','.remove-package',function() {
		$(this).closest('div.package-item').remove();
	});
});
</script>