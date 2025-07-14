<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consulta de Proveedores</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="table-container">
  <h2>Lista de Proveedores</h2>
  <table>
    <thead>
      <tr>
        <th>Empresa</th>
        <th>Representante</th>
        <th>Marcas</th>
        <th>Costo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $res = $conn->query('SELECT * FROM Proveedores');
      while ($row = $res->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['NombreEmpresa']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Representante']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Marcas']) . '</td>';
        echo '<td>$' . number_format($row['Costo'], 2) . '</td>';
        echo '<td>
          <a class="action-btn" href="modificar_proveedor.php?id=' . $row['IdProveedor'] . '">Modificar</a>
          <a class="action-btn delete" href="eliminar_proveedor.php?id=' . $row['IdProveedor'] . '" onclick="return confirm(\'¿Seguro que deseas eliminar el registro?\')">Eliminar</a>
        </td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <div class="button-group">
    <a class="btn" href="formulario_proveedores.php">Volver</a>
  </div>
</div>
</body>
</html>