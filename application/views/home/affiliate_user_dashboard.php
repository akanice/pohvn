<div class="section-block">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Tổng quan</a></li>
            <li><a data-toggle="tab" href="#sale">Sale</a></li>
            <li><a data-toggle="tab" href="#profile">Edit Profile</a></li>
            <li><a data-toggle="tab" href="#">
                    <div class="btn btn-primary">Logout</div>
                </a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active show">
                <h3>Tổng quan</h3>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Tổng quan tài khoản</h4>
                        <div class="row">
                            <div class="col-md-4">Tài Khoản</div>
                            <div class="col-md-8"><?php echo $statisticAffiliate['total']['balance']; ?>đ</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Đã rút</div>
                            <div class="col-md-8"><?php echo $statisticAffiliate['total']['withdraw']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Today</h4>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['today']['impression']; ?></div>
                            <div class="col-md-9">Impressions</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['today']['visitor']; ?></div>
                            <div class="col-md-9">Visitors</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['today']['closed_trans']; ?></div>
                            <div class="col-md-9">Closed Transactions</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['today']['revenue']; ?></div>
                            <div class="col-md-9">Revenue</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>This Month</h4>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['this_month']['impression']; ?></div>
                            <div class="col-md-9">Impressions</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['this_month']['visitor']; ?></div>
                            <div class="col-md-9">Visitors</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['this_month']['closed_trans']; ?></div>
                            <div class="col-md-9">Closed Transactions</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><?php echo $statisticAffiliate['this_month']['revenue']; ?></div>
                            <div class="col-md-9">Revenue</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sale" class="tab-pane fade">
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
                                <th width=''>Ngày lập order</th>
                                <th width=''>Trạng thái</th>
                                <th width=''>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($listAffiliates) foreach ($listAffiliates as $affiliateTransaction) { ?>
                                <tr>
                                    <th width=''><?php echo $affiliateTransaction['id']; ?></th>
                                    <th width=''><?php echo $affiliateTransaction['order']['id']; ?></th>
                                    <th width=''><?php echo $affiliateTransaction['amount']; ?></th>
                                    <th width=''><?php echo $affiliateTransaction['order']['create_time']; ?></th>
                                    <th width=''><?php echo $affiliateTransaction['status']; ?></th>
                                    <th width=''>Chi tiết</th>
                                </tr>
                            <?php } ?>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--<div style="padding-top: 1em;padding-bottom: 2.5em;"><?php /*echo $page_links */?></div>-->
            </div>
            <div id="profile" class="tab-pane fade">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
        </div>
    </div>
</div>
