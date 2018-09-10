<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/13/2018
 * Time: 6:09 AM
 */
$avatar  = !empty($this->session->userdata['logo']) ?
    assets_uploads_url() . $this->session->userdata['logo'] : assets_img_url() . 'favicon.png';
?>

<!-- header header  -->
<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() . 'admin'; ?>">
                <!-- Logo icon -->
                <b><img src="<?php echo assets_img_url(); ?>logoACE_text.png" alt="homepage" class="dark-logo" /></b>
                <!--End Logo icon -->
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
            <!-- toggle and nav items -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <li></li>
            </ul>
            <!-- User profile and search -->
            <ul class="navbar-nav my-lg-0">

                <!-- Search -->
                <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search here"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                </li>
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo $avatar; ?>" alt="user" class="profile-pic" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated slideInRight">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php echo $avatar; ?>" alt="user"></div>
                                    <div>
                                        <h4><?php
                                            $userSession = $this->session->userdata;
                                            echo $userSession['name'];
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <li><a href="<?php echo base_url() . 'admin/profilul-meu' ?>"><i class="ti-user"></i> Profilul meu</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- End header header -->
