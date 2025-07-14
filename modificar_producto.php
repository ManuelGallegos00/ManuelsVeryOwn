<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: consultar_productos.php');
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM Productos WHERE IdProducto = $id");
$producto = $result->fetch_assoc();

if (!$producto) {
    echo "Producto no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Producto</title>
  <link rel="stylesheet" href="estilos.css">
  <style>
    .form-container {
      background: #fff;
      max-width: 450px;
      margin: 48px auto;
      padding: 32px;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.10);
    }
    label { font-weight: bold; display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; border-radius: 6px; margin-top: 5px; }
    .button-group { margin-top: 18px; display: flex; gap: 15px;}
    button, a { padding: 8px 24px; border-radius: 8px; border: none; font-weight: bold; }
    button { background: #1976d2; color: #fff;}
    a { background: #e3f0fd; color: #1976d2; text-decoration: none; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Modificar Producto</h2>
    <form action="actualizar_producto.php" method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($producto['IdProducto']) ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['Nombre']) ?>" required>
      <label for="marca">Marca:</label>
      <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($producto['Marca'] ?? '') ?>">
      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($producto['Precio']) ?>" required>
      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad" min="0" value="<?= htmlspecialchars($producto['Cantidad'] ?? $producto['Stock'] ?? '') ?>">
      <label for="tipo">Tipo de empaque:</label>
      <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($producto['Tipo'] ?? '') ?>">
      <div class="button-group">
        <button type="submit">Guardar Cambios</button>
        <a href="consultar_productos.php">Regresar</a>
      </div>
    </form>
  </div>
</body>
</html>