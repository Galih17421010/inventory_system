<?php 
require_once '../../config/koneksi.php';


// function Untuk Tabel data Keluar
if ($_GET["action"] === "fetchDataStokKeluar") {
    $output= array();
    $sql = "SELECT tanggal, transaksi_keluar, nama_pelanggan, alamat, kd_persediaan_keluar, bahan.nama_bahan as bahan, persediaan_keluar.harga, jumlah, total 
            FROM persediaan_keluar JOIN bahan ON persediaan_keluar.kd_bahan = bahan.kd_bahan";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        $sub_array = array();   
        $sub_array[] = $row['kd_persediaan_keluar'];
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal'])); 
        $sub_array[] = $row['bahan'];
        $sub_array[] = $row['nama_pelanggan'];
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