<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Routinesdb
{

    function __construct(){ 
        $this->ci =& get_instance();
        $this->ci->load->model('roudbmodel');
        #deklarasi variable json
        $rescode = 0;
        $resmsg = "";
    }

    function conn() {
        $db = (array)get_instance()->db;
        return mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
    }

    function anti_injection($data){
        $filter = mysqli_real_escape_string($this->conn(), stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
        return $filter;
    }

    function CekLogin($username, $userpassword){ 
        $username = $this->anti_injection($username);
        $userpassword = $this->anti_injection($userpassword);
        
        $sql = "SELECT username,pass_web FROM tb_user WHERE username='$username'";
        $cek = $this->roudbmodel->openQueryJson($sql);
        $hasil = json_decode($cek,TRUE);
        $rescode = $hasil['result_code'];
        $passcek = $hasil['data_openq']['pass_web'];
        
        if($rescode == 4){
            $verifyPass = $this->routines->verifyHash($userpassword, $passcek);
            $result = json_decode($verifyPass,TRUE);
            $rescode = $result['result_code'];
            if($rescode == 1){
                #password match
                $rescode = 400;
                $msg = 'Password cocok';
            } else {
                $rescode = 401;
                #password not match
                $msg = 'Password salah!';
            }
        } else {
            $rescode = 404;
            $msg = 'Username tidak ditemukan!';
        }
        return json_encode(array(
                'result_code'=>$rescode,
                'result_msg'=>$msg,
                'username'=>$username
        ));
    }

}
