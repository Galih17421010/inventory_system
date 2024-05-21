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
?>