<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Data Bahan Persediaan</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Bahan</h3>
                <div class="fa-pull-right">
                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal" data-keyboard="false" data-backdrop="static">
                      <span class="fas fa-plus"></span>  Create New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tableMaster" class="table table-bordered" style="overflow-x:auto;width:100%">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Bahan</th>
                    <th>Gambar</th>
                    <th>Stok</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                </table>
              </div>
          </div>
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<!-- Form Tambah Data -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Bahan Persediaan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addBahan" method="POST">
        <div class="modal-body">
                <!-- <div class="form-group"> -->
                <!-- <label>Kode Supplier</label>
                    <input type="text" class="form-control" name="kd_supplier" placeholder="Test" disabled>
                </div> -->
                <div class="form-group">
                <label>Nama Bahan</label>
                    <input type="text" class="form-control" name="nama_bahan" placeholder="Nama Bahan..." required>
                </div>
                <div class="form-group">
                
                </div>   
                <div class="form-group">
                    <label>Foto Bahan</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="form-control foto" name="foto" required>
                        </div>
                    </div>
                </div>
        </div>
            <div class="modal-footer justify-content-center">
              <button type="submit" id="insertBtn" class="btn btn-primary">Save changes</button>              
            </div>
        </form> 
      </div>
    </div>
</div>

<!-- Form Edit Data -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Bahan Persediaan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editBahan" method="POST">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle preview_foto" name="preview_foto"
                        src="">
                    </div>
                <div class="form-group">
                <label>Kode Bahan</label>
                    <input type="text" class="form-control" name="kd_bahan" disabled>
                </div>
                <div class="form-group">
                <label>Nama Bahan</label>
                    <input type="text" class="form-control" name="nama_bahan" placeholder="Nama Bahan..." required>
                </div>
                <div class="form-group">
               
                </div>   
                <div class="form-group">
                    <label>Foto Bahan</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="form-control foto" name="foto">
                            <input type="hidden" class="form-control" name="foto_lama" id="foto_lama">
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


<!-- javascript -->
<script>
$(document).ready(function() {
  // Tabel Data
  let dataTable = $('#tableMaster').DataTable({
    processing: true,
    autoWidth: true,
    order: [[ 1, "desc" ]],
    ajax: {
        url:'tampilan/bahan/crudBahan.php?action=fetchData',
        type: 'POST',
      }
  });

  // menambahkan data kedalam database
  $("#addBahan").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
              url: "tampilan/bahan/crudBahan.php?action=insertData",
              type: "POST",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  var json = JSON.parse(data);
                  var status = json.status;
                  if (status == 'true') {
                      $('#addBahan')[0].reset();
                      $('#addModal').modal('hide');
                      Swal.fire({
                          title: "Sukses!",
                          text: "Berhasil Menambahkan Data Bahan Persediaan",
                          icon: "success"
                      });
                      dataTable.ajax.reload();
                  }else{
                      $('#addBahan')[0].reset();
                      $('#addModal').modal('hide');
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

  // Edit Dataa
  $("#tableMaster").on("click", ".editBtn", function() {
        var id = $(this).val();
        $.ajax({
        url: "tampilan/bahan/crudBahan.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#editBahan #id").val(data.id);
            $("#editBahan input[name='kd_bahan']").val(data.kd_bahan);
            $("#editBahan input[name='nama_bahan']").val(data.nama_bahan);
            $("#editBahan .preview_foto").attr("src", "gambar/produk/" + data.foto + "");
            $("#editBahan #foto_lama").val(data.foto);
            // menampilkan modal edit
            $('#editModal').modal('hide');
        }
        });
  });

  // Update data kedalam database
  $("#editBahan").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/bahan/crudBahan.php?action=updateData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#editBahan')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Merubah Data Bahan Persediaan",
                    icon: "success"
                });
                dataTable.ajax.reload();
            }else{
                $('#editBahan')[0].reset();
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
        var delete_image = $(this).closest("td").find(".delete_image").val();
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
                    url: "tampilan/bahan/crudBahan.php?action=deleteData",
                    type: "POST",
                    dataType: "json",
                    data: {id, delete_image},
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