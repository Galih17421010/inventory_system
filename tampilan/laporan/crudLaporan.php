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
        $sub_array[] = $row['stok'];
        $sub_array[] = '<button type="button" data-toggle="modal" data-target="#editModal" value="'.$row["id"].'" class="btn btn-success btn-sm editBtn" data-keyboard="false" data-backdrop="static"><i class="fa fa-edit"></i> Edit</button>  
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


?>