<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Tambah Persediaan masuk</h1>
      </div>
    </div>
  </div>
</section>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="alert alert-info alert-dismissible">
          <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
          Mohon isi data dengan cermat, karena data yang telah disimpan tidak dapat diubah kecuali dihapus !!
        </div>

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Form Transaksi Masuk</h3>
          </div>
          <div class="card-body">
            <form id="insertData" method="post">
              <div class="invoice p-3 mb-3">
                <div class="row">
                  <div class="col-12">
                    <h4><i class="fas fa-globe"></i> <?= $data['nama']?>
                      <center>Nomor : <span id="transaksi_masuk"></span></center>
                    </h4>
                    <hr>
                  </div>
                </div>
                <div class="row invoice-info">
                  <div class="col-sm-2 invoice-col">
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                      <Label>Tanggal :</Label>
                      <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>" required>
                    </div>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <div class="form-group">
                      <label> Nama Supplier : </label>
                      <Select class="form-control" id="supplier" name="supplier" required>
                        <option value="" disabled selected>-- Pilih Supplier --</option>
                            <?php
                              $supplier = mysqli_query($koneksi,"SELECT * FROM suppliers");
                              while($sup = mysqli_fetch_array($supplier)){
                              ?>
                              <option value="<?= $sup['kd_supplier'] ?>"><?= $sup['nama_supplier']; ?></option>
                            <?php } ?>
                      </Select>
                    </div>
                  </div>
                  <div class="col-sm-2 invoice-col">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped" id="tableTransaksiMasuk">
                      <thead>
                      <tr>
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th><center>
                          <button type="button" class="btn btn-success btn-xs tambah" name="tambah" id="tambah">
                            <i class="fas fa-plus-circle"></i>
                          </button></center></th>
                      </tr>
                      </thead>
                      <tfoot>
                        <th colspan="2" style="text-align: right;">Total Keseluruhan</th>
                        <td id="totaljumlah"></td>
                        <td id="totalharga"></td>
                        <td></td>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <hr>
                <div class="row no-print">
                  <div class="col-12">
                    <a href="?page=persediaan-masuk" class="btn btn-default"><i class="fas fa-backward"></i> Kembali</a>
                    <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> 
                      Simpan Data
                    </button>
                  </div>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
    var count = 0;
    $("#tambah").click(function(){
    count = count + 1;
      $('#tableTransaksiMasuk').append('<tr id='+count+'>'+
                          '<td>'+
                            '<select type="text" class="form-control bahan" name="bahan[]" id="bahan'+count+'" required>'+
                              '<option value="" disabled selected>-- Pilih --</option>'+
                              <?php
                                $bahans = mysqli_query($koneksi,"SELECT * FROM bahan");
                                while($bahan = mysqli_fetch_array($bahans)){
                                ?>
                                '<option value="<?= $bahan['kd_bahan'] ?>"><?= $bahan['nama_bahan']; ?></option>'+
                              <?php } ?>
                            '</select>'+
                          '</td>'+
                          '<td><input type="number" class="form-control harga" name="harga[]" id="harga'+count+'" readonly="true"></td>'+
                          '<td><input type="number" class="form-control jumlah" name="jumlah[]" id="jumlah'+count+'" required></td>'+
                          '<td><input type="number" class="form-control total" name="total[]" id="total'+count+'" disabled></td>'+
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
                url: 'tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=fetchSelect', 
                data: 'kd_bahan=' + bahan, 
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

    // kode otomatis 
    $(function () {
        var transaksi_masuk = $(this).text(); 
        $.ajax({
          type: 'POST', 
          url: 'tampilan/persediaan-masuk/crudPersediaanMasuk.php?action=fetchKode', 
          data: 'transaksi_masuk' + transaksi_masuk, 
          success: function(response) { 
            $('#transaksi_masuk').text(response); 
          }
        });
    });

    //Tambah data ke database
    $("#insertData").on("submit", function(e) {
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
                        $('#insertData')[0].reset();
                        Swal.fire({
                            title: "Sukses!",
                            text: "Berhasil Menambahkan Data Persediaan masuk",
                            icon: "success",
                        });
                        location.href = "?page=persediaan-masuk";
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