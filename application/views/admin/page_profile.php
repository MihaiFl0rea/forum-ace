<!DOCTYPE html>
<html lang="en">

    <?php $this->view('admin/includes/header'); ?>

    <body class="fix-header fix-sidebar">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <?php $this->view('admin/includes/top_header'); ?>
            <?php $this->view('admin/includes/left_sidebar'); ?>
            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Dashboard</h3> </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- End Bread crumb -->
                <?php $this->view('admin/includes/warnings'); ?>
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-two">
                                        <header>
                                            <div class="avatar">
                                                <?php if (!empty($logo)): ?>
                                                <img src="<?php echo assets_img_url() . 'logos/' . $logo; ?>" title="<?php echo $name; ?>" />
                                                <?php else: ?>
                                                <img src="<?php echo assets_img_url() . 'logoACE.png'; ?>" title="<?php echo $name; ?>" />
                                                <?php endif; ?>
                                            </div>
                                        </header>

                                        <h3>Allison Walker</h3>
                                        <div class="desc">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.
                                        </div>
                                        <div class="contacts">
                                            <a href=""><i class="fa fa-plus"></i></a>
                                            <a href=""><i class="fa fa-whatsapp"></i></a>
                                            <a href=""><i class="fa fa-envelope"></i></a>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <?php if (!empty($no_company)): ?>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-title">
                                            <h3>Add your company</h3>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <h4 class="card-title">Your company's logo</h4>
                                            <form action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Your company's details</h4>
                                            <div class="basic-form">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="company-name" class="col-md-12">Name</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-name" placeholder="Company Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-city" class="col-md-12">City</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-city" placeholder="Company City">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-address" class="col-md-12">Address</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control input-default" id="company-address" placeholder="Company Address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-email" class="col-md-12">E-Mail</label>
                                                        <div class="col-md-12">
                                                            <input type="email" class="form-control input-default" id="company-email" placeholder="Company E-Mail">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-description" class="col-md-12">Description</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control input-default" id="company-description" rows="5" placeholder="Company Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <!-- Column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="card-body">
                                            <div class="profiletimeline">
                                                <div class="sl-item">
                                                    <div class="sl-left"> <img src="images/users/avatar-1.jpg" alt="user" class="img-circle" /> </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">Michael Qin</a> <span class="sl-date">5 minutes ago</span>
                                                            <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="images/big/img1.jpg" class="img-responsive radius" /></div>
                                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="images/big/img2.jpg" class="img-responsive radius" /></div>
                                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="images/big/img3.jpg" class="img-responsive radius" /></div>
                                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="images/big/img4.jpg" class="img-responsive radius" /></div>
                                                            </div>
                                                            <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left"> <img src="images/users/avatar-2.jpg" alt="user" class="img-circle" /> </div>
                                                    <div class="sl-right">
                                                        <div> <a href="#" class="link">Michael Qin</a> <span class="sl-date">5 minutes ago</span>
                                                            <div class="m-t-20 row">
                                                                <div class="col-md-3 col-xs-12"><img src="images/big/img1.jpg" alt="user" class="img-responsive radius" /></div>
                                                                <div class="col-md-9 col-xs-12">
                                                                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                                            </div>
                                                            <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left"> <img src="images/users/avatar-3.jpg" alt="user" class="img-circle" /> </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">Michael Qin</a> <span class="sl-date">5 minutes ago</span>
                                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                                                                Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                        </div>
                                                        <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left"> <img src="images/users/avatar-4.jpg" alt="user" class="img-circle" /> </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">Michael Qin</a> <span class="sl-date">5 minutes ago</span>
                                                            <blockquote class="m-t-10">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--second tab-->
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted">John Deo</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                    <br>
                                                    <p class="text-muted">(123) 456 7890</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted">Zebra Theme@gmail.com</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                    <br>
                                                    <p class="text-muted">London</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                                                it to make a type specimen book. It has survived not only five centuries </p>
                                            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </p>
                                            <h4 class="font-medium m-t-30">Skill Set</h4>
                                            <hr>
                                            <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="settings" role="tabpanel">
                                        <div class="card-body">
                                            <form class="form-horizontal form-material">
                                                <div class="form-group">
                                                    <label class="col-md-12">Full Name</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="John Doe" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-email" class="col-md-12">Email</label>
                                                    <div class="col-md-12">
                                                        <input type="email" placeholder="Zebra Theme@gmail.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Password</label>
                                                    <div class="col-md-12">
                                                        <input type="password" value="password" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Phone No</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Message</label>
                                                    <div class="col-md-12">
                                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-12">Select Country</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control form-control-line">
                                                                                        <option>London</option>
                                                                                        <option>India</option>
                                                                                        <option>Usa</option>
                                                                                        <option>Canada</option>
                                                                                        <option>Thailand</option>
                                                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-success">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <?php endif; ?>
                    </div>

                    <!-- End PAge Content -->
                </div>
                <!-- End Container fluid  -->
                <!-- footer -->
                <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>

        <div class="modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="changePassModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <form action="javascript:;" novalidate="novalidate">
                        <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div class="form-group">
                                    <label for="oldPass">
                                        old Password
                                    </label>
                                    <input type="password"  data-val="true" data-val-required="this is Required Field" class="form-control" name="oldPass" id="oldPass"/>
                                    <span class="field-validation-valid text-danger" data-valmsg-for="oldPass" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newPass">
                                        New Password
                                    </label>
                                    <input type="password" data-val="true" data-val-required="this is Required Field" class="form-control" name="newPass" id="newPass"/>
                                    <span class="field-validation-valid text-danger"  data-valmsg-for="newPass" data-valmsg-replace="true"></span>

                                </div>
                                <div class="form-group">
                                    <label for="confirmPass">
                                        Confirm Password
                                    </label>
                                    <input type="password" data-val-equalto="Password not Match ", data-val-equalto-other="newPass" data-val="true" data-val-required="this is Required Field" class="form-control" name="confirmPass" id="confirmPass"/>
                                    <span class="field-validation-valid text-danger" data-valmsg-for="confirmPass" data-valmsg-replace="true"></span>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
              </div>
            </div>
          </div>

        <!-- End Wrapper -->
        <?php $this->view('admin/includes/footer'); ?>
        <script src="<?php echo assets_js_url(); ?>lib/dropzone/dropzone.js"></script>
        <script>
          $(function(){
            $("html").niceScroll({
                cursorcolor:"#16385d",
                cursorwidth:"5px",
                background:"#fff",
                cursorborder:"1px solid #5c4ac7",
                cursorborderradius:0
                });  // a world f
          });
        </script>
    </body>

</html>