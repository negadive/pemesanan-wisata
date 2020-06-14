<?php
session_start();
include "../../koneksi.php";
include "model/admin.php";
$db = new database();
$con = $db->mysqli;

$username = $_POST["username"];
$password = $_POST["password"];

$admin = admin::with_username($con, $username);
if($admin->name){
    if($admin->password){
        $_SESSION["name"] = $admin->name;
        $_SESSION["role"] = $admin->role;

        header('Location: ../index.php');
    }else{
        header('Location: ../login.php?r=400');
    }
}else{
    header('Location: ../login.php?r=404');
}

$con->close()

?>