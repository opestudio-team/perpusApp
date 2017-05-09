<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Hash extends CI_Controller{

    function __construct(){
      parent::__construct();      
    }
  
    function index(){
        $data['page_name'] = "Hash Password";
        $this->load->view('page/hash_view',$data);
    }
    
    function hashStart(){
        $str = $this->input->post('str');        
        $hash = $this->routines->hashString($str);
        echo $hash;
    }
}