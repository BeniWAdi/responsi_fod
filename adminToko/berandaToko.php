<?php
require_once '../BDB/BDB.php';
require_once '../myfunction/tampilan.php';
headerToko();
?>
<center><a href="fi_produk.php"><button>Tambah Produk</button></a><center><br/>
<?php

$produks = BDB::findAllByFields("produk", ["id_toko"=>$_SESSION['id_toko']]);
if ($produks != null){
    echo "<table border='1' align='center'>"
     . "<tr>"
     . " <th>Nama Produk</th>"
     . " <th>Jenis Produk</th>"
     . " <th>Deskripsi</th>"
     . " <th>Harga</th>"
     . " <th>Stok</th>"
     . " <th colspan='2'>Aksi</th>"
     . "</tr>";
    foreach ($produks as $produk) {
        echo "<tr>"
        . " <td>" . $produk["nama_produk"] . "</td>"
        . " <td>" . $produk["jenis_produk"] . "</td>"
        . " <td>" . $produk["diskripsi"] . "</td>"
        . " <td>" . $produk["harga"] . "</td>"
        . " <td>" . $produk["stok"] . "</td>"
        . " <td><a href='fe_produk.php?id=".$produk["id_produk"]."'>Edit</a></td>"
        . " <td><a href=''>Hapus</a></td>"
        . "</tr>";
    }
    echo "</table>";
} else {
    echo "<h3 align='center'>Belum Ada Produk ...<h3>";
}
?>