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
                    <h2>Resetarea parolei</h2>
                    <h5>Buna <span><?php echo $firstName; ?></span>,
                        <br>Te rugam sa introduci noua parola</h5>
                    <?php
                    $fattr = array('class' => 'form-signin');
                    echo form_open(site_url().'reset_password/token/'.$token, $fattr); ?>
                    <div class="form-group">
                        <?php echo form_password(
                            array(
                                'name'=>'password',
                                'id'=> 'password',
                                'placeholder'=>'Parola',
                                'class'=>'form-control',
                                'value' => set_value('password')
                            )); ?>
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
                            )); ?>
                        <?php echo form_error('passconf') ?>
                    </div>
                    <?php echo form_submit(array('value'=>'Reset!', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
