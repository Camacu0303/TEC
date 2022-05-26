<?php 
include 'conexion.php';
$conexion= conectar();
if(isset($_POST['exit'])){
$exit= $_POST['exit'];
$query= "INSERT into $exit[0] (";
$sql2= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$exit[0]'";
$query2= mysqli_query($conexion, $sql2);
$columnas= array();
while ($row = mysqli_fetch_array($query2)) {
    array_push($columnas, $row['column_name']);          
}
for($i=0; $i<=sizeof($columnas)-1; $i++){
    if($i==sizeof($columnas)-1){
        $query= $query . $columnas[$i]. ') ';
    }else{
    $query= $query . $columnas[$i]. ', ';
}
}
$query= $query . "VALUES (";
for($i=1; $i<=sizeof($columnas); $i++){
    if($i==sizeof($columnas)){
        $query= $query . "'". $exit[$i] . "')";
    }else{
        $query= $query . "'". $exit[$i] . "',";
}
}
$ejecutar= mysqli_query($conexion, $query);
if($ejecutar){
    echo "Exitoso". $query .sizeof($exit);
}else{
    echo 'Mal ahí' . mysqli_error($conexion);
}
}else{
    $Option= $_POST['tabla'];
    $salida="";
      $sql2= "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Option'";
      $query= mysqli_query($conexion, $sql2);
        
        $columnas= array();
        while ($row = mysqli_fetch_array($query)) {
            array_push($columnas, $row['column_name']);          
        }
        $salida= "$salida". "<div id='form'><form action= 'registrar.php' method='post'>";
        for($i=0; $i<=sizeof($columnas)-1; $i++){
            if($Option=="cursos"){
                    if($i==0){
                        $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                        $salida= $salida . "<input id='input' type='text' name='".$columnas[$i]."'><br>";
                    }else{
                        $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                        $salida= $salida . "<input id='input' type='text' name='".$columnas[$i]."'><br>";
                    }
            }else{
                if($i==0){
                    $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                    $salida= $salida . "<input id='input' value='null' type='text' disabled  name='".$columnas[$i]."'><br>";
                }else{
                    if($columnas[$i]=='Edad'){
                        $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                        $salida= $salida . "<input id='input' type='number'  name='".$columnas[$i]."'><br>";
                    }else{
                        if($columnas[$i]=='FechaNacimiento'){
                            $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                            $salida= $salida . "<input id='input' type='date'  name='".$columnas[$i]."'><br>";
                        }else{
                            $salida= $salida . "<label>" . $columnas[$i] . "</label>";
                            $salida= $salida . "<input id='input' type='text'  name='".$columnas[$i]."'><br>";
                        }
                        
                    }
 
            }
            }
        }
        $salida= $salida . "</form>";
        echo $salida;
        
}

?>