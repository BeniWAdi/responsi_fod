<?php 
require_once '../BDB/BDB.php';
?>
<hr/>
<h1 align='center'>Login Toko</h1>
<hr/><br/>
<form action="" method="post">
    <center>		
        <label>Username :</label>
        <input id="name" name="email" placeholder="email" type="text"><br/>
        <label>Password :</label>
        <input id="password" name="password" placeholder="password" type="password"><br/>
        <input type="submit" name="submit" id="submit" value="Login">
    </center>
</form>
<?php
if (isset($_GET['s'])) {
    echo "<h2 align='center'>Email/Password salah</h2>";
}

if (isset($_POST["submit"])){
    $data["email"] = $_POST["email"];
    $data["password"] = $_POST["password"];
    $toko = BDB::findAllByFields("toko", $data);
    if ($toko != null){
        session_start();
        $_SESSION['id_toko'] = $toko[0]["id_toko"];
        header('Location:berandaToko.php');
    } else {
        header('Location:loginToko.php?s=0');
    }
}
?>