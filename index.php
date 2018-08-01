<?php
require_once 'BDB/BDB.php';
require_once 'myfunction/tampilan.php';

headerHalaman();
$produk = BDB::findAll("produk", "ORDER BY id_produk DESC");
echo "<h2 align='center'>Terbaru</h2>";
$i = 0;
foreach ($produk as $produk) {
    if($i < 11) displayProduk($produk);
    $i++;
}
?>
