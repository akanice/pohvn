<div class="section-block content affiliate-page white-bg">
    <div class="container">
		<div class="row">
			<div class="col-3">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="v-pills-home" aria-selected="true">Tổng quan</a>
					<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#sale" role="tab" aria-controls="v-pills-profile" aria-selected="false">Lịch sử Giao dịch</a>
					<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="v-pills-messages" aria-selected="false">Thiết lập tài khoản</a>
					<a class="nav-link" id="v-pills-settings-tab" href="/dang-xuat">Đăng xuất</a>
				</div>
			</div>

			<div class="col-9">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<h3><i class="fa fa-home"></i> Tổng quan</h3>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<h5>Tài khoản</h5>
								<table class="table table-bordered table-striped">
									<tr>
										<td>Số dư</td>
										<td><?php echo $statisticAffiliate['total']['balance']; ?> đ</td>
									</tr>
									<tr>
										<td>Đã rút</td>
										<td><?php echo $statisticAffiliate['total']['withdraw']; ?> đ</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<h5>Hôm nay</h5>
								<table class="table table-bordered table-striped">
									<tr>
										<td><?php echo $statisticAffiliate['today']['impression']; ?></td>
										<td>Lượt click</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['today']['visitor']; ?></td>
										<td>Lượt ghé thăm</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['today']['closed_trans']; ?></td>
										<td>Lượt chuyển đổi</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['today']['revenue']; ?></td>
										<td>Hoa hồng dự kiến</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<h5>Tháng này</h5>
								<table class="table table-bordered table-striped">
									<tr>
										<td><?php echo $statisticAffiliate['this_month']['impression']; ?></td>
										<td>Lượt click</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['this_month']['visitor']; ?></td>
										<td>Lượt ghé thăm</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['this_month']['closed_trans']; ?></td>
										<td>Lượt chuyển đổi</td>
									</tr>
									<tr>
										<td><?php echo $statisticAffiliate['this_month']['revenue']; ?></td>
										<td>Hoa hồng dự kiến</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<div class="widget red">
							<div class="widget-title">
								<h4>Lịch sử giao dịch</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width=''>Order Id</th>
										<th width=''>Mã đơn hàng</th>
										<th width=''>Giá trị đơn hàng</th>
										<th width=''>Thời gian</th>
										<th width=''>Trạng thái</th>
										<th width=''>Chi tiết</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($listAffiliates) foreach ($listAffiliates as $affiliateTransaction) { 
									//print_r($affiliateTransaction);?>
										<tr>
											<td><?php echo $affiliateTransaction->id; ?></td>
											<td><?php echo $affiliateTransaction->code; ?></td>
											<td><?php echo $affiliateTransaction->amount; ?> đ</td>
											<td><?php echo $affiliateTransaction->create_time; ?></td>
											<td><?php echo $affiliateTransaction->status; ?></td>
											<td></td>
										</tr>
									<?php } ?>
									</tbody>
									</tbody>
								</table>
							</div>
						</div>
						<!--<div style="padding-top: 1em;padding-bottom: 2.5em;"><?php /*echo $page_links */?></div>-->
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="v-pills-messages-tab">
						<div class="row">
							<div class="col-6 px-4">
								<form method="POST" action="">
									<div class="form-group">
										<label for="acc-bank">Tên ngân hàng</label>
										<input name="acc-bank" type="text" placeholder="Vietcombank" class="form-control">
									</div>
									<div class="form-group">
										<label for="acc-name">Chủ tài khoản</label>
										<input name="acc-name" type="text" placeholder="Nguyễn Văn A" class="form-control">
									</div>
									<div class="form-group">
										<label for="acc-number">Số tài khoản</label>
										<input name="acc-number" type="text" placeholder="0010128860886" class="form-control">
									</div>
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
								</form>
							</div>
							<div class="col-6 px-4" style="border-left:1px solid #ccc">
								<h3>Yêu cầu rút tiền</h3>
								<p>Bạn có thể gửi yêu cầu rút tiền khi đạt đủ các yêu cầu dưới đây:</p>
								<ul>
									<li>- Tránh ngày mồng 1 hàng tháng</li>
									<li>- Số dư tài khoản lớn hơn 200.000vnđ</li>
									<li>- Điền đầy đủ thông tin ngân hàng</li>
								</ul><br>
								<p><button class="btn btn-success"><i class="fa fa-money-check-alt"></i> Yêu cầu rút tiền</button></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
