<?php
require_once '../BDB/BDB.php';
require_once 'noAuto.php';

echo "NO PEMBELI   : ".noPembeliAuto()."<br>";
echo "NO TOKO      : ".  noTokoAuto()."<br>";
echo "NO TRANSAKSI : ".  noTransaksiAuto()."<br>";
echo "NO PRODUK    : ".  noProdukAuto("T1610001");

echo "<hr><br>";
$_desctables = array(
  "d_transaksi" => array( 
   array("Field" => "no_transaksi", "Type" => "char(12)"), 
   array("Field" => "id_produk", "Type" => "char(10)"), 
   array("Field" => "quantity", "Type" => "int(11)"), 
  ), 
  "keranjang" => array( 
   array("Field" => "id_pembeli", "Type" => "char(10)"), 
   array("Field" => "id_produk", "Type" => "char(10)"), 
   array("Field" => "quantity", "Type" => "int(11)"), 
  ), 
  "pembeli" => array( 
   array("Field" => "id_pembeli", "Type" => "char(10)"), 
   array("Field" => "nama_pembeli", "Type" => "varchar(100)"), 
   array("Field" => "provinsi", "Type" => "varchar(20)"), 
   array("Field" => "kota", "Type" => "varchar(50)"), 
   array("Field" => "alamat", "Type" => "text"), 
   array("Field" => "telp", "Type" => "varchar(15)"), 
   array("Field" => "email", "Type" => "varchar(50)"), 
   array("Field" => "password", "Type" => "varchar(100)"), 
  ), 
  "produk" => array( 
   array("Field" => "id_produk", "Type" => "char(10)"), 
   array("Field" => "nama_produk", "Type" => "varchar(100)"), 
   array("Field" => "jenis_produk", "Type" => "enum('Makanan','Minuman')"), 
   array("Field" => "diskripsi", "Type" => "text"), 
   array("Field" => "harga", "Type" => "int(11)"), 
   array("Field" => "stok", "Type" => "int(11)"), 
   array("Field" => "foto", "Type" => "varchar(250)"), 
   array("Field" => "id_toko", "Type" => "char(8)"), 
  ), 
  "toko" => array( 
   array("Field" => "id_toko", "Type" => "char(8)"), 
   array("Field" => "nama_toko", "Type" => "varchar(100)"), 
   array("Field" => "diskripsi", "Type" => "text"), 
   array("Field" => "provinsi", "Type" => "varchar(20)"), 
   array("Field" => "kota", "Type" => "varchar(50)"), 
   array("Field" => "alamat", "Type" => "text"), 
   array("Field" => "telp", "Type" => "varchar(15)"), 
   array("Field" => "email", "Type" => "varchar(50)"), 
   array("Field" => "foto", "Type" => "varchar(250)"), 
   array("Field" => "password", "Type" => "varchar(100)"), 
  ), 
  "transaksi" => array( 
   array("Field" => "no_transaksi", "Type" => "char(12)"), 
   array("Field" => "id_pembeli", "Type" => "char(10)"), 
   array("Field" => "tgl_transaksi", "Type" => "date"), 
   array("Field" => "status_transaksi", "Type" => "enum('Diterima','Belum diterima')"), 
   array("Field" => "alamat_pengiriman", "Type" => "text"), 
  ), 
 ); 
    
$_keytables = array(
  "d_transaksi" => array( 
   "PK" => null, 
   "FK" => array( 
    array( 
     "COLUMN_NAME" => "no_transaksi", 
     "REFERENCED_TABLE_NAME" => "transaksi", 
     "REFERENCED_COLUMN_NAME" => "no_transaksi", 
    ), 
    array( 
     "COLUMN_NAME" => "id_produk", 
     "REFERENCED_TABLE_NAME" => "produk", 
     "REFERENCED_COLUMN_NAME" => "id_produk", 
    ), 
   ), 
  ), 
  "keranjang" => array( 
   "PK" => null, 
   "FK" => array( 
    array( 
     "COLUMN_NAME" => "id_pembeli", 
     "REFERENCED_TABLE_NAME" => "pembeli", 
     "REFERENCED_COLUMN_NAME" => "id_pembeli", 
    ), 
    array( 
     "COLUMN_NAME" => "id_produk", 
     "REFERENCED_TABLE_NAME" => "produk", 
     "REFERENCED_COLUMN_NAME" => "id_produk", 
    ), 
   ), 
  ), 
  "pembeli" => array( 
   "PK" => "id_pembeli", 
   "FK" => null, 
  ), 
  "produk" => array( 
   "PK" => "id_produk", 
   "FK" => array( 
    array( 
     "COLUMN_NAME" => "id_toko", 
     "REFERENCED_TABLE_NAME" => "toko", 
     "REFERENCED_COLUMN_NAME" => "id_toko", 
    ), 
   ), 
  ), 
  "toko" => array( 
   "PK" => "id_toko", 
   "FK" => null, 
  ), 
  "transaksi" => array( 
   "PK" => "no_transaksi", 
   "FK" => array( 
    array( 
     "COLUMN_NAME" => "id_pembeli", 
     "REFERENCED_TABLE_NAME" => "pembeli", 
     "REFERENCED_COLUMN_NAME" => "id_pembeli", 
    ), 
   ), 
  ), 
 );

echo "KERANJANG FK : ".json_encode($_keytables["keranjang"]["FK"])."<hrr/>";