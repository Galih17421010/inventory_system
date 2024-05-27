<?php 
require_once '../../config/koneksi.php';

// function Untuk Tabel data Keluar
if ($_GET["action"] === "fetchDataStokKeluar") {
    $output= array();
    $sql = "SELECT tanggal, transaksi_keluar, nama_pelanggan, alamat, kd_persediaan_keluar, bahan.nama_bahan as bahan, persediaan_keluar.harga, jumlah, total 
            FROM persediaan_keluar JOIN bahan ON persediaan_keluar.kd_bahan = bahan.kd_bahan ORDER BY tanggal";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        $sub_array = array();   
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal'])); 
        $sub_array[] = $row['kd_persediaan_keluar'];
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

// function Untuk Tabel data masuk
if ($_GET["action"] === "fetchDataStokMasuk") {
    $output= array();
    $sql = "SELECT tanggal, transaksi_masuk, suppliers.nama_supplier, suppliers.alamat, kd_persediaan_masuk, bahan.nama_bahan as bahan, persediaan_masuk.harga, jumlah, total 
            FROM persediaan_masuk JOIN bahan ON persediaan_masuk.kd_bahan = bahan.kd_bahan JOIN suppliers ON persediaan_masuk.kd_supplier = suppliers.kd_supplier ORDER BY tanggal";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        $sub_array = array();   
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal'])); 
        $sub_array[] = $row['kd_persediaan_masuk'];
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

// function Untuk Tabel data masuk
if ($_GET["action"] === "fetchDataStokPersediaan") {
    $output= array();
    $sql = "SELECT bahan.kd_bahan, nama_bahan, SUM(persediaan_masuk.jumlah) as masuk, SUM(persediaan_keluar.jumlah) as keluar, stok, bahan.harga, (stok * bahan.harga) as nilai 
            FROM bahan LEFT JOIN persediaan_masuk ON bahan.kd_bahan = persediaan_masuk.kd_bahan LEFT JOIN persediaan_keluar ON bahan.kd_bahan = persediaan_keluar.kd_bahan 
            GROUP BY bahan.kd_bahan";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        $sub_array = array();   
        $sub_array[] = $row['kd_bahan'];
        $sub_array[] = $row['nama_bahan'];
        $sub_array[] = $row['masuk'];
        $sub_array[] = $row['keluar'];
        $sub_array[] = $row['stok'];
        $sub_array[] = 'Rp '.number_format($row['harga'],0,',','.');
        $sub_array[] = 'Rp '.number_format($row['nilai'],0,',','.');
        $data[] = $sub_array;
    }
    $output = array(
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
    );
    echo  json_encode($output);
}

// function Untuk Tabel data Stok
if ($_GET["action"] === "fetchDataStok") {
    $output= array();
    $sql = "SELECT persediaan.transaksi, persediaan.kd_persediaan, bahan.nama_bahan as bahan, persediaan.tanggal, persediaan.harga, persediaan.jumlah, persediaan.total, persediaan.status 
            FROM(
            SELECT transaksi_masuk as transaksi, kd_persediaan_masuk as kd_persediaan, tanggal, kd_bahan, harga, jumlah, total, CONCAT('IN') as status 
            FROM persediaan_masuk 
            UNION 
            SELECT transaksi_keluar as transaksi, kd_persediaan_keluar as kd_persediaan, tanggal, kd_bahan, harga, jumlah, total, CONCAT('OUT') as status  
            FROM persediaan_keluar
            ) as persediaan JOIN bahan ON persediaan.kd_bahan = bahan.kd_bahan
            ORDER BY tanggal DESC";

    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);

    $count_rows = mysqli_num_rows($query);
    $data = array();

    while($row = mysqli_fetch_assoc($query))
    {
        if ($row['status'] == 'IN') {
            $status = '<span class="badge badge-warning">Beli Persediaan <i class="fas fa-arrow-alt-circle-down"></i></span>';
        }else{
            $status = '<span class="badge badge-success">Jual Persediaan <i class="fas fa-arrow-alt-circle-up"></i></span>';
        }
    
        $sub_array = array();  
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal'])); 
        $sub_array[] = $row['transaksi'];
        $sub_array[] = $row['bahan'];
        $sub_array[] = '<center>'.$status.'</center>';
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