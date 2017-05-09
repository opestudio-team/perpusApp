<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller{

    function __construct(){
        parent::__construct();     
        $this->ci =& get_instance();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    function index(){ 
        $this->load->view('export_view');
    }
    
    function insertBigData(){
        for($i=0; $i<1000; $i++){
            $tableName = "tb_lap_stok_mtr";
            $keyValList = "kode_brg=>BRG".$i.";nama_brg=>Barang ".$i.";nama_warna=>;nama_gdg=>Gudang ".$i.";qty=>".$i;
            $proses = $this->roudbmodel->insertData($tableName, $keyValList);
        }
    }
    
    function dataStok(){
        $sql = "SELECT m.kode_brg, m.nama_brg, m.nama_warna, m.qty
                FROM tb_lap_stok_mtr m
                ORDER BY m.kode_brg DESC";
        $proses = $this->ci->Roudbmodel->OpenQueryJson($sql);
        $hasil = json_decode($proses,TRUE);
        $data = $hasil['data_openq'];
        $key = array_keys($data[0]); 
        $captionField = array('Kode Barang','Nama Barang','Nama Warna','Qty');

        $table = "";
        for ($i=0; $i < count($data); $i++) { 
            $table .= "<tr class='acts-table'>";
            for ($x=0; $x < count($data[$i]); $x++) {         
                $table .= "<td class='acts-table' data-title='$captionField[$x]'>".$data[$i][$key[$x]]."</td>";
            }
            $table .= "</tr>";
        } 
       echo json_encode(array('dataTable'=>$table));     
    }

    function excel(){
        $idField = array('kode_brg','nama_brg','nama_warna','qty');
        $fieldCaption = $this->input->post('fieldCaption');
        $filter = $this->input->post('filter'); 
        $title = $this->input->post('title');

        $sql = "SELECT ";
        for ($i=0; $i < count($idField); $i++) { 
            $sql .= $idField[$i].",";
        }
        $sql = rtrim($sql,',');
        $sql .= " FROM tb_lap_stok_mtr WHERE ";
        for ($i=0; $i < count($idField); $i++) { 
            $sql .= " ".$idField[$i]." LIKE '%$filter%' OR";
        }
        $sql = rtrim($sql,'OR');
        $sql .= " ORDER BY kode_brg DESC";
        $proses = $this->ci->Roudbmodel->OpenQueryJson($sql);
        $hasil = json_decode($proses,TRUE);
        $data = $hasil['data_openq'];

        $export = $this->ci->routines->table2Excel('Opestudio - Export to Excel Test',$title,$data,$fieldCaption);
        echo json_encode($export);
    }
}
?>
