<?php
require_once '../BDB/BDB.php';
require_once '../myfunction/tampilan.php';
require_once '../myfunction/noAuto.php';
headerToko();
?>
<h1 align='center'>Input Produk</h1>
<form action="" method="post">
    <table align='center'>
        <tr>
            <td>Nama Produk</td>
            <td>:</td>
            <td><input type="text" name="nama_produk"></td>
        </tr>
        <tr>
            <td>Jenis Produk</td>
            <td>:</td>
            <td>
                <select name="jenis_produk">
                    <option>Makanan</option>
                    <option>Minuman</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>
                <textarea name="diskripsi"></textarea>
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><input type="text" name="harga"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td>:</td>
            <td><input type="text" name="stok"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><input type="submit" name="submit" value="Simpan"></td>
        </tr>
    </table>
</form>

<?php //================================= AKSI ===================================
if(isset($_POST["submit"])){
    $data = $_POST;
    $data["id_toko"] = $_SESSION["id_toko"];
    $data["id_produk"] = noProdukAuto($_SESSION["id_toko"]);
    if (BDB::insert("produk", $data)){
        header("Location:berandaToko.php");
    } else {
        echo "<h3 align='center'>Gagal input<h3>";
    }
}
