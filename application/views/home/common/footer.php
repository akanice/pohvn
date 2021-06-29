	<div class="footer">
		<div class="container">
			<div class="row clearfix">
				<div class="col-sm-3 col-12">
					<p><img src="<?=base_url('assets/img/POH_Official_Logo.png')?>" style="max-height: 80px"></p>
					<p><strong>Điện thoại:</strong> 0868.982.215</p>
					<p><strong>Email:</strong> phucvu@poh.vn</p>
					<p><strong>Địa chỉ ĐKKD:</strong>  Số 18H, Ngõ 173/175 Hoàng Hoa Thám, Hà Nội.</p>
					<p><strong>Văn phòng làm việc:</strong>  Số 19A, ngõ 208A Đội Cấn, phường Ba Đình, Hà Nội.</p>
					<a href="//www.dmca.com/Protection/Status.aspx?ID=0cc26b58-c4c4-45da-99ae-e49abad1d921" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/_dmca_premi_badge_5.png?ID=0cc26b58-c4c4-45da-99ae-e49abad1d921"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
					<div class="social-network-footer">
						<h3 class="title">Kết nối với chúng tôi</h3>
						<a href="https://www.facebook.com/hachunforPOH/"><i class="fab fa-facebook"></i></a>
						<a href="https://twitter.com/GiaoPoh/status/1211584049778589696" rel="nofollow"><i class="fab fa-twitter"></i></a>
						<a href="https://www.youtube.com/channel/UCLk4VY2FhPSWJGRx4aAvcNw" rel="nofollow"><i class="fab fa-youtube"></i></a>
						<a href="https://www.pinterest.com/pin/732890539346885380/" rel="nofollow"><i class="fab fa-pinterest"></i></a>
						<a href="https://www.goodreads.com/user/show/107816819-pohthaigiao" rel="nofollow"><i class="fab fa-goodreads"></i></a>
					</div>
				</div>
				<div class="col-sm-3">
					<h3 class="title">Bài mới nhất</h3>
					<ul class="footer_menu">
						<?php foreach ($newest_articles as $item) {?>
						<li class="nav-item"><a href="<?=base_url($item->alias)?>"><i class="fa fa-angle-right"></i> <?=$item->title?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-sm-3">
					<h3 class="title">Đọc nhiều nhất</h3>
					<ul class="footer_menu">
						<?php foreach ($mostviewed_articles as $item) {?>
						<li class="nav-item"><a href="<?=base_url($item->alias)?>"><i class="fa fa-angle-right"></i> <?=$item->title?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-sm-3">
					<h3 class="title">Khóa học POH</h3>
					<ul class="footer_menu">
						<li class="nav-item"><a href="https://poh.vn/thai-giao-280-ngay-yeu-thuong" target="_blank"><i class="fa fa-angle-right"></i> POH Thai giáo 280 ngày yêu thương</a></li>
						<li class="nav-item"><a href="https://poh.vn/acti" target="_blank"><i class="fa fa-angle-right"></i> POH Acti - Phát triển giác quan, vận động và ngôn ngữ cho con yêu</a></li>
						<li class="nav-item"><a href="https://poh.vn/easy-one" target="_blank"><i class="fa fa-angle-right"></i> POH Easy One - Giúp con ăn no ngủ đủ</a></li>
						<li class="nav-item"><a href="https://poh.vn/easy-two" target="_blank"><i class="fa fa-angle-right"></i> POH Easy Two -  Ăn dặm kiểu EASY</a></li>
						<li class="nav-item"><a href="https://poh.vn/tuti" target="_blank"><i class="fa fa-angle-right"></i> POH TuTi - Giúp con ăn hiệu quả hơn</a></li>
					</ul>
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
	
	<div class="bg-darker"></div>
	
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
	<script src="<?=base_url('assets/js/owl.carousel.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/script.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			// $("#sidebar_mobile").mCustomScrollbar({
				// theme: "minimal",
				// setTop: 0,
			// });

			$('#dismiss, .overlay').on('click', function () {
				$('#sidebar_mobile').removeClass('active');
				$('.overlay').removeClass('active');
			});

			$('#sidebarCollapse').on('click', function () {
				$('#sidebar_mobile').addClass('active');
				$('.overlay').addClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
				$('.bg-darker').toggle();
			});
			$('.bg-darker').on('click', function () {
				$('#sidebar_mobile').removeClass('active');
				$('.overlay').removeClass('active');
				$(this).toggle();
			});
			
			$("#courses_slide").owlCarousel({
				loop:false,
				margin:10,
				nav:false,
				dots: false,
				autoplay: false,
				responsiveClass:true,
				responsive:{
					0:{
						items:2,
						stagePadding: 20,
					},
					600:{
						items:3,
						nav:false
					},
					1000:{
						items:5,
						nav:false,
						loop: false,
					}
				}
			});
			
			// $('*').bind('cut copy paste contextmenu', function (e) {
				// e.preventDefault();
			// });
		});
	</script>
	<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="1074253782714594"
  logged_in_greeting=""
  logged_out_greeting="">
      </div>
	<?=@$global_footer_code;?>
</body>