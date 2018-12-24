<div id="main-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <h3 class="page-title">
                    Quản lý người dùng
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?=base_url('admin')?>">Trang chủ</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active">
                        Quản lý người dùng
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE widget-->
                <div class="widget red">
                    <div class="widget-title">
                        <h4>Quản lý người dùng</h4>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th width='5%'>ID</th>
                                <th width='25%'>Email</th>
                                <th width='25%'>Tên</th>
                                <th width='25%'>Địa chỉ</th>
                                <th width='20%'>Hành động</th>
                            </tr>
                            </thead>
                            <form method="GET" action="<?=@$base?>">
                                <tr>
                                    <td width='5%'></td>
                                    <td width='25%'><input type="text" class="form-control" placeholder="Email" name="email" value="<?=@$email?>"></td>
                                    <td width='25%'><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
                                    <td width='25%'><input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="<?=@$address?>"></td>
                                    <td width='20%' style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
                                </tr>
                            </form>
                            <tbody>
                            <?php if($list) foreach ($list as $item){ ?>
                                <tr class="odd gradeX">
                                    <td><?=@$item->id?></td>
                                    <td><?=@$item->email?></td>
                                    <td><?=@$item->name?></td>
                                    <td><?=@$item->address?></td>
                                    <td style="text-align: center"><a href="<?=@base_url('admin/users/view/'.$item->id)?>"><i class="fa fa-pencil"></i> Xem chi tiết</a> | <a href="<?=@base_url('admin/users/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="padding-left: 400px"><?php echo $page_links?></div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>