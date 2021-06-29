<a href="//www.dmca.com/Protection/Status.aspx?ID=0cc26b58-c4c4-45da-99ae-e49abad1d921" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/_dmca_premi_badge_5.png?ID=0cc26b58-c4c4-45da-99ae-e49abad1d921"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
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
	<?=@$landing_data->code_footer;?>
</body>