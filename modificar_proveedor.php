<?php
include 'conexion.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = $conn->query('SELECT * FROM Proveedores WHERE IdProveedor=' . $id);
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Proveedor</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="form-container">
  <h2>Modificar Proveedor</h2>
  <form action="actualizar_proveedor.php" method="POST" onsubmit="return confirm('¿Seguro que deseas modificar la información?');">
    <input type="hidden" name="id" value="<?php echo $row['IdProveedor']; ?>">
    <label>Empresa:</label>
    <input type="text" value="<?php echo htmlspecialchars($row['NombreEmpresa']); ?>" disabled>
    <label>Representante:</label>
    <input type="text" value="<?php echo htmlspecialchars($row['Representante']); ?>" disabled>
    <label>Marcas:</label>
    <input type="text" name="marcas" value="<?php echo htmlspecialchars($row['Marcas']); ?>" required>
    <label>Costo:</label>
    <input type="number" name="costo" step="0.01" value="<?php echo $row['Costo']; ?>" required>
    <div class="button-group">
      <input type="submit" value="Actualizar">
      <a class="btn" href="consultar_proveedores.php">Cancelar</a>
    </div>
  </form>
</div>
</body>
</html>