<?php 
require_once '../../config/koneksi.php';

// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();
    $sql = "SELECT * FROM bahan";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    $no = 1;
    
    while($row = mysqli_fetch_assoc($query))
    {
        $sub_array = array();   
        $sub_array[] = $no++;
        $sub_array[] = $row['kd_bahan'];
        $sub_array[] = $row['nama_bahan'];
        $sub_array[] = '<img src="gambar/produk/'.$row["foto"].'" style="width:50px;height:50px;border:1px solid gray;border-radius:8px;object-fit:cover"></button>';
        $sub_array[] = $row['satuan'];
        $sub_array[] = '<button type="button" data-toggle="modal" data-target="#editModal" value="'.$row["id"].'" class="btn btn-success btn-sm editBtn"><i class="fa fa-edit"></i> Edit</button>  
                        <button type="button" value="'.$row["id"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>
                        <input type="hidden" class="delete_image" value="' .$row["foto"].'">';
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
      // Kode Bahan 
      $qryIdBahan = $koneksi->query("SELECT MAX(kd_bahan) from bahan");
      $rsltBahan = $qryIdBahan->fetch_array();
      $empty = $rsltBahan[0];
      $num = substr($empty,-3, 3);
      $num++;
      $char = "B";
      $kd_bahan = sprintf("%s%03s",$char,$num);

      $nama_bahan = mysqli_real_escape_string($koneksi, $_POST["nama_bahan"]);
      $satuan = mysqli_real_escape_string($koneksi, $_POST["satuan"]);
  
      // Simpan gambar kedalam folder
      $path = "../../gambar/produk/";
      $original_name = $_FILES["foto"]["name"];
      $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
        
      $sql = "INSERT INTO bahan (kd_bahan, nama_bahan, foto, satuan, created_at, updated_at) 
              VALUES ('$kd_bahan','$nama_bahan','$foto','$satuan',NOW(),NOW())";
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
    $sql = "SELECT * FROM bahan WHERE id = $id";
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
    if (!empty($_POST["nama_bahan"]) && !empty($_POST["satuan"])) {
      $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
      $nama_bahan = mysqli_real_escape_string($koneksi, $_POST["nama_bahan"]);
      $satuan = mysqli_real_escape_string($koneksi, $_POST["satuan"]);
  
      if ($_FILES["foto"]["size"] != 0) {
        $path = "../../gambar/produk/";
        $original_name = $_FILES["foto"]["name"];
        $foto = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $foto);
        unlink( $path . $_POST["foto_lama"]);
      } else {
        $foto = mysqli_real_escape_string($koneksi, $_POST["foto_lama"]);
      }
  
      $sql = "UPDATE bahan SET nama_bahan = '$nama_bahan', satuan = '$satuan', foto = '$foto', updated_at = NOW() WHERE id = '$id'";
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

  $sql = "DELETE FROM bahan WHERE `id`=$id";
  $delete =mysqli_query($koneksi,$sql);
  if($delete==true)
  {
      $path = "../../gambar/produk/";
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