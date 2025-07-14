<?php
require('fpdf/fpdf.php'); // Cambia 'fpdf' por 'fpdf181' si es tu carpeta
include("conexion.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(40,10, 'ID Nomina');
$pdf->Cell(40,10, 'ID Empleado');
$pdf->Cell(40,10, 'Salario Base');
$pdf->Ln();

$sql = "SELECT * FROM Nomina";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $pdf->Cell(10, 10, 'No hay datos en la tabla Nomina.', 0, 1);
} else {
    while($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40,10, $row['IdNomina']);
        $pdf->Cell(40,10, $row['IdEmpleado']);
        $pdf->Cell(40,10, $row['SalarioBase']);
        $pdf->Ln();
    }
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="nomina.pdf"');

$pdf->Output();
?>