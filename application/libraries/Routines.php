<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Routines
{

    function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('Roudbmodel');
        // $this->ci->load->library('MyPHPMailer');
    }

    public function cekAuth(){
      /* Mengecek login session*/
      $sesi = $this->ci->session->userdata('isLogin_'.project.'');
      $key = $this->ci->uri->segment('1');

      if ($sesi == TRUE) {
        // redirect('dashboard/home');
        exit();
      } else if($sesi == FALSE) {
        redirect('access');
      }
    }

    function dataEncrypt($data){
        //Get Constant of Key
        $key = key;
            //encrypt process
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
        $ciphertext = $iv . $ciphertext;

        # encode the resulting cipher text so it can be represented by a string
        return base64_encode($ciphertext);

    }

    function dataDecrypt($data){
        //get the Constants Key
        $key = key;
        //Decrypt Process
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $ciphertext_dec = base64_decode("$data");
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        # retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
        # may remove 00h valued characters from end of plain text
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
    }

    function getToken($jnsToken, $expHour = 6, $strParam=""){

        # Get Constant of Project and Key
        $project = project;
        # set default timezone to Jakarta
        date_default_timezone_set("Asia/Jakarta");
        # add Expired Hour From Now()
        $expdatetime = date("Y-m-d H:i", strtotime(sprintf("+%d hours", $expHour)));
        $data = $jnsToken."_".$project."_".$expdatetime."_".$strParam;
        # encode the for get token
        $token = $this->dataEncrypt($data);
        return $token;
    }

    function decToken($token){
        # decrypt data token
        $token_dec = $this->dataDecrypt($token);
        return  $token_dec;
    }

    function cekToken($token) {
        $project = project;

        if (strlen($token)==88 || strlen($token)==108) {
                $flag = 0;
                $msg = "";
                $resmsg = "";

                $dataToken = $this->decToken($token);

                #cek decrypt token valid atau tidak
                $cekValid = $this->validToken($dataToken);
                $hasilCek = json_decode($cekValid,TRUE);
                $codeHasil = $hasilCek['result_code'];
                $msgHasil = $hasilCek['result_msg'];

                if ($codeHasil != 1) {
                    # valid token
                    $arrToken = explode("_",$dataToken);
                    # cek data array kosong atau tidak
                    if (!isset($arrToken[0])) {
                        $nama_login = "";
                    } else {
                        $nama_login = $arrToken[0];
                    }
                    if (!isset($arrToken[1])) {
                        $projectID = "";
                    } else {
                        $projectID = $arrToken[1];
                    }
                    if (!isset($arrToken[2])) {
                        $tglExp = "";
                    } else {
                        $tglExp = $arrToken[2];
                    }
                    if (!isset($arrToken[3])) {
                        $strParam = "";
                    } else {
                        $strParam = $arrToken[3];
                    }

                    # cek bukan karakter. ex: tanda titik dua ":", Spasi, tanda "-"
                    if (preg_match("/\W/", $nama_login)) {
                        $nama_login = "";
                    }
                    if (preg_match("/\W/", $projectID)) {
                        $projectID = "";
                    }
                    # cek format tanggal: Y-m-d H:i / ex: 2016-12-12 13:19
                    if (preg_match("/(19|20)\d\d([-])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])\s([0-1][0-9]|[2][0-3]):([0-5][0-9])$/", $arrToken[2])) {
                        $tglExp = $arrToken[2];
                    } else if (preg_match('/[A-Za-z]/', $arrToken[2])) {
                        $tglExp = "";
                    }

                    # check for project id
                    if ($flag == 0){
                        if ($projectID != $project){
                            $flag = 5;
                            $msg = "Data Project tidak ditemukan.";
                        }
                    }

                    # check for token's expired date
                    if($flag == 0){
                        //set default timezone to Jakarta
                        date_default_timezone_set("Asia/Jakarta");
                        $now = date("Y-m-d H:i");
                        if ($now >= $tglExp){
                            $flag = 6;
                            $msg = "Token telah kadaluarsa.";
                        }
                    }

                    $rescode = $flag;
                    $resmsg = $msg;
                    $resLogin = $nama_login;
                    return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg));
                } else {
                    # invalid token
                    $rescode = 7;
                    $resmsg = "Token invalid. Pastikan klik langsung link pada email";
                    $resLogin = "";
                    $strParam = "";
                    return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg));
                }
        } else {
                $rescode = 7;
                $resmsg = "Token invalid. Pastikan klik langsung link pada email";
                $resLogin = "";
                $strParam = "";
                return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg));
        }
    }

    function validToken($data){
        # cek string setelah decrypt token. string hanya boleh mengandung karakter dalam ASCII Table
        $data = trim($data);
        if(preg_match_all('/[^\x20-\x7f]/im', $data)) {
            # invalid token
            $rescode = 1;
            $resmsg = "Token invalid. Pastikan klik langsung link pada email";
            return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg));
        } else {
            $rescode = 2;
            $resmsg = "valid";
            return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg));
        }
    }

    function emailSend($usrEmail,$username,$emailTemplate,$url="",$token=""){
        /*	fungsi mengirim email setelah melalui proses token
        *	$usrEmail -> email tujuan dari inputan pengguna
        *	$token -> token
        */
        # set default timezone to Jakarta
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i");
        $notifcode = 0;
        $url = base_url();

        $fromEmail = "hello.ope21@gmail.com";
        if (strtolower($emailTemplate) == "download") {
                $isiEmail = "Link download anda adalah: ";
                $emailSubject = "Link Download Source Code";
        } else if(strtolower($emailTemplate) == "email"){
                $isiEmail = "<b>Change Password Request</b><br>
                            Silahkan klik link berikut ini untuk mengubah password<br>
                            ".$url."email/confirmation?t=".$token."<br>";
                $emailSubject = "Change Password";
        }

        $mail = new PHPMailer();
        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP(); 		// we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // user email address
        $mail->Password   = "baftopex21";            // password in GMail
        $mail->SetFrom('me@opestudio.id', 'opestudio.id');  //Who is sending the email
        $mail->Subject    = $emailSubject;
        $mail->Body       = $isiEmail;
        $toEmail = $usrEmail; // Who is addressed the email to
        $mail->AddAddress($toEmail);

        if(!$mail->Send()) {
            // $mail->ErrorInfo; #for errof info
            $notifcode = 4; //email failed to send
        } else {
            $notifcode = 3;
        }
        return json_encode(array('result_code'=>$notifcode));
    }

    function removeDash($str){
        if (preg_match("/-/", $str)) {
            $str = str_replace("-", " ", $str);
        }
        return $str;
    }

    function ucname($string) {
        /* Uppercase first string */
        $string =ucwords(strtolower($string));

        foreach (array('-', '\'') as $delimiter) {
            if (strpos($string, $delimiter)!==false) {
                $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
            }
        }
        return $string;
    }

    function table2Excel($company,$sheetTitle,$data,$fieldCaption){
		/* $sheetTitle -> judul worksheet excel
		 * $data -> dataset array dari hasil 'SELECT' query
		 * $fieldCaption -> data array untuk header kolom
		*/
		if (count($data)>0) {
			$objPHPExcel = new PHPExcel();
			// set properties
			$objPHPExcel->getProperties()
						->setCreator("Export to Excel Generator")
						->setLastModifiedBy("SYSTEM")
						->setTitle("Office 2007 XLSX - Export to Excel")
						->setSubject("Office 2007 XLSX - Export to Excel")
						->setDescription($sheetTitle)
						->setKeywords("")
						->setCategory("Export to Excel");
			$objset = $objPHPExcel->setActiveSheetIndex(0);
			$objget = $objPHPExcel->getActiveSheet();

			$objget->setTitle($sheetTitle); //sheet title
			$val = $fieldCaption;
			array_unshift($val, 'No');

			// style for column header
			$headerStyle = array(
				'alignment'=>array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'fill'=>array( // background style
					'type'=>PHPExcel_Style_Fill::FILL_SOLID,
					'color'=>array('rgb'=>'92d050')
				),
				'font'=>array( // font style
					'color'=>array('rgb'=>'000000'),
					'bold'=>true,
					'size'=>12
				),
				'borders'=>array( // border style
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
					'inside' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
						'color' => array('argb' => 'FF000000'),
					),
				)
			);
			$cells = array(
				'borders'=>array(
					'allborders'=>array(
						'style'=>PHPExcel_Style_Border::BORDER_THIN,
						'color'=>array('rgb'=>'000000')
					)
				)
			);
			$companyStyle = array(
				'font' => array(
					'color' => array('rgb'=>'1BB635'),
					'bold' => true,
					'size' => 15
				)
			);
			$sheetTitleStyle = array(
				'font' => array(
					'color' => array('rgb'=>'4C4D4C'),
					'bold' => true,
					'size' => 12
				)
			);
			$date = date('d-m-Y H:i:s');

			$objset->setCellValue('A1',ucwords($company));
			$objset->setCellValue('A2',ucwords($sheetTitle));
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($companyStyle);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($sheetTitleStyle);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
			// set kolom mulai dari A
			$cols = 'A';
			for ($i=0; $i < count($val); $i++) {
				// set kolom header dengan value dari $val=$fieldCaption
				$objset->setCellValue($cols.'5',ucwords($val[$i]));
				// set lebar kolom (lebar otomatis)
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols)->setAutoSize(true);
				// set style kolom header dari array $headerStyle
				$objPHPExcel->getActiveSheet()->getStyle($cols.'5')->applyFromArray($headerStyle);
				$cols++;
			}

			$baris = 6;
			$no = 1;
			$key = array_keys($data[0]);
			for ($x=0; $x < count($data); $x++) {
				// set kolom mulai dari A
				$cols = 'A';
				for ($i=0; $i < count($val); $i++) {
					// set cell dengan data dari variabel $data. diLooping sebanyak isi $fieldCaption
					if ($cols=='A') {
						$objset->setCellValue($cols.$baris, $no);
						// set number format
						$objPHPExcel->getActiveSheet()->getStyle($cols.$baris)->getNumberFormat()->setFormatCode('0');
					} else {
						$objset->setCellValue($cols.$baris, $data[$x][$key[$i-1]]);
					}
					// set cell style dari array $cells
					$objPHPExcel->getActiveSheet()->getStyle($cols.$baris)->applyFromArray($cells);
					$cols++;
				}
				$baris++;
				$no++;
			}
			$objset->setCellValue('A'.$baris+=1,ucwords('Dibuat pada: '.$date));
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':C'.$baris);
			$objPHPExcel->getActiveSheet()->setTitle($sheetTitle);
			$objPHPExcel->setActiveSheetIndex(0);

   			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
   			ob_start();
   			$objWriter->save('php://output');
   			$xlsData = ob_get_contents();
   			ob_end_clean();

   			$response = array(
   				'status' => 'oke',
   				'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
   			);
   			return $response;
		} else {
			return json_encode(array('msg'=>'Tidak bisa export'));
		}
	}

}
