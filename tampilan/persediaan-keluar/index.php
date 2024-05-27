<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Persediaan Keluar</h1>
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
                  <h3 class="card-title">Data Keluar Barang Transaksi</h3>
                    <div class="fa-pull-right">
                      <a href="?page=add-persediaan-keluar" class="btn btn-outline-primary"><i class="fas fa-plus"></i>Create New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableMaster" class="table table-bordered" style="overflow-x:auto;width:100%">
                      <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Total Belanja</th>
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
        order: [[ 0, "desc" ]],
        ajax: {
        url:'tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=fetchData',
        type: 'POST',
 
      }
  })

    // function to delete data
  $("#tableMaster").on("click", ".deleteBtn", function() {
        var transaksi_keluar = $(this).val();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=deleteData",
                        type: "POST",
                        dataType: "json",
                        data: {transaksi_keluar},
                        success: function(response) {
                            Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                            });
                            dataTable.ajax.reload();
                        }
                    });
                }
            });
  });


});
</script>

