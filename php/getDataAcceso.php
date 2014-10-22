<?php 
	session_start();
	include_once('funcionesAcceso.php');
 	$usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario']:"";
 	$contrasena = isset($_REQUEST['contrasena']) ? $_REQUEST['contrasena']:"";
	$data = isset($_REQUEST['data']) ? $_REQUEST['data']:"";
	
	$getDataAcceso = new accesoPanel;
	 	
	if($data=="login"){
		$consulta = $getDataAcceso->consultar($usuario,$contrasena);
		if($consulta){
			$row = mysqli_fetch_array($consulta);			
			if($row['usuario']){
				echo "existe usuario";
			}else{
				echo "no existe usuario";
			}
		}
	}
	
?>