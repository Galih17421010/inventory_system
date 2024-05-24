<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Supplier</h1>
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
                <h3 class="card-title">List of Supplier</h3>
                <div class="fa-pull-right">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal" data-keyboard="false" data-backdrop="static">
                        <span class="fas fa-plus"></span>  Create New
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="tableMaster" class="table table-bordered">
                    <thead>
                    <tr>
                    <th>Kode Supplier</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
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
          <h4 class="modal-title">Create Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addSupplier" method="POST">
        <div class="modal-body">
                <!-- <div class="form-group"> -->
                <!-- <label>Kode Supplier</label>
                    <input type="text" class="form-control" name="kd_supplier" placeholder="Test" disabled>
                </div> -->
                <div class="form-group">
                <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Nama Lengkap..." required>
                </div>
                <div class="form-group">
                <label>Nomor Telephon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="Hanya Berupa Angka Tanpa Simbol..." required>
                </div>   
                <div class="form-group">
                <label>Alamat Lengkap</label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Tuliskan alamat anda..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Foto Supplier</label>
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


  <!-- Form edit Data -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editSupplier" method="POST">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" class="form-control" name="kd_supplier" placeholder="Test" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Nama Lengkap..." required>
                </div>
                <div class="form-group">
                    <label>Nomor Telephon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="Hanya Berupa Angka Tanpa Simbol..." required>
                </div>   
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Tuliskan alamat anda..."></textarea>
                </div>
                <div class="form-group">
                    <label>Foto Supplier</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="form-control foto" name="foto">
                            <input type="hidden" class="form-control" name="foto_lama" id="foto_lama">
                        </div>
                    </div>
                </div>
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle preview_foto" name="preview_foto"
                        src="gambar\default_profile.jpg">
                    </div>
        </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="editBtn" class="btn btn-primary">Update Data</button>              
            </div>
        </form> 
      </div> 
    </div>
</div> 


<!-- Form Detail Data -->
<div class="modal fade" id="detailModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailSupplier">
                <div class="col-md-12">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                        Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                            <h2 class="lead"><b>nama_supplier</b></h2>
                            <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                            </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img class="img-fluid img-circle preview_foto" name="preview_foto" src="gambar\default_profile.jpg">
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                            <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
      </div>
    </div>
</div>



  <!-- javascript -->
<script>
$(document).ready(function() {
    // data tabel
    fetchData();
    let table = new DataTable("#tableMaster");
 
        // menampilkan data dari database
    function fetchData() {
        $.ajax({
        url: "tampilan/supplier/crudSupplier.php?action=fetchData",
        type: "POST",
        dataType: "json",
        success: function(response) {
            var data = response.data;
            table.clear().draw();
            $.each(data, function(index, value) {
            table.row.add([
                value.kd_supplier,
                value.nama_supplier,
                value.no_telp,
                value.alamat,
                '<button type="button" value="' + value.id + '" data-toggle="modal" data-target="#detailModal" class="btn detailBtn">'+
                '<img src="gambar/supplier/' + value.foto + '" style="width:50px;height:50px;border:1px solid gray;border-radius:8px;object-fit:cover"></button>',
                value.created_at,
                '<button type="button" value="' + value.id + '" data-toggle="modal" data-target="#editModal" class="btn btn-sm btn-success editBtn" data-keyboard="false" data-backdrop="static"><i class="fa fa-edit"></i></button>'+
                '<button type="button" class="btn btn btn-sm btn-danger deleteBtn" value="' + value.id + '"><i class="fa fa-trash"></i></button>' +
                '<input type="hidden" class="delete_image" value="' + value.foto + '">'
            ]).draw(false);
            })
        }
        })
    }

      // menambahkan data kedalam database
    $("#addSupplier").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/supplier/crudSupplier.php?action=insertData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#addSupplier')[0].reset();
                $('#addModal').modal('hide');
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Menambahkan Data Supplier",
                    icon: "success"
                });
                fetchData();
            }else{
                $('#addSupplier')[0].reset();
                $('#addModal').modal('hide');
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                });
                fetchData();
            } 
        }
        });
    });

    // Detail Data
    $("#tableMaster").on("click", ".detailBtn", function() {
        var id = $(this).val();
        $.ajax({
        url: "tampilan/supplier/crudSupplier.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#detailSupplier #id").val(data.id);
            $("#detailSupplier input[name='kd_supplier']").val(data.kd_supplier);
            $("#detailSupplier .nama_supplier").val(data.nama_supplier);
            $("#detailSupplier input[name='no_telp']").val(data.no_telp);
            $("#detailSupplier textarea[name='alamat']").val(data.alamat);
            $("#detailSupplier .preview_foto").attr("src", "gambar/supplier/" + data.foto + "");
            $("#detailSupplier #foto_lama").val(data.foto);
            // menutup modal edit
            $('#detailModal').modal('hide');
        }
        });
    });

    // Edit Dataa
    $("#tableMaster").on("click", ".editBtn", function() {
        var id = $(this).val();
        $.ajax({
        url: "tampilan/supplier/crudSupplier.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#editSupplier #id").val(data.id);
            $("#editSupplier input[name='kd_supplier']").val(data.kd_supplier);
            $("#editSupplier input[name='nama_supplier']").val(data.nama_supplier);
            $("#editSupplier input[name='no_telp']").val(data.no_telp);
            $("#editSupplier textarea[name='alamat']").val(data.alamat);
            $("#editSupplier .preview_foto").attr("src", "gambar/supplier/" + data.foto + "");
            $("#editSupplier #foto_lama").val(data.foto);
            // menampilkan modal edit
            $('#editModal').modal('hide');
        }
        });
    });

    // Update data kedalam database
    $("#editSupplier").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/supplier/crudSupplier.php?action=updateData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#editSupplier')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Merubah Data Supplier",
                    icon: "success"
                });
                fetchData();
            }else{
                $('#editSupplier')[0].reset();
                $('#editModal').modal('hide');
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                });
                fetchData();
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
                    url: "tampilan/supplier/crudSupplier.php?action=deleteData",
                    type: "POST",
                    dataType: "json",
                    data: {id, delete_image},
                    success: function(response) {
                        Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                        });
                        fetchData();
                    }
                });
            }
        });
    });


});
</script>