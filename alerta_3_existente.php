<?php
include("conexion.php");

// Cambia este valor por uno que ya exista en tu tabla Productos
$nombreProducto = "Leche Lala";

// Búsqueda del producto
$sql = "SELECT * FROM Productos WHERE Nombre = '$nombreProducto'";
$result = mysqli_query($conn, $sql);
$producto = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta Producto Existente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 40px;
        }
        .alert {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 6px;
            font-size: 16px;
            border: 2px solid;
            font-weight: bold;
        }
        .success {
            background-color: #d1ffd6;
            color: #2f6627;
            border-color: #2f6627;
        }
        .danger {
            background-color: #ffe4e4;
            color: #b70000;
            border-color: #b70000;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Verificación de producto existente</h2>

<?php if ($producto): ?>
    <div class="alert danger">
        El producto <strong><?= $producto['Nombre'] ?></strong> ya fue registrado en el inventario.
    </div>
<?php else: ?>
    <div class="alert success">
        Producto no registrado previamente. Puedes añadirlo sin problema.
    </div>
<?php endif; ?>

</body>
</html>
