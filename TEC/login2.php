  <?php
include 'conexion.php';
$conexion= conectar();
      if(!$conexion){
		echo "No Se Pudo Conectar Con El Servidor";
      }else{
        $contraseña= $_POST['password'];
        $usuario= $_POST['user'];
        $sql ="SELECT * FROM users where user= '$usuario'";
        $query=mysqli_query($conexion, $sql);
        $row=mysqli_fetch_array($query);
        $user= $row['user'];
        $password= $row['password'];

        if($usuario==$user && $password==$contraseña){
          $_SESSION['type']=(int)$row['type'];
          header('Location: index.php');
            
        }else{
          header('Location: login.php');
        }
      }

      
       
 ?>