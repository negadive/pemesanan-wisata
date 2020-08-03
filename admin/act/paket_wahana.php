<?php
    include "../../koneksi.php";
    $db = new database();
    $con = $db->mysqli;

    if( isset($_POST["tambah-paketwahana"]) ){

        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES["gambar"];
        $file_name = $gambar["name"];
        $file_tmp = $gambar["tmp_name"];
        $new_path = "../../assets/images/$file_name";

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

        $id = $_POST["edit_id"];
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];

        $query = "UPDATE paketwahana SET nama='$nama', harga='$harga', deskripsi='$deskripsi' WHERE id=$id";
        $paketwahana = $con->query($query);
        if($paketwahana){
            $con->close();
            header('Location: ../paket_wahana.php?r=200&action=edit');
        }else{
            header('Location: ../paket_wahana.php?r=400&action=edit');
        }


    }else if( isset($_POST["upload-paketwahana"]) ){

        $id = $_POST["edit_id"];
        $query_gambar = "";
        $gambar = $_FILES["gambar"];

        if(!$gambar["error"]){

            $file_name = $gambar["name"];
            $file_tmp = $gambar["tmp_name"];
            $new_path = "../../assets/images/$file_name";

            $query = "UPDATE paketwahana SET gambar='$file_name' WHERE id=$id";
            $paketwahana = $con->query($query);
            if($paketwahana){
                if(!$gambar["error"]){
                    $q = move_uploaded_file($file_tmp, $new_path);
                }
                $con->close();
                header('Location: ../paket_wahana.php?r=200&action=upload');
            }
        }
        header('Location: ../paket_wahana.php?r=400&action=upload');


    }else if( isset($_POST["match-paketwahana"]) ){

        $id = $_POST["edit_id"];
        $wahana_ids = $_POST["wahana"];

        $con->begin_transaction();
        try {
            //code...
            $delete = $con->query("DELETE FROM matchpw WHERE paketwahana_id=$id");
            foreach($wahana_ids as $wahana_id){

                $insert = $con->query("INSERT INTO matchpw (wahana_id, paketwahana_id) VALUES ($wahana_id, $id)");
            }

            $con->commit();
            $con->close();
            header('Location: ../paket_wahana.php?r=200&action=match');
        } catch (Exception $th) {
            //throw $th;
            $con->rollback();
            header('Location: ../paket_wahana.php?r=400&action=match');
        }


    }else if( isset($_GET["del"]) ){

        $id = $_GET["del"];

        $query = "DELETE FROM paketwahana WHERE id=$id";
        $paketwahana = $con->query($query);

        $con->close();
        header('Location: ../paket_wahana.php?r=200&action=hapus');
    }
?>