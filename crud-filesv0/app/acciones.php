<?php
// Borra el elemento indicado de tabla de usuarios
// Reordena indexa la tabla
function accionBorrar ($id){    
     //<<<< COMPLETAR >>>>>>  
     // anotar en $_SESSION['msg'] un mensaje si el usuario ha sido eliminado o si no existe
    // Elimino de la tabla
    if (array_search("$id",$_SESSION['tuser'])== false) {
        $_SESSION['msg']="no existe el usuario";
     }
    else {
        unset( $_SESSION['tuser'][$id]);   
        $_SESSION['msg']="el usuario ha sido eliminado";
    }
    
}

// Termina: Cierra sesión y vuelva los datos
function accionTerminar(){
       
        volcarDatos($_SESSION['tuser']);
        session_destroy();
       $_SESSION['msg'] = "  Todos datos se han guardado ";
}
 

// Muestra un formularios con los datos de un usuario de la posición $id de la tabla
function accionDetalles($id){
    $login=$id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  =   $usuario[0];
    $nombre   = $usuario[1];
    $comentario=$usuario[2];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

// Muestra  el formularios con los datos permitiendo la modificación
function accionModificar($id){
    $login=$id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  = $usuario[0];
    $nombre  = $usuario[1];
    $comentario=$usuario[2];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();  
}

// Modifica el contenido de usuario
function accionPostModificar() {
    $id = $_POST['login'];
    $nuevovalor = [ $_POST['clave'],$_POST['nombre'],$_POST['comentario']];
    if (array_search($id,$_SESSION['tuser'])==false) {
        $_SESSION['msg'] = "el usuario no existe introduzca un login valido";
    }
    else{
        $_SESSION['tuser'][$id]= $nuevovalor;  
        $_SESSION['msg'] = " Usuario con login $id actualizado";
    }
  

}


// Muestra  el formulario con los datos vacios para realizar una alta
function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

// Proceso los datos del formularios guardándolo en la sesión
// Debe evitar que se puedan introducir dos usuarios con el mismo login y
// que exista algún campo vacio.

function accionPostAlta(){
    limpiarArrayEntrada($_POST[]); //Evito la posible inyección de código
    $id = $_POST['login'];

    if (!isset($_POST['clave'])|| !isset($_POST['nombre'])||!isset($_POST['comentario'])) {
        $_SESSION['msg']= "no puedes dejar ningun campo vacio";
    }
   else{
    $nuevo = [ $_POST['clave'],$_POST['nombre'],$_POST['comentario']];

   }
     if (array_search($id,$_SESSION['tuser'])==false) {
        $_SESSION['tuser'][$id]= $nuevo;  
        $_SESSION['msg'] = " Nuevo usuario añadido.";
     }
     else{
        $_SESSION['msg'] = " ya existe un usuario con ese login";

     }
   
}

    
