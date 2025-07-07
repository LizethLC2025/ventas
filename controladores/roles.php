<?php
// Incluimos el archivo Categoria.php
require_once "../modelos/Categoria.php";
//Instanciamos la clase categoria 
$catergoria= new Categoria();

//Definimos una variable para almacenar el idcategoria
$idcategoria =isset ($_POST ["idcategoria"])? limpiarCadena ($_POST["idcategoria"]) :"";
//definimos una variable para almacenar el nombre 
$nombre = isset($_POST["nombre"])? limpiarCadena ($_POST["nombre"]): "";
//definimos una variable para almacenar la descripcion 
$descripcion =isset ($_POST["descripcion"])? limpiarCadena ($_POST["descripcion"]): "";

//Generamos un switch para determinar la accion a realizar
switch($_GET ["op"]){
    case 'guardaryeditar':
        if (empty($idcategoria)){
            $rspta = $catergoria-> insertar($nombre, $descripcion);
            echo $rsparta ? "Categoria resgiatrada con exito" : "No se pudo registrar la categoria a la base de datos";
        
        }
        else{
            $rspta = $catergoria-> editar($idcategoria, $nombre, $descripcion);
            echo $rsparta ? "categoria editada con exito" : "No se pudo editar la categoria";

        }
}

?>