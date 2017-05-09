<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller{

    function __construct(){
        parent::__construct();      
    }

    function index(){ 
        $this->load->view('login_view');
    }

    function doLogin(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cekLogin = $this->routinesdb->cekLogin($username,$password);
        $result = json_decode($cekLogin,TRUE);
        $rescode = $result['result_code'];
        $usrname = $hasil['username'];
        $now = date("Y-m-d H:i");

        if($rescode == 400){
            #login sukses
            $code = 1;
            $datases = array(
                        'isLogin_'.project => TRUE,
                        'username_'.project => $usrname,
                        'loginTime_'.project => $now
            );
            $this->session->set_userdata($datases);
            echo $code;
        } else if($rescode == 401){
            #password salah
            $code = 2;
        } else {
            #username tidak ditemukan
            $code = 3;
        }
    }
  
    function logout(){
	$this->session->sess_destroy(); 
	$data = array(
	    	'isLogin_'.project.'' => FALSE);
	$this->session->set_userdata($data);	    
	redirect('access');    
    }
}
?>