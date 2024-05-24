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
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
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

<!-- Form Edit Data -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Persediaan Keluar </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <form id="editData" method="post">
                <input type="hidden" name="kd_persediaan_keluar" id="kd_persediaan_keluar">
                <div class="invoice p-3 mb-3">
                  <div class="row">
                    <div class="col-12">
                      <h4>
                        <i class="fas fa-globe"></i> <?= $data['nama']?>
                        <center> Nomor : <span id="kd_persediaan_keluar"></span></center>
                      </h4>
                      <hr>
                    </div>
                  </div>
                  <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                        <Label>Tanggal :</Label>
                        <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                        <label> Nama Pelanggan : </label>
                        <input type="text" class="form-control" name="nama_pelanggan" required>
                      </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                        <label> Alamat Pelanggan : </label>
                        <input type="text" class="form-control" name="alamat" required>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-12 table-responsive">
                      <table class="table table-bordered table-striped" id="tableTransaksi">
                        <thead>
                        <tr>
                          <th>Product</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Subtotal</th>
                          <th><center>
                            <button type="button" class="btn btn-success btn-xs tambah">
                              <i class="fas fa-plus-circle"></i>
                            </button></center></th>
                        </tr>
                        </thead>
                        <tfoot>
                          <th colspan="2" style="text-align: right;">Total Keseluruhan</th>
                          <td id="totaljumlah"></td>
                          <td colspan="2" id="totalharga"></td>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                <hr>
                  <div class="row no-print">
                    <div class="col-12">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-backward"></i> Batal</button>
                      <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> 
                        Update Data
                      </button>
                    </div>
                  </div>
                </div>
              </form>
        </div>      
      </div>
    </div>
</div>




<script>
$(document).ready(function(){
    // Tabel Data
    let dataTable = $('#tableMaster').DataTable({
        processing: true,
        ajax: {
        url:'tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=fetchData',
        type: 'POST',
 
      }
  })

  // Edit Data
  $("#tableMaster").on("click", ".editBtn", function() {
        var kd_persediaan_keluar = $(this).val();; 
        $.ajax({
        url: "tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
          kd_persediaan_keluar : kd_persediaan_keluar
        },
        success: function(response) {
            var data = response.data;
            $("#editData #id").val(data.id);
            $("#editData input[name='kd_persediaan_keluar']").val(data.kd_persediaan_keluar); 
            $("#editData input[name='tanggal']").val(data.tanggal);
            $("#editData #alamat").val(data.alamat);
            $("#editData #kd_persediaan_masuk)").val(data.kd_persediaan_masuk);
            $("#editData #harga").val(data.harga);
            $("#editData #jumlah").val(data.jumlah);
            $("#editData #total").val(data.total);
           
        }
        });
  });


    // function to delete data
  $("#tableMaster").on("click", ".deleteBtn", function() {
        var kd_persediaan_keluar = $(this).val();
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
                        data: {kd_persediaan_keluar},
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

<script>
$(document).ready(function() {
  var count = 0;
  $('.tambah').click(function(){
    count = count + 1;
    $('#tableTransaksi').append('<tr id='+count+'>'+
                        '<td>'+
                          '<select type="text" class="form-control bahan" name="bahan[]" id="bahan'+count+'">'+
                            '<option disabled selected>-- Pilih --</option>'+
                            <?php
                              $datas = mysqli_query($koneksi,"SELECT persediaan_masuk.kd_persediaan_masuk as kd_persediaan_masuk, persediaan_masuk.kd_bahan as kd_bahan, bahan.nama_bahan as nama_bahan, persediaan_masuk.harga as harga, persediaan_masuk.jumlah as jumlah 
                                                              FROM persediaan_masuk JOIN bahan ON persediaan_masuk.kd_bahan = bahan.kd_bahan");
                              while($bahan = mysqli_fetch_array($datas)){
                              ?>
                              '<option value="<?= $bahan['kd_persediaan_masuk'] ?>"><?= $bahan['kd_bahan'] ?> - <?= $bahan['nama_bahan']; ?></option>'+
                            <?php } ?>
                          '</select>'+
                        '</td>'+
                        '<td><input type="text" class="form-control harga" name="harga[]" id="harga'+count+'"></td>'+
                        '<td><input type="text" class="form-control jumlah" name="jumlah[]" id="jumlah'+count+'"></td>'+
                        '<td><input type="text" class="form-control total" name="total[]" id="total'+count+'"></td>'+
                        '<td><center>'+
                          '<button type="button" class="btn btn-danger btn-xs remove" id="remove'+count+'">'+
                           ' <i class="fas fa-trash"></i>'+
                         '</button></center>'+
                        '</td>'+
                      '</tr>');

    // Input otomati 
    $('#bahan'+count+'').change(function() { 
      var bahan = $(this).val(); 
      $.ajax({
        type: 'POST', 
        url: 'tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=fetchSelect', 
        data: 'kd_persediaan_masuk=' + bahan, 
        success: function(response) { 
          $('#harga'+count+'').val(response); 
        }
      });
    });

    // Total Otomatis
    $(document).ready(function () {
        $("#harga"+count+", #jumlah"+count+"").keyup(function () {
          $("#total"+count+"").val($("#harga"+count+"").val() * $("#jumlah"+count+"").val()); 
          var total = 0;
          var jumlah = 0;
          $('.total').each(function(){
            $("#totalharga").text(total += parseFloat($(this).val()));
          });
          $('.jumlah').each(function(){
            $("#totaljumlah").text(jumlah += parseFloat($(this).val()));
          });   
        });
    });

    // delet kolom 
    $(document).on('click', '#remove'+count+'', function(){
      $(this).closest('tr').remove();
    });

  });



  
});
</script>