<?php
    session_start();
    include "../../koneksi.php";
    $db = new database();
    $con = $db->mysqli;

    if( isset($_POST["konfirmasi-transaksi"]) ){

        $id = $_POST["id"];

        $query = "UPDATE transaksi SET status=1 WHERE id=$id";
        $bayar = $con->query($query);
        if($bayar){

            $con->close();
            header('Location: ../transaksi.php?r=200&action=konfirmasi');
        }else

            echo $con->error;


    }
?>