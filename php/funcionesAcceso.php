<?php 
  include_once("conex.php");
  //implementamos la clase acceso
  class accesoPanel{

  	// consulta los usuarios de la BD
  	function consultar($usuario, $contrasena){
   		//creamos el objeto $con a partir de la clase DBManager
   		$con = new DBManager;
   		//usamos el metodo conectar para realizar la conexion
   		if($con->conectar()==true){
    		$sql = "SELECT * FROM hola WHERE usuario = '$usuario' and contrasena = '$contrasena'  ";
			  $datos = mysqli_query( $con->conect	,$sql );
    		if (!$datos)
     			return false;
    		else
     			return $datos;
   		}
  	}	
  }
?>