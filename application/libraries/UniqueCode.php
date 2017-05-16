<?php
  if (!defined('BASEPATH')) exit('Tidak bisa diakses langsung');

/**
 *
 */
class Uniquecode
{

  function generate($str){
    $this->CI =& get_instance();

    $product_code = '';

    // cek last id kode
    $query = "SELECT MAX(last_id) AS id, id_code FROM tb_uniq_code WHERE code_name='$str'";
    $cek = $this->CI->dbm->query($query);
    $result = json_decode($cek, TRUE);
    $id = $result['data'][0]['id'];
    $code = $result['data'][0]['id_code'];

    $unique = $code.$code+1.'000'.$id+1;

  }
}
