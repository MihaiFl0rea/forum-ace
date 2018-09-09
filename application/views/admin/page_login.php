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
            <?php $this->view('admin/includes/warnings'); ?>
            <div class="unix-login">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="login-content card">
                                <div class="login-form">
                                    <h4>Logare</h4>
                                    <?php $fattr = array('class' => 'form-signin');
                                    echo form_open(site_url().'admin/login', $fattr); ?>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <?php echo form_input(array(
                                                'name'=>'email',
                                                'id'=> 'email',
                                                'placeholder'=>'Email',
                                                'class'=>'form-control',
                                                'value'=> set_value('email'))); ?>
                                            <?php echo form_error('email') ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Parola</label>
                                            <?php echo form_password(array(
                                                'name'=>'password',
                                                'id'=> 'password',
                                                'placeholder'=>'Password',
                                                'class'=>'form-control',
                                                'value'=> set_value('password'))); ?>
                                            <?php echo form_error('password') ?>
                                        </div>
                                        <div class="checkbox">
                                            <label class="pull-right">
                                                <a href="<?php echo site_url();?>admin/forgot">Ati uitat parola?</a>
                                            </label>
                                        </div>
                                    <?php echo form_submit(array('value'=>'Logare', 'class'=>'btn btn-primary btn-flat m-b-30 m-t-30')); ?>
                                        <div class="register-link m-t-15 text-center">
                                            <p>Nu aveti cont? <a href="<?php echo site_url();?>admin/register"> Inregistrare aici</a></p>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Wrapper -->

        <?php $this->view('admin/includes/footer'); ?>
    </body>

</html>