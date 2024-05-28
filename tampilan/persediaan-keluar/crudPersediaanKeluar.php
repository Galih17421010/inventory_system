<?php 
require_once '../../config/koneksi.php'; 


if ($_GET["action"] === "fetchKode") {
    $qryIdBahanKeluar = $koneksi->query("SELECT MAX(transaksi_keluar) from persediaan_keluar");
    $rsltBahan = $qryIdBahanKeluar->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "TK";
    $transaksi_keluar = sprintf("%s%03s",$char,$num);

    echo $transaksi_keluar;
    mysqli_close($koneksi);
}

// function Untuk harga data
if ($_GET["action"] === "fetchSelect") {
    $kd_bahan = $_POST["kd_bahan"];
    $sql = "SELECT * FROM bahan where kd_bahan = '$kd_bahan'";
    $result = mysqli_query($koneksi, $sql);

    $data = mysqli_fetch_assoc($result);
    echo $data['harga'];
    mysqli_close($koneksi);
}

// function Untuk harga data
if ($_GET["action"] === "fetchStok") {
    $kd_bahan = $_POST["kd_bahan="];
    $stok = $_POST['jumlah='];
    $sql = "SELECT * FROM bahan where kd_bahan = '$kd_bahan'";
    $result = mysqli_query($koneksi, $sql);

    $data = mysqli_fetch_assoc($result);
    
    echo $stok > $data['stok'] ? 1 : 0;
    
    mysqli_close($koneksi);
}

// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();

    $sql = "SELECT transaksi_keluar, tanggal, nama_pelanggan, alamat, SUM(jumlah) as jumlah, SUM(total) as total FROM persediaan_keluar GROUP BY transaksi_keluar";

    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        

        $sub_array = array();   
        $sub_array[] = $row['transaksi_keluar'];
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal']));
        $sub_array[] = $row['nama_pelanggan'];
        $sub_array[] = $row['alamat'];
        $sub_array[] = $row['jumlah'];
        $sub_array[] = 'Rp '.number_format($row['total'],0,',','.');
        $sub_array[] = '<a type="button" href="?page=detail-persediaan-keluar&id='.$row["transaksi_keluar"].'" class="btn btn-info btn-sm"><i class="fa fa-file-alt"></i> Detail</a>
                        <button type="button" value="'.$row["transaksi_keluar"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>';
                        
        $data[] = $sub_array;
    }
    $output = array(
        'recordsTotal' =>$count_rows ,
        'recordsFiltered'=>   $total_all_rows,
        'data'=>$data,
    );
    echo  json_encode($output);
}

// Tambah data ke database
if ($_GET["action"] === "insertData") {
    $qryIdBahanKeluar = $koneksi->query("SELECT MAX(transaksi_keluar) from persediaan_keluar");
    $rsltBahan = $qryIdBahanKeluar->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "TK";
    $transaksi_keluar = sprintf("%s%03s",$char,$num);

    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST["nama_pelanggan"]);
    $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);

    $count = count((array)$_POST['jumlah']);

    for ($i=0; $i < $count; $i++) { 
        $qryIdBahanKeluar = $koneksi->query("SELECT MAX(kd_persediaan_keluar) from persediaan_keluar");
        $rsltBahan = $qryIdBahanKeluar->fetch_array();
        $empty = $rsltBahan[0];
        $num = substr($empty,-3, 3);
        $num++;
        $char = "BK";
        $kd_persediaan_keluar = sprintf("%s%03s",$char,$num);

        $kd_bahan = mysqli_real_escape_string($koneksi, $_POST["bahan"][$i]);
        $harga = mysqli_real_escape_string($koneksi, $_POST["harga"][$i]);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"][$i]);
        $total = $harga * $jumlah;

        $sql = "INSERT INTO persediaan_keluar (transaksi_keluar, kd_persediaan_keluar, tanggal, nama_pelanggan, alamat, kd_bahan, harga, jumlah, total, created_at, updated_at) 
                VALUES ('$transaksi_keluar','$kd_persediaan_keluar','$tanggal','$nama_pelanggan','$alamat','$kd_bahan','$harga','$jumlah','$total',NOW(),NOW())";
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


// function to delete data
if ($_GET["action"] === "deleteData") {
    $transaksi_keluar = $_POST["transaksi_keluar"];
  
    $sql = "DELETE FROM persediaan_keluar WHERE transaksi_keluar = '$transaksi_keluar'";
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