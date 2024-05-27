<?php 
require_once '../../config/koneksi.php';

// Fungsi kode otomatis
if ($_GET["action"] === "fetchKode") {
    $qryIdBahan = $koneksi->query("SELECT MAX(kd_bahan) from bahan");
    $rsltBahan = $qryIdBahan->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "B";
    $kd_bahan = sprintf("%s%03s",$char,$num);

  echo $kd_bahan;
  mysqli_close($koneksi);
}


// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();
    $sql = "SELECT * FROM bahan";
    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        if ($row['stok'] == 0) {
          $stok = '<span class="badge badge-info">Belum Tersedia</span>';
        }else{
          $stok = $row['stok'];
        }
        $sub_array = array();   
        $sub_array[] = $row['kd_bahan'];
        $sub_array[] = $row['nama_bahan'];
        $sub_array[] = $stok;
        $sub_array[] = 'Rp '.number_format($row['harga'],0,',','.');
        $sub_array[] = '<button type="button" data-toggle="modal" data-target="#editModal" value="'.$row["id"].'" class="btn btn-success btn-sm editBtn" data-keyboard="false" data-backdrop="static"><i class="fa fa-edit"></i> Edit</button>  
                        <button type="button" value="'.$row["id"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>';
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
      $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
  
      
        
      $sql = "INSERT INTO bahan (kd_bahan, nama_bahan, harga, created_at, updated_at) 
              VALUES ('$kd_bahan','$nama_bahan','$harga',NOW(),NOW())";
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
    if (!empty($_POST["nama_bahan"]) && !empty($_POST["harga"])) {
      $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
      $nama_bahan = mysqli_real_escape_string($koneksi, $_POST["nama_bahan"]);
      $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
    
      $sql = "UPDATE bahan SET nama_bahan = '$nama_bahan', harga = '$harga', updated_at = NOW() WHERE id = '$id'";
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
  $sql = "DELETE FROM bahan WHERE `id`=$id";
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