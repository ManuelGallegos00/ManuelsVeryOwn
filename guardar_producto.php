<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $tipo = isset($_POST['tipo']) ? implode(',', $_POST['tipo']) : '';

    // Cambia 'Productos' y los campos por los de tu tabla real si es necesario.
    $stmt = $conn->prepare("INSERT INTO Productos (Nombre, Marca, Precio, Cantidad, Tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $nombre, $marca, $precio, $cantidad, $tipo);

    if ($stmt->execute()) {
        echo "<script>alert('¡Producto guardado correctamente!'); window.location.href='formulario_producto.html';</script>";
    } else {
        echo "<script>alert('Ocurrió un error al guardar.'); window.location.href='formulario_producto.html';</script>";
    }
    $stmt->close();
    $conn->close();
}
?>