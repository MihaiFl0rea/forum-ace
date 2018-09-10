<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/22/2018
 * Time: 6:13 PM
 */
?>

<?php
$flash_data = $this->session->flashdata();
if (!empty($flash_data['flash_message'])) {
    $html = '<div class="bg-warning container flash-message">';
    $html .= $flash_data['flash_message'];
    $html .= '</div>';
    echo $html;
}
?>

<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top ">
    <div class="container">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <i class="fa fa-bars"></i>
        </button>
        <a href="<?php echo base_url() .'acasa'; ?>" class="navbar-brand no-padding">
            <img src="<?php echo assets_img_url(); ?>logoACE_text.png" alt="Facultatea de Automatica, Calculatoare si Electronica">
        </a>
        <div id="main-nav-collapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav main-navbar-nav">
                <li><a href="<?php echo base_url() . 'acasa'; ?>">Noutati</a></li>
                <li><a href="<?php echo base_url() . 'trending'; ?>">Trending!</a></li>
                <li><a href="<?php echo base_url() . 'companii'; ?>">Companii</a></li>
                <li><a href="<?php echo base_url() . 'studenti-activi'; ?>">Studenti activi!</a></li>
                <li><a href="<?php echo base_url() . 'profil'; ?>">Profilul meu</a></li>
                <li><a href="<?php echo base_url() . 'logout'; ?>"><span><i class="fa fa-sign-out"></i> Log out</span></a></li>
            </ul>
        </div>
        <!-- END MAIN NAVIGATION -->
    </div>
</nav>
<!-- END NAVBAR -->
