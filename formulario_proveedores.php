<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Proveedores</title>
  <link rel="stylesheet" href="estilos.css">
  <style>
    body {
      background-image: url('image.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    .form-container {
      background: rgba(255,255,255,0.97);
      max-width: 600px;
      margin: 40px auto;
      padding: 34px 40px 28px 40px;
      border-radius: 22px;
      box-shadow: 0 2px 18px rgba(0,0,0,0.10);
    }
    .form-container label {
      font-size: 1.15rem;
      margin-top: 16px;
      display: block;
      font-weight: bold;
      color: #222;
    }
    .form-container input[type="text"],
    .form-container input[type="number"] {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
      margin-bottom: 8px;
      border-radius: 7px;
      border: 1.5px solid #cfd8dc;
      background: #f8f9fa;
    }
    .button-group {
      margin-top: 18px;
      display: flex;
      gap: 14px;
    }
    .button-group button, .button-group a {
      font-size: 1rem;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      background: #1976D2;
      color: #fff;
      text-decoration: none;
      cursor: pointer;
      transition: background 0.2s;
    }
    .button-group button.consultar {
      background: #43a047;
    }
    .button-group button.fragrantica {
      background: #b388ff;
      color: #333;
    }
    .button-group a.regresar {
      background: #fff;
      color: #1976D2;
      border: 1.5px solid #1976D2;
    }
  </style>
  <script>
    function validarFormulario() {
      var e = document.getElementById('empresa').value.trim();
      var r = document.getElementById('representante').value.trim();
      var m = document.getElementById('marcas').value.trim();
      var c = document.getElementById('costo').value.trim();
      if (!e || !r || !m || !c) {
        alert('Debe de llenar todos los campos del formulario');
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
<div class="form-container">
  <h2>Registrar Proveedor</h2>
  <form action="guardar_proveedor.php" method="POST" onsubmit="return validarFormulario();">
    <label for="empresa">Nombre de la Empresa:</label>
    <input type="text" id="empresa" name="empresa" required>
    <label for="representante">Nombre del Representante:</label>
    <input type="text" id="representante" name="representante" required>
    <label for="marcas">Marcas que Surte:</label>
    <input type="text" id="marcas" name="marcas" required>
    <label for="costo">Costo de los Productos:</label>
    <input type="number" id="costo" name="costo" min="0" step="0.01" required>
    <div class="button-group">
      <button type="submit">Enviar datos</button>
      <button type="button" class="consultar" onclick="window.location.href='consultar_proveedores.php'">Consultar datos</button>
      <button type="button" class="fragrantica" onclick="window.location.href='https://www.fragrantica.com/'">Fragrantica</button>
      <a href="index.html" class="regresar">Regresar</a>
    </div>
  </form>
</div>
</body>
</html>