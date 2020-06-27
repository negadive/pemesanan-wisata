<?php
  session_start();
  if(!isset($_SESSION["admin"])){
    header("Location: login.php");
  }
  ?>
<!DOCTYPE html>
<html>
<head>
  <?php
    require "../koneksi.php";
    include "../model/transaksi.php";
    $db = new database();
    $con = $db->mysqli;
  ?>
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
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
              <div class="card-header">
                <h3 class="card-title">Daftar Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p>
                  <div class="row">
                    <div class="col-6 text-center">
                      <i class="fa fa-check text-success" aria-hidden="true"></i> Konfirmasi
                    </div>
                    <div class="col-6 text-center">
                      <i class="fas fa-times text-danger" aria-hidden="true"></i> Tolak
                    </div>
                  </div>
                </p>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th colspan="2">Nama</th>
                      <th>Deskripsi</th>
                      <th>Tanggal</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $wahana_list = Transaksi::read($con);
                      foreach($wahana_list as $data) {
                        if( ($data["tgl_pemesanan"]>=date("Y-m-d")) & (isset($data["foto_bukti"]) & ($data["status"]) == '0')){
                          echo "
                            <tr>
                              <td>".$data["tr_id"]."</td>
                              <td><img src='../assets/images/".$data["gambar"]."' width='20'/></td>
                              <td>".$data["nama"]."</td>
                              <td>".$data["deskripsi"]."</td>
                              <td>".$data["tgl_pemesanan"]."</td>
                              <td class='text-right'>Rp ".$data["harga"]."</td>
                              <td>".$data["total"]."</td>
                              <td class='text-right'>Rp ".$data["total"]*$data["harga"]."</td>
                              <td onclick='bayar(".json_encode($data).")'>
                                <i class='fa fa-check text-success' aria-hidden='true'></i>
                              </td>
                              <td onclick='tolakBayar(".$data["tr_id"].")'>
                                <i class='fas fa-times text-danger' aria-hidden='true'></i>
                              </td>
                            </tr>
                          ";
                        }
                      }
                      // $con->close();
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th colspan="2">Nama</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th colspan="2">Action</th>
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

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Riwayat Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p>
                <div class="row">
                  <div class="col-4 text-center"><i class="fa fa-check text-success" aria-hidden="true"></i> Lunas</div>
                  <div class="col-4 text-center"><i class="fa fa-spinner" aria-hidden="true"></i> Menunggu pembayaran</div>
                  <div class="col-4 text-center"><i class="fas fa-times text-danger" aria-hidden="true"></i> Gagal</div>
                </div>
                </p>
                <table id="riwayat" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th colspan="2">Nama</th>
                      <th>Deskripsi</th>
                      <th>Tanggal</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $wahana_list = Transaksi::read($con);
                      foreach($wahana_list as $data) {
                          if($data["status"] == '0' & $data["foto_bukti"] != null){
                            continue;
                          }
                          if(($data["tgl_pemesanan"]<date("Y-m-d") & $data["status"] == '0')| $data["status"] == '-1'){
                              $ket = '<i class="fas fa-times text-danger" aria-hidden="true"></i>';
                          }else if($data["status"] == '1'){
                              $ket = '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                          }else if($data["status"] == '0'){
                              $ket = '<i class="fa fa-spinner" aria-hidden="true"></i>';
                          }
                          echo "
                              <tr>
                                <td>".$data["tr_id"]."</td>
                                <td><img src='../assets/images/".$data["gambar"]."' width='20'/></td>
                                <td>".$data["nama"]."</td>
                                <td>".$data["deskripsi"]."</td>
                                <td>".$data["tgl_pemesanan"]."</td>
                                <td class='text-right'>Rp ".$data["harga"]."</td>
                                <td>".$data["total"]."</td>
                                <td class='text-right'>Rp ".$data["total"]*$data["harga"]."</td>
                                <td>$ket</td>
                              </tr>
                          ";
                      }
                      // $con->close();
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th colspan="2">Nama</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>

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

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi Transaksi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <img src="" id="edit_gambar" width="466">
              </div>
              <form role="form" action="./act/transaksi.php" id="konfirmasi-transaksi" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" name="nama" id="bayar_nama" readonly placeholder="Masukkan nama wahana">
                      <input type="hidden" class="form-control" name="id" id="bayar_id">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="harga" id="bayar_harga" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" id="bayar_desk" readonly rows="3" placeholder="Enter ..."></textarea>
                    </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="konfirmasi-transaksi" form="konfirmasi-transaksi" class="btn btn-primary">Konfirmasi</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /.modal -->


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

  $(function () {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var response = getUrlParameter('r')
    if(response == '200'){
      var action = getUrlParameter('action')
      Toast.fire({
        icon: 'success',
        title: 'Wahana berhasil di'+action
      })
    }

    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
      "searching": false
    });
    $("#riwayat").DataTable({
      // "responsive": true,
      // "autoWidth": false,
      // "searching": false
    });
  });

  function bayar(item){
      console.log(item)
      $('#modal-edit').modal('show');
      $('#edit_gambar').attr("src", "../assets/images/"+item.foto_bukti)
      $('#bayar_nama').val(item.nama)
      $('#bayar_id').val(item.tr_id)
      $('#bayar_desk').val(item.deskripsi)
      $('#bayar_harga').val(item.harga)
  }

  function tolakBayar(id){
      var result = confirm('Apa kamu yakin ingin menolak pembayaran?')
      if(result){
          window.location.href = "./act/transaksi.php?dec="+id
      }
  }

</script>
</body>
</html>
