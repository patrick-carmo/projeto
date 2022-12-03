<?php 
    require_once 'dompdf/autoload.inc.php';
	require_once '../connect.php';

    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
	ob_start();

	require_once 'download.php';

	$html = ob_get_clean();

	
	$dompdf->loadHtml($html);

	$dompdf->setPaper('A4', 'landscape');

	$dompdf->render();

	$dompdf->stream();
?>