<?php
	defined('BASEPATH') or die('Tidak dapat diakses langsung');

/**
* 
*/
class Crud extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		$this->template->load(NULL,'generator_crud_view');
	}
}