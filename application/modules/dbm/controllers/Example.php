<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
	}

  function insert(){
    $field_name = array('nama','alamat','email');
    $field_data = array('Alvian','Magetan','alvian@gmail.com');

    $this->dbm->set_table('test');
    $result = $this->dbm->insert($field_name, $field_data);
    echo $result;
  }

  function get(){
    $this->dbm->select('all');
    echo $this->dbm->get('test');
  }

  function get_where(){
    $where_field = array('nama','alamat');
    $field_data = array('Alvian','Magetan');

    $this->dbm->select('all');
    $this->dbm->set_table('test');
    $result = $this->dbm->get_where($where_field, $field_data);
    echo $result;
  }

  function get_like(){
    $where_field = array('nama');
    $field_data = array('Alvian');

    $this->dbm->select("all");
    $this->dbm->set_table('test');
    $result = $this->dbm->get_like($where_field, $field_data);
    echo $result;
  }

  function update(){
    $this->dbm->set_table('test');
    $result = $this->dbm->update(['nama'],['Ope'],array('id'=>1));
    echo $result;
  }

}
