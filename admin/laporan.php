<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<?php
require "../koneksi.php";
include "../model/transaksi.php";
$db = new database();
$con = $db->mysqli;
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <?php
    include "sidebar.php"
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Laporan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <a href="cetak-laporan.php?awal=<?php echo $_GET["awal"]; ?>&akhir=<?php echo $_GET["akhir"]; ?>" class="btn btn-primary">
                  Cetak Laporan
                </a>
                <div class="card-header">
                  <h3 class="card-title">Laporan Pembelian</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  Periode :
                  <form>
                    <input type="date" name="awal" <?php if (isset($_GET["awal"])) {
                                                      echo "value='" . $_GET["awal"] . "'";
                                                    } ?>>
                    s/d
                    <input type="date" name="akhir" <?php if (isset($_GET["akhir"])) {
                                                      echo "value='" . $_GET["akhir"] . "'";
                                                    } ?>>
                    <input type="submit" name="submit_periode">
                  </form>
                  <table id="example2" class="table table-bordered table-hover">
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
                      $wahana_list = Transaksi::laporan($con, $_GET["awal"], $_GET["akhir"]);
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
                    <tfoot>
                      <tr>
                        <th colspan="5">Total</th>
                        <th>
                          <?php
                          if (isset($_GET["awal"]) & isset($_GET["akhir"]))
                            echo Transaksi::total($con, $_GET["awal"], $_GET["akhir"]);
                          else
                            echo Transaksi::total($con);
                          ?>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
      }
    };

    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      var response = getUrlParameter('r')
      if (response == '200') {
        var action = getUrlParameter('action')
        Toast.fire({
          icon: 'success',
          title: 'Wahana berhasil di' + action
        })
      }

      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    function editData(item) {
      console.log(item)
      $('#modal-edit').modal('show');
      $('#edit_gambar').attr("src", "../assets/images/" + item.gambar)
      $('#edit_nama').val(item.nama)
      $('#edit_id').val(item.id)
      $('#edit_desk').val(item.deskripsi)
      $('#edit_harga').val(item.harga)
    }

    function hapusData(id) {
      var result = confirm('Apa kamu yakin ingin menghapus')
      if (result) {
        window.location.href = "./act/paket_wahana.php?del=" + id
      }
    }
  </script>
</body>

</html>