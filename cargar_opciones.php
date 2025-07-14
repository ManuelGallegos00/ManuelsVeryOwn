<?php
include 'conexion.php';
$query = "SELECT IdProducto, Nombre FROM Productos";
$res = mysqli_query($conn, $query);
while ($fila = mysqli_fetch_assoc($res)) {
  echo "<option value='{$fila['IdProducto']}'>{$fila['IdProducto']} - {$fila['Nombre']}</option>";
}
?>