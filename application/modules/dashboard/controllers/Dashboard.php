<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public $template_conf = array();

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

	function index(){
		$this->template_conf = array(
			'title' => 'Dashboard Template'
		);

    	$this->template->set($this->template_conf);
		$this->template->render('dashboard_view');
	}

}
