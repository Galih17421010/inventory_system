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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Keluar Barang Transaksi</h3>
                    <div class="fa-pull-right">
                      <a href="?page=add-persediaan-keluar" class="btn btn-outline-primary"><i class="fas fa-plus"></i>Create New</a>
                    </div>
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
</div>
</section>

<script>
$(document).ready(function(){
    // Tabel Data
    let dataTable = $('#tableMaster').DataTable({
        processing: true,
        
    })
});
</script>