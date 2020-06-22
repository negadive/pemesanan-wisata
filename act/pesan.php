<?php
session_start();
include "../koneksi.php";
include "../admin/act/model/wahana.php";
include "../admin/act/model/costumer.php";
$db = new database();
$con = $db->mysqli;


if($_SESSION["user"]){
    list($jenis_layanan, $id_wahana) = explode("-", $_POST["pesan_wahana"]);
    $tgl = date('Y-m-d', strtotime($_POST["tgl_pesan"]));
    $total = $_POST["jum_tiket"];

    $id_costumer = $_SESSION["user"]["id"];

    $tabel = $jenis_layanan == "P" ? "paketwahana" : "wahana";

    $query = "INSERT INTO transaksi (id_costumer, id_layanan, jenis_layanan, tgl_pemesanan, tgl_transaksi, total) VALUES ($id_costumer, $id_wahana, '$jenis_layanan', '$tgl', now(), $total)";
    echo $query;
    $transaksi = $con->query($query);
    if($transaksi){
        $con->close();
        header('Location: ../index.php?r=200');
    }else{
        echo $con->error;
    }
}else{
    header('Location: ../index.php?r=404');
}



?>