<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/13/2018
 * Time: 6:12 AM
 */ ?>

<!-- Left Sidebar  -->
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-label"></li>
                <li>
                    <a href="<?php echo base_url(); ?>admin" aria-expanded="false">
                        <i class="fa fa-home"></i>
                        <span class="hide-menu">Acasa</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/companies" aria-expanded="false">
                        <i class="fa fa-tachometer"></i>
                        <span class="hide-menu">Companii IT</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/companii">Companii IT</a></li>
                        <li class="nav-devider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/companii/craiova">Companii IT Craiova</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/companii/bucuresti">Companii IT Bucuresti</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/companii/timisoara">Companii IT Timisoara</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/companii/sibiu">Companii IT Sibiu</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/studenti" aria-expanded="false">
                        <i class="fa fa-tachometer"></i>
                        <span class="hide-menu">Studenti UCV</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/studenti">Studenti UCV</a></li>
                        <li class="nav-devider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/studenti/ace">Studenti A.C.E.</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/studenti/mate-info">Studenti Mate-Info</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/studenti-activi">Top activitate</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/articole" aria-expanded="false">
                        <i class="fa fa-tachometer"></i>
                        <span class="hide-menu">Articole</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/articole">Articole</a></li>
                        <li class="nav-devider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/categorii-articole">Categorii articole</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/taguri-articole">Tag-uri articole</a></li>
                        <li class="nav-devider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/adaugare-articol">Adauga articol</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/top-articole" aria-expanded="false">
                        <i class="fa fa-tachometer"></i>
                        <span class="hide-menu">Top Articole</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/articole/programming">Programare</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/articole/testing">Testare</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/articole/mechanics">Mecanica & Electronica</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/articole/altele">Altele</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->
