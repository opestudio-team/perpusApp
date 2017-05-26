# perpusApp

#Instalasi Database
1. Buat database dengan nama 'perpus' (tanpa tanda petik)
2. Import file perpus.sql

#Aturan Penulisan Kode
1. Controller
  a. Nama file dan class controller harus diawali huruf Kapital
  b. Setiap controller yang dibuat harus mewakili sub-modul tertentu. Misal pada modul 'Master' ingin menambah sub-modul 'User', berarti harus membuat 1 file controller dengan nama User.php
  c. Di dalam sub modul/controller User.php wajib ada 6 method, yaitu: index(), tambah(), koreksi(), simpan(), prosesTambah(), prosesKoreksi(). Boleh menambah method lainnya jika dirasa perlu. Tetapi 6 method tersebut wajib ada
