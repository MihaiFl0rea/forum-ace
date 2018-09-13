<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 11:44 PM
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
                if (($template == 'read') || ($template == 'students_by_faculty')): ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Studenti</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/studenti'; ?>">Studenti</a></li>
                                <?php if ($template == 'students_by_faculty'): ?>
                                    <li class="breadcrumb-item active"><?php echo ucfirst($faculty); ?></li>
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
                                        <?php $header = ($template == 'read') ? 'Studenti' : 'Studenti la ' . strtoupper($faculty); ?>
                                        <h4><?php echo $header; ?>
                                            <?php if ($is_admin): ?>
                                                <span> | </span>
                                                <button type="button" class="btn btn-success btn-sm m-l-5">
                                                    <a href="<?php echo base_url() . 'admin/adaugare-student'; ?>">Adauga student</a>
                                                </button>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($students)): ?>
                                            <div class="table-responsive">
                                                <table class="table" id="all_students">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nume</th>
                                                            <?php if ($template == 'read'): ?>
                                                                <th>Facultate</th>
                                                            <?php endif; ?>
                                                            <th>Email</th>
                                                            <th>Data inregistrarii</th>
                                                            <th>Comentarii adaugate</th>
                                                            <?php if ($is_admin): ?>
                                                                <th>#</th>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($students as $faculty => $students_by_faculty):
                                                        foreach ($students_by_faculty as $student): ?>
                                                            <tr id="student-record-<?php echo $student['id']; ?>">
                                                                <td><?php echo $student['id']; ?></td>
                                                                <td><?php echo $student['name']; ?></td>
                                                                <?php if ($template == 'read'): ?>
                                                                    <td><?php echo $student['faculty']; ?></td>
                                                                <?php endif; ?>
                                                                <td><?php echo $student['email']; ?></td>
                                                                <td><?php echo date('d.m.Y', strtotime($student['register_date'])); ?></td>
                                                                <td><?php echo $student['#comments']; ?></td>
                                                                <?php if ($is_admin): ?>
                                                                    <td>
                                                                        <button type="button"
                                                                                id="<?php echo $student['id']; ?>"
                                                                                class="btn btn-warning btn-sm m-b-10 m-l-5">
                                                                            <a href="<?php echo base_url() . 'admin/editare-student/' . $student['id']; ?>">Editare</a>
                                                                        </button>
                                                                        <span> | </span>
                                                                        <button type="button"
                                                                                id="<?php echo $student['id']; ?>"
                                                                                data-avatar="<?php echo $student['avatar']; ?>"
                                                                                class="delete-student btn btn-danger btn-sm m-b-10 m-l-5">Stergere</button>
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
                    <?php if (!$is_admin) { redirect(site_url() . 'admin/studenti'); } ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Studenti</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/studenti'; ?>">Studenti</a></li>
                                <li class="breadcrumb-item active">Adaugare student</li>
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
                                        <h4>Adaugare student</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/adaugare-student', array('enctype' => 'multipart/form-data')); ?>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Nume*'); ?>
                                                    <?php echo form_input(array('id' => 'last_name', 'name' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Nume')); ?>
                                                    <?php echo form_error('last_name'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Prenume*'); ?>
                                                    <?php echo form_input(array('id' => 'first_name', 'name' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Prenume')); ?>
                                                    <?php echo form_error('last_name'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Parola*'); ?>
                                                    <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Parola')); ?>
                                                    <?php echo form_error('password'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Email*'); ?>
                                                    <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')); ?>
                                                    <?php echo form_error('email'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Facultate'); ?>
                                                    <select name="faculty" id="faculty" class="form-control">
                                                        <option value="none" disabled selected>Selectati facultatea</option>
                                                        <option value="ace">A.C.E.</option>
                                                        <option value="mate-info">Mate-Info</option>
                                                    </select>
                                                    <?php echo form_error('faculty'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Avatar</label><br/>
                                                    <?php echo form_upload(array('id' => 'avatar', 'name' => 'avatar')); ?>
                                                    <?php echo form_error('avatar'); ?>
                                                </div>
                                            </div>
                                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Adauga student', 'class' => 'btn btn-primary btn-fill')) ?>
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
                    <?php if (!$is_admin) { redirect(site_url() . 'admin/studenti'); } ?>
                    <!-- Bread crumb -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Studenti</h3> </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/studenti'; ?>">Studenti</a></li>
                                <li class="breadcrumb-item active">Editare student</li>
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
                                        <h4>Editare profil <?php echo $student['last_name'] . ' ' .  $student['first_name']; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php echo form_open(base_url() . 'admin/editare-student/' . $student['id'], array('enctype' => 'multipart/form-data')); ?>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Nume*'); ?>
                                                    <?php echo form_input(array('id' => 'last_name', 'name' => 'last_name', 'class' => 'form-control', 'value' => $student['last_name'])); ?>
                                                    <?php echo form_error('last_name'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Prenume*'); ?>
                                                    <?php echo form_input(array('id' => 'first_name', 'name' => 'first_name', 'class' => 'form-control', 'value' => $student['first_name'])); ?>
                                                    <?php echo form_error('last_name'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Parola noua?'); ?>
                                                    <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Parola noua')); ?>
                                                    <?php echo form_error('password'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Email*'); ?>
                                                    <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'form-control', 'value' => $student['email'])); ?>
                                                    <?php echo form_error('email'); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo form_label('Facultate'); ?>
                                                    <select name="faculty" id="faculty" class="form-control">
                                                        <option value="none" disabled selected>Selectati facultatea</option>
                                                        <option value="ace"<?php echo $student['faculty'] == 'ace' ? ' selected' : ''; ?>>A.C.E.</option>
                                                        <option value="mate-info"<?php echo $student['faculty'] == 'mate-info' ? ' selected' : ''; ?>>Mate-Info</option>
                                                    </select>
                                                    <?php echo form_error('faculty'); ?>
                                                </div>
                                            </div>
                                            <?php if (!empty($student['avatar'])): ?>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="<?php echo assets_uploads_url() . $student['avatar']; ?>" width="100px" />
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label><?php echo !empty($student['avatar']) ? 'Avatar nou?' : 'Avatar'; ?></label><br/>
                                                    <?php echo form_upload(array('id' => 'avatar', 'name' => 'avatar', 'data-old-avatar' => $student['avatar'])); ?>
                                                    <?php echo form_error('logo'); ?>
                                                </div>
                                            </div>
                                            <?php echo form_hidden('old-avatar', $student['avatar']); ?>
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