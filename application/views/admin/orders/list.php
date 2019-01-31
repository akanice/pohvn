<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý đơn hàng
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý đơn hàng
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
						<div class="widget red">
							<div class="widget-title clearfix">
								<h4 class="fleft">Danh sách đơn hàng</h4>
								<div class="fright sub_menu">
									<?php $status = $this->input->get('status'); ?>
									<a href="<?=current_url().'?name='.@$name.'&phone='.@$phone.'&status=';?>" <?php if ($status == '') echo 'class="active"'?>>Tất cả</a><span class="divider">/</span>
									<a href="<?=current_url().'?name='.@$name.'&phone='.@$phone.'&status=pending';?>" <?php if ($status == 'pending') echo 'class="active"'?>>Mới</a><span class="divider">/</span>
									<a href="<?=current_url().'?name='.@$name.'&phone='.@$phone.'&status=process';?>" <?php if ($status == 'process') echo 'class="active"'?>>Đang xử lý</a><span class="divider">/</span>
									<a href="<?=current_url().'?name='.@$name.'&phone='.@$phone.'&status=closed';?>" <?php if ($status == 'closed') echo 'class="active"'?>>Đã đóng</a>
								</div>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered table-responsive" id="sample_1">
									<thead>
									<tr>
										<th width=''>ID</th>
										<th width=''>Ngày tạo</th>
										<th width=''>Ngày dự sinh</th>
										<th width=''>Họ tên</th>
										<th width=''>Số điện thoại</th>
										<th width=''>Email</th>
										<th width=''>Địa chỉ</th>
										<th width=''>Note</th>
										<th width=''>Affiliate</th>
										<th width=''>Trạng thái</th>
										<th width='200px'>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width=''></td>
											<td width=''></td>
											<td width=''></td>
											<td width=''><input type="text" class="form-control" placeholder="Họ tên" name="name" value="<?=@$name?>"></td>
											<td width=''><input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="<?=@$phone?>"></td>
											<td width=''></td>
											<td width=''></td>
											<td width=''></td>
											<td width=''></td>
											<td width=''><input type="hidden" class="form-control" placeholder="Họ tên" name="status" value="<?=@$status?>"></td>
											<td width='' style="text-align: center"><button type="submit" class="btn btn-fill btn-default">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item) {?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><?=@date('d/m/Y <b>H:i</b>', $item->create_time)?></td>
											<td><?=$item->birth_expect?></td>
											<td><?=@$item->customer_name?></td>
											<td><?=@$item->customer_phone?></td>
											<td><?=@$item->customer_email?></td>
											<td><?=@$item->customer_address?></td>
											<td><?=@$item->note?></td>
											<td><a href="<?=@base_url('admin/affiliate/viewUser/'.$item->user_id)?>"><?=@$item->user_name?></a></td>
											<td><?php 
												switch ($item->status) {
													case 'pending':
														$status = 'Mới';$extra_class = 'color_green';
														break;
													case 'process':
														$status =  'Đang xử lý';$extra_class = 'color_blue';
														break;
													case 'confirmed':
														$status =  'Thành công';$extra_class = 'color_red';
														break;
													case 'closed':
														$status =  'Đã hoàn thành';$extra_class = 'color_grey';
														break;
													case 'cancelled':
														$status =  'Đã hủy';$extra_class = 'color_grey';
														break;
													default:
														$status =  'Mới';$extra_class = 'color_default';
												}
												echo '<span class="'.$extra_class.'">'.$status.'</span>';
											?></td>
											<td style="text-align: center">
												<a href="<?=@base_url('admin/orders/edit/'.$item->id)?>" class="btn btn-sm btn-fill btn-primary"><i class="fa fa-pencil"></i> Xử lý</a>
												<?php if (($item->user_name) && ($item->status == 'confirmed')) {?>
												<a href="<?=@base_url('admin/orders/edit/'.$item->id)?>" class="btn btn-sm btn-fill btn-danger"><i class="fa fa-cc-paypal"></i>Affiliate</a>
												<?php } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
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
    function editOrder(itemId,itemNote){
        $('#orderId').val(itemId);
		$('#order-note').html(itemNote);
        $('#editOrderPopup').modal('show');
        return false;
    }
	
	function delayedOrder(itemId,itemNote) {
		$('#orderId2').val(itemId);
		$('#order-note2').html(itemNote);
        $('#delayedOrderPopup').modal('show');
	}
	var site_url = '<?=site_url();?>';
    function assignOrder(event){
        event.preventDefault();
        var staff_technique_id = $('#staff_technique').val();
        var note =  $('#order-note').val();
        var order_id = $('#orderId').val();
        $.ajax({
            type: "POST",
            url: 'ajax/assignOrder',
            data: { staff_technique_id : staff_technique_id, note : note, order_id: order_id },
            dataType: 'JSON',
            cache: false,
            success: function(result){
                if (result.ok){
                    alert("Bạn đã gán đơn hàng thành công!");
                    $('#editOrderPopup').modal('hide');
					$('#order_change_'+result.item_id).html("<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm\" onclick=\"editOrder("+result.item_id+",'"+result.item_note+"')\">"+result.staff_lastname + "&nbsp;" + result.staff_firstname+"</a>");
					$('#extra_buttons_'+result.item_id).html("<a href=\""+site_url+"admin/orders/confirm/"+result.item_id+"\" class=\"btn btn-sm bg-maroon\" onclick=\"return confirm('Bạn chắc chắn kết thúc đơn hàng này?')\"><i class=\"fa fa-print\"></i> Chốt đơn</a>&nbsp;" +
						"<a href=\"javascript:void(0);\" class=\"btn btn-sm bg-primary\" onclick=\"delayedOrder("+result.item_id+",'"+result.item_note+"')\"> Báo hoãn</a>");
                } else {
                    alert(result.msg);
                }
            }
        });
    };
	
	function backOrder(event){
        event.preventDefault();
        var note =  $('#order-note2').val();
        var order_id = $('#orderId2').val();
        $.ajax({
            type: "POST",
            url: 'ajax/backOrder',
            data: {note : note, order_id: order_id },
            dataType: 'JSON',
            cache: false,
            success: function(result){
                if (result.ok){
					console.log(result.item_id);
                    alert("Bạn đã báo hoãn đơn hàng thành công!");
                    $('#delayedOrderPopup').modal('hide');
					$('#order_change_'+result.item_id).html('<a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="editOrder(' + result.item_id + ',"' + result.item_note + '")"><i class="fa fa-user"></i> Gán đơn hàng</a>');
					$('#extra_buttons_'+result.item_id).html('');
                }else{
                    alert(result.msg);
					console.log(result.item_id);
                }
            }
        });
    };
</script>
	<div class="modal fade" id="editOrderPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Gán đơn hàng</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" onsubmit="assignOrder(event)">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="staff_technique">Nhân viên kĩ thuật</label>
							<div class="col-sm-9">
								<select class="form-control" id="staff_technique" name="staff_technique" required="">
									<?php foreach ($staff_techniques as $value) {?>
										<option value="<?=$value->id?>"><?=$value->lastname?> <?=$value->firstname?> - <?=$value->phone?></option>
									<?php } ?>
								</select>
								<input type="hidden" name="id" id="orderId2"/>
							</div>
						</div>
						<div class="form-group">
							<label for="reason" class="col-sm-3 control-label">Ghi chú</label>
							<div class="col-sm-9">
								<textarea name="note" class="form-control" rows="5" id="order-note"></textarea>
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
	
	<div class="modal fade" id="delayedOrderPopup" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Gán đơn hàng</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" onsubmit="backOrder(event)">
						<div class="form-group">
							<label for="reason" class="col-sm-3 control-label">Ghi chú</label>
							<div class="col-sm-9">
								<textarea name="note" class="form-control" rows="5" id="order-note2"></textarea>
								<input type="hidden" name="id" id="orderId"/>
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
<style>
.box .box-header .order_tabs {padding: 7px;}
.box .box-header .order_tabs a {padding: 3px 15px;color: #517282;display:inline-block}
.box .box-header .order_tabs a:hover,.box .box-header .order_tabs a:focus,.box .box-header .order_tabs a.active {color: #0088cc}
.box .box-header .order_tabs a:last-child {border-right:0;}
.divider {color: #ccc;}
</style>