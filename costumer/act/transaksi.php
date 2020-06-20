
<?php
    session_start();
    include "../../koneksi.php";
    $db = new database();
    $con = $db->mysqli;

    if( isset($_POST["bayar-transaksi"]) ){

        $nama = $_POST["nama"];
        $id = $_POST["id"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../images/$file_name";


        $query = "UPDATE transaksi SET tgl_bayar=now(), foto_bukti='$file_name', status=0 WHERE id=$id";
        $bayar = $con->query($query);
        if($bayar){

            $q = move_uploaded_file($file_tmp, $new_path);
            if($q){
                $con->close();
                header('Location: ../index.php?r=200&action=bayar');
            }

        }else

            echo $con->error;


    }
?>