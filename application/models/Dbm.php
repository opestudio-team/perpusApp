<?php
	defined('BASEPATH') or die('Tidak dapat diakses langsung');

/* DBM: Database Model for Codeigniter
 * -----------------------
 * Author/Creator				: Taufiqur Rohman
 * DBM Version 					: 0.1
 * Codeigniter Version	: 3
 */

class Dbm extends CI_Model
{
	private $table_name = "";
	private $select = "";

	function __construct(){
		parent:: __construct();
		$this->load->database();
		date_default_timezone_set('Asia/Jakarta');
	}

	function check_table_name(){
		$flag = true;
		if ($this->table_name == "") {
			$flag = false;
		}
		return $flag;
	}

	function create_array_data($field_name='', $field_data=''){
		// fungsi untuk generate associative array
		for ($i=0; $i < count($field_name); $i++) {
			$array[$field_name[$i]] = $field_data[$i];
		}
		return $array;
	}

	function set_table($tbname){
		$this->table_name = $tbname;
	}

	function select($str){
		if (strtolower($str) == "all") {
			$this->select = "*";
		} else {
			$this->select = $str;
		}
	}

	function query($sql){
		$result = $this->db->simple_query($sql);
		if ($result) {
			$result = $this->db->query($sql);
			$row = $result->row();
			$details = array();
			if (isset($row)) {
				$result_code = 0;
				$result_msg = "Data ditemukan!";
				$details = array_values($result->result());
			} else {
				$result_code = 1;
				$result_msg = "Data tidak ditemukan!";
				$details = "";
			}
			return json_encode(
				array(
					'result_code'=>$result_code,
					'result_msg'=>$result_msg,
					'data'=>$details
				)
			);
		} else {
			$errMsg = $this->db->error();
			$result_code = $err_msg["code"];
			$result_msg = $err_msg["message"];
			return json_encode(
				array(
					'result_code'=>2,
					'result_msg'=>"Proses Open Query gagal. ($result_code) $result_msg"
				)
			);
		}
	}

	function insert($data = ''){
		if ($this->check_table_name()) {
			if (!empty($data)) {
				$this->db->insert($this->table_name, $data);
				$err_msg = $this->db->error();
				$result_code = $err_msg['code'];
				$result_msg	= $err_msg['message'];

				if ($result_code == 0) {
					$result_msg = 'Proses insert data berhasil';
				} else {
					$result_msg = 'Proses insert gagal. ($result_code) $result_msg';
				}
				return json_encode(
					array(
						'result_code'=>$result_code,
						'result_msg'=>$result_msg
					)
				);
			} else {
				echo "Tidak ditemukan data yang bisa diinsert!";
			}
		} else {
			$msg = "Nama tabel belum dideklarasikan!<br/>
						Gunakan <b>\$this->dbm->set_table()</b> untuk set nama tabel sebelum proses insert.";
			$this->show_error_msg($msg);
		}
	}

	function get($tbname = ""){
		if ($tbname != "") {
			if ($this->select != "") {
				$sql = "SELECT $this->select FROM $tbname";
				$result = $this->db->query($sql);
				$row = $result->row();
				if (isset($row)) {
					$result_code = 0;
					$result_msg  = 'Data ditemukan';
					$result_data = array_values($result->result());
				} else {
					$err_msg = $this->db->error();
					$result_code = $err_msg['code'];
					$result_msg	= $err_msg['message'];

					$result_code = 1;
					$result_msg  = 'Data tidak ditemukan. ($result_code) $result_msg';
				}
				return json_encode(
					array(
						'result_code'=>$result_code,
						'result_msg'=>$result_msg,
						'data'=>$result_data
					)
				);
			} else {
				$msg = "Tidak ada kolom yang dipilih dari tabel <b>'$tbname'</b>. <br/>
								Gunakan <b>\$this->dbm->select()</b> untuk menentukan kolom mana saja yang ingin anda pilih.";
				$this->show_error_msg($msg);
			}
		} else {
			$msg = "Tidak ada tabel yang dipilih.";
			$this->show_error_msg($msg);
		}
	}

	function get_where($where_field, $field_data, $andor = 'AND'){
		if ($this->check_table_name()) {
			if ($this->select != "") {
				$sql = "SELECT $this->select FROM $this->table_name WHERE ";
				if (count($where_field) == 1) {
					$sql .= $where_field[0]." = ?";
				} else {
					if (strtolower($andor) != strtolower('like')) {
						for ($i=0; $i < count($where_field); $i++) {
							$sql .= $where_field[$i]." = ? ".$andor." ";
						}
						if (strtolower($andor) == "and") {
							$sql = substr($sql, 0, -4);
						} else if(strtolower($andor) == "or"){
							$sql = substr($sql, 0, -3);
						}
					} else {
						for ($i=0; $i < count($where_field); $i++) {
							$sql .= $where_field[$i]." LIKE ? ";
						}
					}
				}
				$exec = $this->db->query($sql, $field_data);
				$result_data = $exec->result();

				if (count($result_data) > 0) {
					$result_code = 0;
					$result_msg = 'Data ditemukan!';
				} else {
					$result_code = 1;
					$result_msg = 'Data tidak ditemukan.';
				}
				return json_encode(
					array(
						'result_code'=>$result_code,
						'result_msg'=>$result_msg,
						'data'=>$exec->result()
					)
				);
				// return $exec;
			} else {
				$msg = "Tidak ada kolom yang dipilih dari tabel <b>'$this->table_name'</b>. <br/>
								Gunakan <b>\$this->dbm->select()</b> untuk menentukan kolom mana saja yang ingin anda pilih.";
				$this->show_error_msg($msg);
			}
		} else {
			$msg = "Nama tabel belum ditentukan!<br/>
						Gunakan <b>\$this->dbm->set_table()</b> untuk set nama tabel sebelum proses get_where().";
			$this->show_error_msg($msg);
		}
	}

