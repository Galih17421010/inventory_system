<?php 

require_once '../../../asset/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$pdf = new Dompdf(array("enable_remote" => true));
ob_start();

require_once '../../../tampilan/laporan/cetak/laporanStok.php';
$file = ob_get_contents();
ob_get_clean();

$pdf->loadHtml($file);

$pdf->setPaper('A4','landscape');
$pdf->render();
$pdf->stream('Data-Stok.pdf',['Attachment'=>false]);

?>
