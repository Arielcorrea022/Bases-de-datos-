<?php
include 'db_conection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($conn)) {
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $correo = $conn->real_escape_string($_POST['correo']);
        $telefono = $conn->real_escape_string($_POST['telefono']);
        $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); // Cifra la contraseña

        // Verifica si el correo ya está registrado
        $query_check = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $result = $conn->query($query_check);

        if ($result && $result->num_rows > 0) {
            echo "<p>El correo ya está registrado. Intenta con otro correo.</p>";
            echo "<a href='register.html'>Volver al registro</a>";
        } else {
            // Inserta el nuevo usuario
            $query_insert = "INSERT INTO usuarios (nombre, correo, telefono, clave, rol) VALUES ('$nombre', '$correo', '$telefono', '$clave', 'Cliente')";
            if ($conn->query($query_insert)) {
                echo "<p>Registro exitoso. ¡Ya puedes iniciar sesión!</p>";
                echo "<a href='index.html'>Ir al Login</a>";
            } else {
                echo "<p>Error al registrar el usuario: " . $conn->error . "</p>";
            }
        }
    } else {
        die("Error: conexión no definida.");
    }
}
?>

