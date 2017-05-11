<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

  function insert(){
    $data = array(
      'nama_buku' => 'Buku 2',
      'kode_buku' => 'B0002'
    );

    $this->dbm->set_table('tb_m_buku');
    $result = $this->dbm->insert($data);
    echo $result;
  }

  function get(){
    $this->dbm->select('all');
    echo $this->dbm->get('test');
  }

  function get_where(){
    $where_field = array('nama_buku');
    $field_data = array('Buku 1');

    $this->dbm->select('all');
    $this->dbm->set_table('tb_m_buku');
    $result = $this->dbm->get_where($where_field, $field_data);
    echo $result;
  }

  function get_like(){
    $where_field = array('nama_buku');
    $field_data = array('Buku 1');

    $this->dbm->select("nama_buku,kode_buku");
    $this->dbm->set_table('tb_m_buku');
    $result = $this->dbm->get_like($where_field, $field_data);
    echo $result;
  }

  function update(){
    $this->dbm->set_table('tb_m_buku');

    // where_field
    $where = array(
      'id_buku'=>1
    );

    // data yg mau diupdate
    $data_update = array(
      'nama_buku' => 'Buku baru'
    );

    $result = $this->dbm->update($data_update, $where);
    echo $result;
  }

}
