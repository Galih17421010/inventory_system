<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Persediaan Keluar</h1>
      </div>
    </div>
  </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Keluar Barang Transaksi</h3>
            </div>
            <div class="card-body">
              <form id="insertData">
                <div class="form-inline">
                    <label>Tanggal : </label>&nbsp;
                    <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>" required>
                    &nbsp;
                    <label>Kode Transaksi : </label>&nbsp;
                    <input type="text" class="form-control" id="kd_persediaan_keluar" name="kd_persediaan_keluar" disabled>
                    &nbsp;
                    <label> Nama Pelanggan : </label>&nbsp;
                    <input type="text" class="form-control" name="nama" required>
                    &nbsp;
                    <label> Alamat Pelanggan : </label>&nbsp;
                    <input type="text" class="form-control" name="nama" required>
                </div><hr>
                <br>
                <table id="tableMaster" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>Nama Bahan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th> 
                        <button type="button" class="btn btn-success btn-sm" name="add" id="add">
                           <i class="fas fa-plus-circle"></i>
                        </button>
                        <a href=""></a>
                    </th>
                  </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <td colspan="2" style="text-align:right"><b>Total</td>
                      <td id="totaljumlah"></td>
                      <td id="totalharga"></td>
                    </tr>
                  </tfoot>
                </table>
                <br>
                <button type="button" class="btn btn-default" id="back">
                        Batal
                  </button>
                <div class="fa-pull-right">
                  <button type="submit" class="btn btn-success" id="simpan">
                      <span class="fas fa-save"></span>  Simpan
                  </button>
                </div>

              </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var count = 0;
    $('#add').click(function(){
      count = count + 1;
      var html_code = "<tr id='row"+count+"'>";
      html_code += '<td>'+ 
                        '<select class="form-control" name="bahan" id="bahan'+count+'" required>'+
                          '<option disabled selected>Pilih</option>'+
                          <?php
                            $data = mysqli_query($koneksi,"SELECT persediaan_masuk.kd_persediaan_masuk as kd_persediaan_masuk, persediaan_masuk.kd_bahan as kd_bahan, bahan.nama_bahan as nama_bahan, persediaan_masuk.harga as harga, persediaan_masuk.jumlah as jumlah 
                                                            FROM persediaan_masuk JOIN bahan ON persediaan_masuk.kd_bahan = bahan.kd_bahan");
                            while($bahan = mysqli_fetch_array($data)){
                            ?>
                            '<option value="<?= $bahan['kd_persediaan_masuk'] ?>"><?= $bahan['kd_bahan'] ?> - <?= $bahan['nama_bahan']; ?></option>'+
                          <?php } ?>
                        '</select>'+
                    '</td>';
      html_code += '<td>'+
                      '<input type="number" class="form-control" name="harga" id="harga'+count+'" disabled>'+
                    '</td>';
      html_code += '<td>'+
                        '<input type="number" class="form-control jumlah" name="jumlah" id="jumlah'+count+'">'+
                      '</td>';
      html_code +=  '<td>'+
                      '<input type="number" class="form-control total" name="total" id="total'+count+'" disabled>'+
                    '</td>';
      html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger remove'><i class='fas fa-trash'></i></button></td>";   
      html_code += "</tr>";  
      $('#tableMaster').append(html_code);

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

      //Total Otomatis
      $(function () {
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

    });
    
    // kode otomatis 
    $(function () {
      var kd_persediaan_keluar = $(this).text(); 
      $.ajax({
        type: 'POST', 
        url: 'tampilan/persediaan-keluar/crudPersediaanKeluar.php?action=fetchKode', 
        data: 'kd_persediaan_keluar' + kd_persediaan_keluar, 
        success: function(response) { 
          $('#kd_persediaan_keluar').val(response); 
        }
      });
    });

    //hapus baris
    $(document).on('click', '.remove', function(){
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });
    
});

</script>