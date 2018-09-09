<!DOCTYPE html>
<html lang="en">

    <?php $this->view('includes/header'); ?>

    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <?php $this->view('includes/menu'); ?>
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <!-- MAIN CONTENT -->
                        <div class="col-md-8 col-lg-9">
                            <!-- latest posts -->
                            <section class="no-padding-top">
                                <div class="entry-post entry-post-fullwidth">
                                    <figure class="media">
                                        <a href="<?php echo base_url() . 'articol/' . $latest_article['id']; ?>">
                                            <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $latest_article['name_company'])) . '/' . $latest_article['poster']; ?>"
                                                 class="img-responsive img-centered" alt="Image Thumbnail" />
                                        </a>
                                    </figure>
                                    <div class="entry-content">
                                        <div class="entry-header">
                                            <h2 class="entry-title">
                                                <a href="<?php echo base_url() . 'articol/' . $latest_article['id']; ?>"><?php echo $latest_article['title']; ?></a>
                                            </h2>
                                            <div class="meta-line">
                                                <span class="post-date"><i class="fa fa-calendar"></i><?php echo $latest_article['creation_date_en']; ?></span>
                                                <span class="post-comment"><i class="fa fa-comments"></i> <a href="<?php echo base_url() . 'articol/' . $latest_article['id']; ?>">0 Comentarii</a></span>
                                            </div>
                                        </div>
                                        <div class="excerpt">
                                            <p>Adaugat de: <strong><?php echo $latest_article['name_company']; ?></strong></p>
                                            <p class="read-more">
                                                <a href="<?php echo base_url() . 'articol/' . $latest_article['id']; ?>" class="read-more">Vezi Postare!</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-30 margin-bottom-30"></div>
                                <div class="row">
                                    <?php if (!empty($articles)): ?>
                                        <?php foreach ($articles as $article): ?>
                                            <div class="col-sm-6">
                                                <div class="post-entry-card">
                                                    <a href="<?php echo base_url() . 'articol/' . $article['id']; ?>">
                                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name_company'])) . '/' . $article['poster']; ?>"
                                                             class="img-responsive img-centered height-280" alt="Post Thumbnail">
                                                    </a>
                                                    <div class="post-info">
                                                        <h3 class="post-title">
                                                            <a href="<?php echo base_url() . 'articol/' . $article['id']; ?>"><?php echo $article['title']; ?></a>
                                                        </h3>
                                                        <p class="post-excerpt">Adaugat de: <strong><?php echo $article['name_company']; ?></strong></p>
                                                        <span class="post-meta">
                                                            <i class="fa fa-calendar-o"></i> <?php echo $latest_article['creation_date_en']; ?>
                                                        </span>
                                                        <a href="<?php echo base_url() . 'articol/' . $article['id']; ?>" class="read-more pull-right">Vezi Postare!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </section>
                            <!-- end latest posts -->
                            <!-- categorized posts -->
                            <section class="categorized-posts">
                                <h2 class="section-heading pull-left">CREATIVE</h2>
                                <a href="#" class="see-all-posts pull-right">See all posts in Creative <i class="fa fa-long-arrow-right"></i></a>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img10.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Globally benchmark holistic ideas for technologies</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img9.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Completely incubate high-quality e-markets</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img8.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Assertively mesh best-of-breed e-business</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img7.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Holisticly redefine pandemic infrastructures</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- end categorized posts -->
                            <!-- categorized posts -->
                            <section class="categorized-posts">
                                <h2 class="section-heading pull-left">POPULAR</h2>
                                <a href="#" class="see-all-posts pull-right">See all posts in Popular <i class="fa fa-long-arrow-right"></i></a>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img6.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Globally benchmark holistic ideas for technologies</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img5.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Completely incubate high-quality e-markets</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img4.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Assertively mesh best-of-breed e-business</a></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="post-entry post-entry-simple">
                                            <a href="#"><img src="assets/img/blog/blog-med-img3.jpg" class="img-responsive" alt="Post Thumbnail"></a>
                                            <h3 class="post-title"><a href="#">Holisticly redefine pandemic infrastructures</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- end categorized posts -->
                        </div>
                        <!-- END MAIN CONTENT -->
                        <!-- SIDEBAR CONTENT -->
                        <div class="col-md-4 col-lg-3">
                            <div class="sidebar">
                                <?php $this->view('includes/widget_search'); ?>
                                <?php $this->view('includes/widget_recommended'); ?>
                                <?php $this->view('includes/widget_categories'); ?>
                                <?php $this->view('includes/widget_tags'); ?>
                            </div>
                        </div>
                        <!-- END SIDEBAR CONTENT -->
                    </div>
                </div>
            </div>
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>
