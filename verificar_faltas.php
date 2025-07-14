<?php
include("conexion.php");

$empleado_id = 10;

// Verificar si el empleado existe
$sql_empleado = "SELECT * FROM Empleados WHERE IdEmpleado = $empleado_id";
$res_empleado = mysqli_query($conn, $sql_empleado);

if (mysqli_num_rows($res_empleado) == 0) {
    echo "<p style='color: red; font-weight: bold;'>⚠️ El empleado con ID = 10 no existe en la tabla Empleados.</p>";
} else {
    // Verificar si tiene nómina registrada
    $sql_nomina = "SELECT Faltas FROM Nomina WHERE IdEmpleado = $empleado_id";
    $res_nomina = mysqli_query($conn, $sql_nomina);

    if (mysqli_num_rows($res_nomina) == 0) {
        echo "<p style='color: orange; font-weight: bold;'>⚠️ El empleado existe, pero no tiene registros en la tabla Nomina.</p>";
    } else {
        $row = mysqli_fetch_assoc($res_nomina);
        if ((int)$row['Faltas'] == 0) {
            echo "<p style='color: red; font-weight: bold;'>🚨 No hay faltas en el empleado número 10. Verifique el rubro de faltas.</p>";
        } else {
            echo "<p style='color: green; font-weight: bold;'>✅ El empleado tiene " . $row['Faltas'] . " faltas registradas correctamente.</p>";
        }
    }
}
?>
