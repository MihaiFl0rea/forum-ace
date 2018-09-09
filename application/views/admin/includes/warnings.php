<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/17/2018
 * Time: 4:59 PM
 */
$warnings = $this->session->flashdata('warning_messages');
if (!empty($warnings)):
?>

<!-- Container fluid  -->
<!--<div class="container-fluid">-->
    <!-- Start Page Content -->
    <!--<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-content">
                        <div class="alert alert-danger">
                            <?php /*foreach ($warnings as $warning){
                                echo $warning;
                            } */?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- End Page Content -->
<!--</div>-->
<!-- End Container fluid  -->
<?php endif; ?>


<?php
$flash_data = $this->session->flashdata();
if (!empty($flash_data['flash_message'])) {
    $html = '<div class="bg-warning container flash-message">';
    $html .= $flash_data['flash_message'];
    $html .= '</div>';
    echo $html;
}
?>
