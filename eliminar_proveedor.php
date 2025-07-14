<?php
include 'conexion.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$conn->query('DELETE FROM Proveedores WHERE IdProveedor=' . $id);
header('Location: consultar_proveedores.php');
?>