  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="gambar/<?= $data['gambar']?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $data['nama']?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <div class="nav-header">
                Sistem
          </div>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=bahan" class="nav-link">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                Bahan Persediaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=supplier" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
            <div class="nav-header">
                Report
            </div> 
          <li class="nav-item">
            <a href="?page=persediaan-masuk" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
                Persediaan Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=persediaan-keluar" class="nav-link">
              <i class="nav-icon fas fa-folder-minus"></i>
              <p>
                Persediaan Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=laporan" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <div class="nav-header">
                Setting
            </div> 
          <li class="nav-item">
            <a href="?page=user" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=system" class="nav-link">
              <i class="nav-icon fas fas fa-tools"></i>
              <p>Sistem Informasi</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>