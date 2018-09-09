<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/25/2018
 * Time: 6:28 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

    <?php $this->view('admin/includes/header'); ?>

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
                            <h3 class="text-primary">Tag-uri articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/taguri-articole'; ?>">Tag-uri</a></li>
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
                                        <h4>Tag-uri <span> | </span>
                                            <button type="button" class="btn btn-success btn-sm m-l-5">
                                                <a href="<?php echo base_url() . 'admin/adaugare-tag'; ?>">Adauga tag</a>
                                            </button></h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($tags)): ?>
                                            <div class="table-responsive">
                                                <table class="table" id="all_tags">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nume</th>
                                                            <th>Gasit in ? articole</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($tags as $tag): ?>
                                                        <tr id="tag-record-<?php echo $tag['id']; ?>">
                                                            <td><?php echo $tag['id']; ?></td>
                                                            <td><?php echo $tag['name']; ?></td>
                                                            <td>NaN (for now)</td>
                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-warning btn-sm m-b-10 m-l-5">
                                                                    <a href="<?php echo base_url() . 'admin/editare-tag/' . $tag['id']; ?>">Editare</a>
                                                                </button>
                                                                <span> | </span>
                                                                <button type="button"
                                                                        id="<?php echo $tag['id']; ?>"
                                                                        class="delete-tag btn btn-danger btn-sm m-b-10 m-l-5">Stergere</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <h5>Date indisponibile in acest moment!</h5>
                                        <?php endif; ?>
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
                            <h3 class="text-primary">Tag-uri articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/taguri-articole'; ?>">Tag-uri</a></li>
                                <li class="breadcrumb-item active">Adaugare tag</li>
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
                                        <h4>Adaugare tag</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/adaugare-tag'); ?>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Nume*'); ?>
                                                    <?php echo form_input(array('id' => 'name', 'name' => 'name', 'class' => 'form-control', 'placeholder' => 'Nume tag')); ?>
                                                    <?php echo form_error('name'); ?>
                                                </div>
                                            </div>
                                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Adauga tag', 'class' => 'btn btn-primary btn-fill')) ?>
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
                            <h3 class="text-primary">Tag-uri articole</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/taguri-articole'; ?>">Tag-uri</a></li>
                                <li class="breadcrumb-item active">Editare tag</li>
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
                                        <h4>Editare tag</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/editare-tag/' . $tag['id']); ?>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <?php echo form_label('Nume*'); ?>
                                                    <?php echo form_input(array('id' => 'name', 'name' => 'name', 'class' => 'form-control', 'value' => $tag['name'])); ?>
                                                    <?php echo form_error('name'); ?>
                                                </div>
                                            </div>
                                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Editeaza tag', 'class' => 'btn btn-primary btn-fill')) ?>
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
    </body>

</html>
