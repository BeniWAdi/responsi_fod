<?php
require_once "BDB/BDB.php";
require_once 'myfunction/tampilan.php';
require_once 'myfunction/noAuto.php';
headerHalaman();

$pembeli = BDB::findByPk("pembeli", $_SESSION['id_pembeli']);
if(isset($_GET['id'])){
    if ($_POST['submit'] == 'EDIT'){
        $data["id_pembeli"] = $pembeli["id_pembeli"];
        $data["id_produk"] = $_GET["id"];
        BDB::update("keranjang", ["quantity"=>$_POST['quantity']], $data);
    } else {
        BDB::delete("keranjang", ["id_pembeli"=>$pembeli["id_pembeli"], "id_produk"=>$_GET["id"]]);
    }
}
echo "<h1 align='center'>Keranjang</h1>";
$keranjang = BDB::findAllByFields("keranjang", ["pembeli.id_pembeli"=>$pembeli["id_pembeli"]]);
if ($keranjang != null) {
        echo "<table border='1' align='center'>";
    echo "<tr><th>Nama Produk</th><th>Nama Toko</th><th>Jumlah</th><th>Sub Total</th><th></th></tr>";
    $totalHarga = 0;
    foreach ($keranjang as $k) {
        $subTotal = $k["quantity"]*$k["produk"]["harga"];
        echo "<form action='keranjang.php?id=" . $k["id_produk"] . "' method='post'>";
        echo "<tr>";
        echo "<td>" . $k["produk"]["nama_produk"] . "</td>";
        echo "<td><a href='toko.php?id=".$k["produk"]["toko"]["id_toko"]."'>". $k["produk"]["toko"]["nama_toko"] . "</td>";
        echo "<td><input name='quantity' type='number' value='" . $k["quantity"] . "'>"
        . "<input name='submit' type='submit' value='EDIT'></td>";
        echo "<td>Rp.".$subTotal."</td>";
        echo "<td><input name='submit' type='submit' value='X'></td>";
        echo "</tr>";
        echo "</form>";
        $totalHarga += $subTotal;
    }
    echo "<tr><td colspan='3'>Total Harga</td><td colspan='2'>Rp.".$totalHarga."</td></tr>";
    echo "</table><center>";
    echo "<br/>";
    echo "<form action='' method='post'>";
    echo "<textarea name='alamat_pengiriman' placeholder='Alamat pengiriman ...'></textarea><br/>";
    echo "<input name='submit2' type='submit' value='CHECK OUT'>";
    echo "</center></form>";
} else {
    if (isset($_GET['s'])){
        echo "<h2 align='center'>Order telah terkirim, silahkan tunggu sampai pesanan datang ...</h2>";
    }  else {
        echo "<h2 align='center'>Keranjang Kosong</h2>";
    }
    
}

// =========================== AKSI CHECKOUT ====================================

if(isset($_POST["alamat_pengiriman"]) && isset($_POST["submit2"])) {
    $alamatPengiriman = $_POST['alamat_pengiriman'];
    checkOutKeranjang($_SESSION['id_pembeli'], $alamatPengiriman);
    header("Location:keranjang.php?s=1");
}

function checkOutKeranjang($idPembeli, $alamatPengiriman){
    $keranjang = BDB::findAllByFields("keranjang", ["id_pembeli"=>$idPembeli], "ORDER BY id_produk");
    $date_now = "".date("Y/m/d");
    $idToko = "00000000";
    $transaksi = null;
    BDB::beginTransaction();
    foreach ($keranjang as $row){
        if ($transaksi == null || $idToko != substr($row["id_produk"], 0, -2)){
            $transaksi["no_transaksi"] = noTransaksiAuto();
            $transaksi["id_pembeli"] = $row["id_pembeli"];
            $transaksi["tgl_transaksi"] = $date_now;
            $transaksi["status_transaksi"] = "Belum diterima";
            $transaksi["alamat_pengiriman"] = $alamatPengiriman;
            if (BDB::insert("transaksi", $transaksi) == false){
                BDB::rollBackTransaction();
                return false;
            }
        }
        $dTransaksi["no_transaksi"] = $transaksi["no_transaksi"];
        $dTransaksi["id_produk"] = $row["id_produk"];
        $dTransaksi["quantity"] = $row["quantity"];
        if (BDB::insert("d_transaksi", $dTransaksi) == false){
            BDB::rollBackTransaction();
            return false;
        }
        $idToko = substr($row["id_produk"], 0, -2);
    }
    BDB::delete("keranjang", ["id_pembeli"=>$idPembeli]);
    BDB::commitTransaction();
    return true;
}
