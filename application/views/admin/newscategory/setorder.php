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
								Bài viết ưu tiên hiển thị
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
						<h4 class="title">Chọn bài viết ưu tiên hiển thị trong danh mục</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tên danh mục</label>
                                <div class="col-sm-9">
									<?php
									$c = 0;//print_r($news_array);
									if ( count( $news_array ) > 0 && is_array($news_array)) {
										foreach( $news_array as $key=>$newItem ) {?>
												<div class="package-item clearfix">
													<div class="col-sm-10">
														<select data-placeholder="Chọn bài viết hiển thị..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="news_array[<?=$c?>]">
															<?php foreach($news as $a){?>
																<option value="<?=$a->id?>" <?php if (($news_array != '') and ($news_array)) { if($a->id == $newItem) { echo 'selected'; }}?>><?=$a->title?></option>
															<?php }?>
														</select>
													</div>
													<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>
												</div>
										<?php	$c = $c +1;
										}
									}
									?>
									<div id="output-package" class="clearfix"></div>
									<div class="clearfix"><div class="col-sm-12"><a href="#" class="add_package btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div></div>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
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
	<script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen({ max_selected_options: 1 });
        });
    </script>
<script type="text/javascript">
var $ =jQuery.noConflict();
//var $c = 0;
jQuery(document).ready(function($){
	var count = <?php echo $c-1; ?>;
	$(".add_package").click(function() {
		count = count + 1;
		$('#output-package').append('\
			<div class="package-item clearfix"> \
				<div class="col-sm-10">\
					<select data-placeholder="Chọn bài viết hiển thị..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="news_array['+count+']">\
						<?php foreach($news as $a){?>
							<option value="<?=$a->id?>"><?=$a->title?></option>\
						<?php }?>
					</select>\
				</div>\
				<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>\
			</div>');
			$(".chosen-select").chosen({ max_selected_options: 1 });
		return false;
	});
	$(document.body).on('click','.remove-package',function() {
		$(this).closest('div.package-item').remove();
	});
});
</script>