<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpMailerLib 
{
	public function load()
    {
        require_once(APPPATH."third_party/phpmailer/PHPMailer.php");
        $objMail = new \PHPMailer\PHPMailer\PHPMailer;
        return $objMail;
    }
}

