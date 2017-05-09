<?php
	defined('BASEPATH') or die('Tidak dapat diakses langsung');

/**
*
*/
class Register extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->library('routines');
	}

	function index(){
		$this->template->render('register_view','register_view');
	}

	function test(){
		// $check = $this->routines->verifyHash('ope', '$2y$11$540c60dcc03eda100c610OIPmb1xAz2KuJ5KxGgACiNahp0ZDb4cK');
		$result = $this->routines->hashString('ope');
		echo $result."<br/>";
		echo md5(md5(strrev('ope').private_key));
	}
}
