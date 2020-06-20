<?php
session_start();
include "../koneksi.php";
include "../admin/act/model/costumer.php";
$db = new database();
$con = $db->mysqli;


$email = $_POST["email"];
$password = $_POST["password"];


$user = Costumer::login($con, $email, $password);
if( $user ){
    $_SESSION["user"]["id"] = $user["id"];
    $_SESSION["user"]["nama"] = $user["nama"];

    header('Location: index.php');
}
header('Location: ../index.php?r=404');

$con->close();


?>