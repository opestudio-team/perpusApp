<?php
  $attributes = array('id' => 'form_tambah');
  echo form_open('master/buku/simpan', $attributes);
  echo "Nama Buku";
  echo form_input('nama_buku');
  echo "Nama Pengarang";
  echo form_input('nama_pengarang');
  echo form_close();
?>
