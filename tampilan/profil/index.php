<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Profil Pengguna</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="sistem">
                <form id="updateSistem" method="post">
                <input type="hidden" name="id" id="id" value="<?= $_SESSION['log']['id'] ?>">
                <div class="card-body row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <img class="img-thumbnail img-circle preview_foto" name="preview_foto">
                            <br><br>
                            <h2><span class="nama_lengkap"></span></h2>
                            <p class="lead mb-5"><span class="no_telp"></span><br>
                            <span class="email"></span>
                            </p>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No Telephon</label>
                            <input type="number" name="no_telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="showPassword" class="form-control" required>
                            <input type="checkbox" onclick="show()" placeholder="show"> Show
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat anda..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar Sistem</label>
                            <input type="file" name="foto" id="foto" class="form-control foto" />
                            <input type="hidden" name="foto_lama" id="foto_lama" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" name="simpan" class="btn btn-primary">Update Profil</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</section>

<script>
  function show() {
  var x = document.getElementById("showPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
$(document).ready(function() {

        var sistem = $('#sistem').ready(function(){
        var id = $('#id').val();
        $.ajax({
        url: "tampilan/profil/profilSetting.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#updateSistem #id").val(data.id);
            $("#updateSistem input[name='nama_lengkap']").val(data.nama_lengkap);
            $("#updateSistem input[name='email']").val(data.email);
            $("#updateSistem input[name='no_telp']").val(data.no_telp);
            $("#updateSistem .nama_lengkap").text(data.nama_lengkap);
            $("#updateSistem .email").text(data.email);
            $("#updateSistem .no_telp").text(data.no_telp);
            $("#updateSistem input[name='password']").val(data.password);
            $("#updateSistem textarea[name='alamat']").val(data.alamat);
            $("#updateSistem .preview_foto").attr("src", "gambar/user/" + data.foto + "");
            $("#updateSistem #foto_lama").val(data.foto);
           
        }
        });
  });

  // Update data kedalam database
  $("#updateSistem").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/profil/profilSetting.php?action=updateData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil Merubah Data Pribadi",
                    icon: "success"
                }).then((result) => {
                  location.reload();
                });
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
});
</script>