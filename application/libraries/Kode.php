<?php
  if (!defined('BASEPATH')) exit('Tidak bisa diakses langsung');

/**
 *
 */
class Kode
{

  function generate($str){
    $this->CI =& get_instance();

    $product_code = '';
    $numb = '0000';
    $exp = explode(' ', $str);

    // cek last id kode
    $query = "SELECT MAX(last_id) AS id FROM tb_last_kode WHERE id_name='kode_produk'";
    $cek = $this->CI->dbm->query($query);
    $result = json_decode($cek, TRUE);
    $id = $result['data'][0]['id'];

    foreach ($exp as $key) {
      $product_code .= strtoupper(substr($key,0,1));
    }

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
