<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý khách hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?=site_url('admin/customers')?>">Quản lý khách hàng</a></li>
            <li class="active">Danh sách khách hàng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: -15px">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách khách hàng</h3>
                    </div><!-- /.box-header -->
                    <div class="box-header">
                        <a href="<?=site_url('admin/customers/add')?>"><button class="btn btn-primary add-new">Thêm mới</button></a>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ</th>
                                <th>Tên</th>
                                <!--<th>Email</th>-->
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Loại</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <form method="GET" action="<?=@$base?>">
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control" placeholder="Họ" name="lastname" value="<?=@$lastname?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Tên" name="firstname" value="<?=@$firstname?>"></td>
                                    <!--<<td><input type="text" class="form-control" placeholder="Email" name="email" value="<?=@$email?>"></td>-->
                                    <td><input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="<?=@$address?>"></td>
                                    <td></td>
                                    <td>
                                        <select class="form-control" name="type">
                                            <option value="new">New</option>
                                            <option value="old">Old</option>
                                            <option value="lead">Lead</option>
                                            <option value="caring">Caring</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </td>
                                    <td style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
                                </tr>
                            </form>
                            <tbody>
                            <?php if($list) foreach ($list as $item){ ?>
                                <tr class="odd gradeX">
									<td><?=@$item->id?></td>
									<td><?=@$item->lastname?></td>
                                    <td><?=@$item->firstname?></td>
                                    <!--<<td><?=@$item->email?></td>-->
                                    <td><?=@$item->address?></td>
                                    <td><?=@$item->phone?></td>
									<td><?=@ucfirst($item->type)?></td>
                                    <td style="text-align: center">
                                        <?php 	$customer_id = $item->id;
												$qr_code = $this->qrcodemodel->read(array('customer_id'=>$customer_id),array(),true);
										if (isset($qr_code->customer_id) && ($qr_code->customer_id != 0)) {?>
											<span id="qrcode_number_<?=$item->id?>">Số mã QR: <strong><?=$qr_code->number;?></strong> - </span>
										<?php } else {?>
											<span id="qrcode_number_<?=$item->id?>"><a href="javascript:void(0);" class="btn btn-warning btn-sm" onclick="editQrcode(<?=@$item->id?>)"><i class="fa fa-user"></i> Gán QRCode</a></span>
										<?php } ?>
										
										<a href="<?=@base_url('admin/customers/edit/'.$item->id)?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
										<a href="<?=@base_url('admin/customers/delete/'.$item->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a>
										<a href="<?=@base_url('admin/orders/add/'.$item->id)?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tạo đơn hàng</a>
                                    </td>
								</tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination"><?php echo $page_links?></ul>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script type="text/javascript">
    function editQrcode(itemId){
        $('#customerId').val(itemId);
        $('#editQrcodePopup').modal('show');
        return false;
    }

    function assignQrCode(event){
        event.preventDefault();
        var qr_number = $('#qr_number').val();
        var customer_id = $('#customerId').val();
        $.ajax({
            type: "POST",
            url: 'ajax/assignQrCode',
            data: {qr_number:qr_number,customer_id:customer_id},
            dataType: 'JSON',
            cache: false,
            success: function(result){
                if (result.ok){
                    alert("Bạn đã gán mã qrcode cho khách hàng thành công!");
                    $('#editQrcodePopup').modal('hide');
					$('#qrcode_number_'+result.item_id).html('Số mã QR: '+result.qr_number);
                }else{
                    alert(result.msg);
                }
            }
        });
    };
</script>
<div class="modal fade" id="editQrcodePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gán mã QRCode cho khách hàng</h4>
            </div>
			<form class="form-horizontal" method="POST" onsubmit="assignQrCode(event)">
            <div class="modal-body">
                <div class="form-group">
					<label class="col-sm-3 control-label" for="qr_number">Số QRCode</label>
					<div class="col-sm-9">
						<input type="number" name="qr_number" id="qr_number" />
						<input type="hidden" name="customerId" id="customerId" />
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div><!-- ./wrapper -->
