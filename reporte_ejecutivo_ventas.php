<?php
include 'conexion.php';

// 1) TOP 20 productos más vendidos
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

// 2) Producto menos vendido
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes de Ventas</title>
  <link rel="stylesheet" href="estilos.css">
  <style>
    .report-container {
      background: rgba(255,255,255,0.95);
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
    }
    h2 { color: #337aff; margin-top: 0; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      padding: 8px 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th { background: #e3f2fd; }
    a.regresar {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 16px;
      background: #337aff;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
    }
    .boton-excel {
      background: #43a047;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      margin-top: 10px;
      font-weight: bold;
      cursor: pointer;
    }
    .boton-pdf {
      background: #d84315;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      margin-top: 10px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="report-container">
    <h2>Top 20 Productos Más Vendidos</h2>
    <table>
      <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Total Vendido</th></tr>
      <?php while($r = $resTop20->fetch_assoc()): ?>
      <tr>
        <td><?= $r['IdProducto'] ?></td>
        <td><?= htmlspecialchars($r['Nombre']) ?></td>
        <td><?= htmlspecialchars($r['Marca']) ?></td>
        <td><?= $r['TotalVendido'] ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <h2>Producto Menos Vendido</h2>
    <table>
      <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Total Vendido</th></tr>
      <?php if($m = $resMin->fetch_assoc()): ?>
      <tr>
        <td><?= $m['IdProducto'] ?></td>
        <td><?= htmlspecialchars($m['Nombre']) ?></td>
        <td><?= htmlspecialchars($m['Marca']) ?></td>
        <td><?= $m['TotalVendido'] ?></td>
      </tr>
      <?php endif; ?>
    </table>

    <a href="index.html" class="regresar">← Volver al Panel Principal</a>
    <!-- Botón para exportar a Excel -->
    <form action="exportar_reporte_ventas.php" method="post" style="margin-top:20px; display:inline-block;">
      <button type="submit" class="boton-excel">Exportar reporte a Excel</button>
    </form>
    <!-- Botón para exportar a PDF (AHORA lleva a reporte_ejecutivo_productos.php) -->
    <form action="reporte_ejecutivo_productos.php" method="get" style="margin-top:20px; display:inline-block; margin-left:10px;">
      <button type="submit" class="boton-pdf">Exportar reporte a PDF</button>
    </form>
  </div>
</body>
</html>