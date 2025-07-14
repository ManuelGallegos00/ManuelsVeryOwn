<?php
include 'conexion.php';

// 1) Buscar los 3 productos con menor cantidad en inventario y su marca
// (ajusta 'StockTienda' por el campo de cantidad real de tu tabla Productos)
$productosMin = $conn->query("
  SELECT Nombre, Marca, StockTienda 
  FROM Productos 
  WHERE Marca IS NOT NULL AND Marca <> ''
  ORDER BY StockTienda ASC, IdProducto ASC
  LIMIT 3
");

$productos = [];
while($row = $productosMin->fetch_assoc()) {
    $productos[] = $row;
}

// 2) Consulta: representante de la empresa (escoge el primero o el que tú desees)
$consultaRep = $conn->query("SELECT Representante FROM Proveedores LIMIT 1");
$rowRep = $consultaRep->fetch_assoc();
$representante = $rowRep['Representante'] ?? 'Representante';

// Fechas y otros datos
$fechaEntrega = '12 de julio 2025';
$nombreSolicitante = 'Manuel'; // Cambia esto por el nombre real si quieres
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Ejecutivo Proveedores</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 44px;}
    .reporte {
      background: white;
      padding: 32px 44px;
      max-width: 700px;
      margin: auto;
      border-radius: 13px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.12);
    }
    h2 { text-align: center; color: #1976D2; }
    .parrafo-principal {
      font-size: 1.16em;
      margin-bottom: 34px;
      text-align: justify;
      background: #e3f2fd;
      padding: 22px 19px;
      border-radius: 8px;
    }
    .firma {
      text-align: right;
      margin-top: 44px;
    }
    .firma strong { color: #1976D2; }
    ol { padding-left: 22px; }
    ol li { margin-bottom: 8px; }
  </style>
</head>
<body>
<div class="reporte">
  <h2>Reporte Ejecutivo de Proveedores</h2>
  <p class="parrafo-principal">
    C. <?= htmlspecialchars($nombreSolicitante) ?> se le solicita surtir los siguientes productos:
    <ol>
      <?php if (isset($productos[0])): ?>
        <li>20 "<?= htmlspecialchars($productos[0]['Nombre']) ?>" de la marca <?= htmlspecialchars($productos[0]['Marca']) ?>.</li>
      <?php endif; ?>
      <?php if (isset($productos[1])): ?>
        <li>10 "<?= htmlspecialchars($productos[1]['Nombre']) ?>" de la marca <?= htmlspecialchars($productos[1]['Marca']) ?>.</li>
      <?php endif; ?>
      <?php if (isset($productos[2])): ?>
        <li>5 "<?= htmlspecialchars($productos[2]['Nombre']) ?>" de la marca <?= htmlspecialchars($productos[2]['Marca']) ?>.</li>
      <?php endif; ?>
    </ol>
    La fecha para entregar el producto es el <strong><?= $fechaEntrega ?></strong>
    al C. <strong><?= htmlspecialchars($representante) ?></strong> para poder actualizar el inventario de la tienda.
  </p>

  <div class="firma">
    ATENTAMENTE<br><br>
    <strong>Leoncio</strong><br>
    Gerente General
  </div>
</div>
</body>
</html>