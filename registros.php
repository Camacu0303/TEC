<?php 
include 'conexion.php';
if(isset($_POST['row'])){
    $conexion= conectar();
if(!$conexion){
  echo "No Se Pudo Conectar Con El Servidor";
}
    $arr= $_POST['row'];
    $Option= $_POST['tabla'];
    $sql= "DELETE from $Option WHERE ";
    $sql2= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Option'";
    $query= mysqli_query($conexion, $sql2);
    $columnas= array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($columnas, $row['column_name']);          
    }
    for($i=0; $i<=sizeOf($arr)-2; $i++){
    $sql= $sql . $columnas[$i]."='".$arr[$i]."' ";
    if($i!=sizeOf($arr)-2){
        $sql= $sql . "AND". ' ';
    }
    }
    $query3= mysqli_query($conexion, $sql);
    if($query3){
        busqueda($Option, $conexion);
    }else{
        echo $sql;
    }
    

}else{
$Option= $_POST['tabla'];
$conexion= mysqli_connect('localhost','root','', 'universidad');
if(!$conexion){
  echo "No Se Pudo Conectar Con El Servidor";
}else{
    busqueda($Option, $conexion);
}
mysqli_close($conexion);
}
function busqueda($Option, $con){
    $salida="";
    $sql= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Option'";
    $query= mysqli_query($con, $sql);
    $columnas= array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($columnas, $row['column_name']);          
    }
    $salida= $salida . "<table>";
    $salida= $salida . "<tr>";
    for($i=0; $i<=sizeof($columnas)-1; $i++){
        $salida= $salida . "<td>". $columnas[$i]."</td>";
    }
    if($_SESSION['type']==0){
        $salida= $salida . '<td colspan="2">Acciones</td></tr>';
    }
    $sqls= "SELECT * from $Option";
    $queries= mysqli_query($con, $sqls);
    $a="Option=".$Option;
    while($rows = mysqli_fetch_array($queries)) {
   
        $salida= $salida . "<tr>";
        $exit="";
        for($i=0; $i<=sizeof($columnas)-1; $i++){
            if($i==0){
                $exit=$rows[$columnas[$i]];
            }
            $salida= $salida . "<td>".$rows[$columnas[$i]]."</td>";
        }
        for($i=0; $i<=sizeof($columnas)-1; $i++){
            
          
            $a= $a ."&". $i. "=". $rows[$columnas[$i]];

        }
        if($_SESSION['type']==0){
            $salida= $salida . "<td><input type='button' id='delete' value='Borrar'></td>";
            $salida= $salida . "<td><a href='update.php?".$a."'>Update</a></td></tr>";
            $a="Option=".$Option;
        }
 

       
    }
    $salida= $salida . "</table><br><br>";
    echo $salida;
    
}  
?>
 