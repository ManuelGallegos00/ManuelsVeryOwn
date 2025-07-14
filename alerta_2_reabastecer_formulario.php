<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "SupermercadoLeoncio";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    $sql = "UPDATE Productos SET StockTienda = StockTienda + $cantidad WHERE IdProducto = $producto";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Se han reabastecido $cantidad unidades del producto con ID $producto.";
    } else {
        $message = "❌ Error al actualizar el producto: " . $conn->error;
    }
}

$result = $conn->query("SELECT IdProducto, Nombre FROM Productos ORDER BY Nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reabastecer Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        select, input[type="number"] {
            padding: 10px;
            width: 90%;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #e6ffe6;
            color: #155724;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reabastecer Producto</h2>
    <form method="post">
        <select name="producto" required>
            <option value="">Seleccione un producto</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['IdProducto'] ?>"><?= $row['Nombre'] ?></option>
            <?php endwhile; ?>
        </select>
        <input type="number" name="cantidad" placeholder="Cantidad a agregar" min="1" required>
        <button type="submit">Actualizar Stock</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
</div>
</body>
</html>
