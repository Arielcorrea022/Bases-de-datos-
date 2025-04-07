<?php
session_start();
include 'db_conection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica que el campo 'correo' esté definido
    if (isset($_POST['correo']) && isset($_POST['clave'])) {
        $correo = $conn->real_escape_string($_POST['correo']);
        $clave = $_POST['clave'];

        $query = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['bloqueado']) {
                echo "La cuenta está bloqueada. Contacta al administrador.";
            } elseif (password_verify($clave, $row['clave'])) {
                $_SESSION['usuario'] = $row['nombre'];
                $_SESSION['rol'] = $row['rol'];
                header("Location: dashboard.php");
                exit;
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "<p>Usuario no registrado.</p>";
            echo "<a href='register.html'>Regístrate aquí</a>";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

