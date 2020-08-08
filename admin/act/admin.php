
<?php
include "../../koneksi.php";
include "../../model/admin.php";
$db = new database();
$con = $db->mysqli;

if (isset($_POST["tambah-admin"])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $con->query("INSERT INTO admin (username, password, name) VALUES ('$username', md5('$password'), '$nama')");
    if ($query) {
        $con->close();
        header('Location: ../admin.php?r=200&action=tambah');
    } else {
        echo $con->error;
        $con->close();
        header('Location: ../admin.php?r=400&action=tambah&msg=' . $con->error);
    }
} else if (isset($_POST["edit-admin"])) {

    $id = $_POST["edit_id"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $password_query = ($password == "") ? "" : ", password=md5('$password')";

    $query = "UPDATE admin SET username='$username', name='$nama' $password_query WHERE idadmin=$id";
    echo $query;
    $query = $con->query($query);
    if ($query) {
        $con->close();
        header('Location: ../admin.php?r=200&action=edit');
    }
    echo $con->error;
    $con->close();
    // header('Location: ../admin.php?r=400&action=edit&msg='.$con->error);

} else if (isset($_GET["del"])) {
    $id = $_GET["del"];

    $query = "DELETE FROM admin WHERE idadmin=$id";
    $admin = $con->query($query);
    if ($admin) {
        $con->close();
        header('Location: ../admin.php?r=200&action=hapus');
    } else {
        echo $con->error;
        // header('Location: ../admin.php?r=400&action=hapus');
    }
}
?>