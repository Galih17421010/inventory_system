<?php 
require_once '../../config/koneksi.php';

// Edit data
if ($_GET["action"] === "fetchSingle") {
    $sql = "SELECT * FROM system_info WHERE id = 1";
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
        "message" => "No user found with this id"
      ]);
    }
    mysqli_close($koneksi);
}

// Update Data
if ($_GET["action"] === "updateData") {

    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $singkatan = mysqli_real_escape_string($koneksi, $_POST["singkatan"]);
    $email = mysqli_real_escape_string($koneksi, $_POST["email"]);


    if ($_FILES["gambar"]["size"] != 0) {
      $path = "../../gambar/";
      $original_name = $_FILES["gambar"]["name"];
      $gambar = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["gambar"]["tmp_name"], $path . $gambar);
      unlink( $path . $_POST["gambar_lama"]);
    } else {
      $gambar = mysqli_real_escape_string($koneksi, $_POST["gambar_lama"]);
    }

    $sql = "UPDATE system_info SET nama = '$nama', singkatan ='$singkatan', email = '$email', gambar = '$gambar', updated_at = NOW() WHERE id = 1";
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

?>