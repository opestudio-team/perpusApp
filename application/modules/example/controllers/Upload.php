<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

  function index(){
    $this->template->set(array(
      'title' => 'Example: Image upload with secuity checking',
    ));
    $this->template->render('upload_view');
  }

  function process(){
    #Untuk menggunakan library 'Upload' jangan di Autoload dari config, harus di-load dari controller
  	// $nama_web = $this->input->post('namaWeb');

  	$config['upload_path']      = './assets/img/'; #path folder dimana image akan disimpan
    $config['allowed_types']    = 'gif|jpg|png'; #type image yang diijinkan
    $config['max_size']         = '2048000'; #max size image yang diijinkan
    $config['max_width']        = '2500'; #max width dalam pixel (px)
    $config['max_height']       = '1600'; #max height dalam pixel (px)
    $config['overwrite']        = TRUE;
    $config['file_name']        = "bg_img";
    $this->load->library('upload', $config); #Load the upload CI library

    print_r($this->upload->data());
  }
}
