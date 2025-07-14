<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Elimina primero los inventarios relacionados
    $stmt1 = $conn->prepare("DELETE FROM Inventarios WHERE IdProducto = ?");
    $stmt1->bind_param('i', $id);
    $stmt1->execute();
    $stmt1->close();

    // Ahora elimina el producto
    $stmt2 = $conn->prepare("DELETE FROM Productos WHERE IdProducto = ?");
    $stmt2->bind_param('i', $id);
    $stmt2->execute();
    $stmt2->close();
}

header("Location: consultar_productos.php");
exit();
?>