	function get_like($where_field, $field_data){
		if ($this->check_table_name()) {
			if ($this->select != "") {
				$sql = "SELECT $this->select FROM $this->table_name WHERE ";
				for ($i=0; $i < count($where_field); $i++) {
					$sql .= $where_field[$i]." LIKE '%$field_data[$i]%' ";
				}
				$exec = $this->db->query($sql, $field_data);
				$result_data = $exec->result();
				// error message
				$err_msg = $this->db->error();
				$result_code = $err_msg['code'];
				$result_msg	= $err_msg['message'];

				if ($result_code == 0) {
					$result_msg = 'Data ditemukan!';
				} else {
					$result_msg = 'Data tidak ditemukan. ($result_code) $result_msg';
				}
				return json_encode(
					array(
						'result_code'=>$result_code,
						'result_msg'=>$result_msg,
						'data'=>$result_data
					)
				);
			} else {
				$msg = "Tidak ada kolom yang dipilih dari tabel <b>'$this->table_name'</b>. <br/>
								Gunakan <b>\$this->dbm->select()</b> untuk menentukan kolom mana saja yang ingin anda pilih.";
				$this->show_error_msg($msg);
			}
		} else {
			$msg = "Nama tabel belum ditentukan!<br/>
						Gunakan <b>\$this->dbm->set_table()</b> untuk set nama tabel sebelum proses get_where().";
			$this->show_error_msg($msg);
		}
	}

	function update($data_update, $where = ''){
		if ($this->check_table_name()) {
			if ($where == "") {
				$result = $this->db->update($this->table_name, $data_update);
			} else {
				$result = $this->db->update($this->table_name, $data_update, $where);
			}

			// ambil pesan error
			$err_msg = $this->db->error();
			$result_code = $err_msg['code'];
			$result_msg	= $err_msg['message'];

			if ($result_code == 0) {
				$result_msg = 'Proses update data berhasil';
			} else {
				$result_msg = 'Terjadi kesalahan saat mencoba update data.
											($result_code) $result_msg';
			}
			return json_encode(
				array(
					'result_code'=>$result_code,
					'result_msg'=>$result_msg
				)
			);
		} else {
			$msg = "Nama tabel belum dideklarasikan!<br/>
						Gunakan <b>\$this->dbm->set_table()</b> untuk set nama tabel sebelum proses insert.";
			$this->show_error_msg($msg);
		}
	}

	function delete($tbname, $where){
		if ($tbname != "") {
			if ($where != "") {
				if (is_array($where)) {
					$this->db->where($where); // use array format, ie: array('id','5')
					$this->db->delete($tbname);

					// ambil pesan error
					$err_msg = $this->db->error();
					$result_code = $err_msg['code'];
					$result_msg	= $err_msg['message'];

					if ($result_code == 0) {
						$result_msg = 'Data berhasil dihapus';
					} else {
						$result_msg = 'Terjadi kesalahan saat mencoba hapus data dari $tbname.
													($result_code) $result_msg';
					}
					return json_encode(
						array(
							'result_code'=>$result_code,
							'result_msg'=>$result_msg
						)
					);
				} else {
					$msg = "Key 'where' harus dalam format Array!";
					$this->show_error_msg($msg);
				}
			} else {
				$msg = "Key 'where' belum ditentukan. Hati-hati, ini bisa menghapus semua Database
								dalam satu tabel!";
				$this->show_error_msg($msg);
			}
		} else {
			$msg = "Nama tabel belum dideklarasikan!";
			$this->show_error_msg($msg);
		}
	}

	function get_last_id(){
		// get ID (Primary key) from last insert
		$last_id = $this->db->insert_id();
		return $last_id;
	}

	function show_error_msg($message){
		$msg = "<fieldset style='width:90%;margin:20px auto;border:1px solid #ddd;padding:20px;font-family:verdana;font-size:13px;'>";
		$msg .= "<legend><b>DBM Error Messages</b></legend>";
		$msg .= "<div class='row' style='width:100%;'>".$message."</div>";
		$msg .= "<div style='width: 100%;margin-top: 30px;font-size: 10px;border-top: 1px solid #efefef;padding-top: 15px;'>Created by: Taufiqur Rohman<br/>Website: http://opestudio.id</div>";
		$msg .= "</fieldset>";
		echo $msg;
		return false;
	}
}
