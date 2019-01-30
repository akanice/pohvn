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
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div class="body collapse in" style="margin: 0 0 15px">
                            <a href="<?=site_url('admin/affiliate/userAdd')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
                        </div>
                        <div class="widget red">
                            <div class="widget-title">
                                <h4>Danh sách thành viên</h4>
                            </div>
                            <div class="widget-body">
                                <table class="table table-striped table-bordered" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th width=''>Id</th>
                                        <th width=''>Email</th>
                                        <th width=''>Tên</th>
                                        <th width=''>Điện thoại</th>
                                        <th width=''>Lượt view</th>
                                        <th width=''>Lượt Click</th>
                                        <th width=''>Số Order</th>
                                        <th width=''>Đã rút</th>
                                        <th width=''>Còn lại</th>
                                        <th width=''>Tổng</th>
                                        <th width=''>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($users) foreach ($users as $user){ ?>
                                        <tr>
                                            <th width=''></th>
                                            <th width=''><?php echo $user->email; ?></th>
                                            <th width=''><?php echo $user->name; ?></th>
                                            <th width=''><?php echo $user->phone; ?></th>
                                            <th width=''><?php echo $user->total_visite; ?></th>
                                            <th width=''><?php echo $user->total_click; ?></th>
                                            <th width=''><?php echo $user->total_order; ?></th>
                                            <th width=''><?php echo $user->withdraw; ?></th>
                                            <th width=''><?php echo $user->balance; ?></th>
                                            <th width=''><?php echo $user->total_money; ?></th>
                                            <th width=''><?php echo $user->active; ?></th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 0 0 3.5em 1em;"><?php echo $page_links?></div>
                </div>
                <!-- END PAGE CONTAINER-->
            </div>
            <!-- END PAGE -->
        </div>
    </div>
</div>
