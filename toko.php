<?php
require_once "BDB/BDB.php";
require_once "myfunction/tampilan.php";
headerHalaman();
$toko = BDB::findByPk("toko", $_GET['id']);
echo "<h1 align='center'>" . $toko["nama_toko"] . "</h1>";
echo "<center>|<br/>=<br/>=<br/>= | = | =<br/>=<br/>=<br/>|<br/><br/></center>";
?>
<center>
    <h3>INFORMASI</h3>
    <?php
    echo "Alamat : " . $toko["alamat"] . ", " . $toko["kota"] . ", " . $toko["provinsi"] . "<br/>";
    echo "Telp   : " . $toko["telp"] . "<br>";
    echo "Email  : " . $toko["email"] . "<br/><hr/>";
    ?>
    <br/>
    <form action="" method="post">
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
    <?php
    
    if (isset($_POST['submit'])) {
        $produk = BDB::searchAll("produk", "nama_produk, diskripsi", $_POST['keyword']);
        if ($produk != null) {
            foreach ($produk as $produk) {
                if ($produk["jenis_produk"] == $_POST['kategori'] || $_POST['kategori'] == "Semua") {
                    if ($produk["toko"]["id_toko"] == $toko["id_toko"])
                        displayProduk($produk);
                }
            }
        } else {
            echo "<center>Hasil Tidak Ditemukan</center>";
        }
    } else {
        $produk = BDB::findAllByFields("produk", ["id_toko"=>$toko["id_toko"]]);
        foreach ($produk as $produk) {
            displayProduk($produk);
        }
    }
