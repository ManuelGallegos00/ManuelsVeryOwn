<?php
include 'conexion.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_ventas.xls");

echo "<table border='1'>";
echo "<tr><th colspan='4' style='background:#1976D2;color:white;'>Top 20 Productos Más Vendidos</th></tr>";
echo "<tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Total Vendido</th></tr>";

$sqlTop20 = "
  SELECT
    p.IdProducto,
    p.Nombre,
    p.Marca,
    SUM(v.CantidadVendida) AS TotalVendido
  FROM Ventas AS v
  JOIN Productos AS p ON v.IdProducto = p.IdProducto
  GROUP BY p.IdProducto, p.Nombre, p.Marca
  ORDER BY TotalVendido DESC
  LIMIT 20
";
$resTop20 = $conn->query($sqlTop20);
while($r = $resTop20->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$r['IdProducto']}</td>";
    echo "<td>" . htmlspecialchars($r['Nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($r['Marca']) . "</td>";
    echo "<td>{$r['TotalVendido']}</td>";
    echo "</tr>";
}

echo "<tr><td colspan='4'></td></tr>"; // Línea en blanco

echo "<tr><th colspan='4' style='background:#1976D2;color:white;'>Producto Menos Vendido</th></tr>";
echo "<tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Total Vendido</th></tr>";

$sqlMin = "
  SELECT
    p.IdProducto,
    p.Nombre,
    p.Marca,
    SUM(v.CantidadVendida) AS TotalVendido
  FROM Ventas AS v
  JOIN Productos AS p ON v.IdProducto = p.IdProducto
  GROUP BY p.IdProducto, p.Nombre, p.Marca
  ORDER BY TotalVendido ASC
  LIMIT 1
";
$resMin = $conn->query($sqlMin);
if($m = $resMin->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$m['IdProducto']}</td>";
    echo "<td>" . htmlspecialchars($m['Nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($m['Marca']) . "</td>";
    echo "<td>{$m['TotalVendido']}</td>";
    echo "</tr>";
}
echo "</table>";
?>