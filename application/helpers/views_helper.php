<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('view_loader')){

  function view_loader($view, $vars=array(), $output = false){
    $CI = &get_instance();
    return $CI->load->view($view, $vars, $output);
  }
}