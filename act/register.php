<?php
include "../koneksi.php";

$db = new database();
$con = $db->mysqli;

$email = $_POST["email"];
$nama = $_POST["nama"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$no_hp = $_POST["no_hp"];
$alamat = $_POST["alamat"];
$jen_kel = $_POST["jen_kel"];

$query = "INSERT INTO costumer (nama, email, password, gender, no_hp, alamat) VALUES ('$nama', '$email', md5('$password'), '$jen_kel', '$no_hp', '$alamat')";
$query = $con->query($query);

$con->close();
if($query){
    header('Location: ../index.php?r=200');
}else{
    header('Location: ../index.php?r=400');
}





?>