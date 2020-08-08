<?php
session_start();
include "../koneksi.php";
include "../admin/act/model/wahana.php";
include "../admin/act/model/costumer.php";
$db = new database();
$con = $db->mysqli;


if($_SESSION["user"]){
    list($jenis_layanan, $id_wahana) = explode("-", $_POST["pesan_wahana"]);
    $date_format = 'm/d/Y H:i';
    $date_string = $_POST["tgl_pesan"]." ".$_POST["waktu"];

    $tgl = DateTime::createFromFormat($date_format, $date_string);
    $total = $_POST["jum_tiket"];
    $id_costumer = $_SESSION["user"]["id"];
    $tabel = $jenis_layanan == "P" ? "paketwahana" : "wahana";

    $query = "SELECT *
              FROM transaksi
              WHERE (
                  (date(tgl_pemesanan) = '".$tgl->format('Y-m-d')."')
                  AND (hour(tgl_pemesanan) = '".$tgl->format('H')."')
              )
              LIMIT 1";
    $query = $con->query($query);
    $check = $query->num_rows;
    if ($check){
        $con->close();
        $_SESSION["err"] = "Waktu sudah digunakan";
        header('Location: ../index.php?r=400action=waktu');
    }

    $query = "INSERT INTO transaksi (
                                        id_costumer,
                                        id_layanan,
                                        jenis_layanan,
                                        tgl_pemesanan,
                                        tgl_transaksi,
                                        total
                                    )
                      VALUES (
                          $id_costumer,
                          $id_wahana,
                          '$jenis_layanan',
                          '".$tgl->format('Y-m-d H:i:s')."',
                          now(),
                          $total)";

    $transaksi = $con->query($query);
    if($transaksi){
        $con->close();
        header('Location: ../costumer/index.php?r=200');
    }else{
        $con->close();
        header('Location: ../index.php?r=400');
    }
}else{
    header('Location: ../index.php?r=404');
}
