    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data User</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-12">
        <div class="card">
              <div class="card-header">
              <h3 class="card-title">List of Users</h3>
                <div class="fa-pull-right">
                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal">
                      <span class="fas fa-plus"></span>  Create New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="tableMaster" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
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
          <h4 class="modal-title">Create User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addUser" method="post">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="addNamalengkap" name="nama_lengkap" placeholder="Nama Lengkap..." required>
              </div>
              <div class="form-group">
              <label>Email</label>
                <input type="email" class="form-control" id="addEmail" name="email" placeholder="Alamat Email Gunakan @ ..." required>
              </div>
              <div class="form-group">
              <label>Password</label>
                <input type="password" class="form-control" id="addPassword" name="password" placeholder="Set Password..." required>
              </div>
              <div class="form-group">
              <label>Nomor Telephon</label>
                <input type="number" class="form-control" id="addNotelp" name="no_telp" placeholder="Nomor Berupa Angka Tanpa Simbol..." required>
              </div>
          </div>
          <!-- Pembagi form -->
          <div class="col-md-6">
              <div class="form-group">
              <label>Pilih Status</label>
                <select class="form-control" id="addStatus" name="status">
                  <option>-- Select a status --</option>
                  <option value="1">Admin</option>
                  <option value="2">Pimpinan</option>
                </select>
              </div>
              <div class="form-group">
              <label>Alamat Lengkap</label>
                <textarea id="addAlamat" name="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat anda..."></textarea>
              </div>
              <div class="form-group">
              <label>Foto User</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control foto" name="foto" required>
                    </div>
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
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editUser" method="post">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="addNamalengkap" name="nama_lengkap" placeholder="Nama Lengkap..." required>
              </div>
              <div class="form-group">
              <label>Email</label>
                <input type="email" class="form-control" id="addEmail" name="email" placeholder="Alamat Email Gunakan @ ..." required>
              </div>
              <div class="form-group">
              <label>Password</label>
                <input type="password" class="form-control" id="addPassword" name="password" placeholder="Set Password..." required>
              </div>
              <div class="form-group">
              <label>Nomor Telephon</label>
                <input type="number" class="form-control" id="addNotelp" name="no_telp" placeholder="Nomor Berupa Angka Tanpa Simbol..." required>
              </div>
          </div>
          <!-- Pembagi form -->
          <div class="col-md-6">
              <div class="form-group">
              <label>Pilih Status</label>
                <select class="form-control" id="addStatus" name="status">
                  <option>-- Select a status --</option>
                  <option value="1">Admin</option>
                  <option value="2">Pimpinan</option>
                </select>
              </div>
              <div class="form-group">
              <label>Alamat Lengkap</label>
                <textarea id="addAlamat" name="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat anda..."></textarea>
              </div>
              <div class="form-group">
              <label>Foto User</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control foto" name="foto">
                        <input type="hidden" class="form-control" name="foto_lama" id="foto_lama">
                    </div>
                </div>
              </div>
          </div>
        </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" name="" class="btn btn-primary">Update changes</button>              
        </div>
        </form> 
      </div>
    </div>
</div>




<script>
$(document).ready(function() {
  // Tabel Data
  let dataTable = $('#tableMaster').DataTable({
    processing: true,
    ajax: {
        url:'tampilan/user/crudUser.php?action=fetchData',
        type: 'POST',
      }
  });

  // menambahkan data kedalam database
  $("#addUser").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
              url: "tampilan/user/crudUser.php?action=insertData",
              type: "POST",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  var json = JSON.parse(data);
                  var status = json.status;
                  if (status == 'true') {
                      $('#addUser')[0].reset();
                      $('#addModal').modal('hide');
                      Swal.fire({
                          title: "Sukses!",
                          text: "Berhasil Menambahkan Data User",
                          icon: "success"
                      });
                      dataTable.ajax.reload();
                  }else{
                      $('#addUser')[0].reset();
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
        url: "tampilan/user/crudUser.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#editUser #id").val(data.id);
            $("#editUser input[name='nama_lengkap']").val(data.nama_lengkap);
            $("#editUser input[name='email']").val(data.email);
            $("#editUser input[name='no_telp']").val(data.no_telp);
            $("#editUser input[name='password']").val(data.password);
            $("#editUser textarea[name='alamat']").val(data.alamat);
            $("#editUser #addStatus").val(data.status);
            $("#editUser .preview_foto").attr("src", "gambar/produk/" + data.foto + "");
            $("#editUser #foto_lama").val(data.foto);
            // menampilkan modal edit
            $('#editModal').modal('hide');
        }
        });
  });

  // Update data kedalam database
  $("#editUser").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/user/crudUser.php?action=updateData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#editUser')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Merubah Data User",
                    icon: "success"
                });
                dataTable.ajax.reload();
            }else{
                $('#editUser')[0].reset();
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
                    url: "tampilan/user/crudUser.php?action=deleteData",
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