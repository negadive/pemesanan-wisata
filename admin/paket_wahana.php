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
include "../model/paket_wahana.php";
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <h1>Paket Wahana</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Paket Wahana</li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                  Tambah Paket Wahana
                </button>
                <div class="card-header">
                  <h3 class="card-title">Daftar Paket Wahana</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 text-center">
                      <i class="fas fa-edit text-primary" aria-hidden="true"></i> Edit
                    </div>
                    <div class="col-6 text-center">
                      <i class="fas fa-trash-alt text-danger" aria-hidden="true"></i> Hapus
                    </div>
                  </div>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th colspan="2">Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $wahana_list = PaketWahana::read($con);
                      foreach ($wahana_list as $data) {
                        $gambar_path = $data["gambar"] ? "../assets/images/" . $data["gambar"] : "";
                        echo "
                        <tr>
                          <td><img src='$gambar_path' width='20'/></td>
                          <td>" . $data["nama"] . "</td>
                          <td>" . $data["deskripsi"] . "</td>
                          <td>" . $data["harga"] . "</td>
                          <td onclick='editData(" . json_encode($data) . ")'><i class='fas fa-edit text-primary'></i></td>
                          <td onclick='hapusData(" . $data["id"] . ")'><i class='fas fa-trash-alt text-danger'></i></td>
                        </tr>
                      ";
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
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


    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Paket Wahana</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="./act/paket_wahana.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Masukkan nama wahana">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Harga</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" name="harga">
                  </div>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Gambar</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" name="tambah-paketwahana" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.modal -->



    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Paket Wahana</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <img src="" id="edit_gambar" width="466">
            </div>
            <form role="form" action="./act/paket_wahana.php" method="post" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="edit_id">
              <div class="form-group">
                <label for="exampleInputFile">Gambar</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <button type="submit" name="upload-paketwahana" class="input-group-text">Upload</button>
                  </div>
                </div>
              </div>
            </form>

            <form role="form" action="./act/paket_wahana.php" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Masukkan nama wahana">
                  <input type="hidden" class="form-control" name="edit_id">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Harga</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" name="harga" id="edit_harga">
                  </div>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" id="edit_desk" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <button type="submit" name="edit-paketwahana" class="btn btn-primary">Edit</button>
              </div>
            </form>
            <hr>
            <form role="form" action="./act/paket_wahana.php" method="post">
              <div class="card-body">
                <input type="hidden" class="form-control" name="edit_id">
                <div class="form-group">
                  <label>Wahana dalam paket</label>
                  <div class="select2-purple">
                    <select class="select2" name="wahana[]" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                      <?php
                      include "../model/wahana.php";
                      $wahana = Wahana::read($con);
                      foreach ($wahana as $data) {
                        echo "<option name='opt_w' value='" . $data["id"] . "' >" . $data["nama"] . " </option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <button type="submit" name="match-paketwahana" class="btn btn-primary">Tambah wahana</button>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
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

    function editData(item) {
      console.log(item)
      $('#modal-edit').modal('show');
      $('#edit_gambar').attr("src", "../assets/images/" + item.gambar)
      $('#edit_nama').val(item.nama)
      $('[name="edit_id"]').val(item.id)
      $('#edit_desk').val(item.deskripsi)
      $('#edit_harga').val(item.harga)
      $('option[name="opt_w"').removeAttr('selected')
      $.each(item.wahana, function(key, value) {
        $('option[name="opt_w"][value="' + value.id + '"]').attr('selected', '')
      });

      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }

    $(function() {

      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })


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

      $("#example2").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });


    function hapusData(id) {
      var result = confirm('Apa kamu yakin ingin menghapus')
      if (result) {
        window.location.href = "./act/paket_wahana.php?del=" + id
      }
    }
  </script>
</body>

</html>