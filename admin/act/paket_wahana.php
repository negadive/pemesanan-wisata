
<?php
    include "../../koneksi.php";
    $db = new database();
    $con = $db->mysqli;
    // $con = $db->mysqli;
    if( isset($_POST["tambah-paketwahana"]) ){
        echo var_dump($_POST);
        echo var_dump($_FILES);

        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../images/$file_name";


        $query = "INSERT INTO paketwahana (nama, harga, deskripsi, gambar) VALUES ('$nama', '$harga', '$deskripsi', '$file_name')";
        $paketwahana = $con->query($query);
        if($paketwahana){
            $q = move_uploaded_file($file_tmp, $new_path);
            if($q){
                $con->close();
                header('Location: ../paket_wahana.php?r=200&action=tambah');
            }
        }


    }else if( isset($_POST["edit-paketwahana"]) ){
        echo var_dump($_FILES);
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../images/$file_name";

        $query = "UPDATE paketwahana SET nama='$nama', harga='$harga', deskripsi='$deskripsi', gambar='$file_name' WHERE id=$id";
        $paketwahana = $con->query($query);
        if($paketwahana){
            if($gambar){
                $q = move_uploaded_file($file_tmp, $new_path);
            }
            $con->close();
            header('Location: ../paket_wahana.php?r=200&action=edit');
        }

    }else if( isset($_GET["del"]) ){
        $id = $_GET["del"];

        $query = "DELETE FROM paketwahana WHERE id=$id";
        $paketwahana = $con->query($query);

        $con->close();
        header('Location: ../paket_wahana.php?r=200&action=hapus');
    }
?>