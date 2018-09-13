<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 9/13/2018
 * Time: 9:22 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

    <?php $this->view('includes/header'); ?>

    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <?php $this->view('includes/menu'); ?>
            <div class="page-content">
                <div class="container">
                    <h4>Actualizarea profilului</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="contact-form" class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="last_name" class="control-label">Nume</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['front_last_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="first_name" class="control-label">Prenume</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['front_first_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Facultate</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['front_email']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="faculty" class="control-label">Facultate</label>
                                        <select name="faculty" id="faculty" class="form-control">
                                            <option value="ace"<?php echo $user['front_faculty'] == 'ace' ? ' selected' : ''; ?>>A.C.E.</option>
                                            <option value="mate-info"<?php echo $user['front_faculty'] == 'mate-info' ? ' selected' : ''; ?>>Mate-Info</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <img src="<?php echo assets_uploads_url() . $user['front_avatar']; ?>" class="img-responsive" style="width: 30%;"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="submit-button" type="button" class="btn btn-primary"><i class="fa loading-icon"></i> <span>Actualizeaza</span></button>
                                    </div>
                                </div>
                                <input type="hidden" name="msg-submitted" id="msg-submitted" value="true">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>
