<?php
include "../../koneksi.php";
include "model/admin.php";

$db = new database();
$con = $db->mysqli;

$username1 = $_POST["username"];
$password1 = $_POST["password1"];
$name = $_POST["name"];

$admin = new admin($username1, $password1, $name, $role);

$query = $admin->insert($con);
if($query){
    echo "s";
}else{
    echo "g".$con->error;
}
$con->close();

header('Location: ../login.php');




?>