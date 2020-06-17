
<?php
    include "../../koneksi.php";
    $db = new database();
    $con = $db->mysqli;
    // $con = $db->mysqli;
    if( isset($_POST["tambah-wahana"]) ){
        echo var_dump($_POST);
        echo var_dump($_FILES);

        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../images/$file_name";


        $query = "INSERT INTO wahana (nama, harga, deskripsi, gambar) VALUES ('$nama', '$harga', '$deskripsi', '$file_name')";
        $wahana = $con->query($query);
        if($wahana){
            $q = move_uploaded_file($file_tmp, $new_path);
            if($q){
                $con->close();
                header('Location: ../wahana.php?r=200&action=tambah');
            }
        }


    }else if( isset($_POST["edit-wahana"]) ){
        echo var_dump($_FILES);
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../images/$file_name";

        $query = "UPDATE wahana SET nama='$nama', harga='$harga', deskripsi='$deskripsi', gambar='$file_name' WHERE id=$id";
        $wahana = $con->query($query);
        if($wahana){
            $q = move_uploaded_file($file_tmp, $new_path);
            if($q){
                $con->close();
                header('Location: ../wahana.php?r=200&action=edit');
            }
        }

    }else if( isset($_GET["del"]) ){
        $id = $_GET["del"];

        $query = "DELETE FROM wahana WHERE id=$id";
        $wahana = $con->query($query);

        $con->close();
        header('Location: ../wahana.php?r=200&action=hapus');
    }
?>