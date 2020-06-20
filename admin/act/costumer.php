
<?php
    include "../../koneksi.php";
    include "../../model/costumer.php";
    $db = new database();
    $con = $db->mysqli;

    echo var_dump($_POST);
    if( isset($_POST["tambah-costumer"]) ){
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $no_hp = $_POST["no_hp"];
        $alamat = $_POST["alamat"];

        $query = Costumer::insert($con, $nama, $email, $password, $gender, $no_hp, $alamat);

        $con->close();
        if($query){
            header('Location: ../costumer.php?r=200&action=tambah');
        }
    }else if( isset($_POST["edit-costumer"]) ){

        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $no_hp = $_POST["no_hp"];
        $alamat = $_POST["alamat"];

        $query = Costumer::edit($con, $id, $nama, $email, $password, $gender, $no_hp, $alamat);
        if($query){
            $con->close();
            header('Location: ../costumer.php?r=200&action=edit');
        }

    }else if( isset($_GET["del"]) ){
        $id = $_GET["del"];

        $query = "DELETE FROM costumer WHERE id=$id";
        $costumer = $con->query($query);

        $con->close();
        header('Location: ../costumer.php?r=200&action=hapus');
    }
?>