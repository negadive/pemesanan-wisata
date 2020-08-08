<?php
include "../koneksi.php";
$db = new database();
$con = $db->mysqli;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <i class="fas fa-globe"></i> AdminLTE, Inc.
            <small class="float-right">Date: <?php echo date("d-m-Y"); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-12">
          <table class="table table-striped" width="100%">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Customer</th>
                <th>Product</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "../model/transaksi.php";
              if (isset($_GET["awal"]) & isset($_GET["akhir"]))
                $wahana_list = Transaksi::laporan($con, $_GET["awal"], $_GET["akhir"]);
              else
                $wahana_list = Transaksi::read($con);
              foreach ($wahana_list as $data) {

                if ($data["status"] == "1") {

                  echo "
                  <tr>
                    <td>" . $data["tgl_bayar"] . "</td>
                    <td>" . $data["nama_c"] . "</td>
                    <td>" . $data["nama_w"] . "</td>
                    <td>" . $data["total"] . "</td>
                    <td>" . $data["harga"] . "</td>
                    <td>" . $data["harga"] * $data["total"] . "</td>
                  </tr>
                ";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <table class="table table-striped" width="100%">
            <tr>
              <th width="76%">
                Total
              </th>
              <th>
                <?php
                if (isset($_GET["awal"]) & isset($_GET["akhir"]))
                  echo Transaksi::total($con, $_GET["awal"], $_GET["akhir"]);
                else
                  echo Transaksi::total($con);
                ?>
              </th>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->

  <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
</body>

</html>