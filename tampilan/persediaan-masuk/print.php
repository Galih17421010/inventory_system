<?php 

require_once '../../config/koneksi.php';
require_once '../../asset/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id = $_GET["id"];
$sql = "SELECT persediaan_masuk.id, kd_persediaan_masuk, tanggal, suppliers.nama_supplier as supplier, bahan.nama_bahan as bahan, harga, jumlah, total 
FROM persediaan_masuk join suppliers ON suppliers.kd_supplier = persediaan_masuk.kd_supplier 
JOIN bahan ON bahan.kd_bahan = persediaan_masuk.kd_bahan WHERE persediaan_masuk.id=$id";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

$pdf = new Dompdf(array("enable_remote" => true));
ob_start();
require_once '../../tampilan/persediaan-masuk/laporanmasuk.php';
$file = ob_get_contents();
ob_get_clean();

$pdf->loadHtml($file);

$pdf->setPaper('A4','landscape');
$pdf->render();
$pdf->stream('Data-'.$kd_persediaan_masuk.'.pdf',['Attachment'=>false]);

?>
