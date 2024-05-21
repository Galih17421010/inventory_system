<?php 
$timezone = "Asia/Jakarta";
date_default_timezone_set($timezone);

if (!isset($_SESSION['log'])) {
    header('location:login.php');
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="gambar/<?= $data['gambar']?>" />

  <title><?= $data['nama']?> | <?= $data['singkatan']?></title>
 

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
   <!-- Datatables css-->
  <link href="asset/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="asset/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="asset/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Datatables bs5 CSS  -->
  <link rel="stylesheet" href="asset/plugins/datatables-bs5/css/datatables.min.css">

  <!-- jQuery -->
  <script src="asset/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="asset/dist/js/adminlte.js"></script>
  <!-- Datatables -->
  <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="asset/plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- sweetalert2 -->
  <script src="asset/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Datatables bs5  -->
  <script src="asset/plugins/datatables-bs5/js/datatables.min.js"></script>
</head>