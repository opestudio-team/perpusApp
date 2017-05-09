<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class RouDBModel extends CI_Model {
    function __construct(){
        # Call the Model constructor
        parent::__construct();

        $this->load->database();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    function execQuery($sql){
        $result = $this->db->query($sql);
        if ($result) {
                $rescode = 4;
                $msg = "Success";
        } else {
                $rescode = 3;
                $msg = "Failed";
        }
        return json_encode(array("result_code"=>$rescode,"result_msg"=>$msg));
    }

    function ExecSPQuery($sqlSP, $sqlResult){
        $result = $this->db->simple_query($sqlSP);
        $result2 = $this->db->simple_query($sqlResult);
        if ($result && $result2) {
                $this->db->trans_start();
                $this->db->query($sqlSP); # not need to get output
                $result = $this->db->query($sqlResult);
                $this->db->trans_complete();
                $row = $result->row();
                $details = array();
                if (isset($row)){
            $rescode = 4;
            $resmsg = "Data ditemukan.";
            $details = $result->row_array();
                } else {
            $rescode = 3;
            $resmsg = "Data tidak ditemukan.";
                }
                return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg, 'data_openq'=>$details));
        } else {
                $errMsg = $this->db->error();
                $rescode = $errMsg["code"];
                $resmsg = $errMsg["message"];
                return json_encode(array('result_code'=>2, 'result_msg'=>"Proses Open Query gagal. ($rescode) $resmsg"));
        }
    }

    function OpenQueryJSon($SqlStr){
        if (preg_match("/(insert)/i", $SqlStr)) {
                $result = $this->db->query($sql);
                if ($result) {
            $rescode = 4;
            $msg = "Success";
                } else {
            $rescode = 3;
            $msg = "Failed";
                }
                return json_encode(array("result_code"=>$rescode,"result_msg"=>$msg));
        } else {
                $result = $this->db->simple_query($SqlStr);
                if ($result){
            $result = $this->db->query($SqlStr);
            $row = $result->row();
            $details = array();
            if (isset($row)){
                        $rescode = 4;
                        $resmsg = "Data ditemukan.";
                        $details = array_values($result->result());
            } else {
                        $rescode = 3;
                        $resmsg = "Data tidak ditemukan.";
                        $details = array_values($result->result());
            }
            return json_encode(array('result_code'=>$rescode, 'result_msg'=>$resmsg, 'data_openq'=>$details));
                } else {
            $errMsg = $this->db->error();
            $rescode = $errMsg["code"];
            $resmsg = $errMsg["message"];
            return json_encode(array('result_code'=>2, 'result_msg'=>"Proses Open Query gagal. ($rescode) $resmsg"));
                }
        }
    }

    function convertToArr($fieldValueData) {
        $data = array();
        if ($fieldValueData != ''){
            $fieldValueArr = explode(';', $fieldValueData);
            foreach ($fieldValueArr as $value) {
                $keyVal = explode('=>', $value);
                if ((strtolower($keyVal[1]) != 'null') && ($keyVal[1] != '')) {
                    #bukan data kosong
                    if (substr($keyVal[1], 0, 1) != '+') {
                        #tidak ditemukan string awal '+', tambahkan escaped
                        $key = $keyVal[0];
                        #ubah semua karakter petik sat (') maupun petik dua (")
                        $val = str_replace("'", ' ', $keyVal[1]);
                        $val = str_replace("\"", ' ', $val);
                        if ((strtolower($val) == "now()") || (strtolower($val) == "now")) {
                            $val = date("Y-m-d H:i:s");
                        }
                    } else {
                        $key = $keyVal[0];
                        if (strpos($keyVal[1], ".")){
                            #titik ditemukan, ubah ke nilai float
                            $val = floatval($keyVal[1]);
                        } else{
                            $val = intval($keyVal[1]);
                        }
                    }
                    $data[$key] = $val;
                }
            }
        }
        return $data;
    }

    function insertData($tableName, $fieldValueData) {		 	
        $data = $this->convertToArr($fieldValueData);
        return $this->insertDataArr($tableName, $data);
    }

    function insertDataArr($tableName, $data){
        $this->db->insert($tableName, $data);
        $errMsg = $this->db->error();
        $rescode = $errMsg["code"];
        $resmsg = $errMsg["message"];

        if ($rescode == 0){
                #proses insert berhasil
                $resmsg = "Proses Insert data telah berhasil.";
        } else {
                $resmsg = "Proses Insert gagal. ($rescode) $resmsg.";
                $rescode = 2;
        }
        return json_encode(array('result_code'=>$rescode, 'result_msg'=> $resmsg));
    }

    function updateData($tableName, $fieldValueData, $whereList) {		 	
        $data = $this->convertToArr($fieldValueData);
	   $where = $this->convertToArr($whereList);
        return $this->updateDataArr($tableName, $data, $where);
    }

    function updateDataArr($tableName, $data, $where){
        $this->db->update($tableName, $data, $where);

        $errMsg = $this->db->error();
        $rescode = $errMsg["code"];
        $resmsg = $errMsg["message"];

        if ($rescode == 0){
            #proses insert berhasil
            $resmsg = "Proses Update data telah berhasil.";
        } else {
            $resmsg = "Proses Update gagal. ($rescode) $resmsg.";
            $rescode = 2;
        }
        return json_encode(array('result_code'=>$rescode, 'result_msg'=> $resmsg));
        #return json_encode(array('result_code'=>0, 'result_msg'=> 'masuk'));
    }

    function deleteData($tableName, $whereList) {		 	
        $where = $this->convertToArr($whereList);
        return $this->deleteDataArr($tableName, $where);
    }

    function deleteDataArr($tableName, $where){
        $this->db->delete($tableName, $where);

        $errMsg = $this->db->error();
        $rescode = $errMsg["code"];
        $resmsg = $errMsg["message"];

        if ($rescode == 0){
            #proses delete berhasil
            $resmsg = "Proses Delete data telah berhasil.";
        } else {
            $resmsg = "Proses Delete gagal. ($rescode) $resmsg.";
            $rescode = 2;
        }
        return json_encode(array('result_code'=>$rescode, 'result_msg'=> $resmsg));
    }

    function getLastID(){
        $lastID = $this->db->insert_id();
        return $lastID;
    }

}
?>
