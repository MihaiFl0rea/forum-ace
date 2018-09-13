<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 9/10/2018
 * Time: 3:41 PM
 */
?>

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
                        <div class="col-md-12">
                            <?php if ($template == 'articles_by_company'): ?>
                            <!-- latest posts -->
                            <section class="no-padding-top">
                                <?php if (!empty($articles)): ?>
                                <h2 class="articles-header">Articole ale companiei <span class="blue-header"><?php echo $company; ?><span</h2>
                                    <?php foreach ($articles as $id => $article): ?>
                                <div class="entry-post entry-post-fullwidth">
                                    <figure class="media">
                                        <a href="<?php echo base_url() . 'articol/' . $id; ?>">
                                            <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name'])) . '/' . $article['poster']; ?>"
                                                 class="img-responsive img-centered max-wdt-50" alt="<?php echo $article['name']; ?>" />
                                        </a>
                                    </figure>
                                    <div class="entry-content txt-alg-center">
                                        <div class="entry-header">
                                            <h2 class="entry-title">
                                                <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['title']; ?></a>
                                            </h2>
                                            <div class="meta-line">
                                                <span class="post-date"><i class="fa fa-calendar"></i><?php echo $article['creation_date_en']; ?></span>
                                                <span class="post-comment">
                                                    <i class="fa fa-comments"></i>
                                                    <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['#comments']; ?> Comentarii</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="excerpt">
                                            <p>Adaugat de: <strong><?php echo $article['name']; ?></strong></p>
                                            <p class="read-more">
                                                <a href="<?php echo base_url() . 'articol/' . $id; ?>" class="read-more">Vezi Postare!</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-30 margin-bottom-30"></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <p>Deocamdata, aceasta companie nu a adaugat niciun articol. Va rugam sa reveniti in curand.</p>
                                <?php endif; ?>
                            </section>
                            <!-- end latest posts -->
                            <?php endif; ?>

                            <?php if ($template == 'articles_by_category'): ?>
                                <!-- latest posts -->
                                <section class="no-padding-top">
                                    <?php if (!empty($articles)): ?>
                                        <h2 class="articles-header">Articole din categoria <span class="blue-header"><?php echo $category; ?></span></h2>
                                        <?php foreach ($articles as $id => $article): ?>
                                            <div class="entry-post entry-post-fullwidth">
                                                <figure class="media">
                                                    <a href="<?php echo base_url() . 'articol/' . $id; ?>">
                                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name'])) . '/' . $article['poster']; ?>"
                                                             class="img-responsive img-centered max-wdt-50" alt="<?php echo $article['name']; ?>" />
                                                    </a>
                                                </figure>
                                                <div class="entry-content txt-alg-center">
                                                    <div class="entry-header">
                                                        <h2 class="entry-title">
                                                            <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['title']; ?></a>
                                                        </h2>
                                                        <div class="meta-line">
                                                            <span class="post-date"><i class="fa fa-calendar"></i><?php echo $article['creation_date_en']; ?></span>
                                                            <span class="post-comment">
                                                    <i class="fa fa-comments"></i>
                                                    <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['#comments']; ?> Comentarii</a>
                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="excerpt">
                                                        <p>Adaugat de: <strong><?php echo $article['name']; ?></strong></p>
                                                        <p class="read-more">
                                                            <a href="<?php echo base_url() . 'articol/' . $id; ?>" class="read-more">Vezi Postare!</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-30 margin-bottom-30"></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Deocamdata, nu exista articole incadrate in aceasta categorie. Va rugam sa reveniti in curand.</p>
                                    <?php endif; ?>
                                </section>
                                <!-- end latest posts -->
                            <?php endif; ?>

                            <?php if ($template == 'articles_by_tag'): ?>
                                <!-- latest posts -->
                                <section class="no-padding-top">
                                    <?php if (!empty($articles)): ?>
                                        <h2 class="articles-header"><span class="blue-header">#<?php echo $tag; ?></span></h2>
                                        <?php foreach ($articles as $id => $article): ?>
                                            <div class="entry-post entry-post-fullwidth">
                                                <figure class="media">
                                                    <a href="<?php echo base_url() . 'articol/' . $id; ?>">
                                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name'])) . '/' . $article['poster']; ?>"
                                                             class="img-responsive img-centered max-wdt-50" alt="<?php echo $article['name']; ?>" />
                                                    </a>
                                                </figure>
                                                <div class="entry-content txt-alg-center">
                                                    <div class="entry-header">
                                                        <h2 class="entry-title">
                                                            <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['title']; ?></a>
                                                        </h2>
                                                        <div class="meta-line">
                                                            <span class="post-date"><i class="fa fa-calendar"></i><?php echo $article['creation_date_en']; ?></span>
                                                            <span class="post-comment">
                                                    <i class="fa fa-comments"></i>
                                                    <a href="<?php echo base_url() . 'articol/' . $id; ?>"><?php echo $article['#comments']; ?> Comentarii</a>
                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="excerpt">
                                                        <p>Adaugat de: <strong><?php echo $article['name']; ?></strong></p>
                                                        <p class="read-more">
                                                            <a href="<?php echo base_url() . 'articol/' . $id; ?>" class="read-more">Vezi Postare!</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-30 margin-bottom-30"></div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Deocamdata, nu exista articole asignate acestui tag. Va rugam sa reveniti in curand.</p>
                                    <?php endif; ?>
                                </section>
                                <!-- end latest posts -->
                            <?php endif; ?>

                        </div>
                        <!-- END MAIN CONTENT -->
                    </div>
                </div>
            </div>
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>

