<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/20/2018
 * Time: 4:24 PM
 */
?>
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
                                    <h2>Aproape gata!</h2>
                                    <p>Buna ziua,
                                        <br>Reprezentant al companiei <strong><?php echo $name; ?></strong>
                                        <br>(Email: <span><?php echo $email;?></span>)
                                    </p>
                                    <small>Va rugam sa introduceti parola contului dvs.</small>
                                    <?php $formAttr = array('class' => 'form-signin');
                                    echo form_open('admin/complete/token/'.$token, $formAttr); ?>
                                    <div class="form-group">
                                        <?php echo form_password(
                                            array(
                                                'name'=>'password',
                                                'id'=> 'password',
                                                'placeholder'=>'Parola',
                                                'class'=>'form-control',
                                                'value' => set_value('password')
                                            )
                                        ); ?>
                                        <?php echo form_error('password') ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_password(
                                            array(
                                                'name'=>'passconf',
                                                'id'=> 'passconf',
                                                'placeholder'=>'Confirmare Parola',
                                                'class'=>'form-control',
                                                'value'=> set_value('passconf')
                                            )
                                        ); ?>
                                        <?php echo form_error('passconf') ?>
                                    </div>
                                    <?php echo form_hidden('user_id', $user_id);?>
                                    <?php echo form_submit(array('value'=>'Incheie inregistrarea', 'class'=>'btn btn-success btn-flat m-b-30 m-t-30')); ?>
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