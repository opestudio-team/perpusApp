<?php
  if (!defined('BASEPATH')) exit('Tidak bisa diakses langsung');

  /** Password hash library
   * version: 0.1
   */
  class Password
  {

    protected $salt = '$2y$11$';

    function generate($password, $debug = FALSE){
      if (!empty($password)) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
          $start_time = microtime(true);
          $salt_pass  = $this->salt . substr(md5(uniqid(rand(), true).uniqid(rand(), true)), 0, 22);
          $password   = md5(strrev($password.private_key));
          $crypt      = crypt($password, $salt_pass);
          $end_time   = microtime(true);

          if ($debug) {
            $time = $end_time - $start_time;
            return $time;
          }
          return $crypt;
        }
      }
    }

    function verify($password, $hash){
      if (!empty($password) && !empty($hash)) {
        $password = md5(strrev($password.private_key));
        if(crypt($password, $hash) == $hash){
          $rescode = 0;
          $resmsg = 'Password cocok';
        } else {
          $rescode = 1;
          $resmsg = 'Password tidak cocok!';
        }
        return json_encode(
          array(
            'result_code'=>$rescode,
            'result_msg'=>$resmsg,
            )
          );
      }
    }
  }

?>
