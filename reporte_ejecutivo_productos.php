<?php
include 'conexion.php';

// 1ra consulta: número total de productos (almacenados en la tabla Productos)
$consultaTotal = $conn->query("SELECT COUNT(*) AS total FROM Productos");
$rowTotal = $consultaTotal->fetch_assoc();
$totalProductos = $rowTotal['total'] ?? 0;

// 2da consulta: la marca más común (puedes cambiar el criterio si quieres una marca específica)
$consultaMarca = $conn->query("SELECT Marca, COUNT(*) as total FROM Productos GROUP BY Marca ORDER BY total DESC LIMIT 1");
$rowMarca = $consultaMarca->fetch_assoc();
$marcaEjemplo = $rowMarca['Marca'] ?? 'Desconocida';

// Repite la consulta 1 (ya la tenemos)
// Repite la consulta 2 (ya la tenemos)
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Ejecutivo PDF</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px;}
    .reporte {
      background: white;
      padding: 30px 40px;
      max-width: 700px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.13);
    }
    h2 { text-align: center; color: #1976D2; }
    .parrafo-principal {
      font-size: 1.15em;
      margin-bottom: 30px;
      text-align: justify;
      background: #e3f2fd;
      padding: 20px 18px;
      border-radius: 9px;
    }
    .firma {
      text-align: right;
      margin-top: 48px;
    }
    .firma strong { color: #1976D2; }
    @media print {
      body { background: #fff; }
      .reporte { box-shadow: none; }
    }
  </style>
</head>
<body>
<div class="reporte">
  <h2>Reporte Ejecutivo de Productos</h2>
  <p class="parrafo-principal">
    C. GALLEGOS, gerente de la tienda <strong>"SUPERMERCADO LEONCIO</strong>,<br>
    Se le informa que la tienda tiene <strong><?= $totalProductos ?></strong> productos almacenados en la tabla.<br>
    Productos de la marca <strong><?= htmlspecialchars($marcaEjemplo) ?></strong>.<br>
    Se le informa que la tienda tiene <strong><?= $totalProductos ?></strong> productos almacenados en la tabla.<br>
    Productos de la marca <strong><?= htmlspecialchars($marcaEjemplo) ?></strong>.
  </p>

  <div class="firma">
    Atentamente,<br>
    <strong>Equipo Supermercado Leoncio</strong>
  </div>
</div>
</body>
</html>