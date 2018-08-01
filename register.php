<?php
    require_once "BDB/BDB.php";
    require_once "myfunction/tampilan.php";
    require_once "myfunction/noAuto.php";
    headerHalaman();
?>
<h1 align='center'>REGISTER</h1>
<form action="" method="post">
    <table align='center'>
        <tr><td>Nama</td><td><input type="text" name="nama_pembeli"></td></tr>
        <tr><td>Provinsis</td><td><input type="text" name="provinsi"></td></tr>
        <tr><td>Kota</td><td><input type="text" name="kota"></td></tr>
        <tr><td>Alamat</td><td><textarea name="alamat"></textarea></td></tr>
        <tr><td>Telp</td><td><input type="text" name="telp"></td></tr>
        <tr><td>Email</td><td><input type="email" name="email"></td></tr>
        <tr><td>Password</td><td><input type="password" name="password"></td></tr>
        <tr><td></td><td><input type="submit" name="submit" value="SUBMIT"></td></tr>
    </table>
</form>

<?php // ======================== AKSI ============================
    if(isset($_POST['submit'])){
        $data = $_POST;
        $data["id_pembeli"] = noPembeliAuto();
        if (BDB::insert("pembeli", $data)){
            $_SESSION['id_pembeli'] = $data["id_pembeli"]; 
            header("Location:index.php");
        } else {
            echo "<h2 align='center'>Gagal register ...</h2>";
        }
    }
?>