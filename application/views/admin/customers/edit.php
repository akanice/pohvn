<aside class="right-side">
    <section class="content-header">
        <h1>
            Quản lý khách hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?=site_url('admin/customers')?>">Quản lý khách hàng</a></li>
            <li class="active">Cập nhật thông tin khách hàng</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: -15px">
            <!-- left column -->
            <form role="form" method="POST" enctype="multipart/form-data" action="">
                <div class="col-md-8 col-sm-6">
                    <!-- general form elements -->
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cập nhật thông tin khách hàng</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Ảnh đại diện </label>
                                <div class="col-md-10"><input type="file" class="form-control" name="avatar"/>
                                    <?php if($customer->avatar != ''){?>
                                        <img src="<?=@base_url($customer->avatar)?>" width="100" height="100">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Họ </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="lastname" required="" value="<?=@$customer->lastname?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Tên </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="firstname" required="" value="<?=@$customer->firstname?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Email </label>
                                <div class="col-md-10"><input type="email" class="form-control" name="email" required="" value="<?=@$customer->email?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Ngày sinh </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="birthday" id="birthday" value="<?=@date('d/m/Y', $customer->birthday)?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Số điện thoại </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="phone" value="<?=@$customer->phone?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Địa chỉ 1 </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="address" value="<?=@$customer->address?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Địa chỉ 2 </label>
                                <div class="col-md-10"><input type="text" class="form-control" name="address2" value="<?=@$customer->address2?>"/></div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Giới tính</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="sex">
                                        <option value="male" <?php if($customer->sex == "male"){ echo 'selected'; }?>>Nam</option>
                                        <option value="female" <?php if($customer->sex == "female"){ echo 'selected'; }?>>Nữ</option>
                                        <option value="other" <?php if($customer->sex == "other"){ echo 'selected'; }?>>N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">Loại</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="type">
                                        <option value="new" <?php if($customer->type == "new"){ echo 'selected'; }?>>Mới</option>
                                        <option value="old" <?php if($customer->type == "old"){ echo 'selected'; }?>>Cũ</option>
                                        <option value="lead" <?php if($customer->type == "lead"){ echo 'selected'; }?>>Tiềm năng</option>
                                        <option value="caring" <?php if($customer->type == "caring"){ echo 'selected'; }?>>Đang chăm sóc</option>
                                        <option value="reject" <?php if($customer->type == "reject"){ echo 'selected'; }?>>Đã từ chối</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row-fluid">
                                <label class="col-md-2">ID thiết bị </label>
                                <div class="col-md-10">
                                    <select data-placeholder="Chọn tag..." class="chosen-select" multiple style="width:450px;" tabindex="4" name="id_device[]">
                                        <?php foreach($names as $s){?>
                                            <option value="<?=$s->id?>" <?php if (($id_devices != '') and ($id_devices != false)) { if(in_array($s->id,$id_devices)) { echo 'selected'; }}?>><?=$s->name?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" name="submit" value="Lưu lại">
                            <a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</aside>
</div>
<script src="<?=  base_url('assets/js/jquery-ui.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#birthday").datepicker({ dateFormat: 'd/m/Y' });
        $(".chosen-select").chosen();
    });
</script>
