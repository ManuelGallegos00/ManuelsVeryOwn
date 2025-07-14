<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresa = $_POST['empresa'];
    $representante = $_POST['representante'];
    $marcas = $_POST['marcas'];
    $costo = $_POST['costo'];
    // Validación
    if (empty($empresa) || empty($representante) || empty($marcas) || $costo === "") {
        echo "<script>alert('Debe de llenar todos los campos del formulario'); window.history.back();</script>";
        exit;
    }
    $stmt = $conn->prepare('INSERT INTO Proveedores (NombreEmpresa, Representante, Marcas, Costo) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('sssd', $empresa, $representante, $marcas, $costo);
    if ($stmt->execute()) {
        echo "<script>alert('Proveedor agregado correctamente'); window.location.href='consultar_proveedores.php';</script>";
    } else {
        echo "<script>alert('Error al agregar: {$stmt->error}'); window.history.back();</script>";
    }
}
?>