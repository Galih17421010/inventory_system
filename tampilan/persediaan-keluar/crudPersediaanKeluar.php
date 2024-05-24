<?php 
require_once '../../config/koneksi.php'; 
require_once '../../asset/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

if ($_GET["action"] === "fetchKode") {
    $qryIdBahanKeluar = $koneksi->query("SELECT MAX(kd_persediaan_keluar) from persediaan_keluar");
    $rsltBahan = $qryIdBahanKeluar->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "BK";
    $kd_persediaan_keluar = sprintf("%s%03s",$char,$num);

    echo $kd_persediaan_keluar;
    mysqli_close($koneksi);
}

if ($_GET["action"] === "fetchSelect") {
    $kd_persediaan_masuk = $_POST["kd_persediaan_masuk"];
    $sql = "SELECT * FROM persediaan_masuk where kd_persediaan_masuk = '$kd_persediaan_masuk'";
    $result = mysqli_query($koneksi, $sql);


    $data = mysqli_fetch_assoc($result);
    echo $data['harga'];
    
    mysqli_close($koneksi);
}

// Tambah data ke database
if ($_GET["action"] === "insertData") {
    $qryIdBahanKeluar = $koneksi->query("SELECT MAX(kd_persediaan_keluar) from persediaan_keluar");
    $rsltBahan = $qryIdBahanKeluar->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "BK";
    $kd_persediaan_keluar = sprintf("%s%03s",$char,$num);

    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST["nama_pelanggan"]);
    $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);

    $count = count((array)$_POST['jumlah']);

    for ($i=0; $i < $count; $i++) { 
        $kd_persediaan_masuk = mysqli_real_escape_string($koneksi, $_POST["bahan"][$i]);
        $harga = mysqli_real_escape_string($koneksi, $_POST["harga"][$i]);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"][$i]);
        $total = mysqli_real_escape_string($koneksi, $_POST["total"][$i]);

        $sql = "INSERT INTO persediaan_keluar (kd_persediaan_keluar, tanggal, nama_pelanggan, alamat, kd_persediaan_masuk, harga, jumlah, total, created_at, updated_at) 
                VALUES ('$kd_persediaan_keluar','$tanggal','$nama_pelanggan','$alamat','$kd_persediaan_masuk','$harga','$jumlah','$total',NOW(),NOW())";
        $query= mysqli_query($koneksi,$sql);
        $lastId = mysqli_insert_id($koneksi);
    }

    if($query == true)
    {
        $data = array(
            'status'=>'true',
        );
        echo json_encode($data);
    }
    else
    {
         $data = array(
            'status'=>'false',
        );
        echo json_encode($data);
    } 
}


// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();

    $sql = "SELECT id, kd_persediaan_keluar, tanggal, nama_pelanggan, alamat, SUM(jumlah) as jumlah, SUM(total) as total FROM `persediaan_keluar` GROUP BY kd_persediaan_keluar";

    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        

        $sub_array = array();   
        $sub_array[] = $row['kd_persediaan_keluar'];
        $sub_array[] = $row['nama_pelanggan'];
        $sub_array[] = $row['alamat'];
        $sub_array[] = $row['jumlah'];
        $sub_array[] = 'Rp '.number_format($row['total'],0,',','.');
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal']));
        $sub_array[] = '<a type="button" href="?page=edit-persediaan-keluar&id='.$row["kd_persediaan_keluar"].'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <button type="button" value="'.$row["kd_persediaan_keluar"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>
                        <a type="button" href="tampilan/persediaan-keluar/print.php?id='.$row["kd_persediaan_keluar"].'" class="btn btn-primary btn-sm printBtn" target="blank">
                        <i class="fa fa-print"></i> Print</a>';
                        
        $data[] = $sub_array;
    }
    $output = array(
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
    );
    echo  json_encode($output);
}

// Edit data
if ($_GET["action"] === "fetchSingle") {
    
    $kd_persediaan_keluar = $_POST["kd_persediaan_keluar"];
    $sql = "SELECT * FROM persediaan_keluar WHERE kd_persediaan_keluar = '$kd_persediaan_keluar'";
    $result = mysqli_query($koneksi, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result);
      echo json_encode([
        "statusCode" => 200,
        "data" => $data
      ]);
    } else {
      echo json_encode([
        "statusCode" => 404,
        "message" => "No user found with this id"
      ]);
    }
    mysqli_close($koneksi);
}


// function to delete data
if ($_GET["action"] === "deleteData") {
    $kd_persediaan_keluar = $_POST["kd_persediaan_keluar"];
  
    $sql = "DELETE FROM persediaan_keluar WHERE kd_persediaan_keluar = '$kd_persediaan_keluar'";
    $delete =mysqli_query($koneksi,$sql);
    if($delete==true)
    {
        $data = array(
            'status'=>'success',
        );
        echo json_encode($data);
    }
    else
    {
        $data = array(
            'status'=>'failed',
        );
        echo json_encode($data);
    } 
}

?>