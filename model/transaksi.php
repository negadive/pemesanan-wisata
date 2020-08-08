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

        $query = $con->query("SELECT *, tr.id AS tr_id FROM transaksi AS tr JOIN wahana ON tr.id_layanan=wahana.id WHERE $id tr.jenis_layanan='W'");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        $query = $con->query("SELECT *, tr.id AS tr_id FROM transaksi AS tr JOIN paketwahana ON tr.id_layanan=paketwahana.id WHERE $id tr.jenis_layanan='P'");
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }

        return $hasil;
    }

    public static function laporan($con, $awal=null, $akhir=null){

        if(($awal != null) and ($akhir != null)){
            $w_query = "and (tr.tgl_bayar BETWEEN '$awal' AND '$akhir')";
        }else
            $w_query = "";

        $customer_join_q = " JOIN costumer AS c ON tr.id_costumer=c.id ";

        $query_str = "SELECT *, tr.id AS tr_id, c.nama AS nama_c, w.nama AS nama_w
                      FROM transaksi AS tr
                      JOIN wahana AS w ON tr.id_layanan=w.id
                      $customer_join_q
                      WHERE tr.jenis_layanan='W' $w_query";
        $query = $con->query($query_str);
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }
        $query_str = "SELECT *, tr.id AS tr_id, c.nama AS nama_c, w.nama AS nama_w
                      FROM transaksi AS tr
                      JOIN paketwahana AS w ON tr.id_layanan=w.id
                      $customer_join_q
                      WHERE tr.jenis_layanan='P' $w_query";
        $query = $con->query($query_str);
        while($d = $query->fetch_array(MYSQLI_ASSOC)){
            $hasil[] = $d;
        }

        return $hasil;
    }

    public static function total($con, $awal=null, $akhir=null){
        if($awal != null and $akhir != null){
            $w_query = "and tgl_bayar between '$awal' and '$akhir'";
        }else{
            $w_query = "";
        }
        $hasil = 0;
        $query_str = "SELECT sum(total*harga) AS total_ FROM transaksi AS tr JOIN wahana ON tr.id_layanan=wahana.id WHERE status=1 and tr.jenis_layanan='W' $w_query";
        $query = $con->query($query_str);
        $d = $query->fetch_array(MYSQLI_ASSOC);
        $hasil += $d["total_"];

        $query_str = "SELECT sum(total*harga) AS total_ FROM transaksi AS tr JOIN paketwahana ON tr.id_layanan=paketwahana.id WHERE status=1 and tr.jenis_layanan='P' $w_query";
        $query = $con->query($query_str);
        $d = $query->fetch_array(MYSQLI_ASSOC);
        $hasil += $d["total_"];

        return $query ? $hasil : 0;
    }
}
