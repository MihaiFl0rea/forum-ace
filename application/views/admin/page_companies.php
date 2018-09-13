<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:03 PM
 */

$current_user = $this->session->userdata;
$is_admin = (!empty($current_user['role']) && $current_user['role'] == 'admin');
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
                    if (($template == 'read') || ($template == 'companies_by_city')): ?>
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Companii</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/companii'; ?>">Companii</a></li>
                            <?php if ($template == 'companies_by_city'): ?>
                                <li class="breadcrumb-item active"><?php echo ucfirst($city); ?></li>
                            <?php endif; ?>
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
                                    <?php $header = ($template == 'read') ? 'Companii' : 'Companii din ' . ucfirst($city); ?>
                                    <h4><?php echo $header; ?>
                                        <?php if ($is_admin): ?>
                                        <span> | </span>
                                        <button type="button" class="btn btn-success btn-sm m-l-5">
                                            <a href="<?php echo base_url() . 'admin/adaugare-companie'; ?>">Adauga companie</a>
                                        </button>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($companies)): ?>
                                    <div class="table-responsive">
                                        <table class="table" id="all_companies">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nume</th>
                                                    <?php if ($template == 'read'): ?>
                                                    <th>Oras</th>
                                                    <?php endif; ?>
                                                    <th>Email</th>
                                                    <th>Data inregistrarii</th>
                                                    <th>Articole adaugate</th>
                                                    <?php if ($is_admin): ?>
                                                    <th>#</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($companies as $city => $companies_by_city):
                                                    foreach ($companies_by_city as $company): ?>
                                                    <tr id="company-record-<?php echo $company['id']; ?>">
                                                        <td><?php echo $company['id']; ?></td>
                                                        <td><?php echo $company['name']; ?></td>
                                                        <?php if ($template == 'read'): ?>
                                                        <td><?php echo $company['city']; ?></td>
                                                        <?php endif; ?>
                                                        <td><?php echo $company['email']; ?></td>
                                                        <td><?php echo date('d.m.Y', strtotime($company['register_date'])); ?></td>
                                                        <td><?php echo $company['#articles']; ?></td>
                                                        <?php if ($is_admin): ?>
                                                        <td>
                                                            <button type="button"
                                                                    id="<?php echo $company['id']; ?>"
                                                                    class="btn btn-warning btn-sm m-b-10 m-l-5">
                                                                <a href="<?php echo base_url() . 'admin/editare-companie/' . $company['id']; ?>">Editare</a>
                                                            </button>
                                                            <span> | </span>
                                                            <button type="button"
                                                                    id="<?php echo $company['id']; ?>"
                                                                    data-logo="<?php echo $company['logo']; ?>"
                                                                    class="delete-company btn btn-danger btn-sm m-b-10 m-l-5">Stergere</button>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <?php endforeach; ?>
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
                    <?php if (!$is_admin) { redirect(site_url() . 'admin/companii'); } ?>
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Companii</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/companii'; ?>">Companii</a></li>
                            <li class="breadcrumb-item active">Adaugare companie</li>
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
                                    <h4>Adaugare companie</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <?php echo form_open(base_url() . 'admin/adaugare-companie', array('enctype' => 'multipart/form-data')); ?>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Nume companie*'); ?>
                                                <?php echo form_input(array('id' => 'name', 'name' => 'name', 'class' => 'form-control', 'placeholder' => 'Nume companie')); ?>
                                                <?php echo form_error('name'); ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Email*'); ?>
                                                <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')); ?>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Parola*'); ?>
                                                <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Parola')); ?>
                                                <?php echo form_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Oras*'); ?>
                                                <?php echo form_input(array('id' => 'city', 'name' => 'city', 'class' => 'form-control', 'placeholder' => 'Oras')); ?>
                                                <?php echo form_error('city'); ?>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <?php echo form_label('Adresa'); ?>
                                                <?php echo form_input(array('id' => 'address', 'name' => 'address', 'class' => 'form-control', 'placeholder' => 'Adresa')); ?>
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <?php echo form_label('Descriere'); ?>
                                                <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'class' => 'form-control', 'placeholder' => 'Scurta descriere')); ?>
                                                <?php echo form_error('descriere'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Logo</label><br/>
                                                <?php echo form_upload(array('id' => 'logo', 'name' => 'logo')); ?>
                                                <?php echo form_error('logo'); ?>
                                            </div>
                                        </div>
                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Adauga companie', 'class' => 'btn btn-primary btn-fill')) ?>
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
                    <?php if (!$is_admin) { redirect(site_url() . 'admin/companii'); } ?>
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Companii</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/companii'; ?>">Companii</a></li>
                            <li class="breadcrumb-item active">Editare companie</li>
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
                                    <h4>Editare profil <?php echo $company['name']; ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <?php echo form_open(base_url() . 'admin/editare-companie/' . $company['id'], array('enctype' => 'multipart/form-data')); ?>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Nume companie*'); ?>
                                                <?php echo form_input(array('id' => 'name', 'name' => 'name', 'class' => 'form-control', 'value' => $company['name'])); ?>
                                                <?php echo form_error('name'); ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Email*'); ?>
                                                <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'form-control', 'value' => $company['email'])); ?>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Parola noua?'); ?>
                                                <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Parola noua')); ?>
                                                <?php echo form_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <?php echo form_label('Oras*'); ?>
                                                <?php echo form_input(array('id' => 'city', 'name' => 'city', 'class' => 'form-control', 'value' => $company['city'])); ?>
                                                <?php echo form_error('city'); ?>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <?php echo form_label('Adresa'); ?>
                                                <?php echo form_input(array('id' => 'address', 'name' => 'address', 'class' => 'form-control', 'value' => $company['address'])); ?>
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <?php echo form_label('Descriere'); ?>
                                                <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'class' => 'form-control', 'value' => $company['description'])); ?>
                                                <?php echo form_error('descriere'); ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($company['logo'])): ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="<?php echo assets_uploads_url() . $company['logo']; ?>" width="100px" />
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label><?php echo !empty($company['logo']) ? 'Logo nou?' : 'Logo'; ?></label><br/>
                                                <?php echo form_upload(array('id' => 'logo', 'name' => 'logo', 'data-old-logo' => $company['logo'])); ?>
                                                <?php echo form_error('logo'); ?>
                                            </div>
                                        </div>
                                        <?php echo form_hidden('old-logo', $company['logo']); ?>
                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Editeaza profilul', 'class' => 'btn btn-primary btn-fill')) ?>
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