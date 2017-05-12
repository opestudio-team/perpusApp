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
      $this->template->render('master_buku_view');
      // echo $this->kode->generate('Buku Pemrograman PHP');
    }

    public function tambah(){

    }

    public function koreksi(){

    }

    function prosesTambah(){
      /* ambil data dari kiriman AJAX */
      $nama_buku        = $this->input->post('nama_buku');
      $pengarang        = $this->input->post('pengarang');
      $tahun_terbit     = $this->input->post('tahun_terbit');
      $penerbit         = $this->input->post('penerbit');
      $kategori         = $this->input->post('kategori');

      /* generate kode Buku */
      // $kode_buku = $this->kode->generate($nama_buku);

      /* generate ucode (unique code) */
      // $ucode_buku = $this->ucode->generate();

      /* set data insert */
      $data = array(
        // 'kode_buku' => $kode_buku,
        'nama_buku' => $nama_buku,
        // 'ucode_buku' => $ucode_buku,
        'tahun_terbit' => $tahun_terbit,
        'ucode_penerbit' => $penerbit,
        'ucode_pengarang' => $pengarang,
        'ucode_kategori' => $karegori
      );

      /* insert ke Database */
      $result = $this->dbm->insert($data);
    }

    function prosesKoreksi(){

    }
  }
