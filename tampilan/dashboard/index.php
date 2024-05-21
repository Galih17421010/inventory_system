<h1 class="">Selamat datang, <?= $_SESSION['log']['nama_lengkap'] ?></h1>
<hr>
<div class="row">
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Prison List</span>
        <span class="info-box-number text-right h5">
         75
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-border-all"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Cell Block</span>
        <span class="info-box-number text-right h5">
          757
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Crimes</span>
        <span class="info-box-number text-right h5">
         75
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-bars"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Actions</span>
        <span class="info-box-number text-right h5">
          75
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Currrent Inmates</span>
        <span class="info-box-number text-right h5">
          34
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Released Inmates</span>
        <span class="info-box-number text-right h5">
        15
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  
  <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-file-alt"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Today's Visits</span>
        <span class="info-box-number text-right h5">
          11
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of All Report</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="tableMaster" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Laporan</th>
                    <th>Nama Laporan</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr> 
                  </thead>
                </table>
               </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function() {
  // Tabel Data
  let dataTable = $('#tableMaster').DataTable({
    processing: true,
   
  });

});
</script>