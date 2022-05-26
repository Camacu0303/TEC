<?php
	//conectamos Con el servidor
	include 'conexion.php';  $conexion=conectar();
	//verificamos la conexion
	if(!$conectar){
		echo"No Se Pudo Conectar Con El Servidor";
	}else{

	
	
	}
	//recuperar las variables
	$nombre=$_POST['Nombre'];
    $Apellido1=$_POST['primeApellido'];
    $Apellido2=$_POST['segundoApellido'];
    $Edad=$_POST['Edad'];
    $Nacimiento=$_POST['FechaNacimiento'];
    $Direccion=$_POST['direccion'];
	$Especialidad=$_POST['especialidad'];

	//hacemos la sentencia de sql
	$sql="INSERT INTO profesores (Nombre, primeApellido, segundoApellido, Edad, FechaNacimiento, direccion, especialidad) VALUES('$nombre','$Apellido1', '$Apellido2', '$Edad', '$Nacimiento', '$Direccion', '$Especialidad' )";
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