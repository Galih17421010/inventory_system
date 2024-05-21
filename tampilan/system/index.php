<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Sistem Informasi</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<div class="row">
    <div class="col-12">
        <div class="card" id="sistem">
        <form id="updateSistem" method="post">
            <div class="card-body row">
            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <img class="img-thumbnail img-circle preview_gambar" name="preview_gambar">
                    <br><br>
                    <h2><span class="nama"></span></h2>
                    <p class="lead mb-5"><span class="singkatan"></span><br>
                    <span class="email"></span>
                    </p>
                </div>
            </div>
            <div class="col-7">
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                <label>Nama Sistem</label>
                <input type="text" name="singkatan" class="form-control">
                </div>
                <div class="form-group">
                <label>Emai Sistem</label>
                <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                <label>Gambar Sistem</label>
                <input type="file" name="gambar" id="gambar" class="form-control gambar" />
                <input type="hidden" name="gambar_lama" id="gambar_lama" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Informasi</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

        var sistem = $('#sistem').ready(function(){
        var id = $(this).val();
        $.ajax({
        url: "tampilan/system/systemSetting.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        },
        success: function(response) {
            var data = response.data;
            $("#updateSistem #id").val(data.id);
            $("#updateSistem input[name='nama']").val(data.nama);
            $("#updateSistem input[name='singkatan']").val(data.singkatan);
            $("#updateSistem input[name='email']").val(data.email);
            $("#updateSistem .nama").text(data.nama);
            $("#updateSistem .singkatan").text(data.singkatan);
            $("#updateSistem .email").text(data.email);
            $("#updateSistem .preview_gambar").attr("src", "gambar/" + data.gambar + "");
            $("#updateSistem #gambar_lama").val(data.gambar);
           
        }
        });
  });

  // Update data kedalam database
  $("#updateSistem").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
        url: "tampilan/system/systemSetting.php?action=updateData",
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
                    text: "Berhasil Merubah Data Sistem",
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