<div class="content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Thống kê giao dịch
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Danh sách các giao dịch
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4>Danh sách affiliate</h4>
                            </div>
                            <div class="widget-body">
                                <table class="table table-striped table-bordered" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th width=''>Id</th>
                                        <th width=''>Đơn hàng</th>
                                        <th width=''>Số tiền hoa hồng</th>
                                        <th width=''>Affiliate</th>
                                        <th width=''>Email</th>
                                        <th width=''>Ngày lập order</th>
                                        <th width=''>Trạng thái</th>
                                        <th width=''>Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($listAffiliates) foreach ($listAffiliates as $affiliateTransaction){?>
                                        <tr>
                                            <td width=''><?=@$affiliateTransaction->affiliate_transaction_id?></td>
                                            <td width=''><a href="<?=@base_url('admin/orders/edit/'.$affiliateTransaction->order_id)?>" target="_blank"><?=@$affiliateTransaction->code?></a></td>
                                            <td width=''><?=@$affiliateTransaction->amount?></td>
                                            <td width=''><?=@$affiliateTransaction->name?></td>
                                            <td width=''><?=@$affiliateTransaction->email?></td>
                                            <td width=''><?=date('d/m/Y', $affiliateTransaction->modify_time)?></td>
                                            <td width=''><?=@$affiliateTransaction->status?></td>
                                            <td width=''><?=@$affiliateTransaction->note?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div style="padding-top: 1em;padding-bottom: 2.5em;"><?php echo $page_links?></div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
