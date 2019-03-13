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
											<td id="td_status_<?=@$item->id?>"><?php 
												switch ($item->status) {
													case 'pending':
														$status = 'Mới';$extra_class = 'color_green';
														break;
													case 'process':
														$status =  'Đang xử lý';$extra_class = 'color_blue';
														break;
													case 'confirmed':
														$status =  'Đã thanh toán';$extra_class = 'color_red';
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
											<td style="text-align: center" id="td_<?=@$item->id?>">
											<?php if (($item->status == 'closed') or ($item->status == 'cancelled')) {
												echo '&nbsp';
											} else { ?>
												<a href="<?=@base_url('admin/orders/edit/'.$item->id)?>" class="btn btn-sm btn-fill btn-primary"><i class="fa fa-pencil"></i> Xử lý</a>
												<?php if (($item->user_name) && ($item->status == 'confirmed')) {?>
												<a href="javascript:void(0);" class="btn btn-sm btn-fill btn-danger" onclick="payAffiliate(<?=@$item->affiliate_transaction_id?>,'<?=@$item->note?>','<?=@$item->total_price;?>','<?=@$item->commission?>',<?=@$item->id?>,<?=@$item->user_id?>)"><i class="fa fa-cc-paypal"></i>Affiliate</a>
												<?php } } ?>
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
    function payAffiliate(itemId,itemNote,itemValue,itemCom,rowID,affiliateID){
        $('#order_transid').val(itemId);
        $('#order_id').val(rowID);
		$('#order-note').html(itemNote);
		$('#order-value').val(itemValue);
		$('#order-commission').val(itemCom);
		$('#order-affiliate-id').val(affiliateID);
        $('#editOrderPopup').modal('show');
        return false;
    }

	var site_url = '<?=site_url();?>';
	
	function backOrder(event){
        event.preventDefault();
		$('#loading_spinner').show();
        var note =  $('#order-note2').val();
        var trans_id = $('#order_transid').val();
        var order_id = $('#order_id').val();
        var order_value = $('#order-value').val();
        var order_commission = $('#order-commission').val();
        var order_affiliate_id = $('#order-affiliate-id').val();
        $.ajax({
            type: "POST",
            url: site_url + "admin/ajax/payAffiliate",
            data: { order_id:order_id, note : note, trans_id: trans_id, order_value:order_value, order_commission:order_commission, order_affiliate_id:order_affiliate_id },
            dataType: 'JSON',
            cache: false,
            success: function(result){
                if (result.ok){
					$('#loading_spinner').hide();
					$('#editOrderPopup').modal('hide');
					alert(result.msg);
					$('#td_'+order_id).html('&nbsp;');
					$('#td_status_'+order_id).html('Đã hoàn thành');
                } else {
                    alert(result.msg);
					console.log(result.item_id);
                }
            }
        });
    };
</script>
	
	<div class="modal fade" id="editOrderPopup" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Thanh toán hoa hồng cho Affiliate</h4>
				</div>
				<form class="form-horizontal" method="POST" onsubmit="backOrder(event)">
				<div class="modal-body">
					<div class="form-group">
						<label for="reason" class="col-sm-4 control-label">Giá trị đơn hàng:</label>
						<div class="col-sm-5">
							<input name="orderValue" id="order-value" value="" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="reason" class="col-sm-4 control-label">Hoa hồng cho affiliate:</label>
						<div class="col-sm-5">
							<input name="orderCommission" id="order-commission" value="" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="reason" class="col-sm-4 control-label">Ghi chú</label>
						<div class="col-sm-8">
							<textarea name="note" class="form-control" rows="5" id="order-note2"></textarea>
							<input type="hidden" name="trans_id" id="order_transid" value=""/>
							<input type="hidden" name="order_id" id="order_id" value=""/>
							<input type="hidden" name="order-affiliate-id" id="order-affiliate-id" value=""/>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p>Bạn đồng ý thanh toán hoa hồng đơn hàng này cho affiliate?</p>
					<button type="button" class="btn btn-secondary btn-fill" data-dismiss="modal">Hủy</button>
					<button type="submit" class="btn btn-primary btn-fill"><img src="<?=base_url('assets/img/loading.gif')?>" id="loading_spinner" style="display:none"> Đồng ý</button>
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