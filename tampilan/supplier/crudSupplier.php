<?php 
require_once '../../config/koneksi.php';

// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $sql = "SELECT * FROM suppliers";
    $result = mysqli_query($koneksi, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    mysqli_close($koneksi);
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data
    ]);
}

// Tambah data ke database
if ($_GET["action"] === "insertData") {
    if (!empty($_POST["nama_supplier"]) && !empty($_POST["no_telp"]) && !empty($_POST["alamat"])) {

      // Kode supplier 
      $qryIdSupplier = $koneksi->query("SELECT MAX(kd_supplier) from suppliers");
      $rsltSupplier = $qryIdSupplier->fetch_array();
      $empty = $rsltSupplier[0];
      $num = substr($empty,-3, 3);
      $num++;
      $char = "S";
      $kd_supplier = sprintf("%s%03s",$char,$num);

      // $kd_supplier = mysqli_real_escape_string($koneksi, $idSupplier);
      $nama_supplier = mysqli_real_escape_string($koneksi, $_POST["nama_supplier"]);
      $no_telp = mysqli_real_escape_string($koneksi, $_POST["no_telp"]);
      $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);
  
      // Simpan gambar kedalam folder
      $path = "../../gambar/supplier/";
      $original_name = $_FILES["foto"]["name"];
      $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
  
      $sql = "INSERT INTO suppliers (kd_supplier, nama_supplier, no_telp, alamat, foto, created_at, updated_at) VALUES ('$kd_supplier','$nama_supplier','$no_telp','$alamat','$foto',NOW(),NOW())";
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
}

// Edit data
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM suppliers WHERE id = $id";
  $result = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

// Update Data
if ($_GET["action"] === "updateData") {
  if (!empty($_POST["nama_supplier"]) && !empty($_POST["no_telp"]) && !empty($_POST["alamat"])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST["nama_supplier"]);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST["no_telp"]);
    $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);

    if ($_FILES["foto"]["size"] != 0) {
      $path = "../../gambar/supplier/";
      $original_name = $_FILES["foto"]["name"];
      $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
      unlink( $path . $_POST["foto_lama"]);
    } else {
      $foto = mysqli_real_escape_string($koneksi, $_POST["foto_lama"]);
    }

    $sql = "UPDATE suppliers SET nama_supplier = '$nama_supplier', no_telp = '$no_telp', alamat = '$alamat', foto = '$foto', updated_at = NOW() WHERE id = '$id'";
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

    mysqli_close($koneksi);
  } 
}

// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  $delete_image = $_POST["delete_image"];

  $sql = "DELETE FROM suppliers WHERE `id`=$id";
  $delete =mysqli_query($koneksi,$sql);
  if($delete==true)
  {
      $path = "../../gambar/supplier/";
      unlink($path . $delete_image);
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