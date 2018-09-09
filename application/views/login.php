<!DOCTYPE html>
<html>
    <?php $this->view('includes/header'); ?>
    <body>
        <?php
        $flash_data = $this->session->flashdata();
        if (!empty($flash_data['flash_message'])) {
            $html = '<div class="bg-warning container flash-message">';
            $html .= $flash_data['flash_message'];
            $html .= '</div>';
            echo $html;
        }
        ?>
        <div class="container centered-block">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <h2>Forum A.C.E.</h2>
                    <?php $fattr = array('class' => 'form-signin');
                    echo form_open(site_url().'login', $fattr); ?>
                    <div class="form-group">
                        <?php echo form_input(array(
                            'name'=>'email',
                            'id'=> 'email',
                            'placeholder'=>'Email',
                            'class'=>'form-control',
                            'value'=> set_value('email'))); ?>
                        <?php echo form_error('email') ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_password(array(
                            'name'=>'password',
                            'id'=> 'password',
                            'placeholder'=>'Parola',
                            'class'=>'form-control',
                            'value'=> set_value('password'))); ?>
                        <?php echo form_error('password') ?>
                    </div>
                    <?php echo form_submit(array('value'=>'Log in!', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                    <?php echo form_close(); ?>
                    <h5>Ai uitat parola? Click <a href="<?php echo site_url();?>forgot">aici</a></h5>
                    <h5>Nu ai cont? <a href="<?php echo site_url();?>register">Inregistrare</a></h5>
                </div>
            </div>
        </div>
    </body>
</html>