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
		$result = $this->password->generate('ope');
		echo $result."<br/>";
		echo "MD5: ".md5(md5(strrev('ope').private_key));
	}

	function verify(){
		$check = $this->password->verify('ope', '$2y$11$a1e47046adb8f95f701beuydDs1WYmOWtnZpT2Eh4P1w.AdnWI2Vy');
		print_r($check);
	}
}
