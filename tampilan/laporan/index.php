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
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Stok Persediaan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Persediaan Keluar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Persediaan Masuk</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <center><h3>Laporan Stok Barang</h3></center>
                    <table id="tableStok" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Total Belanja</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                    </table>

                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <center><h3>Laporan Persediaan Keluar</h3></center>
                    <table id="tableKeluar" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Total Belanja</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                    <center><h3>Laporan Persediaan Masuk</h3></center>
                    <table id="tableMasuk" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Total Belanja</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
  </div>
</section>

<script>
  $(document).ready(function () {
    // Tabel Data Stok
    let dataTable = $('#tableStok').DataTable({
        processing: true,
      
    });
    
  });

  $(document).ready(function () {
    // Tabel Data Keluar
    let dataTable = $('#tableKeluar').DataTable({
        processing: true,
      
    });
    
  });

  $(document).ready(function () {
    // Tabel Data Masuk
    let dataTable = $('#tableMasuk').DataTable({
        processing: true,
      
    });
    
  });
</script>