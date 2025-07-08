<?php
// Incluimos el archivo Roles.php
require_once "../modelos/Roles.php";
//Instanciamos la clase roles
$roles= new Roles();   
//Definimos una variable para almacenar el idroles
$idroles =isset ($_POST ["idroles"])? limpiarCadena ($_POST["idroles"]) :"";
//definimos una variable para almacenar el nombre 
$nombre = isset($_POST["nombre"])? limpiarCadena ($_POST["nombre"]): "";
//definimos una variable para almacenar la condición
$condicion =isset ($_POST["condicion"])? limpiarCadena ($_POST["condicion"]): "";

//Generamos un switch para determinar la accion a realizar
switch($_GET ["op"]){
    case 'guardaryeditar':
        if (empty($idroles)){
            $rspta = $roles-> insertar($nombre, $condicion);
            echo $rsparta ? "Categoria resgiatrada con exito" : "No se pudo registrar la categoria a la base de datos";
        
        }
        else{
            $rspta = $roles-> editar($idroles, $nombre, $condicion);
            echo $rsparta ? "categoria editada con exito" : "No se pudo editar la categoria";

        }
        break;
        //si elijo la opción desactivar ejecuta esta sección del código
        case 'desactivar'
        $rspta = $roles->desactivar($idroles);
        echo $rspta ? "Roles desactivados" : "No se pudo desactivar";
        break;
    case 'activar' :
        $rspta = $roles->activar($idroles);
        echo $rspta ? "Roles activados" : "No se pudo activar";
        break;
        case 'mostrar'
        $rpsta = $roles->mostrar($idroles);
        //Convertir el resultado en JSON
        echo json_encode($rspta);
        break;
        


}

?>