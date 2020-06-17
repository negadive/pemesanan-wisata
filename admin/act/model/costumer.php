<?php
class Costumer{

    public $nama;
    public $email;
    public $password;
    public $gender;
    public $no_hp;
    public $alamat;

    function __construct($nama, $deskripsi, $harga ,$gambar){
        $this->nama = $nama;
        $this->deskripsi = $deskripsi;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    public static function  insert($con, $nama, $email, $password, $gender, $no_hp, $alamat){
        $query = $con->query("INSERT INTO costumer (nama, email, password, gender, no_hp, alamat)
            VALUES ('$nama', '$email', 'md5($password)', '$gender', '$no_hp', '$alamat')");

        return $query;
    }

    public static function  edit($con, $id, $nama, $email, $password, $gender, $no_hp, $alamat){
        $query = $con->query("UPDATE costumer (nama, email, password, gender, no_hp, alamat)
            VALUES ('$nama', '$email', '$password', '$gender', '$no_hp', '$alamat') WHERE id=$id");

        return $query;
    }

    public static function read($con){
        $query = $con->query("SELECT * FROM costumer");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        return $hasil;
    }

}


?>