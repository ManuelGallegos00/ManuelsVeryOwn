<?php
include("conexion.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=nomina.xls");

$sql = "SELECT * FROM Nomina";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "No hay datos disponibles en la tabla Nomina.";
} else {
    echo "IdNomina	IdEmpleado	SalarioBase	Faltas	VentasExtra	HorasExtra
";
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['IdNomina']."	".$row['IdEmpleado']."	".$row['SalarioBase']."	".$row['Faltas']."	".$row['VentasExtra']."	".$row['HorasExtra']."
";
    }
}
?>
