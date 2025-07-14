<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Courier','B',16);
$pdf->Cell(0,10,'✅ FPDF funciona correctamente con Courier!', 0, 1);
$pdf->Ln(10);
$pdf->SetFont('Courier','',12);
$pdf->Cell(0,10,'Este PDF fue generado sin usar Arial.', 0, 1);
$pdf->Output();
?>
