<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

// Capture the output of the PHP file
ob_start();
include(__DIR__ . '/template.php');
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->render();

header('Content-Type: application/pdf');
$dompdf->stream('document.pdf', array("Attachment" => false));

?>
