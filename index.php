<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technological of Costa Rica: Tec</title>
    <link rel="stylesheet" href="indexstyle.css">
</head>
<body>
    <header>
 <div id="header"> 
         </div><a href='logout.php' style='float: right;font-size: 25px;
    color: azure;
    text-decoration: none;'>Sign off</a>
    </header>


    <h1>Select the record:</h1>
    
</body>
</html>
<?php 
session_start();
if(empty($_SESSION)){
header('Location: login.php');
}else{
    $salida='';
    echo $_SESSION['type'];
    switch($_SESSION['type']){
        case 0:   
        $salida.= '<ul>
        <li><a href="registro_estudiante.html">Student</a></li>
        <li><a href="registro_profesor.html">Teacher</a></li>
        <li><a href="registro_curso.html">Course</a></li>
        <li><a href="registros.html">Recorded records</a></li>
        <li><a href="registrar.html">Register in tables</a></li></ul>';
        break;
        case 1:
            $salida.= '<ul>
            <li><a href="registros.html">Recorded records</a></li>
            <li><a href="registrar.html">Register in tables</a></li></ul>';
        break;
    }
    echo $salida;

}
?>