<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Laporan</h1>
      </div>
    </div>
  </div>
</section>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline card-tabs">
          <div class="card-header">
            <h4 class="card-title">Laporan Keluar Masuk Persediaan</h4>
              <div class="card-tools">
                  <button type="button" class="btn btn-lg btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
              </div>
          </div>
          <div class="card-body">
            <table id="tableCetak" class="table table-bordered" style="overflow-x:auto;width:100%">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jumlah</th>
                    <th>Total Jual</th>
                    <th>Cetak</th>
                  </tr>
                </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-header">
  <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Stok Persediaan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Persediaan Masuk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Persediaan Keluar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-setting-tab" data-toggle="pill" href="#custom-tabs-three-setting" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Mutasi Persediaan</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="col-12">
                  <h4><i class="fas fa-globe"></i> <?= $data['nama']?></h4>
                </div>
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <center><h3>Laporan Stok Persediaan</h3></center><br>
                    <table id="tablePersediaan" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Masuk</th>
                        <th>Stok Keluar</th>
                        <th>Sisa Stok</th>
                        <th>Harga</th>
                        <th>Total Nilai Stok</th>
                      </tr>
                      </thead>
                    </table><br>
                    <div class="col-12">
                      <center><a href="./tampilan/laporan/cetak/print.php" class="btn btn-success pull-right" target="blank"><i class="fa fa-print"></i> Print Data</a></center>
                    </div>
                    
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <center><h3>Laporan Persediaan Masuk</h3></center><br>
                    <table id="tableMasuk" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Bahan</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Total Beli</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                  <center><h3>Laporan Persediaan Keluar</h3></center><br>
                    <table id="tableKeluar" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Bahan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Harga Jual</th>
                        <th>Total Jual</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-setting" role="tabpanel" aria-labelledby="custom-tabs-three-setting-tab">
                  <center><h3>Laporan Mutasi Persediaan</h3></center><br>
                    <table id="tableStok" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Bahan</th>
                        <th><center> Status</center></th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer">

              </div>
            </div>
          </div>
        </div>
  </div>
</section>


<script>
  $(document).ready(function () {
    // Tabel Data persediaan
    let dataTable = $('#tableCetak').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        ajax: {
        url:'tampilan/laporan/crudLaporan.php?action=fetchDataCetak',
        type: 'POST',
      }
      
    });
    
  });

  $(document).ready(function () {
    // Tabel Data persediaan
    let dataTable = $('#tablePersediaan').DataTable({
        processing: true,
        ajax: {
        url:'tampilan/laporan/crudLaporan.php?action=fetchDataStokPersediaan',
        type: 'POST',
      }
      
    });
    
  });

  $(document).ready(function () {
    // Tabel Data Masuk
    let dataTable = $('#tableMasuk').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        ajax: {
        url:'tampilan/laporan/crudLaporan.php?action=fetchDataStokMasuk',
        type: 'POST',
      }
      
    });
    
  });

  $(document).ready(function () {
    // Tabel Data Keluar
    let dataTable = $('#tableKeluar').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        ajax: {
        url:'tampilan/laporan/crudLaporan.php?action=fetchDataStokKeluar',
        type: 'POST',
      }
    });
    
  });

  $(document).ready(function () {
    // Tabel Data Stok
    let dataTable = $('#tableStok').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        ajax: {
        url:'tampilan/laporan/crudLaporan.php?action=fetchDataStok',
        type: 'POST',
      }
    });
    
  });
</script>