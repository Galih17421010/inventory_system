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



  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

  
  <link rel="stylesheet" href="asset/plugins/sweetalert2/sweetalert2.min.css">
  <script src="asset/plugins/sweetalert2/sweetalert2.min.js"></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Inv-</b>CTR</a>
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

<!-- jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/adminlte.min.js"></script>

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
