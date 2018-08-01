<?php
require_once '../BDB/BDB.php';
require_once '../myfunction/tampilan.php';
require_once '../myfunction/tampilan.php';

?>
<hr/>
<h1 align='center'>Daftar Toko</h1>
<hr/><br/>
<form action="" method="post">
    <table align='center'>
        <tr>
            <td>Nama Toko</td>
            <td>:</td>
            <td><input type="text" name="nama_toko"></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>
                <textarea name="diskripsi"></textarea>
            </td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>:</td>
            <td><input type="text" name="provinsi"></td>
        </tr>
        <tr>
            <td>Kota</td>
            <td>:</td>
            <td><input type="text" name="kota"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                <textarea name="alamat"></textarea>
            </td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>:</td>
            <td><input type="text" name="telp"></td>
        </tr>
        <tr>
            <td>email</td>
            <td>:</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><input type="submit" name="submit" value="Simpan"></td>
        </tr>
    </table>
</form>

<?php // =========================== AKSI ===============================

if(isset($_POST['submit'])){
    $data = $_POST;
    $data["id_toko"] = noTokoAuto();
    if (BDB::insert("toko", $data)){
        session_start();
        $_SESSION['id_toko'] = $data["id_toko"];
        header("Location:berandaToko.php");
    } else {
        echo "<br/><h3 align='center'>Gagal Input</h3>";
    }
}
?>