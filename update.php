<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
<header>
 <div id="header"> 
         </div><a href='logout.php' style='float: right;font-size: 25px;
    color: azure;
    text-decoration: none;'>Cerrar sesión</a>
     
    </header>
    <h1>Actualización de registros en base de datos</h1>
</body>
</html>
<?php 
include "conexion.php";

$con= conectar();
if(isset($_POST['where'])){
$where= $_POST['where'];
$Option= $_POST['Option'];

$array = array_values($_POST);

$upd="UPDATE $Option SET ";
$sql= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Option'";
$query= mysqli_query($con, $sql);
$columnas= array();
$i=0;
while ($row = mysqli_fetch_array($query)) {
        $upd.= $row['column_name'] . "='". $array[$i++]."'," ;     
}
$upd= substr($upd, 0, -1);
$upd.=$where;
echo $upd;
$finalexe=mysqli_query($con, $upd);
if($finalexe){
header('Location: registros.html');
}else{
    echo "error: ".mysqli_error($con) . $upd;
}
}else{
    $array = array_values($_GET);
    $exit= $array[0];
    $sql= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$array[0]'";
        $query= mysqli_query($con, $sql);
        $columnas= array();
        while ($row = mysqli_fetch_array($query)) {
            array_push($columnas, $row['column_name']);          
        }
    
    $query2_where="WHERE ";
    for($i=0; $i<=sizeOf($array)-2; $i++){
        $query2_where= $query2_where . $columnas[$i] ."='" . $array[$i+1];
        if($i!=sizeOf($columnas)-1){
        $query2_where= $query2_where ."' AND ";
        }else{
            $query2_where= $query2_where ."'";
        }
    }
      $salida="";

      $salida.='<form action="update.php" method="post">';
      for($i=0; $i<=sizeOf($array)-2; $i++){
          $salida= $salida . "<label>".$columnas[$i]."</label><input type='text' required name='".$columnas[$i]."' value='".$array[$i+1]."' ><br>";
      }
      $salida.= '<input name="where" type="text" value="'.$query2_where. '" hidden>';
      $salida.= '<input name="Option" type="text" value="'.$exit. '" hidden>';
      $salida.= "<input type='submit'>";
      $salida.= "</table><br><br><a href='registros.html'>Volver</a>";

      $salida.= '</form>';
      echo $salida;
}


?>

