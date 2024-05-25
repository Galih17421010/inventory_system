<?php
$query = mysqli_query($koneksi,"SELECT *, sum(jumlah) AS totaljumlah, sum(total) AS totalbeli FROM persediaan_masuk WHERE transaksi_masuk = '".$_GET['id']."'");
$row = mysqli_fetch_array($query);
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Detail Transaksi Persediaan Masuk</h3>
          </div>
          <div class="card-body">
              <div class="invoice p-3 mb-3">
                <div class="row">
                  <div class="col-12">
                    <h4><i class="fas fa-globe"></i> <?= $data['nama']?>
                    <span class="float-right">Tanggal : <?= date('d/m/Y', strtotime($row['tanggal']))?></span>
                      <center>Nomor : <?= $row['transaksi_masuk']?> </center>
                    </h4>
                    <hr>
                  </div>
                </div>
                <br>
                <div class="row">

                </div>
                <div class="row">
                  <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Harga Jual</th>
                                <th>Harga Beli</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $transaksi_masuk = $_GET["id"];
                                $sql = "SELECT kd_persediaan_masuk, suppliers.nama_supplier, bahan.nama_bahan as nama_bahan, harga_beli, jumlah, total, harga_jual 
                                        FROM persediaan_masuk JOIN suppliers ON persediaan_masuk.kd_supplier = suppliers.kd_supplier 
                                        JOIN bahan ON persediaan_masuk.kd_bahan = bahan.kd_bahan WHERE transaksi_masuk = '$transaksi_masuk'";
                                $result = mysqli_query($koneksi, $sql);
                                
                            while($datas = mysqli_fetch_array($result)){?>    
                                <tr>
                                    <td><?= $datas['kd_persediaan_masuk']?></td>
                                    <td><?= $datas['nama_supplier']?></td>
                                    <td><?= $datas['nama_bahan']?></td>
                                    <td>Rp <?= number_format($datas['harga_jual'],0,",",".") ?></td>
                                    <td>Rp <?= number_format($datas['harga_beli'],0,",",".") ?></td>
                                    <td><center><?= $datas['jumlah']?></center></td>
                                    <td> Rp <?= number_format($datas['total'],0,",",".") ?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <th colspan="5" style="text-align: right;"><center>Total Keseluruhan</center></th>
                            <td><center><b><?= $row['totaljumlah']?></b></center></td>
                            <td colspan="2"><b>Rp  <?= number_format($row['totalbeli'],0,",",".") ?></b></td>
                        </tfoot>
                    </table>
                  </div>
                </div>  
                <br>    
                <hr>
                <div class="row no-print">
                  <div class="col-12">
                   
                    <a href="?page=persediaan-masuk" class="btn btn-info"><i class="fas fa-backward"></i> Kembali</a>
                    
                    <a href="tampilan/persediaan-masuk/cetak/print.php?id=<?= $row['transaksi_masuk']?>" class="btn btn-success float-right" target="blank"><i class="fa fa-print"> Print Data</i></a>
                  </div>
                </div>    
              </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
