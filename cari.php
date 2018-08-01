<?php
require_once "BDB/BDB.php";
require_once "myfunction/tampilan.php";
headerHalaman();
?>
<form id="#" action="#" method="get">
    <center>
        <input type="text" name="keyword" placeholder="Cari produk ..."><br/><br/>
        <select name="kategori"> 
            <option value="Semua">Semua</option>
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
        </select>
        <input  name="submit" type="submit" value="CARI"><br/><hr/>
    </center>
</form>

<?php // ==================================== AKSI ===================================

if (isset($_GET['submit'])) {
    $produk = BDB::searchAll("produk", "nama_produk, diskripsi, toko.nama_toko", $_GET['keyword']);
    if ($produk != null) {
        foreach ($produk as $p) {
            if ($p["jenis_produk"] == $_GET['kategori'] || $_GET['kategori'] == "Semua") {
                displayProduk($p);
            }
        }
    } else {
        echo "<center>Hasil Tidak Ditemukan</center>";
    }
}