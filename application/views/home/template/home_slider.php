	<section id="#slider" class="featured-area featured-style-26 penci-featured-loaded">
		<div class="container">
			<div class="wrapper-item wrapper-item-classess">
				<?php if ($section_sliders) $i=1;foreach ($section_sliders as $item) {?>
				<div class="penci-item-mag penci-item-<?=$i?>"> <a class="penci-image-holder owl-lazy" href="<?=base_url($item->alias)?>" title="<?=$item->title?>" style="background-image: url('<?=base_url($item->thumb)?>'); opacity: 1;"></a>
					<div class="penci-slide-overlay penci-slider6-overlay"> <a class="overlay-link" href="<?=base_url($item->alias)?>"></a>
						<div class="penci-mag-featured-content">
							<div class="feat-text slider-hide-date">
								<!--<div class="cat featured-cat"><a class="penci-cat-name" href="#" rel="category tag">Editor's Picks</a><a class="penci-cat-name" href="#" rel="category tag">Travel</a></div>-->
								<h3><a title="<?=$item->title?>" href="<?=base_url($item->alias)?>"><?=$item->title?></a></h3>
							</div>
						</div>
					</div>
				</div>
				<?php $i++;} ?>
			</div>
		</div>
	</section>