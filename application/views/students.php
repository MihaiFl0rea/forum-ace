<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 9/13/2018
 * Time: 5:22 PM
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
                    <?php if ($template == 'top_students'): ?>
                        <?php if (!empty($students)): ?>
                    <h2 class="articles-header">Top studenti activi</h2>
                    <div class="row">
                        <!-- MAIN CONTENT -->
                        <?php $counter = 1; ?>
                        <?php foreach ($students as $id_student => $student): ?>
                            <div class="col-md-4">
                                <div class="testimonial-rating">
                                    <img src="<?php echo assets_uploads_url() . $student['avatar']; ?>" class="img-circle avatar" alt="avatar">
                                    <div class="text justify-block">
                                        <h3># <?php echo $counter; ?></h3>
                                        <strong class="name"><?php echo $student['name']; ?></strong>
                                        <h4 class="title"><?php echo strtoupper($student['faculty']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++;
                            endforeach; ?>
                        <!-- END MAIN CONTENT -->
                    </div>
                        <?php else: ?>
                            <p>Niciun student nu s-a inscris, pana acum.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php $this->view('includes/footer'); ?>
        </div>
        <!-- END WRAPPER -->
        <?php $this->view('includes/footer_js'); ?>
    </body>

</html>
