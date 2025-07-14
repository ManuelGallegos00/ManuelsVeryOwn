<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("UPDATE Productos SET Nombre=?, Marca=?, Precio=?, Cantidad=?, Tipo=? WHERE IdProducto=?");
    $stmt->bind_param('ssdisi', $nombre, $marca, $precio, $cantidad, $tipo, $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: consultar_productos.php");
exit();
?>