<?php
// Llamo al archivo global.php
require_once "global.php";

// Creo la variable de conexión
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Configuro el charset
$conexion->set_charset(DB_ENCODE);

// Verifico si hubo error de conexión
if ($conexion->connect_errno) {
    printf("Fallo la conexión a la base de datos: %s\n", $conexion->connect_error);
    exit();
} else {
    // Esto lo puedes comentar o quitar en producción
    // printf("Conexión a la base de datos exitosa: %s\n", DB_NAME);
}

// === FUNCIONES UTILITARIAS ===
if (!function_exists('ejecutarConsulta')) {

    // Ejecuta una consulta y devuelve el resultado completo
    function ejecutarConsulta($sql) {
        global $conexion;
        return $conexion->query($sql);
    }

    // Ejecuta una consulta y devuelve una sola fila
    function ejecutarConsultaSimpleFila($sql) {
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    // Ejecuta una consulta INSERT y devuelve el ID insertado
    function ejecutarConsulta_retornarID($sql) {
        global $conexion;
        $conexion->query($sql);
        return $conexion->insert_id;
    }

    // Limpia una cadena para evitar inyecciones SQL y caracteres peligrosos
    function limpiarCadena($str) {
        global $conexion;
        $str = mysqli_real_escape_string($conexion, trim($str)); // Arreglado: era `mysql_` en vez de `mysqli_`
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}





