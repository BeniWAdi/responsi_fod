<?php

function displayProduk(array $produk) {
    echo "<center><table border='1'>"
    . "<tr>"
    . "<th colspan='2'><strong>" . $produk["nama_produk"] . "</strong></th>"
    . "</tr>"
    . "<tr>"
    . "<td><a href='toko.php?id=" . $produk["toko"]["id_toko"] . "'>" . $produk["toko"]["nama_toko"] . "</a></td>"
    . "<td>Rp." . $produk["harga"] . "</td>"
    . "</tr>"
    . "<tr>"
    . "<td colspan='2'> <a href='detail.php?id=" . $produk["id_produk"] . "'><button>BELI</button></a>"
    . "</td>"
    . "</tr>"
    . "</table></center><br/>";
}

function headerHalaman() {
    session_start();
    $log = "<a href='login.php'>Login</a>";
    $bar3 = "<a href='registerPembeli.php'>Register<a>";
    if (isset($_SESSION['id_pembeli'])) {
        $pembeli = BDB::findByPk("pembeli", $_SESSION['id_pembeli']);
        $log = "<a href='act/act_logout.php'>Logout ( " . $pembeli["nama_pembeli"] . " )</a>";
        $bar3 = "<a href='keranjang.php'>Keranjang</a>";
    }
    echo "<hr/><center>"
    . "<table>"
    . "<tr>"
    . "<td><a href='index.php'>Beranda</a> | </td>"
    . "<td><a href='cari.php'>Cari Produk</a> | </td>"
    . "<td>" . $bar3 . " | </td>"
    . "<td>" . $log . "</td>"
    . "</tr>"
    . "</table></center><hr/><br/>";
}

function headerToko() {
    session_start();
    $log = "";
    if (isset($_SESSION['id_toko'])) {
        $toko = BDB::findByPk("toko", $_SESSION['id_toko']);
        $log = "<a href='../act/act_logout.php'>Logout ( " . $toko["nama_toko"] . " )</a>";
    } else {
        header('Location:loginToko.php');
    }
    echo "<hr/><center>"
    . "<table>"
    . "<tr>"
    . "<td><a href='berandaToko.php'>Produk</a> | </td>"
    . "<td><a href='pesanan.php'>Pesanan</a> | </td>"
    . "<td>" . $log . "</td>"
    . "</tr>"
    . "</table></center><hr/><br/>";
}