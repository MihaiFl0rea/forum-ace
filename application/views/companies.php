<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 9/9/2018
 * Time: 8:25 PM
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
                    <div class="row">
                        <!-- PAGE CONTENT -->
                        <div class="col-md-12">
                            <h2 class="section-heading">Companii colaboratoare</h2>
                            <h5>Cele mai mari companii de IT din Craiova si nu numai isi doresc sa colaboreze cu studentii Universitatii din Craiova.</h5>
                            <h5 class="margin-bottom-30">Un prim pas il constituie prezentarea articolelor / anunturilor de mare interes prezente in acest forum.</h5>
                        </div>
                        <?php if (!empty($companies)): ?>
                            <div class="row">
                                <?php foreach ($companies as $company): ?>
                                    <div class="col-sm-6">
                                        <div class="team-member">
                                            <a href="<?php echo base_url() . 'articole-companie/' . $company['id_company']; ?>">
                                                <img src="<?php echo assets_uploads_url() . $company['logo']; ?>" class="img-responsive img-centered fixed-height-210" alt="<?php echo $company['name']; ?>">
                                            </a>
                                            <div class="member-info">
                                                <h3 class="name"><?php echo $company['name']; ?></h3>
                                                <span class="title"><?php echo $company['city']; ?></span>
                                                <p class="short-bio"><?php echo $company['description']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!-- END PAGE CONTENT -->
                    </div>
                </div>
            </div>
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>
