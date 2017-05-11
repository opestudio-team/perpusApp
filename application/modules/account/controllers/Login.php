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

	function index(){
		$this->template->render('login_view','login_view');
	}

	function do_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$check = $this->rousecurity->checkLogin('opeganteng','ope');

		$result_check = json_decode($check, TRUE);
		$result_code = $result_check['result_code'];
		$result_msg = $result_check['result_msg'];

		if ($result_code == 0) {
			$data_session = array(
				// 'id_user_'.project => $id_user,
				'is_login_'.project => TRUE,
				'jam_login_'.project => date("Y-m-d H:i"),
				'token_'.project => md5(strrev($username).private_key)
			);
			// redirect('dashboard','refresh');
		} else {

		}
		echo $check;
	}
}
