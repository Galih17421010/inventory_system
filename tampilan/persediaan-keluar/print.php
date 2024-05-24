<?php 

require_once '../../config/koneksi.php';
require_once '../../asset/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$kd_persediaan_keluar = $_GET["id"];
$sql = "SELECT *, sum(jumlah) AS totaljumlah, sum(total) AS totalbeli FROM persediaan_keluar  WHERE kd_persediaan_keluar = '$kd_persediaan_keluar'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

$pdf = new Dompdf(array("enable_remote" => true));
ob_start();
require_once '../../tampilan/persediaan-keluar/laporankeluar.php';
$file = ob_get_contents();
ob_get_clean();

$pdf->loadHtml($file);

$pdf->setPaper('A4','landscape');
$pdf->render();
$pdf->stream('Data-'.$kd_persediaan_keluar.'.pdf',['Attachment'=>false]);

?>
