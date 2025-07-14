<?php
include("conexion.php");

$sql = "SELECT Nombre FROM Productos WHERE StockTienda = 0";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alerta Stock Cero</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 30px; }
        .alerta {
            background-color: #ffe0e0;
            border: 1px solid #ff4d4d;
            padding: 15px;
            margin-bottom: 20px;
            color: #a94442;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h2>Productos con stock en cero</h2>
<?php
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='alerta'>Ya no hay producto <strong>" . htmlspecialchars($row['Nombre']) . "</strong></div>";
    }
} else {
    echo "<p>No hay productos con stock cero.</p>";
}
?>
</body>
</html>