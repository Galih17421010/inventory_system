<?php 
require_once '../../config/koneksi.php';

// Edit data
if ($_GET["action"] === "fetchSingle") {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $sql = "SELECT * FROM users WHERE id = '$id'";
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

      $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
      $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST["nama_lengkap"]);
      $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
      $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
      $no_telp = mysqli_real_escape_string($koneksi, $_POST["no_telp"]);
      $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);

      if ($_FILES["foto"]["size"] != 0) {
        $path = "../../gambar/user/";
        $original_name = $_FILES["foto"]["name"];
        $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
        unlink( $path . $_POST["foto_lama"]);
      } else {
        $foto = mysqli_real_escape_string($koneksi, $_POST["foto_lama"]);
      }
  
      $sql = "UPDATE users SET nama_lengkap = '$nama_lengkap', email = '$email', password='$password', no_telp = '$no_telp', alamat = '$alamat', foto = '$foto', updated_at = NOW() WHERE id = '$id'";
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