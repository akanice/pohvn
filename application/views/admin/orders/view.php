<link href="<?=base_url('assets/css/invoice.css')?>" rel="stylesheet" />
<aside class="right-side" style="padding-bottom:60px">
    <section class="content-header">
        <h1>
            Quản lý đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?=site_url('admin/orders')?>">Quản lý đơn hàng</a></li>
            <li class="active">Thêm mới đơn hàng</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="invoice">
		<!-- title row -->
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i> Công ty TNHH DND - locnuoc365.com
					<small class="pull-right">Ngày tạo: <?=@date('d/m/Y', $order->create_date)?></small>
				</h2>
			</div>
			<!-- /.col -->
		</div>
		<!-- info row -->
		<div class="row invoice-info">
			<div class="col-sm-4 invoice-col">
				Từ:
				<address>
				<strong>Công ty TNHH DND</strong><br>
				132C Nguyễn Huy Tưởng<br>
				Thanh Xuân Trung, Hà Nội<br>
				Phone: 012 345 6789<br>
				Email: admin@locnuoc365.com
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
				Khách hàng:
				<address>
				<strong><?=$customer->lastname?> <?=$customer->firstname?></strong><br>
				<strong>Địa chỉ:</strong> <?=$customer->address?><br>
				<?=$customer->address2?><br>
				<strong>Phone:</strong> <?=$customer->phone?><br>
				<strong>Email:</strong> <?=$customer->email?>
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
				<b>Hóa đơn #<?=$order->id?></b><br>
				<br>
				<b>Mã hóa đơn:</b> <?=$order->order_code?><br>
				<b>Ngày tạo:</b> <?=@date('d/m/Y', $order->create_date)?><br>
				<b>Ngày thực hiện:</b> <?=@date('d/m/Y', $order->implement_date)?><br>
				<b>Nhân viên kỹ thuật:</b> <?=@$staff->lastname?> <?=@$staff->firstname?>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped table-invoice">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên sản phẩm</th>
							<th>Mã sản phẩm #</th>
							<th>Số lượng</th>
							<th>Đơn giá</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
					<?php if ($product_array) {foreach ($product_array as $item) {?>
						<tr>
							<td><?=$item->id?></td>
							<td><?=$item->product_name?></td>
							<td><?=$item->sku?></td>
							<td><?=$item->quantity?></td>
							<td><?=number_format($item->sell_price,0,',','.')?></td>
							<td><?=number_format($item->quantity*$item->sell_price,0,',','.')?></td>
						</tr>
					<?php } }?>
					</tbody>
				</table>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
				<p class="lead">Phương thức thanh toán:</p>
				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
					Nhận tiền sau khi hoàn thành lắp đặt cho khách hàng
				</p>
			</div>
			<!-- /.col -->
			<div class="col-xs-6">
				<p class="lead">Ngày chốt đơn: <?=@date('d/m/Y', $order->complete_date)?></p>

				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Thuế VAT</th>
								<td>10% (đã cộng)</td>
							</tr>
							<tr>
								<th>Shipping:</th>
								<td>Free</td>
							</tr>
							<tr>
								<th style="width:50%">Tổng cộng:</th>
								<td><?=number_format($order->total_price,0,',','.')?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- this row will not appear when printing -->
		<div class="row no-print">
			<div class="col-xs-12">
				<a href="javascript:window.print()" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
				<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
			  </button>
				<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-download"></i> Generate PDF
			  </button>
			</div>
		</div>
	</section>
</aside>
</div>
<!--
<script src="<?=  base_url('assets/js/jquery-ui.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#implement_date").datepicker({ dateFormat: 'd/m/yy' });
    });
</script>
-->
