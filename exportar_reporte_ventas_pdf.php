<?php
require('fpdf/fpdf.php');
include 'conexion.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,'Reporte de Ventas',0,1,'C');
$pdf->Ln(4);

// --- TOP 20 productos más vendidos ---
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,8,'Top 20 Productos Mas Vendidos',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7,'ID',1);
$pdf->Cell(60,7,'Nombre',1);
$pdf->Cell(50,7,'Marca',1);
$pdf->Cell(30,7,'Total Vendido',1);
$pdf->Ln();

$sqlTop20 = "
  SELECT
    p.IdProducto,
    p.Nombre,
    p.Marca,
    SUM(v.CantidadVendida) AS TotalVendida
  FROM Ventas AS v
  JOIN Productos AS p ON v.IdProducto = p.IdProducto
  GROUP BY p.IdProducto, p.Nombre, p.Marca
  ORDER BY TotalVendida DESC
  LIMIT 20
";
$resTop20 = $conn->query($sqlTop20);
$pdf->SetFont('Arial','',10);
while($r = $resTop20->fetch_assoc()) {
    $pdf->Cell(20,7,$r['IdProducto'],1);
    $pdf->Cell(60,7,utf8_decode($r['Nombre']),1);
    $pdf->Cell(50,7,utf8_decode($r['Marca']),1);
    $pdf->Cell(30,7,$r['TotalVendida'],1);
    $pdf->Ln();
}

$pdf->Ln(7);

// --- Producto menos vendido ---
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,8,'Producto Menos Vendido',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7,'ID',1);
$pdf->Cell(60,7,'Nombre',1);
$pdf->Cell(50,7,'Marca',1);
$pdf->Cell(30,7,'Total Vendido',1);
$pdf->Ln();

$sqlMin = "
  SELECT
    p.IdProducto,
    p.Nombre,
    p.Marca,
    SUM(v.CantidadVendida) AS TotalVendida
  FROM Ventas AS v
  JOIN Productos AS p ON v.IdProducto = p.IdProducto
  GROUP BY p.IdProducto, p.Nombre, p.Marca
  ORDER BY TotalVendida ASC
  LIMIT 1
";
$resMin = $conn->query($sqlMin);
$pdf->SetFont('Arial','',10);
if($m = $resMin->fetch_assoc()) {
    $pdf->Cell(20,7,$m['IdProducto'],1);
    $pdf->Cell(60,7,utf8_decode($m['Nombre']),1);
    $pdf->Cell(50,7,utf8_decode($m['Marca']),1);
    $pdf->Cell(30,7,$m['TotalVendida'],1);
    $pdf->Ln();
}

$pdf->Output('D', 'reporte_ventas.pdf');
exit;
?>