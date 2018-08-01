<?php
require_once 'BDB/BDB.php';
require_once 'myfunction/tampilan.php';
$detId = "";
if (isset($_GET['detId']))
    $detId = $_GET['detId'];
headerHalaman();
?>
<h1 align='center'>LOGIN</h1>
<form action="" method="post">
    <center>
        <input type="email" placeholder="email" name="email"><br/>
        <input type="password" placeholder="password" name="password"><br/>
        <input name="submit" type="submit" value="LOGIN">
    </center>
</form>
<center>
<?php if (isset($_GET['s'])) echo "Password/Email Salah"; ?>
    <br/><br/>
    <a href="register.php">Daftar</a><br/><hr/>
    <a href="adminToko/daftarToko.php">Buka Toko</a>
    <a href="adminToko/loginToko.php">Login Toko</a>
    <div id="com"></div>
</center>

<?php
// ============================== AKSI ==============================
if (isset($_POST["submit"])) {
    $data["email"] = $_POST['email'];
    $data["password"] = $_POST['password'];
    $pembeli = BDB::findAllByFields("pembeli", $data);
    if ($pembeli != null) {
        $_SESSION['id_pembeli'] = $pembeli[0]["id_pembeli"];
        if ($_GET['detId'] != "") {
            header('Location:detail.php?id=' . $_GET['detId']);
        } else {
            header('Location:index.php');
        }
    } else {
        if (isset($_GET['detId'])) {
            header("Location:login.php?detId=" . $_GET['detId'] . "&s=0");
        } else {
            header('Location:login.php?&s=0');
        }
    }
}