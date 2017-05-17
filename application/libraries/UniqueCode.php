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
    $numb = '0000';

    // cek last id kode
    $query = "SELECT MAX(last_id) AS id, id_code FROM tb_uniq_code WHERE code_name='$str'";
    $cek = $this->CI->dbm->query($query);
    $result = json_decode($cek, TRUE);
    $id = $result['data'][0]['id'];
    $code = $result['data'][0]['id_code'];

    // update last id
    $this->CI->dbm->set_table('tb_last_kode');
    $data_update = array(
      'last_id' => $id+1
    );

    $update = $this->CI->dbm->update($data_update);
    $result = json_decode($cek, TRUE);
    $result_code = $result['result_code'];

    if ($result_code == 0) {
      return $product_code . substr($numb,0,-strlen($id)) . $id;
    }

  }
}
