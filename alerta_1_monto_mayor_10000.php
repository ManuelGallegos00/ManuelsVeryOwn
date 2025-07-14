<?php
include 'conexion.php';
$query = "SELECT * FROM Finanzas";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Monto'] > 10000) {
        echo '<div class="alert alert-warning">⚠️ Monto mayor a $10,000</div>';
    }
}
?>
<style>
.alert { margin: 20px auto; padding: 15px 20px; max-width: 700px;
border-radius: 8px; font-weight: bold; font-family: Arial, sans-serif; }
.alert-warning { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
.alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
.alert-info { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
.alert-warning{...}</style>
