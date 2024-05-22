<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Persediaan Masuk</h1>
      </div>
    </div>
  </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Masuk Barang Transaksi</h3>
                <div class="fa-pull-right">
                  <button type="button" class="btn btn-outline-primary" id="btnCreated" data-toggle="modal" data-target="#addModal">
                      <span class="fas fa-plus"></span>  Create New
                  </button>
                </div>
            </div>
            <div class="card-body">
              <br>
                <table id="tableMaster" class="table table-bordered table-responsive-sm">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Nama Supplier</th>
                    <th>Nama Bahan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                    <th>Cetak Dokument</th>
                  </tr>
                  </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Form Tambah Data -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Bahan Masuk <span id="kd_persediaan_masuk"></span></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addbahanMasuk" method="post">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>" required>
                </div>
                <div class="form-group">
                    <label>Bahan</label>
                    <select name="kd_bahan" class="form-control" id="kd_bahan">
                        <option disabled selected>-- Pilih Bahan --</option>
                        <?php
                          $data = mysqli_query($koneksi,"SELECT * FROM bahan");
                          while($bahan = mysqli_fetch_array($data)){
                          ?>
                          <option value="<?php echo $bahan['kd_bahan'] ?>"><?php echo $bahan['nama_bahan']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="kd_supplier" class="form-control" id="kd_supplier">
                        <option disabled selected>-- Pilih Supplier --</option>
                        <?php
                          $data = mysqli_query($koneksi,"SELECT * FROM suppliers");
                          while($supplier = mysqli_fetch_array($data)){
                          ?>
                          <option value="<?php echo $supplier['kd_supplier'] ?>"><?php echo $supplier['nama_supplier']; ?></option>
                        <?php } ?>
                    </select>
                </div>
          </div>
          <!-- Pembagi form -->
          <div class="col-md-6">
                <div class="form-group">
                    <label>Harga Bahan</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Bahan</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="form-group">
                    <label>Total Harga</label>
                    <div class="input-group">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span>Rp</span>
                      </div>
                    </div>
                    <input type="number" class="form-control" id="total" name="total" disabled>
                    </div>
                </div>
          </div>
        </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" name="" class="btn btn-primary">Save changes</button>              
        </div>
        </form> 
      </div>
    </div>
</div>


<!-- Form Edit Data -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form id="editbahanMasuk" method="post">
        <input type="hidden" name="id" id="id">
        <div class="modal-header">
          <h4 class="modal-title">Edit Bahan Masuk <span id="kd_persediaan_masuk"></span></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
          <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal" value="" required>
                </div>
                <div class="form-group">
                    <label>Bahan</label>
                    <select name="kd_bahan" class="form-control" id="kd_bahan">
                        <option disabled selected>-- Pilih Bahan --</option>
                        <?php
                          $data = mysqli_query($koneksi,"SELECT * FROM bahan");
                          while($bahan = mysqli_fetch_array($data)){
                          ?>
                          <option value="<?php echo $bahan['kd_bahan'] ?>"><?php echo $bahan['nama_bahan']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="kd_supplier" class="form-control" id="kd_supplier">
                        <option disabled selected>-- Pilih Supplier --</option>
                        <?php
                          $data = mysqli_query($koneksi,"SELECT * FROM suppliers");
                          while($supplier = mysqli_fetch_array($data)){
                          ?>
                          <option value="<?php echo $supplier['kd_supplier'] ?>"><?php echo $supplier['nama_supplier']; ?></option>
                        <?php } ?>
                    </select>
                </div>
          </div>
          <!-- Pembagi form -->
          <div class="col-md-6">
                <div class="form-group">
                    <label>Harga Bahan</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Bahan</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="form-group">
                    <label>Total Harga</label>
                    <div class="input-group">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span>Rp</span>
                      </div>
                    </div>
                    <input type="number" class="form-control" id="total" name="total" disabled>
                    </div>
                </div>
          </div>
        </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="updateBtn" class="btn btn-primary">Update Data</button>     
        </div>
        </form> 
      </div>
    </div>
</div>




<script type="text/javascript">
$(document).ready(function() {
    // Tabel Data
    let dataTable = $('#tableMaster').DataTable({
    processing: true,
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
