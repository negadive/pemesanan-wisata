<?php
class Transaksi{

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

    public static function read($con, $user_id=null){
        $id = $user_id==null ? "" : "tr.id_costumer=$user_id and";
        $query = $con->query("SELECT *, tr.id as tr_id FROM transaksi as tr join wahana on tr.id_layanan=wahana.id where $id tr.jenis_layanan='W'");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        $query = $con->query("SELECT *, tr.id as tr_id FROM transaksi as tr join paketwahana on tr.id_layanan=paketwahana.id where $id tr.jenis_layanan='P'");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        return $hasil;
    }
}


?>