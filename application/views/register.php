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
                    <h2>Creare cont</h2>
                    <?php
                    $formAttr = array('class' => 'form-signin');
                    echo form_open(base_url() . 'register', $formAttr); ?>
                    <div class="form-group">
                        <?php echo form_input(
                            array(
                                'name'=>'lastname',
                                'id'=> 'lastname',
                                'placeholder'=>'Nume',
                                'class'=>'form-control',
                                'value'=> set_value('lastname')
                            )); ?>
                        <?php echo form_error('lastname');?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input(
                            array(
                                'name'=>'firstname',
                                'id'=> 'firstname',
                                'placeholder'=>'Prenume',
                                'class'=>'form-control',
                                'value' => set_value('firstname')
                            )); ?>
                        <?php echo form_error('firstname');?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input(
                            array(
                                'name'=>'email',
                                'id'=> 'email',
                                'placeholder'=>'Email',
                                'class'=>'form-control',
                                'value'=> set_value('email')
                            )); ?>
                        <?php echo form_error('email');?>
                    </div>
                    <?php echo form_submit(array('value'=>'Inregistrare', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
