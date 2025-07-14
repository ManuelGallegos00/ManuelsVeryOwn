<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $marcas = $_POST['marcas'];
    $costo = $_POST['costo'];
    $stmt = $conn->prepare('UPDATE Proveedores SET Marcas=?, Costo=? WHERE IdProveedor=?');
    $stmt->bind_param('sdi', $marcas, $costo, $id);
    $stmt->execute();
}
header('Location: consultar_proveedores.php');
?>