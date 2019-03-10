
<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Dashboard
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>"><i class="fa fa-home"></i> Trang chủ</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

        <div class="row clearfix">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Các bài viết mới đăng</h4>
						<p class="category">10 bài viết mới nhất (Click để sửa)</p>
					</div>
					<div class="content">
						<ul>
						<?php //print_r($news);?>
							<?php foreach ($news as $new) { ?>
							<li><a href="<?=base_url('admin/news/edit/'.$new->id)?>" target="_blank"><?=$new->title?></a> - <i class="fa fa-eye"></i> <?=$new->count_view;?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Đơn hàng mới nhất trong 48h qua</h4>
						<p class="category">Đơn hàng mới nhất chờ xử lý</p>
					</div>
					<div class="content">
						<ul>
						<?php foreach ($newest_order24 as $order) { ?>
							<li><i class="fa fa-user"></i> <a href="<?=base_url('admin/orders/edit/'.$order->id)?>" target="_blank"><?=$order->customer_name.' - '.$order->customer_phone?></a> - <i class="fa fa-code"></i>Mã đơn hàng: <?=$order->code;?></li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Đơn hàng chờ xử lý</h4>
						<p class="category">Tất cả đơn hàng ở trạng thái pending</p>
					</div>
					<div class="content">
						<ul>
						<?php foreach ($newest_order as $order) { ?>
							<li><i class="fa fa-user"></i> <a href="<?=base_url('admin/orders/edit/'.$order->id)?>" target="_blank"><?=$order->customer_name.' - '.$order->customer_phone?></a> - <i class="fa fa-code"></i>Mã đơn hàng: <?=$order->code;?></li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row clearfix">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Doanh thu 10 ngày gần nhất</h4>
						<p class="category"><small><i>Dự tính dựa trên số đơn hàng nhận được</i></small></p>
					</div>
					<div class="content" >
						<canvas id="myChart" width="" height="160"></canvas>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" type="text/javascript"></script>
						<script>
						var ctx = document.getElementById("myChart");
						var myLineChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: <?=$data_label?>,
								datasets: [{
									label: 'Doanh thu',
									data: <?=@$data_revenue?>,
									borderColor: '#c0392b',
									backgroundColor:  '#c0392b',
									fill: true,
									borderWidth: 1
								}]
							},
							options: {
								responsive: true,
								aspectRatio: 2,
								tooltips: {
									mode: 'index',
									intersect: false,
								},
								hover: {
									mode: 'nearest',
									intersect: true
								},
								scales: {
									xAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: '10 ngày gần nhất'
										}
									}],
									yAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Đơn vị: vnđ'
										}
									}]
								}
							}
						});
						</script>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card">
					<div class="header">
						<h4 class="title">Thống kê đơn hàng 10 ngày gần nhất</h4>
						<p class="category"><small><i>Dự tính dựa trên số đơn hàng nhận được</i></small></p>
					</div>
					<div class="content" >
						<canvas id="myChartOrder" width="" height="160"></canvas>
						<script>
						var ctx = document.getElementById("myChartOrder");
						var myLineChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: <?=$data_label?>,
								datasets: [{
									label: 'Số đơn hàng',
									data: <?=@$data_orders?>,
									borderColor: '#8e44ad',
									backgroundColor:  '#8e44ad',
									fill: true,
									borderWidth: 1
								}]
							},
							options: {
								responsive: true,
								aspectRatio: 2,
								tooltips: {
									mode: 'index',
									intersect: false,
								},
								hover: {
									mode: 'nearest',
									intersect: true
								},
								scales: {
									xAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: '10 ngày gần nhất'
										}
									}],
									yAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Đơn vị: đơn'
										}
									}]
								}
							}
						});
						</script>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->