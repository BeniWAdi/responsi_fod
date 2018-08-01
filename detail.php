<?php
require_once 'BDB/BDB.php';
require_once 'myfunction/tampilan.php';

headerHalaman();
$produk = BDB::findByPk("produk", $_GET['id']);
echo "<h1 align='center'>" . $produk["nama_produk"] . "</h1>";
echo "<center>|<br/>=<br/>=<br/>= | = | =<br/>=<br/>=<br/>|<br/><br/></center>";
echo "<center>";
echo "Nama Toko : <a href='toko.php?id=" . $produk["toko"]["id_toko"] . "'>" . $produk["toko"]["nama_toko"] . "</a>";
echo "<p>" . $produk["diskripsi"] . "</p>";
echo "Stok : " . $produk["stok"] . " | Harga : Rp." . $produk["harga"];
echo "</center>";
?>
<br/><hr/>
<form action="" method="post">
    <center>
        <span>Jumlah Pesan : </span>
        <input name="quantity" type="number" value="1" size="5">
        <input name="submit" type="submit" value="ADD TO CARD"><br/>
        <?php if (isset($_GET['s'])) echo "Jumlah Pesan Melebihi Stok"; ?>
    </center>
</form>

<?php // ==================================== AKSI ============================== 

if (isset($_POST["submit"])) {
    $data["id_produk"] = $_GET['id'];
    if ($produk["stok"] < $_POST['quantity']) {
        header("Location:detail.php?id=" . $produk["id_produk"] . "&s=0");
        exit;
    }
    if (isset($_SESSION['id_pembeli'])) {
        $data["id_pembeli"] = $_SESSION['id_pembeli'];
        $keranjang = BDB::findAllByFields("keranjang", $data);
        if ($keranjang != null) {
            BDB::update("keranjang", ["quantity"=> ($keranjang[0]["quantity"]+$_POST['quantity'])], $data);
        } else {
            $data["quantity"] = $_POST['quantity'];
            BDB::insert("keranjang", $data);
        }
        header("Location:toko.php?id=" . $produk["id_toko"]);
    } else {
        header("Location:login.php?detId=" . $produk["id_produk"]);
    }
}