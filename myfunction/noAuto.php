<?php

function noPembeliAuto() {
    $date_now = "" . date("Y/m/d");
    $id_depan = "P" . substr($date_now, 2, 2) . substr($date_now, 5, 2) . substr($date_now, -2);
    $pembeli = BDB::findAll("pembeli", "ORDER BY id_pembeli DESC");
    $temp = "0000000000";
    if ($pembeli != null)
        $temp = $pembeli[0]["id_pembeli"];
    if ($id_depan != substr(0, 7)) {
        return $id_depan . "001";
    } else {
        $id_akhir = intval(substr($temp, -3)) + 1;
        if ($id_akhir < 10) {
            return $id_depan . "00$id_akhir";
        } elseif ($id_akhir < 100) {
            return $id_depan . "0$id_akhir";
        } else {
            return $id_depan . $id_akhir;
        }
    }
}

function noTokoAuto() {
    $date_now = "" . date("Y/m/d");
    $id_depan = "T" . substr($date_now, 2, 2) . substr($date_now, 5, 2);
    $toko = BDB::findAll("toko", "ORDER BY id_toko DESC");
    $temp = "0000000000";
    if ($toko != null)
        $temp = $toko[0]["id_toko"];
    if ($id_depan != substr($temp, 0, 5)) {
        return $id_depan . "001";
    } else {
        $id_akhir = intval(substr($temp, -3)) + 1;
        if ($id_akhir < 10) {
            return $id_depan . "00$id_akhir";
        } elseif ($id_akhir < 100) {
            return $id_depan . "0$id_akhir";
        } else {
            return $id_depan . $id_akhir;
        }
    }
}

function noProdukAuto($idToko) {
    $produk = BDB::findAllByFields("produk", ["id_toko" => $idToko], "ORDER BY id_produk DESC", 0);
    $temp = "0000000000";
    if ($produk != null)
        $temp = $produk[0]["id_produk"];
    $idDepan = "M" . substr($idToko, -7);
    $idBelakang = intval(substr($temp, -2)) + 1;
    if ($idBelakang < 10) {
        return $idDepan . "0" . $idBelakang;
    } else {
        return $idDepan . $idBelakang;
    }
}

function noTransaksiAuto() {
    $date_now = "" . date("Y/m/d");
    $id_depan = "NT" . substr($date_now, 2, 2) . substr($date_now, 5, 2) . substr($date_now, -2);
    $transaksi = BDB::findAll("transaksi", "ORDER BY no_transaksi DESC", 0);
    $temp = "000000000000";
    if ($transaksi != null)
        $temp = $transaksi[0]["no_transaksi"];
    if ($id_depan != substr($temp, 0, 8)) {
        return $id_depan . "0001";
    } else {
        $id_akhir = intval(substr($temp, -3)) + 1;
        if ($id_akhir < 10) {
            return $id_depan . "000$id_akhir";
        } elseif ($id_akhir < 100) {
            return $id_depan . "00$id_akhir";
        } elseif ($id_akhir < 1000) {
            return $id_depan . "0$id_akhir";
        } else {
            return $id_depan . "" . $id_akhir;
        }
    }
}
