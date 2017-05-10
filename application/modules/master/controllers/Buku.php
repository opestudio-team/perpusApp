<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   *
   */
  class Buku extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    public function index(){
      $this->template->set(array(
        'title' => 'Master Buku',
        'tes' => 'tes lagi'
      )); 
      // $this->template->main('template/template');
  		$this->template->render('master_buku_view');
    }
  }
