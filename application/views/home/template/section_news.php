<div class="section-block home-featured-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="home-featured-cat" id="category-<?= @$section_news['parent_cat']->id ?>">
                    <div class="section-title">
                        <h3><?= $section_news['parent_cat']->title ?></h3>
                    </div>
                    <?php if (isset($section_news['slogan']->value) && ($section_news['slogan']->value != '')) { ?>
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_60 vc_sep_pos_align_center vc_sep_color_orange vc_separator-has-text"><span
                                class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
                            <h4><?= @$section_news['slogan']->value ?></h4><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                        </div>
                    <?php } ?>
                    <div class="content row clearfix">
                        <div class="col-md-8 col-lg-8 col-xs-12">
                            <div class="box-articles clearfix row">
                                <!-- Article items -->
                                <?php if ($section_news['news_featured']) {//print_r($section_news['news_featured']);
                                    foreach ($section_news['news_featured'] as $item) {
                                        //print_r($item[0]->alias);
                                        ?>
                                        <div class="article col-md-6 col-sm-12 col-xs-12" id="article-<?= $item->id ?>">
                                            <div class="fleft article-thumb">
                                                <a href="<?= base_url($item->alias) ?>" class="image-holder fix-size"
                                                   style="background-image:url('<?= @$item->thumb ?>');display:inline-block"></a>
                                            </div>
                                            <div class="article-title">
                                                <a href="<?= base_url($item->alias) ?>"><h4 class="article-title"><?= $item->title ?></h4></a>
                                                <div class="article-date"><i class="fa fa-calendar"></i> <?= @date('d/m/Y', $item->create_time) ?></div>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>

                                <?php if ($section_news['news_item']) {
                                    foreach ($section_news['news_item'] as $item) {
                                        //print_r($item[0]->alias);
                                        ?>
                                        <div class="article col-md-6 col-sm-12 col-xs-12" id="article-<?= $item[0]->id ?>">
                                            <div class="fleft article-thumb">
                                                <a href="<?= base_url($item[0]->alias) ?>" class="image-holder fix-size"
                                                   style="background-image:url('<?= @$item[0]->thumb ?>');display:inline-block"></a>
                                            </div>
                                            <div class="article-title">
                                                <a href="<?= base_url($item[0]->alias) ?>"><h4 class="article-title"><?= $item[0]->title ?></h4></a>
                                                <div class="article-date"><i class="fa fa-calendar"></i> <?= @date('d/m/Y', $item[0]->create_time) ?></div>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>

                            <!-- Category items -->
                            <div class="box-cats clearfix row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="cat-primary penci-slide-overlay">
                                        <div class="cat-thumb">
                                            <a href="#"><img src="<?= $section_news['parent_cat']->image ?>" class="img-holder"></a>
                                        </div>
                                        <a href="#">
                                            <div class="overlay-link"></div>
                                        </a>
                                        <div class="cat-title">
                                            <a href="#"><h3>Chuyên mục: <?= $section_news['parent_cat']->title ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="cat-smaller">
                                        <div class="cat-title">
                                            <a href="#"><h3>Chuyên mục khác</h3></a>
                                        </div>
                                        <ul class="row clearfix">
                                            <?php if ($section_news['child_cat']) foreach ($section_news['child_cat'] as $item) { ?>
                                                <li class="col-md-6 col-sm-12 col-xs-12"><a
                                                        href="<?= base_url('category/') . $section_news['parent_cat']->alias . '/' . $item->alias ?>"><i
                                                            class="fa fa-angle-right"></i> <?php echo $item->title ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-xs-12 d-none d-sm-block">
                            <div class="box-right banner">
                                <a href="#"><img src="/assets/img/sample_image-2.jpg" class="img-holder"></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
