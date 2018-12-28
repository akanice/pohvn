<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Sửa slider
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/configs')?>">Cài đặt hiển thị website</a>
							</li>
							<li class="active">
								Sửa slider
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-lg-8">
				<div class="card">
					<div class="header">
						<?php if (isset($notice)) {?>
						<div class="alert alert-success">
							<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
								<i class="pe-7s-close"></i>
							</button>
							<span>
								<b><?=@$notice?></span>
						</div>
						<?php } ?>
						<h4 class="title"><a href="<?=base_url('admin/configs/')?>" class="btn btn-fill btn-sm btn-primary">Quay lại</a> Sửa slider</h4>
						<p><small><i>(Tính từ trái quả phải, từ trên xuống dưới*)</i></small></p>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<?php if ($slider_block_new) foreach ($slider_block_new as $item) {?>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Block <?=@$item->term_id?></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Chọn bài viết hiển thị..." class="chosen-select form-control" style="width:100%;" tabindex="4" name="slider_block_<?=@$item->term_id?>">
                                        <?php foreach($news as $a){?>
                                            <option value="<?=$a->id?>" <?php if (($item->value != '') and ($item->value != false)) { if ($a->id == $item->value) { echo 'selected'; }}?>><?=$a->title?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
							<?php } ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
								</div>
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
	<script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen();
        });
    </script>