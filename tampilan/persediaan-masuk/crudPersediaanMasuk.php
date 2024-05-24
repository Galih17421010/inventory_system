<?php 
require_once '../../config/koneksi.php'; 


if ($_GET["action"] === "fetchKode") {
    $qryIdBahanMasuk = $koneksi->query("SELECT MAX(kd_persediaan_masuk) from persediaan_masuk");
    $rsltBahan = $qryIdBahanMasuk->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "BM";
    $kd_persediaan_masuk = sprintf("%s%03s",$char,$num);

    echo $kd_persediaan_masuk;
    mysqli_close($koneksi);
}

// function Untuk Tabel data
if ($_GET["action"] === "fetchData") {
    $output= array();

    $sql = "SELECT persediaan_masuk.id, kd_persediaan_masuk, tanggal, suppliers.nama_supplier as supplier, bahan.nama_bahan as bahan, harga, jumlah, total 
            FROM persediaan_masuk join suppliers ON suppliers.kd_supplier = persediaan_masuk.kd_supplier 
            JOIN bahan ON bahan.kd_bahan = persediaan_masuk.kd_bahan";

    $totalQuery = mysqli_query($koneksi,$sql);
    $total_all_rows = mysqli_num_rows($totalQuery);
    
    $query = mysqli_query($koneksi,$sql);
    $count_rows = mysqli_num_rows($query);
    $data = array();
    
    while($row = mysqli_fetch_assoc($query))
    {
        

        $sub_array = array();   
        $sub_array[] = $row['kd_persediaan_masuk'];
        $sub_array[] = date('d/m/Y', strtotime($row['tanggal']));
        $sub_array[] = $row['supplier'];
        $sub_array[] = $row['bahan'];
        $sub_array[] = 'Rp '.number_format($row['harga'],0,',','.');
        $sub_array[] = $row['jumlah'];
        $sub_array[] = 'Rp '.number_format($row['total'],0,',','.');
        $sub_array[] = '<button type="button" data-toggle="modal" data-target="#editModal" value="'.$row["id"].'" class="btn btn-success btn-sm editBtn" data-keyboard="false" data-backdrop="static">
                            <i class="fa fa-edit"></i> Edit</button>  
                        <button type="button" value="'.$row["id"].'" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i> Delete</button>
                        <a href="tampilan/persediaan-masuk/print.php?id='.$row["id"].'" class="btn btn-primary btn-sm printBtn" target="blank"><i class="fa fa-print"> Print</i></a>';
                        
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
    $qryIdBahanMasuk = $koneksi->query("SELECT MAX(kd_persediaan_masuk) from persediaan_masuk");
    $rsltBahan = $qryIdBahanMasuk->fetch_array();
    $empty = $rsltBahan[0];
    $num = substr($empty,-3, 3);
    $num++;
    $char = "BM";
    $kd_PersediaanMasuk = sprintf("%s%03s",$char,$num);

    $kd_supplier = mysqli_real_escape_string($koneksi, $_POST["kd_supplier"]);
    $kd_bahan = mysqli_real_escape_string($koneksi, $_POST["kd_bahan"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"]);
    $total = $harga * $jumlah ;
      
    $sql = "INSERT INTO persediaan_masuk (kd_persediaan_masuk, tanggal, kd_supplier, kd_bahan, harga, jumlah, total, created_at, updated_at) 
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

// Edit data
if ($_GET["action"] === "fetchSingle") {
    $id = $_POST["id"];
    $sql = "SELECT * FROM persediaan_masuk WHERE id = $id";
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
    if (!empty($_POST["harga"]) && !empty($_POST["jumlah"])) {
        $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
        $kd_supplier = mysqli_real_escape_string($koneksi, $_POST["kd_supplier"]);
        $kd_bahan = mysqli_real_escape_string($koneksi, $_POST["kd_bahan"]);
        $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
        $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"]);
        $total = $harga * $jumlah ;
  
      $sql = "UPDATE persediaan_masuk SET tanggal = '$tanggal', kd_supplier = '$kd_supplier', kd_bahan = '$kd_bahan', harga = '$harga', jumlah = '$jumlah', total = '$total', updated_at = NOW() WHERE id = '$id'";
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
  
    $sql = "DELETE FROM persediaan_masuk WHERE `id`=$id";
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