<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Bài viết nổi bật tại mỗi chuyên mục
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/configs')?>">Cài đặt hiển thị website</a>
							</li>
							<li class="active">
								Bài viết nổi bật tại mỗi chuyên mục
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
						<h4 class="title"><a href="<?=base_url('admin/configs/')?>" class="btn btn-fill btn-sm btn-primary">Quay lại</a> Chọn bài viết</h4>
						<p><small><i></i></small></p>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<?php if ($news) foreach ($news as $item) {//print_r($item);?>
							<div class="form-group">
                                <label class="col-sm-2 control-label"><?=@$item['cat_title']?></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Chọn bài viết hiển thị..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="cat_<?=@$item['cat_id']?>[]">
                                        <?php foreach($item['content'] as $a){?>
                                            <?php print_r($item['content'])?>
											<option value="<?=$a->id?>" <?php if (($home_cat_available != '') and ($home_cat_available)) { if(in_array($a->id,$item['current_news_id'])) { echo 'selected'; }}?>><?=$a->title?></option>
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
</div>
	<script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen({ max_selected_options: 2 });
        });
    </script>