<aside class="right-side">
    <section class="content-header">
        <h1>
            Quản lý đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?=site_url('admin/orders')?>">Quản lý đơn hàng</a></li>
            <li class="active">Cập nhật đơn hàng</li>
        </ol>
    </section>
    <!-- Main content -->
	<link href="<?=base_url('assets/css/select.min.css')?>" rel="stylesheet" />
	<script src="<?=base_url('assets/js/plugins/select2/select2.full.min.js')?>"></script>
	<script>
		$(document).ready(function() {
			$(".select2").select2();
			$("#addmore_row").click(function() {
				// setTimeout(function(){ $(".select2").select2(); }, 100);
				$(".select2").select2();
			});
		}).change(function() {
			$(".select2").select2();
		})
	</script>
    <section class="content">
        <div class="row" style="margin-left: -15px" ng-controller="OrderEditCtrl">
            <!-- left column -->
			<form role="form" method="POST" enctype="multipart/form-data" action="<?=base_url('admin/orders/edit/'.$id)?>">
				<div class="col-md-12 col-sm-12 col-lg-10">
					<!-- general form elements -->
					<div class="box box-success box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Cập nhật đơn hàng</h3>
						</div>
						<div class="box-body">
                            <div class="form-group row-fluid">
								<div class="col-md-3"><label>Tên máy:</label></div>
								<div class="col-md-7">
									<select class="form-control select2 select2-hidden-accessible" required="" style="width: 100%;" tabindex="-1" aria-hidden="true" name="device_id">
										<?php foreach ($devices as $key => $value) {?>
											<option value="<?=$value->id;?>" <?php if($order->id_device==$value->id) {echo 'selected';}?>><?=$value->name?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-2">
									<button class="btn btn-primary" style="width:100%;display:inline-block" type="submit" name="submitForm" value="submitDevice">Xác nhận</button>
								</div>
								<br><br><hr>
								
								<?php if (isset($products)) {?>
								<div class="">
									<h4>Linh kiện tương ứng</h4>
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Tên sản phẩm</th>
												<th>Tuổi thọ</th>
												<th>Giá tiền</th>
												<th>Số lượng</th>
												<th>Thành tiền</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($products as $item) {?>
											<tr class="odd gradeX">
												<td><?=@$item->name?></td>
												<td><?php 
													if (@$item->longevity < 30) { 
														echo $item->longevity." ngày";
													} elseif (($item->longevity >= 30) && ($item->longevity < 365) && ($item->longevity%30 == 0)) {
														echo ($item->longevity/30)." tháng";
													} elseif (($item->longevity >= 365) && ($item->longevity%365 == 0)) {
														echo ($item->longevity/365)." năm";
													} else {
														echo $item->longevity." ngày";
													}
													?>
												</td>
												<td id="product_price_<?=$item->pro_id?>" class="form_product_price"><?=number_format($item->sell_price,0,',','.')?></td>
												<td><input type="text" name="product_id[<?=$item->pro_id?>]" class="form-control form_product_number" id="number_product_<?=$item->pro_id?>" data-input="<?=$item->pro_id?>" value="<?php if(isset($item->quantity)) {echo $item->quantity;} else {echo '0';}?>"></td>
												<td><span style="text-align:right" name="total_item_<?=$item->pro_id?>" class="form-control form_product_total" id="total_item_<?=$item->pro_id?>"></span></td>
											</tr>
											<script>
													number_product = $('#number_product_<?=$item->pro_id?>').val();
													sum = 0;
													number_product = parseInt($('#number_product_<?=$item->pro_id?>').val());
													pricing = parseInt($('#product_price_<?=$item->pro_id?>').html())*1000;
													$('#total_item_<?=$item->pro_id?>').html(pricing*number_product);
													$('#number_product_<?=$item->pro_id?>').val(number_product);
													$('#total_item_').val(pricing*number_product);
											</script>
											<?php }?>
										</tbody>
									</table>
								</div>
								<?php } ?>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="submitForm" value="submitAll">Lưu lại</button>
							<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
						</div>
					</div>
				</div>
			</form>
        </div>
    </section>
</aside>
</div>
<script>
	function multiplyShares(itemId) {
		var pricing = parseInt($('#product_price_'+itemId).html())*1000;
		number_product = $('#number_product_'+itemId).val();
		
		sum = (pricing*number_product);
		console.log(sum);
		$('#total_item_'+itemId).html(sum);
		//alert(itemId);
	};
	$(".form_product_number").keyup(function() { multiplyShares($(this).attr('data-input')); });
</script>
