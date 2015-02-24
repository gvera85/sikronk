<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funciones {

public function generateRedirectURL()
{
$CI = &get_instance();
$preURL = parse_url($_SERVER['REQUEST_URI']);
$redirectUrl = array('redirectUrl' => 'http://' . $_SERVER['SERVER_NAME'] . $preURL['path']);
$CI->session->set_userdata($redirectUrl);
}

}