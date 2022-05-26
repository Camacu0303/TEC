<?php
	//conectamos Con el servidor
	include 'conexion.php';  $conexion=conectar();
	//verificamos la conexion
	if(!$conectar){
		echo"No Se Pudo Conectar Con El Servidor";
	}else{

	
	
	}
	//recuperar las variables
	$curso=$_POST['curso'];
    $desc=$_POST['descripcion'];
    $creditos=$_POST['creditos'];

	//hacemos la sentencia de sql
	$sql="INSERT INTO cursos (curso, descripcion, creditos) VALUES('$curso','$desc', '$creditos')";
	//ejecutamos la sentencia de sql
	$ejecutar=mysqli_query($conectar, $sql);
	//verificamos la ejecucion
	if ($ejecutar) {
        echo "New record created successfully <a href='index.php'>Volver</a>";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conectar);
      }

    mysqli_close($conectar);

?>