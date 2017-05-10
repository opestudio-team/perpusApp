<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Get extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $id_file = $this->input->get('img');

    # check file extension
    if (empty($id_file)) {
      redirect('access/notfound');
    } else {
      if (preg_match('/\.jpg|.jpeg+$/', $id_file)) {
        $file = '../img/'.basename($id_file);
        $check = getimagesize($file);
        if ($check) {
          Header('Content-Type: image/gif');
          readfile($file);
        } else {
          redirect('access/notfound');
        }
      } else {
        redirect('access/notfound');
      }
    }
  }

}
