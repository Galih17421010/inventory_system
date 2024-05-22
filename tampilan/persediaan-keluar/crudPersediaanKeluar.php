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

    $kd_supplier = mysqli_real_escape_string($koneksi, $_POST["kd_supplier"]);
    $kd_bahan = mysqli_real_escape_string($koneksi, $_POST["kd_bahan"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"]);
    $total = $harga * $jumlah ;
      
    $sql = "INSERT INTO persediaan_keluar (kd_persediaan_masuk, tanggal, kd_supplier, kd_bahan, harga, jumlah, total, created_at, updated_at) 
            VALUES ('$kd_PersediaanMasuk','$tanggal','$kd_supplier','$kd_bahan','$harga','$jumlah','$total',NOW(),NOW())";
    $query= mysqli_query($koneksi,$sql);
    $lastId = mysqli_insert_id($koneksi);
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