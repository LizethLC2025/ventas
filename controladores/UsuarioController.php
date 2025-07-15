<?php
// Incluimos el modelo de Usuario para poder usar sus funciones
// La ruta es ../modelos/Usuario.php porque UsuarioController.php está en controladores/
// y Usuario.php está en modelos/, así que subimos un nivel (..) y entramos a modelos/
require_once "../modelos/Usuario.php";

// Creamos una instancia de la clase Usuario del modelo
$usuario = new Usuario();

// Variable para manejar la operación solicitada (ej. "login", "registro")
// Se obtiene del parámetro 'op' de la URL o formulario
$op = isset($_GET["op"]) ? $_GET["op"] : (isset($_POST["op"]) ? $_POST["op"] : "");

// Iniciamos la sesión PHP al principio del script
// Es crucial para manejar el estado del usuario (si está logueado, sus datos, etc.)
session_start();

switch ($op) {
    case "login":
        // Lógica para manejar el inicio de sesión
        $email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? limpiarCadena($_POST["password"]) : "";

        if (empty($email) || empty($password)) {
            // Si faltan datos, redirigimos al login con un mensaje de error
            $_SESSION['mensaje_error'] = "Por favor, introduce tu email y contraseña.";
            header("Location: ../vistas/login.php"); // Asegúrate de que esta ruta sea correcta
            exit();
        }

        // Llamamos al método verificarLogin del modelo Usuario
        $fila = $usuario->verificarLogin($email, $password);

        if ($fila) {
            // Login exitoso: Guardar datos del usuario en la sesión
            $_SESSION['idusuario'] = $fila['idusuario'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellido'] = $fila['apellido'];
            $_SESSION['email'] = $fila['email'];
            // Puedes añadir más datos del usuario o sus roles si los obtuvieras aquí

            // Redirigir según el rol del usuario (esto lo implementaremos más adelante)
            // Por ahora, redirigamos a una página de bienvenida general
            header("Location: ../vistas/bienvenida.php"); // Crea esta vista después
            exit();
        } else {
            // Login fallido: Redirigir al login con un mensaje de error
            $_SESSION['mensaje_error'] = "Credenciales incorrectas o usuario inactivo.";
            header("Location: ../vistas/login.php"); // Asegúrate de que esta ruta sea correcta
            exit();
        }
        break;

    case "registro":
        // Lógica para manejar el registro de un nuevo usuario
        $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
        $email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? limpiarCadena($_POST["password"]) : "";

        if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
            $_SESSION['mensaje_error'] = "Por favor, completa todos los campos para el registro.";
            header("Location: ../vistas/registro.php"); // Crea esta vista después
            exit();
        }

        // Aquí podrías añadir una verificación si el email ya existe antes de insertar
        // $usuario_existente = $usuario->verificarEmailExistente($email); // Necesitarías crear este método en el modelo
        // if ($usuario_existente) {
        //     $_SESSION['mensaje_error'] = "El email ya está registrado.";
        //     header("Location: ../vistas/registro.php");
        //     exit();
        // }

        $id_nuevo_usuario = $usuario->insertar($nombre, $apellido, $email, $password);

        if ($id_nuevo_usuario > 0) {
            // Registro exitoso: Asignar un rol por defecto si es necesario (ej. rol de "usuario regular")
            // Esto implicaría usar el modelo de Roles y usuario_roles, lo haremos más adelante.
            $_SESSION['mensaje_exito'] = "¡Registro exitoso! Ya puedes iniciar sesión.";
            header("Location: ../vistas/login.php");
            exit();
        } else {
            $_SESSION['mensaje_error'] = "Hubo un error al registrar el usuario. Inténtalo de nuevo.";
            header("Location: ../vistas/registro.php");
            exit();
        }
        break;

    case "logout":
        // Lógica para cerrar sesión
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
        header("Location: ../vistas/login.php"); // Redirige al login
        exit();
        break;

    default:
        // Si no se especifica ninguna operación, o es una operación desconocida
        // Podríamos redirigir a una página de inicio o al login
        header("Location: ../vistas/login.php"); // Redirige al login por defecto
        exit();
        break;
}
?>