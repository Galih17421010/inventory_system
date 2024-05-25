<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<style>
table, th, td {
    border:1px solid black;
    border-collapse: collapse;
}
tr {
    text-align: center;
}
</style>

    <title>Print <?= $data['transaksi_masuk']?></title>
</head>
<body>
    <center>CV TIA RISWAN</center>
    <center>Laporan Stok Bahan Masuk</center>
    <center>Per Periode : <?= date('d/m/Y', strtotime($data['tanggal']))?></center>
    <br><br><br>
    
        <table style="width:100%">
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
                <td><center><b><?= $data['totaljumlah']?></b></center></td>
                <td><center><b>Rp  <?= number_format($data['totalbeli'],0,",",".") ?></b></center></td>
            </tfoot>
        </table>
    </div>
    <br><br><br><br>
    
   <table style="width:100%">
   <tr style="border:1px solid white;">
        <td style="border: white;">
            <div style="height: 80px; overflow: auto; padding: 10px; text-align: justify; width: 650px;">
            Pimpinan
         
        </div><br>
        </td>
        <td style="border: white; ">
            <div style="height: 80px; overflow: auto; padding: 10px; text-align: justify;">
            Bandar Lampung,.........................................</strong><br><br><br><br><br>
            Admin
        </div><br>
        </td>
    </tr>
   </table>

    
</body>
</html>