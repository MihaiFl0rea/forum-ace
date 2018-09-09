<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/25/2018
 * Time: 12:42 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

    <?php $this->view('admin/includes/froala_header'); ?>

    <body class="fix-header fix-sidebar">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <?php $this->view('admin/includes/top_header'); ?>
            <?php $this->view('admin/includes/left_sidebar'); ?>
            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <?php $this->view('admin/includes/warnings');
                if (($template == 'read')): ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/articole'; ?>">Articole</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Bread crumb -->
                    <div class="container-fluid">
                        <!-- Start Page Content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-success btn-sm m-l-5">
                                    <a href="<?php echo base_url() . 'admin/adaugare-articol'; ?>">Adauga articol</a>
                                </button>
                            </div>
                        </div>
                        <?php if (!empty($articles)): ?>
                            <?php foreach ($articles as $article): ?>
                            <div class="row article-summary" id="article-record-<?php echo $article['id']; ?>">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-title">
                                            <h5><i><?php echo $article['creation_date']; ?></i></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-two">
                                                <div class="poster">
                                                    <a href="<?php echo base_url() . 'admin/articole/' . $article['id']; ?>">
                                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name_company'])) . '/' . $article['poster']; ?>" width="250px" />
                                                    </a>
                                                </div>
                                                <h2>
                                                    <a href="<?php echo base_url() . 'admin/articole/' . $article['id']; ?>"><?php echo $article['title']; ?></a>
                                                </h2>
                                                <header>
                                                    <div class="avatar">
                                                        <img src="<?php echo assets_uploads_url() . $article['logo_company']; ?>" />
                                                    </div>
                                                </header>
                                                <h3><?php echo $article['name_company']; ?></h3>
                                                <div class="desc"><?php echo $article['type_name']; ?></div>
                                            </div>
                                            <button type="button" class="btn btn-warning btn-sm m-l-5 pull-right">
                                                <a href="<?php echo base_url() . 'admin/editare-articol/' . $article['id']; ?>">Edit</a>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm m-l-5 pull-right delete-article" id="<?php echo $article['id']; ?>">Delete</button>

                                            <!--<button class="btn btn-danger btn btn-sm sweet-confirm">Sweet Delete</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <h5>Date indisponibile in acest moment!</h5>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- End PAge Content -->
                    </div>
                <?php endif; ?>

                <?php if (($template == 'read_article')): ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/articole'; ?>">Articole</a></li>
                                <li class="breadcrumb-item active"><?php echo $article['title'] ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Bread crumb -->
                    <div class="container-fluid">
                        <!-- Start Page Content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h5><strong><?php echo $article['creation_date']; ?> | <?php echo $article['type_name']; ?></strong></h5>
                                    </div>
                                    <div class="card-body article-full">
                                        <div class="card-two">
                                            <div class="poster">
                                                <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name_company'])) . '/' . $article['poster']; ?>" width="500px" />
                                            </div>
                                            <h2>
                                                <?php echo $article['title']; ?>
                                            </h2>
                                            <div class="fr-view">
                                                <?php echo $article['body']; ?>
                                            </div>
                                            <h5>
                                                Categorii: <?php echo $article['all_categories']; ?>
                                            </h5>
                                            <h5>
                                                Tag-uri: <?php echo $article['all_tags']; ?>
                                            </h5>
                                            <header>
                                                <div class="avatar">
                                                    <img src="<?php echo assets_uploads_url() . $article['logo_company']; ?>" />
                                                </div>
                                            </header>
                                            <h4><?php echo $article['name_company']; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End PAge Content -->
                    </div>
                <?php endif; ?>

                <?php if ($template == 'create'): ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'articole'; ?>">Articole</a></li>
                                <li class="breadcrumb-item active">Adaugare articol</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Bread crumb -->
                    <div class="container-fluid">
                        <!-- Start Page Content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title form-group">
                                        <h4>Adaugare articol</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/adaugare-articol', array('id' => 'add_article_form', 'enctype' => 'multipart/form-data')); ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo form_label('Tip articol*'); ?><br/>
                                                    <?php echo form_radio(array('id' => 'type_company', 'name' => 'type', 'value' => '0')); ?>
                                                    <?php echo form_label('Anunt companie','type_company', array('class' => 'checkbox-inline')); ?>
                                                    <?php echo form_error('type'); ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo form_radio(array('id' => 'type_student', 'name' => 'type', 'value' => '1')); ?>
                                                    <?php echo form_label('Postare (<strong>Sharing is caring</strong> <span>&#9786;</span>)','type_student', array('class' => 'checkbox-inline')); ?>
                                                    <?php echo form_error('type'); ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Titlu*'); ?>
                                                    <?php echo form_input(array('id' => 'title', 'name' => 'title', 'class' => 'form-control', 'placeholder' => 'Titlu articol')); ?>
                                                    <?php echo form_error('title'); ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Poster</label><br/>
                                                    <?php echo form_upload(array('id' => 'poster', 'name' => 'poster')); ?>
                                                    <?php echo form_error('poster'); ?>
                                                </div>
                                                <div class="form-group col-md-12" style="display: none;">
                                                    <img id="img_preview" name="img_preview" src="#" width="100px" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Continut articol*'); ?>
                                                    <?php echo form_textarea(array('id' => 'article_body', 'name' => 'article-body', 'class' => 'form-control')); ?>
                                                    <?php echo form_error('article_body'); ?>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo form_label('Incadrare articol in categorie/ii*'); ?>
                                                        <select multiple name="categories[]" id="article_categories" class="form-control">
                                                            <?php foreach ($categories as $category): ?>
                                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php echo form_error('categories[]'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo form_label('Tag-uri articol*'); ?>
                                                        <select multiple name="tags[]" id="article_tags" class="form-control">
                                                            <?php foreach ($tags as $tag): ?>
                                                                <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php echo form_error('tags[]'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Adauga articol', 'class' => 'btn btn-primary btn-fill')) ?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Content -->
                    </div>
                <?php endif; ?>

                <?php if ($template == 'update'): ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/articole'; ?>">Articole</a></li>
                                <li class="breadcrumb-item active">Editare articol</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Bread crumb -->
                    <div class="container-fluid">
                        <!-- Start Page Content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>Editare articol</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/editare-articol/' . $article['id'], array('id' => 'edit_article_form', 'enctype' => 'multipart/form-data')); ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo form_label('Tip articol*'); ?><br/>
                                                    <?php $checked = $article['type'] == '0' ? array('checked' => 'checked') : array(); ?>
                                                    <?php echo form_radio(array_merge(array('id' => 'type_company', 'name' => 'type', 'value' => '0'), $checked)); ?>
                                                    <?php echo form_label('Anunt companie','type_company', array('class' => 'checkbox-inline')); ?>
                                                    <?php echo form_error('type'); ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php $checked = $article['type'] == '1' ? array('checked' => 'checked') : array(); ?>
                                                    <?php echo form_radio(array_merge(array('id' => 'type_student', 'name' => 'type', 'value' => '1'), $checked)); ?>
                                                    <?php echo form_label('Postare (<strong>Sharing is caring</strong> <span>&#9786;</span>)','type_student', array('class' => 'checkbox-inline')); ?>
                                                    <?php echo form_error('type'); ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Titlu*'); ?>
                                                    <?php echo form_input(array('id' => 'title', 'name' => 'title', 'class' => 'form-control', 'value' => $article['title'])); ?>
                                                    <?php echo form_error('title'); ?>
                                                </div>
                                                <?php if (!empty($article['poster'])): ?>
                                                    <div class="col-md-12">
                                                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $article['name_company'])) . '/' . $article['poster']; ?>" width="100px" />
                                                    </div>
                                                <?php endif; ?>
                                                    <div class="form-group col-md-12">
                                                        <label><?php echo !empty($article['poster']) ? 'Poster nou?' : 'Poster'; ?></label><br/>
                                                        <?php echo form_upload(array('id' => 'poster', 'name' => 'poster', 'data-old-logo' => $article['poster'])); ?>
                                                        <?php echo form_error('poster'); ?>
                                                    </div>
                                                <?php echo form_hidden('old-poster', $article['poster']); ?>
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Continut articol*'); ?>
                                                    <?php echo form_textarea(array('id' => 'article_body', 'name' => 'article-body', 'class' => 'form-control', 'value' => $article['body'])); ?>
                                                    <?php echo form_error('article_body'); ?>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo form_label('Incadrare articol in categorie/ii*'); ?>
                                                        <select multiple name="categories[]" id="article_categories" class="form-control">
                                                            <?php foreach ($categories as $category): ?>
                                                                <option value="<?php echo $category['id']; ?>"
                                                                    <?php echo in_array($category['id'], $article['categories']) ? ' selected="selected"' : ''; ?>><?php echo $category['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php echo form_error('categories[]'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo form_label('Tag-uri articol*'); ?>
                                                        <select multiple name="tags[]" id="article_tags" class="form-control">
                                                            <?php foreach ($tags as $tag): ?>
                                                                <option value="<?php echo $tag['id']; ?>"
                                                                    <?php echo in_array($tag['id'], $article['tags']) ? ' selected="selected"' : ''; ?>><?php echo $tag['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php echo form_error('tags[]'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Editeaza articol', 'class' => 'btn btn-primary btn-fill')) ?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Content -->
                    </div>
                <?php endif; ?>
                <!-- footer -->
                <footer class="footer"> © Facultatea de Automatica, Calculatoare si Electronica, <?php echo date('Y'); ?></footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        <?php $this->view('admin/includes/footer'); ?>
        <?php $this->view('admin/includes/froala_footer'); ?>
    </body>

</html>
