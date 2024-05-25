<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Persediaan Masuk</h1>
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
                <h3 class="card-title">Data Masuk Barang Transaksi</h3>
                  <div class="fa-pull-right">
                    <a href="?page=add-persediaan-masuk" class="btn btn-outline-primary"><i class="fas fa-plus"></i>Create New</a>
                  </div>
              </div>
              <div class="card-body">
                <br>
                  <table id="tableMaster" class="table table-bordered" style="overflow-x:auto;width:100%">
                    <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Tanggal</th>
                      <th>Nama Supplier</th>
                      <th>Jumlah</th>
                      <th>Total Beli</th>
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






<script type="text/javascript">
$(document).ready(function() {
    // Tabel Data
    let dataTable = $('#tableMaster').DataTable({
    processing: true,
    order: [[ 1, "desc" ]],
    ajax: {
        url:'tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=fetchData',
        type: 'POST',
 
      }
   
  });

  //panggil kode
  $('#btnCreated').click(function() { 
		var kd_persediaan_masuk = $(this).text(); 
		$.ajax({
			type: 'POST', 
			url: 'tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=fetchKode', 
			data: 'kd_persediaan_masuk' + kd_persediaan_masuk, 
			success: function(response) { 
				$('#kd_persediaan_masuk').text(response); 
			}
		});
	});


  //Total Otomatis
  $(function () {
    $("#harga, #jumlah").keyup(function () {
     $("#total").val(+$("#harga").val() * +$("#jumlah").val());
    });
  });

  //Tambah data
  $("#addbahanMasuk").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
              url: "tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=insertData",
              type: "POST",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  var json = JSON.parse(data);
                  var status = json.status;
                  if (status == 'true') {
                      $('#addbahanMasuk')[0].reset();
                      $('#addModal').modal('hide');
                      Swal.fire({
                          title: "Sukses!",
                          text: "Berhasil Menambahkan Data Bahan Persediaan",
                          icon: "success"
                      });
                      dataTable.ajax.reload();
                  }else{
                      Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: "Something went wrong!",
                      });
                      
                  } 
              }
        });
  });

  // Edit Data
  $("#tableMaster").on("click", ".editBtn", function() {
        var id = $(this).val();
        var kd_persediaan_masuk = $(this).text(); 
        $.ajax({
        url: "tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id, kd_persediaan_masuk : kd_persediaan_masuk
        },
        success: function(response) {
            var data = response.data;
            $("#editbahanMasuk #id").val(data.id);
            $('#editbahanMasuk #kd_persediaan_masuk').text(data.kd_persediaan_masuk); 
            $("#editbahanMasuk input[name='tanggal']").val(data.tanggal);
            $("#editbahanMasuk #kd_supplier").val(data.kd_supplier);
            $("#editbahanMasuk #kd_bahan").val(data.kd_bahan);
            $("#editbahanMasuk #harga").val(data.harga);
            $("#editbahanMasuk #jumlah").val(data.jumlah);
            $("#editbahanMasuk #total").val(data.total);
            // menampilkan modal edit
            $('#editModal').modal('hide');
        }
        });
  });

  // Update data kedalam database
  $("#editbahanMasuk").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=updateData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#editbahanMasuk')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Merubah Data Bahan Persediaan",
                    icon: "success"
                });
                dataTable.ajax.reload();
            }else{
                $('#editbahanMasuk')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                });
                dataTable.ajax.reload();
            } 
        }
        });
    });


  // function to delete data
  $("#tableMaster").on("click", ".deleteBtn", function() {
        var id = $(this).val();
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
                    url: "tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=deleteData",
                    type: "POST",
                    dataType: "json",
                    data: {id},
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
