<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Danh sách mẫu dự án</h4>
						<a href="<?=site_url('admin/projects/add')?>"><button class="btn btn-fill btn-info">Thêm mới</button></a>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Tên</th>
									<th>Preview</th>
									<th>Hiển thị</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<form method="GET" action="<?=@$base?>">
								<tr>
									<td></td>
									<td><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
									<td></td>
									<td>
										<select class="form-control" name="display">
											<option value="">--Chọn--</option>
											<option value="1" <?php if($display=="1"){echo 'selected="selected" ';}?>>Có</option>
											<option value="0" <?php if($display=="0"){echo 'selected="selected" ';}?>>Không</option>
										</select>
									</td>
									<td style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
								</tr>
							</form>
							<tbody>
							<?php if($list) foreach ($list as $item){ ?>
								<tr class="odd gradeX">
								<td><?=@$item->id?></td>
								<td><?=@$item->name?></td>
								<td><a href="<?=@base_url('projects/'.$item->alias)?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Xem</a></td>
								<td>
									<?php
									switch ($item->display) {
										case '1':
											echo 'Có';
											break;
										case '0':
											echo "Không";
											break;
									}
									?>
								</td>
								<td style="text-align: center"><a href="<?=@base_url('admin/projects/edit/'.$item->id)?>"><i class="fa fa-pencil"></i> Sửa</a> | <a href="<?=@base_url('admin/projects/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> <!-- end row -->
	</div>
</div>