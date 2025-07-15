<?php
// Incluimos el archivo de conexión a la base de datos
// La ruta es ../config/Conexion.php porque Usuario.php está en modelos/
// y Conexion.php está en config/, así que subimos un nivel (..) y entramos a config/
require_once "../config/Conexion.php";

class Usuario {

    // Constructor de la clase (opcional, pero buena práctica si necesitas inicializar algo)
    public function __construct() {
        // Puedes dejarlo vacío o inicializar algo aquí si es necesario
    }

    // Método para insertar un nuevo usuario en la tabla 'usuario'
    public function insertar($nombre, $apellido, $email, $password) {
        // Llamamos a la función global 'ejecutarConsulta_retornarID' definida en Conexion.php
        // para insertar el usuario y obtener el ID recién creado.
        // Es crucial HASHEAR la contraseña antes de guardarla por seguridad.
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Usa PASSWORD_DEFAULT para el algoritmo más actual

        // La columna 'activo' se establece en 1 (true) por defecto para nuevos usuarios
        $sql = "INSERT INTO usuario (nombre, apellido, email, password, activo) VALUES ('$nombre', '$apellido', '$email', '$password_hash', 1)";

        return ejecutarConsulta_retornarID($sql);
    }

    // Método para verificar las credenciales de inicio de sesión de un usuario
    public function verificarLogin($email, $password_ingresada) {
        // Llamamos a la función global 'ejecutarConsultaSimpleFila'
        // para buscar un usuario por su email y que esté activo.
        $sql = "SELECT idusuario, nombre, apellido, email, password, activo FROM usuario WHERE email = '$email' AND activo = 1";
        $fila = ejecutarConsultaSimpleFila($sql);

        // Si se encontró una fila (usuario existe)
        if ($fila) {
            // Verificamos si la contraseña ingresada coincide con la contraseña hasheada en la BD
            if (password_verify($password_ingresada, $fila['password'])) {
                return $fila; // Retorna todos los datos del usuario si las credenciales son correctas
            }
        }
        return false; // Retorna false si no se encontró el usuario o la contraseña es incorrecta
    }

    // Método para obtener los detalles de un usuario por su ID
    public function mostrar($idusuario) {
        $sql = "SELECT idusuario, nombre, apellido, email, activo FROM usuario WHERE idusuario = '$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar todos los usuarios (útil para un administrador, por ejemplo)
    public function listar() {
        $sql = "SELECT idusuario, nombre, apellido, email, activo FROM usuario";
        return ejecutarConsulta($sql);
    }

    // Puedes agregar más métodos aquí, como:
    // - 'actualizar($idusuario, $nombre, $apellido, ...)'
    // - 'desactivar($idusuario)'
    // - 'activar($idusuario)'
    // - 'cambiarPassword($idusuario, $nueva_password)'
}
?>