<?php

require_once '../BDB/BDB.php';
require_once '../myfunction/tampilan.php';
headerToko();
if (isset($_GET["id_produk"])){
    echo "<h3 align='center'>Stok kurang<h3>";
}
$transaksi = findTransaksiByToko($_SESSION['id_toko']);
$totHarga = 0;
if ($transaksi != null) {
    foreach ($transaksi as $t) {
        echo "<center>";
        echo $t["pembeli"]["nama_pembeli"];
        echo "<br>" . $t["tgl_transaksi"];
        echo "<br>" . $t["alamat_pengiriman"];
        echo "</center>";
        echo "<table border='1' align='center'>"
        . "<tr>"
        . " <td>Nama Produk</td>"
        . " <td>Jenis Produk</td>"
        . " <td>Harga</td>"
        . " <td>Jumlah</td>"
        . " <td>Sub Total</td>"
        . "</tr>";
        $dTransaksi = BDB::findAllByFields("d_transaksi", ["no_transaksi" => $t["no_transaksi"]], "", 1);
        if ($dTransaksi != null) {
            foreach ($dTransaksi as $dt) {
                $harga = $dt["produk"]["harga"];
                $jumlah = $dt["quantity"];
                $subtot = $harga * $jumlah;
                echo "<tr>"
                . " <td>" . $dt["produk"]["nama_produk"] . "</td>"
                . " <td>" . $dt["produk"]["jenis_produk"] . "</td>"
                . " <td>" . $harga . "</td>"
                . " <td>" . $jumlah . "</td>"
                . " <td>" . $subtot . "</td>"
                . "</tr>";
                $totHarga += $subtot;
            }
            echo "<tr style='text-align:center'>"
            . " <td colspan='4'><b>Total Harga</b></td>"
            . " <td><b>" . $totHarga . "</b></td>"
            . "</tr>";
            echo "</table>";
            echo "<center><button><a href='pesanan.php?no_transaksi=" . $dt["no_transaksi"] . "'>ACCEPT</a></button><br><br></center>";
            echo "<hr/>";
        }
    }
} else {
    echo "<h2 align='center'>Tidak ada pesanan</h2>";
}

function findTransaksiByToko($idToko) {
    $dTransaksi = BDB::findAllByFields("d_transaksi", ["toko.id_toko" => $idToko], "GROUP BY no_transaksi", 0);
    $transaksi = null;
    if ($dTransaksi != null) {
        foreach ($dTransaksi as $dt) {
            $temp = BDB::findAllByFields("transaksi", ["no_transaksi" => $dt["no_transaksi"], "status_transaksi" => "Belum diterima"]);
            if ($temp != null)
                $transaksi[] = $temp[0];
        }
    }
    return $transaksi;
}

// =========================================== AKSI ============================================================

if (isset($_GET["no_transaksi"])) {
    $dTransaksi = BDB::findAllByFields("d_transaksi", ["no_transaksi" => $_GET["no_transaksi"]], "", 1);
    BDB::beginTransaction();
    foreach ($dTransaksi as $dt) {
        $produk = BDB::findByPk("produk", $dt["id_produk"], 0);
        if ($produk["stok"] < $dt["quantity"]) {
            BDB::rollBackTransaction();
            header("Location:pesanan.php?id_produk=" . $dt["id_produk"]);
        } else {
            $data["stok"] = $produk["stok"] - $dt["quantity"];
            BDB::update("produk", $data, $produk["id_produk"]);
        }
    }
    BDB::update("transaksi", ["status_transaksi" => "Diterima"], $_GET["no_transaksi"]);
    BDB::commitTransaction();
    header("Location:berandaToko.php");
}
?>