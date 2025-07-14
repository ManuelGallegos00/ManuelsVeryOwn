<?php include("verificar_faltas.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Exportar Nómina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 40px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .export-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            margin: 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            font-size: 15px;
            margin-bottom: 20px;
        }
        .nav-button {
            background-color: #6c757d;
        }
        .nav-button:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="export-container">
        <h2>Exportar Nómina</h2>
        <p class="message">Verificación automática del empleado ID 10 mostrada arriba.</p>
        <form method="post" action="exportar_pdf.php" target="_blank">
            <button type="submit">📄 Exportar a PDF</button>
        </form>
        <form method="post" action="exportar_excel.php">
            <button type="submit">📊 Exportar a Excel</button>
        </form>
        <form action="insertar_empleado.php">
            <button type="submit" class="nav-button">👤 Ir a Insertar Empleado</button>
        </form>
    </div>
</body>
</html>
