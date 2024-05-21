<?php 
require_once '../../config/koneksi.php';

// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();
    $sql = "SELECT * FROM users";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    $no = 1;
    
    while($row = mysqli_fetch_assoc($query))
    {
        if ($row['status'] != 1) {
            $status = 'Pimpinan';
        }else{
            $status = 'Admin';
        }
    
        $sub_array = array();   
        $sub_array[] = $no++;
        $sub_array[] = $row['nama_lengkap'];
        $sub_array[] = $row['email'];
        $sub_array[] = '<img src="gambar/user/'.$row["foto"].'" style="width:50px;height:50px;border:1px solid gray;border-radius:8px;object-fit:cover"></button>';
        $sub_array[] = $status;
        $sub_array[] = date('d M Y', strtotime($row['created_at']) );
        $sub_array[] = '<button type="button" data-toggle="modal" data-target="#editModal" value="'.$row["id"].'" class="btn btn-success btn-sm editBtn"><i class="fa fa-edit"></i> Edit</button>  
                        <button type="button" value="'.$row["id"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>
                        <input type="hidden" class="delete_image" value="'.$row["foto"].'">';
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

      $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST["nama_lengkap"]);
      $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
      $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
      $no_telp = mysqli_real_escape_string($koneksi, $_POST["no_telp"]);
      $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);
      $status = mysqli_real_escape_string($koneksi, $_POST["status"]);
  
      // Simpan gambar kedalam folder
      $path = "../../gambar/user/";
      $original_name = $_FILES["foto"]["name"];
      $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
        
      $sql = "INSERT INTO users (nama_lengkap, email, password, no_telp, foto, status, alamat, created_at, updated_at)
              value('$nama_lengkap', '$email', '$password', '$no_telp','$foto','$status','$alamat',NOW(),NOW() )";

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

// Edit data
if ($_GET["action"] === "fetchSingle") {
    $id = $_POST["id"];
    $sql = "SELECT * FROM users WHERE id = $id";
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
      $status = mysqli_real_escape_string($koneksi, $_POST["status"]);
  
      if ($_FILES["foto"]["size"] != 0) {
        $path = "../../gambar/user/";
        $original_name = $_FILES["foto"]["name"];
        $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
        unlink( $path . $_POST["foto_lama"]);
      } else {
        $foto = mysqli_real_escape_string($koneksi, $_POST["foto_lama"]);
      }
  
      $sql = "UPDATE users SET nama_lengkap = '$nama_lengkap', email = '$email', password='$password', no_telp = '$no_telp', alamat = '$alamat', foto = '$foto', status = '$status', updated_at = NOW() WHERE id = '$id'";
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
  
// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  $delete_image = $_POST["delete_image"];

  $sql = "DELETE FROM users WHERE `id`=$id";
  $delete =mysqli_query($koneksi,$sql);
  if($delete==true)
  {
      $path = "../../gambar/user/";
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