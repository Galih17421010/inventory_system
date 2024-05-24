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

    <title>Print <?= $data['kd_persediaan_masuk']?></title>
</head>
<body>
    <center>CV TIA RISWAN</center>
    <center>Laporan Stok Bahan Masuk</center>
    <center>Per Periode : <?= date('d/m/Y', strtotime($data['tanggal']))?></center>
    <br><br><br>
    
        <table style="width:100%">
            <thead>
                <tr>
                    <th>ID Bahan</th>
                    <th>Nama Supplier</th>
                    <th>Nama Bahan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['kd_persediaan_masuk']?></td>
                    <td><?= $data['supplier']?></td>
                    <td><?= $data['bahan']?></td>
                    <td>Rp <?= number_format($data['harga'],0,",",".") ?></td>
                    <td><?= $data['jumlah']?></td>
                    <td> Rp <?= number_format($data['total'],0,",",".") ?></td>
                </tr>
            </tbody>
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