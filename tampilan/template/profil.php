<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link"><?= $data['singkatan']?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
        <!-- profil  -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="gambar/user/<?= $_SESSION['log']['foto'] ?>" alt="User Avatar" class="img-size-32 img-circle mr-2">
              <?= $_SESSION['log']['nama_lengkap'] ?>
              <i class="fas fa-caret-down"></i>               
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
              <a class="dropdown-item" href="#"><span class="fa fa-user"></span> My Account</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php"><span class="fas fa-sign-out-alt"></span> Logout</a>
          </div>
        </li>

        <!-- Full layar -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
       
    </ul>
  </nav>