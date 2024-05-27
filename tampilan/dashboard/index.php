<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h1 class="">Selamat datang, <?= $_SESSION['log']['nama_lengkap'] ?></h1>
        <hr>
      </div>
    </div>

    <?php
      $querybahan = mysqli_query($koneksi,"SELECT COUNT(kd_bahan) as bahan, SUM(stok) as stok FROM bahan");
      $bahan = mysqli_fetch_array($querybahan);
    ?>
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Stok <?= $bahan['stok']?></h3>
            <p>Data Persediaan <?= $bahan['bahan']?> Bahan</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-bag"></i>
          </div>
          <a href="?page=bahan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <?php
        $querysupplier = mysqli_query($koneksi,"SELECT COUNT(kd_supplier) as supplier FROM suppliers");
        $supplier = mysqli_fetch_array($querysupplier);
      ?>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-gray">
          <div class="inner">
            <h3><?= $supplier['supplier']?></h3>
            <p>Supplier</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="?page=supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <?php
        $querylaporan = mysqli_query($koneksi,"SELECT (SELECT COUNT(kd_persediaan_masuk) as laporan FROM persediaan_masuk)+(SELECT COUNT(kd_persediaan_keluar) as laporan FROM persediaan_keluar) AS laporan");
        $laporan = mysqli_fetch_array($querylaporan);
      ?>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $laporan['laporan']?> Persediaan</h3>
            <p>Laporan</p>
          </div>
          <div class="icon">
            <i class="fa fa-print"></i>
          </div>
          <a href="?page=laporan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <?php
        $querymasuk = mysqli_query($koneksi,"SELECT COUNT(kd_persediaan_masuk) as masuk, sum(jumlah) as total FROM persediaan_masuk");
        $persediaan_masuk = mysqli_fetch_array($querymasuk);
      ?>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $persediaan_masuk['total']?></h3>
            <p>Persediaan Masuk <?= $persediaan_masuk['masuk']?> Data</p>
          </div>
          <div class="icon">
            <i class="fa fa-folder-plus"></i>
          </div>
          <a href="?page=persediaan-masuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <?php
        $querykeluar = mysqli_query($koneksi,"SELECT COUNT(kd_persediaan_keluar) as keluar, sum(jumlah) as total FROM persediaan_keluar");
        $persediaan_keluar = mysqli_fetch_array($querykeluar);
      ?>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $persediaan_keluar['total']?></h3>
            <p>Persediaan Keluar <?= $persediaan_keluar['keluar']?> Data</p>
          </div>
          <div class="icon">
            <i class="fa fa-folder-minus"></i>
          </div>
          <a href="?page=persediaan-keluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      
    </div>

  </div>
</section>



