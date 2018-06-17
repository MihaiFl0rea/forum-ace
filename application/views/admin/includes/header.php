<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/6/2018
 * Time: 11:30 PM
 */
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets_img_url(); ?>img/favicon.png">
        <title>Ela - Bootstrap Admin Dashboard Template</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo assets_css_url(); ?>lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo assets_css_url(); ?>helper.css" rel="stylesheet">
        <link href="<?php echo assets_css_url(); ?>style.css" rel="stylesheet">
        <!-- Other CSS libraries -->
        <link href="<?php echo assets_css_url(); ?>lib/calendar2/semantic.ui.min.css" rel="stylesheet">
        <link href="<?php echo assets_css_url(); ?>lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
        <link href="<?php echo assets_css_url(); ?>lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="<?php echo assets_css_url(); ?>lib/owl.theme.default.min.css" rel="stylesheet" />
        <?php if (!empty($grocerycrud)): ?>
        <!-- Jeg er Mihai -->
        <link href="<?php echo assets_grocery_css_url(); ?>add-edit-form.css" rel="stylesheet" />
        <link href="<?php echo assets_grocery_css_url(); ?>common.css" rel="stylesheet" />
        <link href="<?php echo assets_grocery_css_url(); ?>general.css" rel="stylesheet" />
        <link href="<?php echo assets_grocery_css_url(); ?>list.css" rel="stylesheet" />
        <?php endif; ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
        <!--[if lt IE 9]>
        <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
