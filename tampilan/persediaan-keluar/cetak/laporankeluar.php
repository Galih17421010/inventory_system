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

    <title>Print <?= $data['transaksi_keluar']?></title>
</head>
<body>
    <center>CV TIA RISWAN</center>
    <center>Laporan Stok Bahan Keluar</center>
    <center>Per Periode : <?= date('d/m/Y', strtotime($data['tanggal']))?></center>
    <br><br><br>
    
        <table style="width:100%">
            <thead>
                <tr>
                    <th>Kode Bahan</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Bahan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                require_once '../../../config/koneksi.php'; 
                    $transaksi_keluar = $_GET["id"];
                    $sql = "SELECT kd_persediaan_keluar, nama_pelanggan, alamat, bahan.nama_bahan as nama_bahan, jumlah, total, persediaan_keluar.harga 
                            FROM persediaan_keluar JOIN bahan ON persediaan_keluar.kd_bahan = bahan.kd_bahan WHERE transaksi_keluar = '$transaksi_keluar' ORDER BY kd_persediaan_keluar";
                    $result = mysqli_query($koneksi, $sql);
                    
                while($datas = mysqli_fetch_array($result)){?>    
                    <tr>
                        <td><?= $datas['kd_persediaan_keluar']?></td>
                        <td><?= $datas['nama_pelanggan']?></td>
                        <td><?= $datas['alamat']?></td>
                        <td><?= $datas['nama_bahan']?></td>
                        <td>Rp <?= number_format($datas['harga'],0,",",".") ?></td>
                        <td><?= $datas['jumlah']?></td>
                        <td> Rp <?= number_format($datas['total'],0,",",".") ?></td>
                    </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><center><b>Total</b></center></td>
                    <td><b><?= $data['totaljumlah'] ?></b></td>
                    <td><b>Rp <?= number_format($data['totalbeli'],0,",",".") ?></b></td>
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