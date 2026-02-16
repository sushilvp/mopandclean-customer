<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration
|--------------------------------------------------------------------------
| Update these settings with your SMTP credentials.
| Common providers:
|   Gmail: smtp.gmail.com, port 587, tls
|   Outlook: smtp-mail.outlook.com, port 587, tls
|   Custom: your mail server details
|
*/

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'smtp.gmail.com';       // Change to your SMTP host
$config['smtp_port']   = 587;
$config['smtp_user']   = '';                       // Your email address
$config['smtp_pass']   = '';                       // Your app password
$config['smtp_crypto'] = 'tls';
$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";
$config['wordwrap']    = TRUE;
