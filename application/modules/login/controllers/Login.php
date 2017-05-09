<?php
	defined('BASEPATH') or die('Tidak dapat diakses langsung');

/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

	function index()
	{
		$this->template->load(NULL,'login_view');
	}
}