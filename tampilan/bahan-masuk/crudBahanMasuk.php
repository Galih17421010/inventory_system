<?php 
require_once '../../config/koneksi.php';


// function Untuk Tabel data masuk
if ($_GET["action"] === "fetchDataStokMasuk") {
    
    $sql = "SELECT tanggal, transaksi_masuk, suppliers.nama_supplier, suppliers.alamat, kd_persediaan_masuk, bahan.nama_bahan as bahan, persediaan_masuk.harga, jumlah, total 
            FROM persediaan_masuk JOIN bahan ON persediaan_masuk.kd_bahan = bahan.kd_bahan JOIN suppliers ON persediaan_masuk.kd_supplier = suppliers.kd_supplier";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        $sub_array = array();   
        $sub_array[] = $row['kd_persediaan_masuk'];
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal'])); 
        $sub_array[] = $row['bahan'];
        $sub_array[] = $row['nama_supplier'];
        $sub_array[] = $row['alamat'];
        $sub_array[] = $row['jumlah'];
        $sub_array[] = 'Rp '.number_format($row['harga'],0,',','.');
        $sub_array[] = 'Rp '.number_format($row['total'],0,',','.');
        $data[] = $sub_array;
    }
    $output = array(
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
    );
    echo  json_encode($output);
}
?>