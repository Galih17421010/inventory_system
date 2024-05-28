<?php 
include "config/koneksi.php";
session_start();


//Cek Sudah Login atau Belum
if (isset($_SESSION['log'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="gambar/<?= $data['gambar']?>">
  <title><?= $data['nama']?></title>


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="asset/plugins/sweetalert2/sweetalert2.min.css">
  <script src="asset/plugins/sweetalert2/sweetalert2.min.js"></script>

<style>
    .main-center {
   margin: 0 auto;
   max-width: 400px;
   padding: 40px 40px;
   position:absolute;
   left:0;
   right:0;
   top: 50%;
   transform: translateY(-50%);
}

</style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-light">    
    <div class="row col-12">
        <span class="navbar-brand brand-text font-weight-light">
            &emsp; 
            <i class="fa fa-globe"></i> <?= $data['nama']?> - <?= $data['singkatan']?>
        </span>
    </div>
  </nav>

    <!-- Main content -->
    <div class="content-wrapper">
      <div class="container">
        <div class="row">

            <div class="main-center">
                <div class="login-box">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                        <a href="" class="h3"><b><?= $data['nama']?></b></a>
                        </div>
                        <div class="card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form id="login" method="post">
                            <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            </div>
                            <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" id="showPassword" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            </div>
                            <div class="input-group mb-3">
                            <div class="col-8">
                                <input type="checkbox" onclick="show()">
                                    Show Password
                            </div>
                            </div>
                            <div class="text-center mt-2 mb-3">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>

  </div>
 
  <footer class="main-footer">
    <center>
    <strong>Copyright &copy; 2024 <a href="mailto:<?= $data['email']?>"><?= $data['nama']?></a>.</strong>
    All rights reserved.
    </center>
  </footer>

</div>


<?php 
//cek login user
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $cekdatabase = mysqli_query($koneksi, "SELECT * From users WHERE email='$email' and password='$password' LIMIT 1");
  $set = mysqli_fetch_assoc($cekdatabase);

  if($set){
      $_SESSION['log'] = $set;
      header('location:index.php');
  } 
  else {
      echo'<script type="text/javascript">
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Cek Kembali Email & Password Anda!"
        });
      </script>';
  }
}
?>

<script>
  function show() {
  var x = document.getElementById("showPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
