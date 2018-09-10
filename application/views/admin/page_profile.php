<!DOCTYPE html>
<html lang="en">

    <?php $this->view('admin/includes/header'); ?>

    <body class="fix-header fix-sidebar">
        <!-- Preloader - style you can find in spinners.css -->
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
                        <h3 class="text-primary">Dashboard</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- End Bread crumb -->
                <?php $this->view('admin/includes/warnings'); ?>
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-two">
                                        <header>
                                            <div class="avatar">
                                                <?php if (!empty($user['logo'])): ?>
                                                <img src="<?php echo assets_uploads_url() . $user['logo']; ?>" title="<?php echo $user['name']; ?>" />
                                                <?php else: ?>
                                                <img src="<?php echo assets_img_url() . 'logoACE.png'; ?>" title="<?php echo $user['name']; ?>" />
                                                <?php endif; ?>
                                            </div>
                                        </header>
                                        <h4><?php echo $user['name']; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <?php if (!empty($user['city'])): ?>
                        <div class="container-fluid">
                            <div class="row">
                                <!--<div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-title">
                                            <h3>Add your company</h3>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <h4 class="card-title">Your company's logo</h4>
                                            <form action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Editeaza profilul</h4>
                                            <div class="basic-form">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="company-name" class="col-md-12">Nume</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-name" value="<?php echo $user['name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-city" class="col-md-12">City</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-city" value="<?php echo $user['city']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-address" class="col-md-12">Address</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-address" value="<?php echo $user['address']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-email" class="col-md-12">E-Mail</label>
                                                        <div class="col-md-12">
                                                            <input type="email" class="form-control input-default" id="company-email" value="<?php echo $user['email']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-description" class="col-md-12">Descriere</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" id="company-description" rows="5" cols="7"><?php echo $user['description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">Editeaza</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- End PAge Content -->
                </div>
                <!-- End Container fluid  -->
                <!-- footer -->
                <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>

        <div class="modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="changePassModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <form action="javascript:;" novalidate="novalidate">
                        <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div class="form-group">
                                    <label for="oldPass">
                                        old Password
                                    </label>
                                    <input type="password"  data-val="true" data-val-required="this is Required Field" class="form-control" name="oldPass" id="oldPass"/>
                                    <span class="field-validation-valid text-danger" data-valmsg-for="oldPass" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newPass">
                                        New Password
                                    </label>
                                    <input type="password" data-val="true" data-val-required="this is Required Field" class="form-control" name="newPass" id="newPass"/>
                                    <span class="field-validation-valid text-danger"  data-valmsg-for="newPass" data-valmsg-replace="true"></span>

                                </div>
                                <div class="form-group">
                                    <label for="confirmPass">
                                        Confirm Password
                                    </label>
                                    <input type="password" data-val-equalto="Password not Match ", data-val-equalto-other="newPass" data-val="true" data-val-required="this is Required Field" class="form-control" name="confirmPass" id="confirmPass"/>
                                    <span class="field-validation-valid text-danger" data-valmsg-for="confirmPass" data-valmsg-replace="true"></span>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
              </div>
            </div>
          </div>

        <!-- End Wrapper -->
        <?php $this->view('admin/includes/footer'); ?>
        <script src="<?php echo assets_js_url(); ?>lib/dropzone/dropzone.js"></script>
        <script>
          $(function(){
            $("html").niceScroll({
                cursorcolor:"#16385d",
                cursorwidth:"5px",
                background:"#fff",
                cursorborder:"1px solid #5c4ac7",
                cursorborderradius:0
                });  // a world f
          });
        </script>
    </body>

</html>