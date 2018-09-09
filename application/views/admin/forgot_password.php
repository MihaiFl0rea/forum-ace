<?php $this->view('admin/header'); ?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box forgot-password">
					<div class="content">
						<div class="header">
							<div class="logo text-center"><img src="<?php echo assets_img_url(); ?>logo.png" alt="DiffDash"></div>
							<p class="lead">Recover my password</p>
						</div>
						<p class="text-center margin-bottom-30">Please enter your email address below to receive instructions for resetting password.</p>
                        <?php $formAttr = array('class' => 'form-auth-small');
                            echo form_open(site_url().'main/forgot/', $formAttr); ?>
							<!--<div class="form-group">
								<label for="signup-password" class="control-label sr-only">Password</label>
								<input type="password" class="form-control" id="signup-password" placeholder="Password">
							</div>-->
                            <div class="form-group">
                                <label for="signup-password" class="control-label sr-only">Email</label>
                                <?php echo form_input(array(
                                    'id'=> 'signup-password',
                                    'placeholder'=>'Email',
                                    'class'=>'form-control',
                                    'value'=> set_value('email'))); ?>
                                <?php echo form_error('email') ?>
                            </div>
                        <?php echo form_submit(array('value'=>'Reset Password', 'class'=>'btn btn-primary btn-lg btn-block')); ?>
							<div class="bottom">
								<span class="helper-text">Know your password? <a href="page-login.html">Login</a></span>
							</div>
                        <?php echo form_close(); ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<?php $this->view('admin/footer'); ?>