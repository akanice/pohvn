	<section class="contactpage">
		<div class="gmap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.872000546368!2d105.79508822371959!3d20.997767423138022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acba76838065%3A0x2c40367a53b64bd7!2zVOG7kSBI4buvdSwgVHJ1bmcgVsSDbiwgVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1444808196941" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="container">
			<div class="row clearfix">
				<div class="col-sm-7">
					<div class="contact-info">
						<h4 class="heading"><?=$this->lang->line("contactus");?></h4>
						<p style="width: 200px"><img src="<?=base_url('assets/img/logo.png')?>" class="img-holder"></p>
						<p class="name hl"><?=$this->lang->line("companyname");?></p>
						<p><strong><i class="fa fa-map-marker"></i> <?=$this->lang->line("address");?>:</strong> P.906 - CT2 chung cư Bộ công an, đường Tố Hữu, Nam Từ Liêm, Hà Nội</p>
						<p><strong><i class="fa fa-envelope"></i> Email:</strong> sales@nhatminhdev.com</p>
						<p><strong><i class="fa fa-phone"></i> <?=$this->lang->line("phone");?>:</strong> 0911 144 000 / 0916 365 966</p>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="contact-form">
						<h4 class="heading">Form <?=$this->lang->line("contact");?></h4>
						<form id="contact-form">
							<div class="form-group">
								<label for="name"><?=$this->lang->line("name");?></label>
								<input type="name" class="form-control" id="name" placeholder="Nguyễn Văn A" name="c-name">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" placeholder="email@gmail.com" name="c-email">
							</div>
							<div class="form-group">
								<label for="content"><?=$this->lang->line("content");?></label>
								<textarea class="form-control" id="content" name="c-content"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-more" id="button-contact"><i class="fa fa-send"></i> <?=$this->lang->line("send");?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>