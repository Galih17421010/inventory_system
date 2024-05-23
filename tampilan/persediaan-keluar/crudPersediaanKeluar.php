<?php 
require_once '../../config/koneksi.php'; 

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

?>