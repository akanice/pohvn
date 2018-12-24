<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý sản phẩm
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
							<a href="<?=site_url('admin/products/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý sản phẩm</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width='5%'>ID</th>
										<th width='20%'>Ảnh</th>
										<th width='25%'>Tên sản phẩm</th>
										<th width='25%'>Danh mục</th>
										<th width='25%'>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width='5%'></td>
											<td width="20%"></td>
											<td width='25%'><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
											<td width='25%'>
												<select class="form-control" name="category">
													<option value="">--Chọn--</option>
													<?php foreach ($productcategory as $c) {?>
														<option value="<?=@$c->id?>" <?php if($category==$c->id){echo 'selected="selected" ';}?>><?=@$c->name?></option>
													<?php }
													?>
												</select>
											</td>
											<td width='25%' style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><img src="<?=@site_url($item->thumb)?>" style="height:60px"></td>
											<td><?=@$item->name?></td>
											<td><?=@$item->category?></td>
											<td style="text-align: center"><a href="<?=@base_url('admin/products/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/products/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
					</div>
				</div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
