<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   *
   */
  class Buku extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();
      /* get id user */
      // $id_user = $this->session->userdata('id_user_'.project);
    }

    public function index(){
      $this->template->set(array(
        'title' => 'Master Buku',
      ));
      $this->template->breadcrumb(true);
      $this->template->render('master_buku_view');
    }

    public function tambah(){

    }

    public function koreksi(){

    }

    function simpan(){
      /* ambil semua data dari post */
      $data = $this->input->post();

      /* cek data kosong atau tidak */
      if (isset($data)) {
        /* cek jenis proses */
        if ($data['jns_proses'] == 'baru') {
          $proses = $this->prosesTambah($data);
        } else {
          $proses = $this->prosesKoreksi($data);
        }
      }

      $this->output->set_content_type('application/json')->set_output($proses);
    }

    function prosesTambah($data){
      $nama_buku        = $data['nama_buku'];
      $pengarang        = $data['pengarang'];
      $tahun_terbit     = $data['tahun_terbit'];
      $penerbit         = $data['penerbit'];
      $kategori         = $data['kategori'];

      /* generate kode Buku */
      $kode_buku = $this->kode->generate($nama_buku);

      /* generate ucode (unique code) */
      $ucode_buku = $this->uniquecode->generate('buku');

      /* set data insert */
      $data = array(
        'kode_buku' => $kode_buku,
        'nama_buku' => $nama_buku,
        'ucode_buku' => $ucode_buku,
        'tahun_terbit' => $tahun_terbit,
        'ucode_penerbit' => $penerbit,
        'ucode_pengarang' => $pengarang,
        'ucode_kategori' => $karegori
      );

      /* set tabel */
      $this->dbm->set_table('tb_m_buku');

      /* insert ke Database */
      $insert = $this->dbm->insert($data);
      $result = json_decode($insert,TRUE);

      $result_code = $result['result_code'];
      if ($result_code == 0) {
        # insert success
        $msg = "Insert success!";
      } else {
        # insert failed
        $msg = "Insert failed!";
      }

      return json_encode(array(
        'result_code' => $result_code,
        'result_msg' => $msg
      ));
    }

    function prosesKoreksi($data){
      $nama_buku        = $data['nama_buku'];
      $pengarang        = $data['pengarang'];
      $tahun_terbit     = $data['tahun_terbit'];
      $penerbit         = $data['penerbit'];
      $kategori         = $data['kategori'];

    }
  }
