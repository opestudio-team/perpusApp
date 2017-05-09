<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Rousecurity
{

    function connect() {
      $db = (array)get_instance()->db;
      return mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
    }

    function anti_injection($data){
      $filter = mysqli_real_escape_string($this->connect(), stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
      return $filter;
    }

    function check_character($username, $password){
    	if (!ctype_alnum($username) OR !ctype_alnum($password)){
        return 0;
      } else{
    	  return 1;
    	}
    }

    function checkLogin($username, $password){
      $this->ci =& get_instance();

      $username = $this->anti_injection($username);
      $password = $this->anti_injection($password);

      // md5 password
      $password_md5 = md5(md5(strrev($password).private_key));

      $where_field = array('nama_login','password');
      $field_data = array($username,$password_md5);

      $this->ci->dbm->select('nama_login,password_salt');
      $this->ci->dbm->set_table(db_prefix.'tb_m_user');
      $result = $this->ci->dbm->get_where($where_field, $field_data);

      $data = json_decode($result, TRUE);
      $result_code = $data['result_code'];

      if ($result_code == 0) {
        $password_salt = $data['data'][0]['password_salt'];
        $check_pass_salt = $this->ci->password->verify($password, $password_salt);

        $result_check = json_decode($check_pass_salt, TRUE);
        $result_code = $result_check['result_code'];
        $result_msg = $result_check['result_msg'];
        if ($result_code == 0) {
          $msg = "Password cocok!";
        } else {
          $msg = "Password salah!";
        }
      } else {
        $msg = "Username atau Password salah!";
      }
      return json_encode(
        array(
          'result_code' => $result_code,
          'result_msg' => $msg
        )
      );
    }

}
