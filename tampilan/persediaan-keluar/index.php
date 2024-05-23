<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Persediaan Keluar</h1>
      </div>
    </div>
  </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chart-line"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transaksi</span>
                <span class="info-box-number">QTY</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number">Rp</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
    </div>
</section>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Keluar Barang Transaksi</h3>
            </div>
            <div class="card-body">
                <table id="tableMaster" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Total Belanja</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                </table>
            </div>
        </div>
    </div>        
</div>

<script>
$(document).ready(function(){
    // Tabel Data
    let dataTable = $('#tableMaster').DataTable({
        processing: true,
        
    })
});
</script>