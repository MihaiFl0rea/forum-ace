<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 9/6/2018
 * Time: 12:27 AM
 */
?>

<!DOCTYPE html>
<html lang="en">

    <?php $this->view('includes/header'); ?>

    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <?php $this->view('includes/menu'); ?>
            <!-- BREADCRUMBS -->
            <div class="page-header breadcrumbs-only">
                <div class="container">
                    <ol class="breadcrumb link-accent">
                        <li><a href="<?php echo base_url() . 'home'; ?>">Articole</a></li>
                        <li class="active"><?php echo $article['title']; ?></li>
                    </ol>
                </div>
            </div>
            <!-- END BREADCRUMBS -->
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <!-- blog post -->
                            <article class="entry-post entry-post-single">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php echo $article['title']; ?></h1>
                                    <div class="meta-line">
                                        <span class="post-author"><i class="fa fa-user"></i> <a href="#"><?php echo $article['name_company']; ?></a></span>
                                        <span class="post-date"><i class="fa fa-calendar"></i> <?php echo $article['creation_date_en']; ?></span>
                                        <span class="post-comment"><i class="fa fa-comments"></i> <a href="#">4 Comments</a></span>
                                    </div>
                                </header>
                                <figure class="media">
                                    <a href="#">
                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name_company'])) . '/' . $article['poster']; ?>"
                                             class="img-responsive img-centered" alt="by <?php echo $article['name_company']; ?>">
                                    </a>
                                </figure>
                                <div class="content">
                                    <?php echo $article['body']; ?>
                                </div>
                            </article>
                            <!-- end blog post -->
                            <?php if (!empty($article['tags'])): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Tag-uri:</h4>
                                    <!-- tag list -->
                                    <?php $tags = explode(', ', $article['all_tags']); ?>
                                    <ul class="list-inline tag-list">
                                        <?php foreach ($tags as $tag): ?>
                                        <li><a href="#"><?php echo $tag; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <!-- end tag list -->
                                </div>
                            </div>
                            <?php endif; ?>
                            <!-- author info -->
                            <section class="post-author-info">
                                <h3 class="section-heading sr-only">About The Author</h3>
                                <div class="media">
                                    <a href="#" class="media-left">
                                        <img src="<?php echo assets_uploads_url() . $article['logo_company']; ?>" class="img-circle w-h-60px" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="author-name"><?php echo $article['name_company']; ?></a>
                                        <p class="author-title"><?php echo $article['city_company']; ?></p>
                                    </div>
                                </div>
                            </section>
                            <!-- end author info -->
                            <!-- related post -->
                            <section class="related-posts">
                                <h3 class="section-heading">Postari asemanatoare</h3>
                                <ul class="list-unstyled related-post-list row">
                                    <li class="col-md-4">
                                        <a href="#">
                                            <img src="<?php echo assets_img_url(); ?>blog/blog-med-img.jpg" class="img-responsive" alt="Related Post">
                                        </a>
                                        <a href="#" class="post-title">Monotonectally Pursue Extensive Process iImprovements</a>
                                    </li>
                                    <li class="col-md-4">
                                        <a href="#">
                                            <img src="<?php echo assets_img_url(); ?>blog/blog-med-img2.jpg" class="img-responsive" alt="Related Post">
                                        </a>
                                        <a href="#" class="post-title">Progressively Maximize Multidisciplinary Innovation Before Proactive E-markets</a>
                                    </li>
                                    <li class="col-md-4">
                                        <a href="#">
                                            <img src="<?php echo assets_img_url(); ?>blog/blog-med-img3.jpg" class="img-responsive" alt="Related Post">
                                        </a>
                                        <a href="#" class="post-title">Phosfluorescently conceptualize team</a>
                                    </li>
                                </ul>
                            </section>
                            <!-- end related post -->
                            <!-- comments -->
                            <article class="comments">
                                <h3 class="section-heading">Comentarii</h3>
                                <?php if (!empty($article['comments'])): ?>
                                <ul class="media-list">
                                    <?php foreach ($article['comments'] as $id_comment => $comment): ?>
                                        <li class="media" id="row_comment_<?php echo $id_comment; ?>">
                                            <div id="comment_displayed_<?php echo $id_comment; ?>">
                                                <a href="#" class="media-left">
                                                    <img src="<?php echo $comment['avatar_user']; ?>" class="avatar" alt="avatar">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading comment-author"><a href="#"><?php echo $comment['name_user']; ?></a></h4>
                                                    <span class="timestamp"><?php echo $comment['creation_date']; ?></span>
                                                    <p class="comment-body"><?php echo $comment['body']; ?></p>
                                                    <p class="comments-options">
                                                        <?php if ($comment['id_user'] != $this->session->userdata['front_id']): ?>
                                                        <span class="comm-color answer-to-comment"  data-id="<?php echo $id_comment; ?>">
                                                            <i class="fa fa-reply"></i> <span>Raspunde</span>
                                                        </span>
                                                        <?php endif; ?>
                                                        <span class="comm-color thumbs-up-color m-l-10 m-r-10 like-comment"
                                                              data-id="<?php echo $id_comment; ?>" <?php echo !empty($comment['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ?
                                                            'data-review-id="'.$comment['reviews']['thumbs_up'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                            <i class="fa <?php echo !empty($comment['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ? 'fa-thumbs-up' : 'fa-thumbs-o-up' ?>"></i>
                                                            <span><?php echo count($comment['reviews']['thumbs_up']); ?></span>
                                                        </span>
                                                        <span class="comm-color thumbs-down-color m-r-10 dislike-comment"
                                                              data-id="<?php echo $id_comment; ?>" <?php echo !empty($comment['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ?
                                                            'data-review-id="'.$comment['reviews']['thumbs_down'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                            <i class="fa <?php echo !empty($comment['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ? 'fa-thumbs-down' : 'fa-thumbs-o-down' ?>"></i>
                                                            <span><?php echo count($comment['reviews']['thumbs_down']); ?></span>
                                                        </span>
                                                        <?php if ($comment['id_user'] == $this->session->userdata['front_id']): ?>
                                                            <?php if (empty($comment['responded'])): ?>
                                                            <span class="comm-color pull-right delete-comment" data-id="<?php echo $id_comment; ?>">
                                                                <i class="fa fa-trash-o"></i> <span>Sterge</span>
                                                            </span>
                                                            <?php endif; ?>
                                                            <span class="comm-color m-r-10 pull-right edit-comment" data-id="<?php echo $id_comment; ?>">
                                                                <i class="fa fa-pencil-square-o"></i> <span>Editeaza</span>
                                                            </span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <?php if ($comment['id_user'] != $this->session->userdata['front_id']): ?>
                                                        <div class="form-group hidden" id="respond_to_<?php echo $id_comment; ?>">
                                                            <textarea class="form-control" name="comment" rows="5" cols="30" data-id="<?php echo $article['id'] ?>"></textarea>
                                                            <button class="btn btn-danger btn-xs add-response-comment"
                                                                    data-comment-level="1" data-id="<?php echo $id_comment; ?>">Adauga raspuns</button>
                                                            <button class="btn btn-info btn-xs cancel-adding-response" data-id="<?php echo $id_comment; ?>">Anuleaza</button>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php /* ----- First level of response ----- */ ?>
                                                    <?php if (!empty($comment['responded'])): ?>
                                                    <ul class="media-list">
                                                        <?php foreach ($comment['responded'] as $id_comment_responded => $comment_responded): ?>
                                                        <li class="media comment-by-author" id="row_comment_<?php echo $id_comment_responded; ?>">
                                                            <div id="comment_displayed_<?php echo $id_comment_responded; ?>">
                                                                <a href="#" class="media-left">
                                                                    <img src="<?php echo $comment_responded['avatar_user']; ?>" class="avatar" alt="avatar">
                                                                </a>
                                                                <div class="media-body">
                                                                    <h4 class="media-heading comment-author"><a href="#"><?php echo $comment_responded['name_user']; ?></a></h4>
                                                                    <span class="timestamp"><?php echo $comment_responded['creation_date']; ?></span>
                                                                    <p class="comment-body"><?php echo $comment_responded['body']; ?></p>
                                                                    <p class="comments-options">
                                                                        <?php if ($comment_responded['id_user'] != $this->session->userdata['front_id']): ?>
                                                                        <span class="comm-color answer-to-comment" data-id="<?php echo $id_comment_responded; ?>">
                                                                            <i class="fa fa-reply"></i> <span>Raspunde</span>
                                                                        </span>
                                                                        <?php endif; ?>
                                                                        <span class="comm-color thumbs-up-color m-l-10 m-r-10 like-comment"
                                                                              data-id="<?php echo $id_comment_responded; ?>" <?php echo !empty($comment_responded['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ?
                                                                            'data-review-id="'.$comment_responded['reviews']['thumbs_up'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                                            <i class="fa <?php echo !empty($comment_responded['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ? 'fa-thumbs-up' : 'fa-thumbs-o-up' ?>"></i>
                                                                            <span><?php echo count($comment_responded['reviews']['thumbs_up']); ?></span>
                                                                        </span>
                                                                        <span class="comm-color thumbs-down-color m-r-10 dislike-comment"
                                                                              data-id="<?php echo $id_comment_responded; ?>" <?php echo !empty($comment_responded['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ?
                                                                            'data-review-id="'.$comment_responded['reviews']['thumbs_down'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                                            <i class="fa <?php echo !empty($comment_responded['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ? 'fa-thumbs-down' : 'fa-thumbs-o-down' ?>"></i>
                                                                            <span><?php echo count($comment_responded['reviews']['thumbs_down']); ?></span>
                                                                        </span>
                                                                        <?php if ($comment_responded['id_user'] == $this->session->userdata['front_id']): ?>
                                                                            <?php if (empty($comment_responded['responded'])): ?>
                                                                            <span class="comm-color pull-right delete-comment" data-id="<?php echo $id_comment_responded; ?>">
                                                                                <i class="fa fa-trash-o"></i> <span>Sterge</span>
                                                                            </span>
                                                                            <?php endif; ?>
                                                                            <span class="comm-color m-r-10 pull-right edit-comment" data-id="<?php echo $id_comment_responded; ?>">
                                                                                <i class="fa fa-pencil-square-o"></i> <span>Editeaza</span>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                    <?php if ($comment_responded['id_user'] != $this->session->userdata['front_id']): ?>
                                                                        <div class="form-group hidden" id="respond_to_<?php echo $id_comment_responded; ?>">
                                                                            <textarea class="form-control" name="comment" rows="5" cols="30" data-id="<?php echo $article['id'] ?>"></textarea>
                                                                            <button class="btn btn-danger btn-xs add-response-comment"
                                                                                    data-comment-level="2" data-id="<?php echo $id_comment_responded; ?>">Adauga raspuns</button>
                                                                            <button class="btn btn-info btn-xs cancel-adding-response" data-id="<?php echo $id_comment_responded; ?>">Anuleaza</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php /* ----- Second level of response ----- */ ?>
                                                                    <?php if (!empty($comment_responded['responded'])): ?>
                                                                    <ul class="media-list">
                                                                        <?php foreach ($comment_responded['responded'] as $id_second_response => $second_response): ?>
                                                                            <li class="media comment-by-author" id="row_comment_<?php echo $id_second_response; ?>">
                                                                                <div id="comment_displayed_<?php echo $id_second_response; ?>">
                                                                                    <a href="#" class="media-left">
                                                                                        <img src="<?php echo $second_response['avatar_user']; ?>" class="avatar" alt="avatar">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h4 class="media-heading comment-author"><a href="#"><?php echo $second_response['name_user']; ?></a></h4>
                                                                                        <span class="timestamp"><?php echo $second_response['creation_date']; ?></span>
                                                                                        <p class="comment-body"><?php echo $second_response['body']; ?></p>
                                                                                        <p class="comments-options">
                                                                                            <span class="comm-color thumbs-up-color m-l-10 m-r-10 like-comment"
                                                                                                  data-id="<?php echo $id_second_response; ?>" <?php echo !empty($second_response['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ?
                                                                                                'data-review-id="'.$second_response['reviews']['thumbs_up'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                                                                <i class="fa <?php echo !empty($second_response['reviews']['thumbs_up'][$this->session->userdata['front_id']]) ? 'fa-thumbs-up' : 'fa-thumbs-o-up' ?>"></i>
                                                                                                <span><?php echo count($second_response['reviews']['thumbs_up']); ?></span>
                                                                                            </span>
                                                                                            <span class="comm-color thumbs-down-color m-r-10 dislike-comment"
                                                                                                  data-id="<?php echo $id_second_response; ?>" <?php echo !empty($second_response['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ?
                                                                                                'data-review-id="'.$second_response['reviews']['thumbs_down'][$this->session->userdata['front_id']]['id_review'].'"' : '' ?>>
                                                                                                <i class="fa <?php echo !empty($second_response['reviews']['thumbs_down'][$this->session->userdata['front_id']]) ? 'fa-thumbs-down' : 'fa-thumbs-o-down' ?>"></i>
                                                                                                <span><?php echo count($second_response['reviews']['thumbs_down']); ?></span>
                                                                                            </span>
                                                                                            <?php if ($second_response['id_user'] == $this->session->userdata['front_id']): ?>
                                                                                                <span class="comm-color pull-right delete-comment" data-id="<?php echo $id_second_response; ?>">
                                                                                                    <i class="fa fa-trash-o"></i> <span>Sterge</span>
                                                                                                </span>
                                                                                                <span class="comm-color m-r-10 pull-right edit-comment" data-id="<?php echo $id_second_response; ?>">
                                                                                                    <i class="fa fa-pencil-square-o"></i> <span>Editeaza</span>
                                                                                                </span>
                                                                                            <?php endif; ?>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <?php if ($second_response['id_user'] == $this->session->userdata['front_id']): ?>
                                                                                    <div class="form-group hidden" id="comment_edited_<?php echo $id_second_response; ?>">
                                                                                        <textarea class="form-control" name="comment" rows="5" cols="30"><?php echo $second_response['body']; ?></textarea>
                                                                                        <button class="btn btn-success btn-xs update-comment" data-id="<?php echo $id_second_response; ?>">Modifica</button>
                                                                                        <button class="btn btn-info btn-xs cancel-editing" data-id="<?php echo $id_second_response; ?>">Anuleaza</button>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                    <?php endif; ?>
                                                                    <?php /* ----- End of Second level of response ----- */ ?>
                                                                </div>
                                                            </div>
                                                            <?php if ($comment_responded['id_user'] == $this->session->userdata['front_id']): ?>
                                                                <div class="form-group hidden" id="comment_edited_<?php echo $id_comment_responded; ?>">
                                                                    <textarea class="form-control" name="comment" rows="5" cols="30"><?php echo $comment_responded['body']; ?></textarea>
                                                                    <button class="btn btn-success btn-xs update-comment" data-id="<?php echo $id_comment_responded; ?>">Modifica</button>
                                                                    <button class="btn btn-info btn-xs cancel-editing" data-id="<?php echo $id_comment_responded; ?>">Anuleaza</button>
                                                                </div>
                                                            <?php endif; ?>
                                                        </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <?php endif; ?>
                                                    <?php /* ----- End of First level of response ----- */ ?>
                                                </div>
                                            </div>
                                            <?php if ($comment['id_user'] == $this->session->userdata['front_id']): ?>
                                            <div class="form-group hidden" id="comment_edited_<?php echo $id_comment; ?>">
                                                <textarea class="form-control" name="comment" rows="5" cols="30"><?php echo $comment['body']; ?></textarea>
                                                <button class="btn btn-success btn-xs update-comment" data-id="<?php echo $id_comment; ?>">Modifica</button>
                                                <button class="btn btn-info btn-xs cancel-editing" data-id="<?php echo $id_comment; ?>">Anuleaza</button>
                                            </div>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>

                                    <!-- Hidden comments containers used for dinamically adding a comment -->
                                    <ul class="media-list hidden" id="answered_comment_content">
                                        <li class="media comment-by-author hidden" id="answered_content">
                                            <div class="comment_displayed_">
                                                <a href="#" class="media-left">
                                                    <img src="<?php echo assets_img_url(); ?>blog/post-author.png" class="avatar" alt="avatar">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading comment-author"><a href="#">Ashley Young</a></h4><span class="timestamp">Jan 14, 2016 18:40 PM</span>
                                                    <p class="comment-body"></p>
                                                    <p class="comments-options" id="options_comment_">
                                                        <span class="comm-color answer-to-comment">
                                                            <i class="fa fa-reply"></i> <span>Raspunde</span>
                                                        </span>
                                                            <span class="comm-color thumbs-up-color m-l-10 m-r-10 like-comment">
                                                            <i class="fa fa-thumbs-o-up"></i> <span>2</span>
                                                        </span>
                                                            <span class="comm-color thumbs-down-color m-r-10 dislike-comment">
                                                            <i class="fa fa-thumbs-o-down"></i> <span>3</span>
                                                        </span>
                                                            <span class="comm-color pull-right edit-comment">
                                                            <i class="fa fa-pencil-square-o"></i> <span>Editeaza</span>
                                                        </span>
                                                    </p>
                                                    <div class="form-group" id="comment_to_add_">
                                                        <textarea class="form-control" id="add_comment_to_" name="comment" rows="5" cols="30"></textarea>
                                                        <button class="btn btn-danger btn-xs add-response-comment">Add</button>
                                                        <button class="btn btn-info btn-xs cancel-adding-response">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="comment_edited_">
                                                <textarea class="form-control" id="edit_comment_" name="comment" rows="5" cols="30"></textarea>
                                                <button class="btn btn-success btn-xs update-comment">Edit</button>
                                                <button class="btn btn-info btn-xs cancel-editing">Cancel</button>
                                            </div>
                                        </li>
                                    </ul>
                                    <li class="media hidden" id="typical_comment">
                                        <div id="comment_displayed_">
                                            <a href="#" class="media-left">
                                                <img src="<?php echo assets_img_url(); ?>blog/user2.png" class="avatar" alt="avatar">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading comment-author"><a href="#">Michael</a></h4>
                                                <span class="timestamp">10 hours ago</span>
                                                <p class="comment-body"></p>
                                                <p class="comments-options">
                                                    <span class="comm-color pull-right delete-comment">
                                                        <i class="fa fa-trash-o"></i> <span>Sterge</span>
                                                    </span>
                                                    <span class="comm-color m-r-10 pull-right edit-comment">
                                                        <i class="fa fa-pencil-square-o"></i> <span>Editeaza</span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group hidden" id="comment_edited_">
                                            <textarea class="form-control" name="comment" rows="5" cols="30"></textarea>
                                            <button class="btn btn-success btn-xs update-comment" data-id="">Editeaza</button>
                                            <button class="btn btn-info btn-xs cancel-editing" data-id="">Anuleaza</button>
                                        </div>
                                    </li>
                                    <!-- End of hidden comments containers -->
                                </ul>
                                <?php else: ?>
                                <p>Nu a fost adaugat niciun comentariu, pana in acest moment.</p>
                                <?php endif; ?>
                            </article>
                            <!--<button type="button" class="btn btn-default center-block">Mai multe comentarii</button>-->
                            <!-- end comments -->
                            <!-- comment form -->
                            <section class="comment-form margin-bottom">
                                <h4 class="section-heading add-comment-header"><i class="fa fa-plus-square-o"></i> Adauga un comentariu</h4>
                                <form class="form-horizontal" style="display: none" id="add_comment_form">
                                    <div class="form-group">
                                        <label for="comment" class="control-label sr-only">Your Commment</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" data-id="<?php echo $article['id']; ?>" name="comment" rows="5" cols="30" placeholder="Mesaj"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Publica comentariu</button>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <!-- end comment form -->
                        </div>
                        <div class="col-md-3">
                            <!-- sidebar -->
                            <div class="sidebar">
                                <?php $this->view('includes/widget_recommended'); ?>
                                <?php $this->view('includes/widget_categories'); ?>
                                <?php $this->view('includes/widget_tags'); ?>
                                <?php $this->view('includes/widget_search'); ?>
                            </div>
                            <!-- end sidebar -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT -->
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>
