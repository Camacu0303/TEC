<?php 
session_start();
if(empty($_SESSION)){
    header('Location: login.php');
}
   
  
function conectar(){
    $conectar=  mysqli_connect('localhost', 'root', '', 'universidad');
    //verificamos la conexion
    if(!$conectar){
        echo"No Se Pudo Conectar Con El Servidor";
    }else{
    return $conectar;
    }
}
?>