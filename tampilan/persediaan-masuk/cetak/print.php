<?php 

require_once '../../../config/koneksi.php';
require_once '../../../asset/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$transaksi_masuk = $_GET["id"];
$sql = "SELECT *, sum(jumlah) AS totaljumlah, sum(total) AS totalbeli FROM persediaan_masuk  WHERE transaksi_masuk = '$transaksi_masuk'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

$pdf = new Dompdf(array("enable_remote" => true));
ob_start();

require_once '../../../tampilan/persediaan-masuk/cetak/laporanmasuk.php';
$file = ob_get_contents();
ob_get_clean();

$pdf->loadHtml($file);

$pdf->setPaper('A4','landscape');
$pdf->render();
$pdf->stream('Data-'.$transaksi_masuk.'.pdf',['Attachment'=>false]);

?>
