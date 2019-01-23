<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý data khách hàng
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý data khách hàng
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

    <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Danh sách khách hàng</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <form method="GET" action="<?=@$base?>">
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control" placeholder="Họ tên" name="name" value="<?=@$name?>"></td>
                                    <td></td>
                                    <td><input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="<?=@$address?>"></td>
                                    <td><input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="<?=@$phone?>"></td>
                                    <td style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
                                </tr>
                            </form>
                            <tbody>
                            <?php if($list) foreach ($list as $item){ ?>
                                <tr class="odd gradeX">
									<td><?=@$item->id?></td>
                                    <td><?=@$item->name?></td>
                                    <td><?=@$item->email?></td>
                                    <td><?=@$item->address?></td>
                                    <td><?=@$item->phone?></td>
                                    <td style="text-align: center">
										<a href="<?=@base_url('admin/customers/edit/'.$item->id)?>" class="btn btn-primary btn-sm btn-fill"><i class="fa fa-pencil"></i> Sửa</a>
										<a href="<?=@base_url('admin/customers/delete/'.$item->id)?>" class="btn btn-danger btn-sm btn-fill" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a>
										
                                    </td>
								</tr>
                            <?php } ?>
                            </table>
							</div>
						</div>
					</div>
					<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
</div>

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
