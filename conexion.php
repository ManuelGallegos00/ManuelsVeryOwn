<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'supermercadoleoncio';
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}
?>