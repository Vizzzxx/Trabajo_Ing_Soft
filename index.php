<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Configuración de conexión a MySQL
    $host = 'localhost';
    $usuario = 'root';
    $password = '';
    $basedatos = 'bd_cita';

    // Crear la conexión
    $conexion = new mysqli($host, $usuario, $password, $basedatos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }

    // Preparar la llamada al procedimiento almacenado
    $stmt = $conexion->prepare("CALL INICIOAUTENTICACION(?, ?, @P_RETORNO)");
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $stmt->close();

    // Obtener el valor de P_RETORNO
    $query = $conexion->query("SELECT @P_RETORNO AS retorno");
    $row = $query->fetch_assoc();
    $retorno = $row['retorno'];

    // Verificar el resultado
    if ($retorno === 'INICIO') {
        // Credenciales correctas, redirigir
        header("Location: index.html");
        exit();
    } elseif ($retorno === 'DENEGADO') {
        // Credenciales incorrectas
        echo "Usuario o contraseña incorrectos.";
    }

    // Cerrar conexión
    $conexion->close();
}
?>
