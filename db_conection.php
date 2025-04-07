<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // Servidor (en XAMPP suele ser localhost)
$username = "root";         // Usuario por defecto de XAMPP
$password = "";             // Contraseña por defecto (vacía en XAMPP)
$dbname = "sistema";        // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
