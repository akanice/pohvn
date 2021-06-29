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
								<a href="<?=base_url('admin/landingpage')?>">Quản lý tin tức</a>
							</li>
							<li class="active">
								Thêm mới landing page
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-8 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tiêu đề</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title"  required=""/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Link/Url</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="alias" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Loại bài viết</label>
							<div class="col-sm-10">
								<select name="type" class="form-control" readonly >
									<option value="default">Mặc định</option>
									<option value="landing" selected>Landing Page</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Template</label>
							<div class="col-sm-10">
								<select name="template" class="form-control" >
									<?php foreach ($files as $file) {?>
									<option value="<?=$file?>"><?=$file?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Loại hoa hồng</label>
							<div class="col-sm-10">
								<select class="form-control" name="commission_type">
									<option value="percent">Phần trăm (%)</option>
									<option value="fixed">Cố định</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Giá trị</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="commission_value" placeholder=""></div>
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
                <!-- END VALIDATION STATES-->
            </div>
			
			</form>
        </div>
    </div>
</div>	
<script type="text/javascript">
var $ =jQuery.noConflict();
var $c = 0;
jQuery(document).ready(function($){
	var count = <?php echo $c=0; ?>;
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
