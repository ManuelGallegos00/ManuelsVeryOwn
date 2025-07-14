<?php
include 'conexion.php';

$result = $conn->query("SELECT * FROM Productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consulta de Productos</title>
  <link rel="stylesheet" href="estilos.css">
  <style>
    body {
      background: url('image.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .table-container {
      background: rgba(255,255,255,0.97);
      margin: 50px auto 30px auto;
      max-width: 950px;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(20,44,100,0.12);
      padding: 36px 38px;
    }
    h2 {
      color: #1976d2;
      font-size: 2rem;
      text-align: left;
      margin-bottom: 22px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 1.07rem;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 14px;
      border-bottom: 1px solid #e1e1e1;
      text-align: left;
    }
    th {
      background: #e3f0fd;
      color: #1976d2;
      font-weight: 700;
      border-bottom: 2px solid #b3d3f7;
    }
    tr:last-child td {
      border-bottom: none;
    }
    .acciones-btn {
      display: flex;
      gap: 8px;
    }
    .modificar-btn, .eliminar-btn {
      font-size: 0.96rem;
      padding: 7px 16px;
      border-radius: 7px;
      border: none;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.16s;
      text-decoration: none;
      box-shadow: 0 2px 4px rgba(60,90,150,.06);
    }
    .modificar-btn { background: #2196F3; }
    .modificar-btn:hover { background: #1565c0; }
    .eliminar-btn { background: #ff5252; }
    .eliminar-btn:hover { background: #b71c1c; }
    .regresar-btn {
      display: inline-block;
      margin-top: 28px;
      padding: 10px 28px;
      background: #1976d2;
      color: #fff;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
      border: none;
      font-size: 1.08rem;
      box-shadow: 0 2px 7px rgba(44,100,190,.09);
      transition: background .17s;
    }
    .regresar-btn:hover {
      background: #0e468c;
      color: #fff;
    }
  </style>
  <script>
    function confirmarEliminacion(id) {
      if (confirm("¿Seguro que deseas eliminar el producto?")) {
        window.location.href = "eliminar_producto.php?id=" + id;
      }
    }
  </script>
</head>
<body>
  <div class="table-container">
    <h2>Listado de Productos</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Tipo de Empaque</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['IdProducto'] ?? $row['id'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['Nombre'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['Marca'] ?? '—') ?></td>
              <td>
                <?php
                  $precio = isset($row['Precio']) ? $row['Precio'] : (isset($row['precio']) ? $row['precio'] : '');
                  echo $precio !== '' ? '$'.number_format($precio, 2) : '—';
                ?>
              </td>
              <td><?= htmlspecialchars($row['Cantidad'] ?? $row['Stock'] ?? '—') ?></td>
              <td><?= htmlspecialchars($row['Tipo'] ?? $row['tipo'] ?? '—') ?></td>
              <td>
                <div class="acciones-btn">
                  <a class="modificar-btn" href="modificar_producto.php?id=<?= urlencode($row['IdProducto'] ?? $row['id'] ?? '') ?>">Modificar</a>
                  <button class="eliminar-btn" type="button" onclick="confirmarEliminacion('<?= $row['IdProducto'] ?? $row['id'] ?? '' ?>')">Eliminar</button>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align:center; color:#999;">No hay productos registrados.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <a href="formulario_producto.php" class="regresar-btn">Regresar</a>
  </div>
</body>
</html>
<?php $conn->close(); ?>