<?php
require_once('tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

	// Load table data from file
	public function LoadData() {
        $rows = array();

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                $stmt = $dbh->prepare("SELECT gep.gyarto, gep.tipus, gep.kijelzo, gep.memoria, gep.merevlemez, gep.videovezerlo, gep.ar, gep.db
                    FROM (gep INNER JOIN oprendszer on oprendszer.id = gep.oprendszerid)
                    INNER JOIN processzor on processzor.id = gep.processzorid
                    WHERE processzor.gyarto = :gyarto AND oprendszer.nev = :nev AND gep.gyarto=:marka");
             $stmt->execute(array(":gyarto" => $_GET["procnev"], ":nev" => $_GET["oprecnev"], ":marka" => $_GET["mark"]));
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        } catch (PDOException $e) {
            // Kezeld a hibát, például hibauzenet küldésével
            echo "Hiba történt a lekérdezés során: " . $e->getMessage();
        }

        return $rows;
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Web-programozás II');
$pdf->SetTitle('Kiválasztott');
$pdf->SetSubject('Web-programozás II - 3. Labor - TCPDF');
$pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Labor3');

// set default header data
$pdf->SetHeaderData("nje.png", 15, "Készlet", "Web-programozás II\nBeadandó\n".date('Y.m.d',time()));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/hun.php')) {
    require_once(dirname(__FILE__).'/lang/hun.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('helvetica', 'B', 6);

// add a page
$pdf->AddPage();

// table caption
$caption = 'Kiválasztott';

// column titles
$header = array('gyarto', 'tipus', 'kijelzo', 'memoria', 'merevlemez', 'videovezerlo', 'ar', 'db');

// data loading
$rows = $pdf->LoadData();

// print colored table
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(128, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('', 'B');

// Header
$w = array(20, 45, 15, 15, 15, 40, 20, 10); // Column widths
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
}
$pdf->Ln();

// Data
$pdf->SetFont('helvetica', '', 10);
$pdf->SetFillColor(235, 235, 235);
$pdf->SetTextColor(0);

foreach ($rows as $row) {
    for ($i = 0; $i < count($header); $i++) {
        $pdf->Cell($w[$i], 6, $row[$header[$i]], 'LR', 0, 'L', 1);
    }
    $pdf->Ln();
}

$pdf->Cell(array_sum($w), 0, '', 'T');

// close and output PDF document
$pdf->Output('labor3-2.pdf', 'I');

?>
