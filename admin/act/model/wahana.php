<?php
class Wahana{

    public $nama;
    public $deskripsi;
    public $harga;
    public $gambar;

    var $table_name = "wahana";

    function __construct($nama, $deskripsi, $harga ,$gambar){
        $this->nama = $nama;
        $this->deskripsi = $deskripsi;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    function insert($con){
        $query = $con->query("INSERT INTO $this->table_name (nama, deskripsi, harga, gambar)
            VALUES ('$this->nama', '$this->deskripsi', '$this->harga','$this->gambar')");

        return $query;
    }

    public static function read($con){
        $query = $con->query("SELECT * FROM wahana");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        return $hasil;
    }

}


?>