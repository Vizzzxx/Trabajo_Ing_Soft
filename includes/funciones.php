<?php

function obtener_servicios() {
    $db = null; // Inicializar la variable $db fuera del bloque try para que esté disponible en el bloque finally
    try {
        // Importar las credenciales
        require 'database.php';

        // Verificar si la conexión fue exitosa
        if (!$db) {
            throw new Exception("Error al conectar a la base de datos");
        }

        // Consulta SQL
        $sql = "SELECT * FROM tbl_autenticacion";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        // Verificar si la consulta fue exitosa
        if (!$consulta) {
            throw new Exception("Error en la consulta: " . mysqli_error($db));
        }

        // Acceder a los resultados
        echo "<pre>";
        while ($fila = mysqli_fetch_assoc($consulta)) {
            var_dump($fila);
        }
        echo "</pre>";

    } catch (Exception $e) {
        // Manejar la excepción
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        if ($db) {
            mysqli_close($db);
        }
    }
}

obtener_servicios();