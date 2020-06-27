<?php
  include "../koneksi.php";
  $db = new database();
  $con = $db->mysqli;


  $query = "SELECT *, tr.id as tr_id FROM wisata.transaksi tr join wisata.wahana wh ON tr.id_layanan=wh.id WHERE jenis_layanan='W' and tr.id=".$_GET["id"]."
  UNION
  SELECT *, tr.id as tr_id FROM wisata.transaksi tr join wisata.paketwahana pw ON tr.id_layanan=pw.id WHERE jenis_layanan='P' and tr.id=".$_GET["id"];
  $query = $con->query($query);
  $tr = $query->fetch_array(MYSQLI_ASSOC);
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


    <div class="row invoice-info">
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        To
        <address>
        <?php
          $query = "SELECT * FROM costumer WHERE id=".$tr["id_costumer"];
          $query = $con->query($query);
          $cos = $query->fetch_array(MYSQLI_ASSOC);

          echo "
          <strong>".$cos['nama']."</strong><br>
          ".$cos['alamat']."<br>
          ".$cos['no_hp']."<br>
          ".$cos['email'];

        ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
      <?php
        echo "
        <b>Order ID:</b> ".$tr["tr_id"];
      ?>
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
            <th>Product</th>
            <th>QTY</th>
            <th>Harga</th>
          </tr>
          </thead>
          <tbody>
            <?php
            include "../model/transaksi.php";

                echo "
                  <tr>
                    <td>".$tr["tgl_bayar"]."</td>
                    <td>".$tr["nama"]."</td>
                    <td>".$tr["total"]."</td>
                    <td>".$tr["harga"]."</td>
                  </tr>
                ";
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
            <th width="79.5%">
              Total
            </th>
            <th>
            <?php
              echo $tr["total"]*$tr["harga"];
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
