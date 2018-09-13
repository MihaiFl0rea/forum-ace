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
                        <i class="fa fa-users"></i>
                        <span class="hide-menu">Companii IT</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/companii">Companii IT</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/studenti" aria-expanded="false">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="hide-menu">Studenti UCV</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/studenti">Studenti UCV</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/categorii-articole" aria-expanded="false">
                        <i class="fa fa-exchange"></i>
                        <span class="hide-menu">Categorii articole</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/categorii-articole">Categorii</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/taguri-articole" aria-expanded="false">
                        <i class="fa fa-hashtag"></i>
                        <span class="hide-menu">Tag-uri articole</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/taguri-articole">Tag-uri</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="<?php echo base_url(); ?>admin/articole" aria-expanded="false">
                        <i class="fa fa-sticky-note-o"></i>
                        <span class="hide-menu">Articole</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>admin/articole">Articole</a></li>
                        <li class="nav-devider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/adaugare-articol">Adauga articol</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->
