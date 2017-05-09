<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller{

  function __construct(){
    parent::__construct();     
    $this->ci =& get_instance();
  }

  function index(){ 
    $this->downloadPage();
  }
  
  function downloadPage(){ 
    $key = $this->ci->uri->segment('2');
    $sql = "SELECT url_page FROM tb_link_download where url_page='$key'";
    $proses = $this->roudbmodel->openQueryJson($sql);
    $hasil = json_decode($proses, TRUE);
    $rescode = $hasil['result_code'];
    if($rescode == 4){
        if(isset($key)){
            $filename = $this->ci->routines->removeDash($key);
            $filename = $this->ci->routines->ucname($filename);
            $data['filename'] = $filename;
            $this->load->view('page/download_view',$data);
        } 
    } else {
        $this->load->view('page/download_error_view');
    }
    
  }
  function downRequest(){
    $emailTemplate = "Download";
    $email = $this->input->post('emailDownload'); 
    $name = $this->input->post('nama');
    $url = $this->input->post('url');
    
    $sql = "SELECT link_dl_file FROM tb_link_download where url_page='$url'";
    $proses = $this->roudbmodel->openQueryJson($sql);
    $hasil = json_decode($proses, TRUE);
    $rescode = $hasil['result_code'];
    $data = $hasil['data_openq'];
    
    if($rescode == 4){
        if(isset($email)){ 
            $sending = $this->routines->emailSend($email,$name,$emailTemplate,$data);
            $resSending = json_decode($sending,TRUE);
            $sendCode = $resSending['result_code'];

            if($sendCode == 3){
                $save = $this->saveDataDownload($email, $name);
                $hasil = json_decode($save, TRUE);
                $rescode = $hasil['result_code'];
                if($rescode == 4){
                    echo $sendCode;
                }            
            } else {
                echo $sendCode;
            }
        }
    }    
  }
  
  function saveDataDownload($email,$name){
    $tableName = "tb_data_user_dl";
    $keyValList = "email_user=>".$email.";nama_user=>".$name;
    $proses = $this->roudbmodel->insertData($tableName, $keyValList);
    $hasil = json_decode($proses,TRUE);
    $rescode = $hasil['result_code'];
    
    if($rescode == 4){
        $msg = "Simpan berhasil";
    } else {
        $msg = "Gagal menyimpan";
    }
    return json_encode(array('result_code'=>$rescode, 'result_msg'=>$msg));
  }
}
?>