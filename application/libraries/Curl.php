<?php if(defined('BASEPATH')) or die('Tidak bisa diakses langsung');

/**
 * Go to your php.ini file and remove the ; mark from the beginning of the following line:
 * ;extension=php_curl.dll
 */
class Curl
{

  /*
    $data harus dalam format associative array
    ie: $data = array(
          'nama' => 'Ope',
          'alamat' => 'Sampang'
        );
  */
  function post($data,$url){

    $dataArr = '';
    foreach ($data as $key => $value) {
      $dataArr .= $key.'='.$value.'&';
    }
    rtrim($dataArr,'&');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => 'cURL Opestudio',
      CURLOPT_POST => TRUE,
      CURLOPT_POSTFIELDS => $dataArr,
      CURLOPT_HEADER => FALSE
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl) != 0) {
      return 'Something error';
    } else {
      return $response;
    }

    curl_close($curl);
  }
}
