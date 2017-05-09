<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller{

  function __construct(){
    parent::__construct();     
    $this->ci =& get_instance();
  }

  function index(){ 
    $this->load->view('template');
  }
  
}
?>