<?php
// Incluimos el archivo de conexión que ya tenemos configurado
require_once "Conexion.php";

// Intentamos crear una conexión
// La variable global $conexion se define dentro de Conexion.php si la conexión es exitosa
global $conexion;

// Verificamos si la conexión se estableció correctamente
if ($conexion->connect_errno) {
    echo "<h1>Error de Conexión a la Base de Datos</h1>";
    echo "<p>No se pudo conectar a la base de datos.</p>";
    echo "<p>Detalles del error: " . $conexion->connect_error . "</p>";
    echo "<p>Revisa la configuración en <strong>config/global.php</strong> (DB_HOST, DB_NAME, DB_USER, DB_PASSWORD) y asegúrate de que tu servidor MySQL esté en funcionamiento.</p>";
} else {
    echo "<h1>¡Conexión a la Base de Datos Exitosa!</h1>";
    echo "<p>Te has conectado correctamente a la base de datos: <strong>" . DB_NAME . "</strong></p>";
    echo "<p>Servidor MySQL: " . DB_HOST . "</p>";
    echo "<p>Usuario: " . DB_USER . "</p>";

    // Opcional: Intentar una consulta simple para verificar que las tablas existen
    $result_usuarios = $conexion->query("SELECT COUNT(*) FROM usuario");
    if ($result_usuarios) {
        $num_usuarios = $result_usuarios->fetch_row()[0];
        echo "<p>Número de registros en la tabla 'usuario': " . $num_usuarios . "</p>";
    } else {
        echo "<p>Error al intentar leer la tabla 'usuario'. Asegúrate de que existe y se llama correctamente.</p>";
        echo "<p>Detalles del error: " . $conexion->error . "</p>";
    }

    // Cierra la conexión
    $conexion->close();
}
?>