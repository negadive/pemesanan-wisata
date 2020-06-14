<?php
class database{

	var $host = "127.0.0.1";
	var $uname = "admin";
	var $pass = "admin";
    var $db = "wisata";

    var $mysqli = null;

	function __construct(){
        $this->mysqli = new mysqli($this->host, $this->uname, $this->pass, $this->db);		// mysql_select_db($this->db);
        // Check connection
        if (mysqli_connect_errno()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

	// function tampil_data(){
	// 	$data = mysql_query("select * from user");
	// 	while($d = mysql_fetch_array($data)){
	// 		$hasil[] = $d;
	// 	}
	// 	return $hasil;
	// }
}

?>