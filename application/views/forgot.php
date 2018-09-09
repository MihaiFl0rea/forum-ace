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
                    <h2>Recuperare parola</h2>
                    <p>V-ati uitat parola?<br>
                        Introduceti adresa de email si va vom trimite instructiunile pentru resetarea parolei</p>
                    <?php $fattr = array('class' => 'form-signin');
                    echo form_open(base_url().'forgot', $fattr); ?>
                    <div class="form-group">
                        <?php echo form_input(array(
                            'name'=>'email',
                            'id'=> 'email',
                            'placeholder'=>'Email',
                            'class'=>'form-control',
                            'value'=> set_value('email'))); ?>
                        <?php echo form_error('email') ?>
                    </div>
                    <?php echo form_submit(array('value'=>'Trimite', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
