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
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Acasa</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Acasa</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- End Bread crumb -->
                <?php $this->view('admin/includes/warnings'); ?>
                <?php $current_user = $this->session->userdata;
                    if (!empty($current_user['role']) && $current_user['role'] == 'admin'): ?>
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <?php if (!empty($pending_companies)): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Ultimele companii inregistrate</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="recent_companies">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nume</th>
                                                    <th>Oras</th>
                                                    <th>Email</th>
                                                    <th>Data inregistrarii</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pending_companies as $pending_company): ?>
                                                    <tr>
                                                        <td><?php echo $pending_company['id']; ?></td>
                                                        <td><?php echo $pending_company['name']; ?></td>
                                                        <td><?php echo $pending_company['city']; ?></td>
                                                        <td><?php echo $pending_company['email']; ?></td>
                                                        <td><?php echo date('d.m.Y', strtotime($pending_company['register_date'])); ?></td>
                                                        <td>
                                                            <button type="button"
                                                                    id="<?php echo $pending_company['id']; ?>"
                                                                    data-email="<?php echo $pending_company['email']; ?>"
                                                                    data-table-name="company"
                                                                    class="approve-user btn btn-success btn-xs btn-rounded m-b-10 m-l-5">Aproba!</button>
                                                            <strong>/</strong>
                                                            <span class="badge badge-warning">Pending</span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($pending_students)): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Ultimii studenti inregistrati</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="recent_students">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nume</th>
                                                    <th>Email</th>
                                                    <th>Data inregistrarii</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pending_students as $pending_student): ?>
                                                    <tr>
                                                        <td><?php echo $pending_student['id']; ?></td>
                                                        <td><?php echo $pending_student['last_name'] . ' ' . $pending_student['first_name']; ?></td>
                                                        <td><?php echo $pending_student['email']; ?></td>
                                                        <td><?php echo date('d.m.Y', strtotime($pending_student['register_date'])); ?></td>
                                                        <td>
                                                            <button type="button"
                                                                    id="<?php echo $pending_student['id']; ?>"
                                                                    data-email="<?php echo $pending_student['email']; ?>"
                                                                    data-table-name="student"
                                                                    class="approve-user btn btn-success btn-xs btn-rounded m-b-10 m-l-5">Aproba!</button>
                                                            <strong>/</strong>
                                                            <span class="badge badge-warning">Pending</span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- End PAge Content -->
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