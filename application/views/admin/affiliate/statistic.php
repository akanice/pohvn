<div class="content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý affiliate
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý affiliate
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
                                        <th width=''>Affiliate Id</th>
                                        <th width=''>Order</th>
                                        <th width=''>Số tiền hoa hồng</th>
                                        <th width=''>Người giới thiệu</th>
                                        <th width=''>Email</th>
                                        <th width=''>Ngày lập order</th>
                                        <th width=''>Trạng thái</th>
                                        <th width=''>Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($listAffiliates) foreach ($listAffiliates as $affiliateTransaction){ ?>
                                        <tr>
                                            <th width=''>Affiliate Id</th>
                                            <th width=''>Order</th>
                                            <th width=''>Số tiền hoa hồng</th>
                                            <th width=''>Người giới thiệu</th>
                                            <th width=''>Email</th>
                                            <th width=''>Ngày lập order</th>
                                            <th width=''>Trạng thái</th>
                                            <th width=''>Chi tiết</th>
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

		<div class="row">
			<div class="col-md-12">
				<div class="card">

				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
</div>
