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

            <div class="unix-login">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="login-content card">
                                <div class="login-form">
                                    <h4>Register</h4>
                                    <?php $formAttr = array('class' => 'form-signin');
                                        echo form_open('/main/register', $formAttr); ?>
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <?php echo form_input(array(
                                                    'id'=> 'username2',
                                                    'placeholder'=>'Username',
                                                    'class'=>'form-control',
                                                    'value' => set_value('username'))); ?>
                                            <?php echo form_error('username');?>
                                        </div>
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <?php echo form_input(array(
                                                'id'=> 'email',
                                                'placeholder'=>'Email',
                                                'class'=>'form-control',
                                                'value' => set_value('email'))); ?>
                                            <?php echo form_error('email');?>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <?php echo form_password(array(
                                                'id'=> 'password',
                                                'placeholder'=>'Password',
                                                'class'=>'form-control',
                                                'value' => set_value('password'))); ?>
                                            <?php echo form_error('password');?>
                                        </div>
                                    <?php echo form_submit(array('value'=>'Register', 'class'=>'btn btn-success btn-flat m-b-30 m-t-30')); ?>
                                        <div class="register-link m-t-15 text-center">
                                            <p>Already have account ? <a href="<?php echo site_url(); ?>admin/login"> Sign in</a></p>
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