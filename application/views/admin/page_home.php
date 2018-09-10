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
                                    <h4 class="txt-alg-center">Ultimele companii inregistrate</h4>
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
                                    <h4 class="txt-alg-center">Ultimii studenti inregistrati</h4>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h2 class="txt-alg-center">Statistici Forum A.C.E.</h2>
                                </div>
                                <div class="card-body">
                                    <!-- Students statistics -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-graduation-cap f-s-40 color-primary"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>73</h2>
                                                        <p class="m-b-0">Studenti</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-university f-s-40 color-primary"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>51</h2>
                                                        <p class="m-b-0">Studenti ACE</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-university f-s-40 color-primary"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>22</h2>
                                                        <p class="m-b-0">Studenti Mate-Info</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-comments-o f-s-40 color-primary"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>166</h2>
                                                        <p class="m-b-0">Comentarii studenti</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Students statistics -->
                                    <!-- Companies statistics -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-users f-s-40 color-danger"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>12</h2>
                                                        <p class="m-b-0">Companii</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-user-secret f-s-40 color-danger"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>6</h2>
                                                        <p class="m-b-0">Companii (Craiova)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-user-secret f-s-40 color-danger"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>3</h2>
                                                        <p class="m-b-0">Companii (Bucuresti)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-user-secret f-s-40 color-danger"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>3</h2>
                                                        <p class="m-b-0">Companii (Alte orase)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Companies statistics -->
                                    <!-- Articles statistics -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-sticky-note-o f-s-40 color-success"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>59</h2>
                                                        <p class="m-b-0">Articole</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-share f-s-40 color-success"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>31</h2>
                                                        <p class="m-b-0">Anunturi companii</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card p-30">
                                                <div class="media">
                                                    <div class="media-left meida media-middle">
                                                        <span><i class="fa fa-reply f-s-40 color-success"></i></span>
                                                    </div>
                                                    <div class="media-body media-text-right">
                                                        <h2>28</h2>
                                                        <p class="m-b-0">Postari IT</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Articles statistics -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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