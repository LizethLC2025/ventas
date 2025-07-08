<?php
//Incluimops el archivo a la conexion a la base de datos
//../ sale de un nivel del lugar de donde estamos
require"../config/Conexion.php";

//Creo la clase Roles
class roles{
    //Definimos un constructror 
    //Elconstructor se va a ejecutar por primera vez 
    //al ejecutar la clase 
    public function _construct(){

    }
    //Definimos un metodo para inserta una categoria a la base de datos 
    public function insertar($nombre, $descripcion){
        //definimos unavariable para almacenar la consulta 
        $sql ="INSERT INTO roles (nombre, condicion)
        VALUES ($nombre, '1')";
        //Retornamos el resultado de la consulta 
        returnejecutarConsulta($sql)

    }
    //Definimos un metodo para editar unos roles
    public function editar($idroles, $nombre, $descripcion){
        //Definmos una variable para  almacenar una consulta 
        $sql = "UPDATE categoria SET nombre= '$nombre', descripcion= 'descripcion';
        WHERE idcategoria='idcategoria'";
        return ejecutarConsulta ($sql);


    }
    //Definimos una funcion para activar una catergoria 
    public function activar ($idcategoria){
        //Definimos una variable para almacenar la consulta
        $sql="UPDATE categoria SET condicion = 1
    
    WHERE idcategoria = '$idcategoria'";
    return ejecuutarConsulta($sql);

    }
    //definimos una funcion para desactivar la categoria
    public function desactivar ($idcategoria){
        //definimos una variable para almacenar la consulta
        $sql= "UPDATE categoria SET condicion = 0
        WHERE idcategoria = '$idcategoria'";
        //retornamos la consulta
        return ejecutarConsulta ($sql);
    
    }
    //Definimos una consulta para mostrar una fila de la base de datos
    public function mostrar ($idcategoria){
        //definimos una variable para almacenar la consulta
        $sql= "SELECT * FROM categoria WHERE idcategoria= '$idcategoria'";
        //retornamos la consulta
        return ejecutarConsultaSimpleFila($sql);
    }
    //Definimos una funcion para listar las categorias 
    public function listar (){
        //definimos una variable donde se va a guardar la consulta
        $sql= "SELECT*FROM categoria";
        //retornamos la consulta
        return ejecutarConsulta($sql);
    }
    //definimos una funcion para listar las categorias activas
    public function select(){
        $sql= "SELECT* FROM categoria WHERE condicion= 1";
        //retornamos la consulta
        return ejecutarCosulta($sql);
    }
    



}

?>