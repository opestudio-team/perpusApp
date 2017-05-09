<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{

  function __construct(){
    parent::__construct();      
  }

  function verify(){
    $token = rawurldecode($this->input->get('t',TRUE)); 
    $token = str_replace(" ", "+", $token);
    if(isset($token)){
        $cekToken = $this->routines->cekToken($token);
    }
  }
}
?>