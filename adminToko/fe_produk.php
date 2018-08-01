<?php
require_once '../BDB/BDB.php';
require_once '../myfunction/tampilan.php';
headerToko();
$produk = BDB::findByPk("produk", $_GET["id"], 0);
?>
<h1 align='center'>Input Produk</h1>
<form action="" method="post">
    <table align='center'>
        <tr>
            <td>Nama Produk</td>
            <td>:</td>
            <td><input type="text" name="nama_produk" value="<?php echo $produk["nama_produk"]?>"></td>
        </tr>
        <tr>
            <td>Jenis Produk</td>
            <td>:</td>
            <td>
                <select name="jenis_produk">
                    <option>Makanan</option>
                    <option <?php if($produk["jenis_produk"]=="Minuman") echo 'selected';?>>Minuman</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>
                <textarea name="diskripsi"><?php echo $produk["diskripsi"]?></textarea>
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><input type="text" name="harga" value="<?php echo $produk["harga"]?>"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td>:</td>
            <td><input type="text" name="stok" value="<?php echo $produk["stok"]?>"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><input type="submit" name="submit" value="EDIT"></td>
        </tr>
    </table>
</form>

<?php //================================= AKSI ===================================
if(isset($_POST["submit"])){
    $data = $_POST;
    if (BDB::update("produk", $data, $produk["id_produk"])){
        header("Location:berandaToko.php");
    } else {
        echo "<h3 align='center'>Gagal input<h3>";
    }
}
