<div id="main-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <h3 class="page-title">
                    Quản lý admin
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?=base_url('admin')?>">Trang chủ</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active">
                        Quản lý admin
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <?php if($admingroup == 'admin'){?>
                    <div class="body collapse in" style="margin: 0 0 15px">
                        <a href="<?=  site_url('admin/admins/add')?>" class="btn btn-success">Thêm mới</a>
                    </div>
                <?php } ?>
            <!-- BEGIN EXAMPLE TABLE widget-->
            <div class="widget red">
                <div class="widget-title">
                    <h4>Quản lý admin</h4>
                </div>
            <div class="widget-body">
            <table class="table table-striped table-bordered" id="sample_1">
            <thead>
            <tr>
                <th width='5%'>ID</th>
                <th width='25%'>Email</th>
                <th width='20%'>Group</th>
                <th width='25%'>Ngày đăng kí</th>
                <th width='25%'>Hành động</th>
            </tr>
            </thead>
            <form method="GET" action="<?=@$base?>">
                <tr>
                    <td width='5%'></td>
                    <td width='25%'><input type="text" class="form-control" placeholder="Email" name="email" value="<?=@$email?>"></td>
                    <td width='20%'>
                        <select class="form-control" name="group">
                            <option value="">--Chọn--</option>
                            <option value="admin" <?php if($group=="admin"){echo 'selected="selected" ';}?>>Admin</option>
                            <option value="mod" <?php if($group=="mod"){echo 'selected="selected" ';}?>>Mod</option>
                        </select>
                    </td>
                    <td width='25%'></td>
                    <td width='25%' style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
                </tr>
            </form>
            <tbody>
            <?php if($list) foreach ($list as $item){ ?>
                <tr class="odd gradeX">
                    <td><?=@$item->id?></td>
                    <td><?=@$item->email?></td>
                    <td><?=@$item->group?></td>
                    <td><?=date("d/m/Y",@$item->create_time)?></td>
                    <?php if($item->id!=1){?>
                        <td style="text-align: center"><a href="<?=@base_url('admin/admins/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/admins/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php }else{?>
                    <td></td>
                </tr>
            <?php }} ?>
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