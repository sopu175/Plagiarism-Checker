<?php

// Include 'Composer' autoloader.
include 'vendor/autoload.php';

//$parser = new \Smalot\PdfParser\Parser();
//$parser2 = new \Smalot\PdfParser\Parser();
//$pdf    = $parser->parseFile('uploads/Guide-to-Google-Search-Console.pdf');
//$pdf2    = $parser2->parseFile('uploads/United.pdf');
//
//
//$pages  = $pdf->getPages();
//$pagetow = $pdf2->getPages();
//

//// Loop over each page to extract text.
//foreach ($pages as $page) {
//    echo $page->getText();
//}
//
//foreach ($pagetow as $pagess) {
//    echo $pagess->getText();
//}


$path = '/uploads/int_29_sec_01.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename='.$path);
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

readfile($path);
?>