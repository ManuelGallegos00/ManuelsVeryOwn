<?php
include("conexion.php");

$sql = "SELECT Nombre FROM Productos WHERE StockTienda < 5";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alerta Reabastecer</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 30px; }
        .alerta {
            background-color: #fff8e1;
            border: 1px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h2>Productos que necesitan reabastecimiento</h2>
<?php
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='alerta'>Solicitar al proveedor 10 unidades del producto <strong>" . htmlspecialchars($row['Nombre']) . "</strong></div>";
    }
} else {
    echo "<p>No hay productos por debajo del umbral de reabastecimiento.</p>";
}
?>
</body>
</html>