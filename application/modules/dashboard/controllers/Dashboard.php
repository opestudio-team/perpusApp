<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public $template_conf = array();

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();		
	}

	function index(){
		$template = new Template();

		$this->template_conf = array(
			'title' => 'Dashboard Template',
			'breadcrumb' => true
		);

    	$template->config($this->template_conf);
		$template->render('dashboard_view');
	}

}
