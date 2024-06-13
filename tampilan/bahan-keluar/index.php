<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Data Bahan Keluar</h1>
      </div>
    </div>
  </div>
</section>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Bahan</h3>
                <div class="fa-pull-right">
                  
                </div>
              </div>
              <div class="card-body">
                <center><h3>Laporan Persediaan Keluar</h3></center><br>
                    <table id="tableKeluar" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
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
          </div>
        </div>
    </div>
  </div>
</section>


<script>
$(document).ready(function () {
    // Tabel Data Keluar
    let dataTable = $('#tableKeluar').DataTable({
        processing: true,
        ajax: {
        url:'tampilan/bahan-keluar/crudBahanKeluar.php?action=fetchDataStokKeluar',
        type: 'POST',
      }
    });
    
});
</script>