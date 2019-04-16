<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý menu item
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/news')?>">Quản lý menu item</a>
							</li>
							<li class="active">
								Thêm mới menu item
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
						<h4 class="title"><a href="<?=base_url('admin/menus/')?>" class="btn btn-fill btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Quay lại</a> Tạo item cho <strong>"<?php echo $menu->name;?>"</strong></h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên hiển thị</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="display_name" required="" />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Thuộc menu</label>
                                <div class="col-sm-10">
                                    <select name="menu_id" class="form-control" disabled>
										<?php foreach ($menus as $item) {?>
										<option value="<?=@$item->id?>" <?php if($item->id==$menu->id){echo 'selected="selected" ';}?>><?=@$item->name?></option>
										<?php } ?>
									</select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Menu item cha</label>
                                <div class="col-sm-10">
                                    <select name="parent" class="form-control">
										<option value="0">--- Trống ---</option>
										<?php 
											$this->multi_menu->set_items($results);
											echo $this->multi_menu->render_admin();
										?>
									</select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Url / Link</label>
								<div class="col-sm-3">
									<select name="type_url" id="type_url" class="form-control">
										<option value="0">--- Chọn ---</option>
										<option value="t_landing">Landing Page</option>
										<option value="t_cat">Chuyên mục</option>
										<option value="t_page">Trang</option>
										<option value="t_link">Custom Link</option>
									</select>
								</div>
                                <div class="col-sm-6">
                                    <div id="slug">
										<select name="slug" class="form-control">
											<option>--- Chọn ---</option>
										</select>
									</div>
                                </div>
								<div class="col-sm-1">
									<img src="<?=base_url('assets/img/loading.gif')?>" id="loading_spinner" style="display:none">
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-fill btn-default">Hủy</a>
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
	
	<script type="text/javascript">
	var site_url = '<?=site_url();?>';
	// $(document).ready(function() {//$("#type_url").change(function(event) {
		// $("#test").click(function(event) {
			// event.preventDefault();
			// // var optionSelected = $("option:selected", this);
			// // var type_url = this.text;
			// var dataString = $('#test_value').text();
			// alert(dataString);
			// console.log(dataString);
			// $.ajax ({
				// type: "POST",
				// url: site_url + "admin/ajax/loadUrl",
				// data: {dataString:dataString},
				// cache: false,
				// success: function(data) {
					// // $("#slug").html(response);
					// console.log(data);
				// } 
			// });
		// });
	// }); 
		$('#type_url').on('change', function (e) {
			$('#loading_spinner').show();
			var optionSelected = $("option:selected", this);
			var dataString = this.value;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: site_url + "admin/ajax/loadUrl",
				data: { dataString : dataString },
				//dataType: 'JSON',
				cache: false,
				success: function(html){
					$("#slug").html(html);
					$('#loading_spinner').hide();
				}
			})	
        })
	
	</script>