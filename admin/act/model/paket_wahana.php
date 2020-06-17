<?php
class PaketWahana{

    public $nama;
    public $deskripsi;
    public $harga;
    public $gambar;

    var $table_name = "paketwahana";

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
        $query = $con->query("SELECT * FROM paketwahana");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $wahana = $con->query("SELECT wahana.* FROM matchpw JOIN wahana on matchpw.wahana_id=wahana.id where matchpw.paketwahana_id=".$d["id"]);
            while($dd = $wahana->fetch_array(MYSQLI_ASSOC)){
                $d["wahana"][] = $dd;
            }
            $hasil[] = $d;
        }
        return $hasil;
    }

}


?>