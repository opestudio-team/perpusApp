<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

	function index(){
    $this->template->set('title','Dashboard Template');
		$this->template->render('dashboard_view');
	}

}
