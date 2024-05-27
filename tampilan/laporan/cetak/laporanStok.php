<?php 
require_once '../../../config/koneksi.php';

$sql = "SELECT SUM(stok) as stok, SUM(stok * harga) as nilai FROM bahan";
$result = mysqli_query($koneksi, $sql);
$datas = mysqli_fetch_array($result);

?>

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

    <title>Print Stok</title>
</head>
<body>
    <center>CV TIA RISWAN</center>
    <center>Laporan Stok Persediaan</center>
    <br><br><br>
    
        <table style="width:100%">
            <thead>
                <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Sisa Stok</th>
                <th>Harga</th>
                <th>Total Nilai Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                require_once '../../../config/koneksi.php';

                $sql = "SELECT bahan.kd_bahan, nama_bahan, SUM(persediaan_masuk.jumlah) as masuk, SUM(persediaan_keluar.jumlah) as keluar, stok, bahan.harga, (stok * bahan.harga) as nilai 
                        FROM bahan LEFT JOIN persediaan_masuk ON bahan.kd_bahan = persediaan_masuk.kd_bahan LEFT JOIN persediaan_keluar ON bahan.kd_bahan = persediaan_keluar.kd_bahan 
                        GROUP BY bahan.kd_bahan";
                $laporan = mysqli_query($koneksi, $sql);
                while($row = mysqli_fetch_array($laporan)){?>    
                    <tr>
                        <td><?= $row['kd_bahan']?></td>
                        <td><?= $row['nama_bahan']?></td>
                        <td><?= $row['masuk']?></td>
                        <td><?= $row['keluar']?></td>
                        <td><?= $row['stok']?></td>
                        <td>Rp <?= number_format($row['harga'],0,",",".") ?></td>
                        <td> Rp <?= number_format($row['nilai'],0,",",".") ?></td>
                    </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><center><b>Total Keseluruhan</b></center></td>
                    <td><b><?= $datas['stok'] ?></b></td>
                    <td></td>
                    <td><b>Rp <?= number_format($datas['nilai'],0,",",".") ?></b></td>
                </tr>
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
            Bandar Lampung,.........................................<br><br><br><br><br>
            Admin
        </div><br>
        </td>
    </tr>
   </table>
  
    
</body>
</html>