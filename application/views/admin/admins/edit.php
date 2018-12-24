<style type="text/css">
    .help-inline{
        color: #ff0000;
    }
</style>
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
                    <li>
                        <a href="<?=base_url('admin/admins')?>">Quản lý admin</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active">
                        Cập nhật
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="widget red">
                    <div class="widget-title">
                        <h4>Cập nhật thông tin người quản trị </h4>
                    </div>
                    <div class="widget-body form">
                        <!-- BEGIN FORM-->
                        <form class="form-horizontal" method="POST">
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="span6" name="email" value="<?=@$admin->email?>" required=""/>
                                    <span class="help-inline "><?=@$error_email?></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Mật khẩu</label>
                                <div class="controls">
                                    <input type="password" class="span6" name="password" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nhập lại mật khẩu</label>
                                <div class="controls">
                                    <input type="password" class="span6" name="repassword" required=""/>
                                    <span class="help-inline"><?php echo form_error('repassword'); ?></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quyền</label>
                                <div class="controls">
                                    <select class="input-large m-wrap" name="group" required="">
                                        <option value="admin" <?php if($admin->group=="admin"){echo 'selected="selected" ';}?>>Admin</option>
                                        <option value="mod" <?php if($admin->group=="mod"){echo 'selected="selected" ';}?>>Mod</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success" name="submit" value="Cập nhật">
                                <a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>