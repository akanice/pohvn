	<div class="footer">
		<div class="container">
			<div class="row clearfix">
				<div class="col-sm-7 col-xs-12">
					<h3 class="title">Về chúng tôi</h3>
					<p>Với mong muốn sẻ chia một phần trách nhiệm với các bố các mẹ và trở thành người bạn đồng hành tin cậy của ba mẹ, POH hy vọng có thể giúp các bậc phụ huynh giải quyết các vấn đề của con trẻ ở các giai đoạn khác nhau, để nuôi dạy con thành người.</p>
					<div class="row clearfix">
						<div class="col-sm-4">
							<img class="" src="/wp-content/uploads/2018/05/POH_Official_Logo-300x179.png" width="142" height="85">
						</div>
						<div class="col-sm-8">
							<p><strong>Điện thoại:</strong> 0868982215<br>
							<strong>Email:</strong> phucvu.poh@gmail.com<br>
							<strong>Địa chỉ:</strong> Số 18H, Ngõ 173/175 Hoàng Hoa Thám, Hà Nội, 100000</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<h3 class="title">Bài mới nhất</h3>
					<ul class="footer_menu">
						<?php foreach ($newest_articles as $item) {?>
						<li class="nav-item"><a href="<?=base_url($item->alias)?>"><?=$item->title?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-sm-2">
					<h3 class="title">Khác</h3>
					<?php 
					$this->menusmodel->setup_footer_menu();
					$this->multi_menu->set_items($footer_menu);
					echo $this->multi_menu->render(); ?>
				</div>
			</div>
		</div>
	</div>
	
	<footer>
		<div class="container">
			<div class="col-sm-12">
				<div class="copyright center">
					<h6>© Copyright by POH 2015</h6>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script type="text/javascript">
		var site_url = '<?=site_url();?>';
		var post_id = '<?=@$new->id?>';
		
		<?php if (isset($_GET['poh'])) {?>
		var poh_affiliate_slug = '<?=@$_GET['poh']?>';
		<?php }?>
		var cookies_expires = <?=@$cookies_expires;?>;
		
		<?php if ($this->auth->isUserLogin()) {?>
			var share_link = '<?=current_url().'?poh='.$user_profile->user_code;?>'; 
		<?php } else { ?>
			var share_link = '<?=current_url();?>'; 
		<?php } ?>
	</script>
	<script type='text/javascript' src='/assets/js/jquery-plugins/jquery.cookie.js'></script>
	<script type='text/javascript' src='/assets/js/landingpage.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-submenu.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/script.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#sidebar_mobile").mCustomScrollbar({
				theme: "minimal"
			});

			$('#dismiss, .overlay').on('click', function () {
				$('#sidebar_mobile').removeClass('active');
				$('.overlay').removeClass('active');
			});

			$('#sidebarCollapse').on('click', function () {
				$('#sidebar_mobile').addClass('active');
				$('.overlay').addClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
			});
		});
	</script>
	<?=@$global_footer_code;?>
</body>