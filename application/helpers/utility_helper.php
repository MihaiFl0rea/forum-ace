<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function assets_css_url()
{
    return base_url() . 'assets/css/';
}

function assets_css_froala_url()
{
    return base_url() . 'assets/css/froala_editor/';
}

function assets_js_url()
{
    return base_url() . 'assets/js/';
}

function assets_js_froala_url()
{
    return base_url() . 'assets/js/froala_editor/';
}

function assets_icons_url()
{
    return base_url() . 'assets/icons/';
}

function assets_img_url()
{
    return base_url() . 'assets/img/';
}

function assets_uploads_url()
{
    return base_url() . 'assets/uploads/avatars/';
}

function assets_uploads_absolute_path()
{
    return FCPATH . 'assets' . DIRECTORY_SEPARATOR .
        'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR;
}

function assets_uploads_files_url()
{
    return '/forum/assets/uploads/articles/';
}

function assets_files_absolute_path()
{
    return FCPATH . 'assets' . DIRECTORY_SEPARATOR .
        'uploads' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR;
}