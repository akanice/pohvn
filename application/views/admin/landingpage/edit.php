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
                                <label class="col-sm-2">Tiêu đề</label>
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
                                    <textarea class="form-control ckeditor" name="content" rows="10"><?=@$landingpage->content?></textarea>
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
			
			<div class="col-md-4 col-lg-4">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới</h4>
					</div>
					<div class="content">
					<?php
					$c = 0;
					if ( count( $pricingPackage ) > 0 && is_array($pricingPackage)) {
						foreach( $pricingPackage as $packageDay ) {
							if ( isset( $packageDay['packitem'] ) || isset( $packageDay['packdetails'] ) ) {
								printf( '
									<div class="package-item">
										<table class="form-table poh_metabox">
											<tbody>
												<tr><th>Số ngày thai kỳ:</td><th></td></tr>
												<tr><th style="width:150px">Từ</th><td><input type="text" name="pricingPackage[%1$s][packitemfrom]" value="%2$s" /></td></tr>
												<tr><th style="width:150px">Đến</th><td><input type="text" name="pricingPackage[%1$s][packitemto]" value="%3$s" /></td></tr>
												<tr><th style="width:150px">Giá còn</th><td><input type="text" name="pricingPackage[%1$s][packdetails]" value="%4$s" /> vnđ</td></tr>
											</tbody>
										</table><hr>
										<a href="javascript:void(0);" class="remove-package"><i class="fa fa-trash"></i></a>',
										$c, $packageDay['packitemfrom'],$packageDay['packitemto'], $packageDay['packdetails'], __( 'Remove','ninezeroseven' ) 
									);
								echo '</div>';
								$c = $c +1;
							}
						}
					}
					?>
					</div>
				</div>
			</div>
			</form>
        </div>
    </div>
	
	<script>
	var $ =jQuery.noConflict();
	jQuery(document).ready(function($){
		var count = <?php echo $c; ?>;
		$(".add_package").click(function() {
			count = count + 1;
			$('#output-package').append('\
				<div class="package-item"> \
					<table class="form-table cmb_metabox">\
						<tbody>\
							<tr><th>Số ngày thai kỳ:</td><th></td></tr>\
							<tr><th style="width:150px">Từ</th><td><input type="text" name="pricingPackage['+count+'][packitemfrom]" value="" /></td></tr>\
							<tr><th style="width:150px">Đến</th><td><input type="text" name="pricingPackage['+count+'][packitemto]" value="" /></td></tr>\
							<tr><th style="width:150px">Giá còn</th><td><input type="text" name="pricingPackage['+count+'][packdetails]" value="" /> vnđ</td></tr>\
						</tbody>\
					</table>\
					<hr>\
					<a href="javascript:void(0);" class="remove-package"><i class="fa fa-trash"></i></a></div>');
			return false;
		});
		$(document.body).on('click','.remove-package',function() {
			$(this).parent().remove();
		});
	});
	</script>