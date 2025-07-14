<?php
include("conexion.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEmpleado = $_POST['IdEmpleado'];
    $nombre = $_POST['Nombre'];
    $salario = $_POST['Salario'];

    if ($salario < 10000) {
        $error = "El salario debe ser mayor a $10,000.";
    } else {
        $check = "SELECT * FROM Empleados WHERE IdEmpleado = '$idEmpleado'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            $error = "El identificador de empleado ya existe.";
        } else {
            $sql = "INSERT INTO Empleados (IdEmpleado, Nombre, Salario) VALUES ('$idEmpleado', '$nombre', '$salario')";
            if (mysqli_query($conn, $sql)) {
                $success = "✅ Empleado insertado correctamente con salario mayor a $10,000.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf0f6;
            padding: 40px;
            text-align: center;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1e7e34;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
        }
        .success {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Insertar Nuevo Empleado</h2>
        <form method="post">
            <label for="IdEmpleado">ID Empleado:</label>
            <input type="number" name="IdEmpleado" required><br>

            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" required><br>

            <label for="Salario">Salario:</label>
            <input type="number" name="Salario" required><br>

            <button type="submit">Guardar Empleado</button>
        </form>
        <?php if ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
