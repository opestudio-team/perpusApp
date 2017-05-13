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
      redirect('error/notfound');
    } else {
      if (preg_match('/\.jpg|.jpeg+$/', $id_file)) {
        $file = '../img/'.basename($id_file);
        @$exif = exif_read_data($file, 0, true);
        $image_status = '';
        $image_data = json_encode($exif);
        $check = getimagesize($file);

        if ($check) {
          /* check exif data */
          foreach ($exif as $key => $section) {
            foreach ($section as $name => $val) {
              if (strtolower($name) == 'documentname') {
                $image_status = "scripted image";
              } else {
                if ($image_data == '' || $image_data == NULL) {
                  $image_status = "scripted image";
                } else {
                  $image_status = "pure image";
                }
              }
            }
          }
          if ($image_status == 'pure image') {
            Header('Content-Type: image/gif');
            readfile($file);
          } else {
            redirect('error/notfound');
          }
        } else {
          redirect('error/notfound');
        }
      } else {
        redirect('error/notfound');
      }
    }
  }

}
