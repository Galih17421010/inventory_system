<?php 
//koneksi
$koneksi = mysqli_connect("localhost","root","","inventori");

if(!$koneksi){
    die(mysqli_connect_errno());
}

//sistem
$sql = "SELECT * FROM system_info WHERE id = 1";
$sistem = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($sistem);

?>