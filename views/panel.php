<?php
session_start();
if(@$_POST['usuario']){
	include_once("../php/funcionesAcceso.php");
	$getDataAcceso = new accesoPanel;
	$consulta = $getDataAcceso->consultar($_POST['usuario'],$_POST['pass']);  
	if($consulta){
		$row = mysqli_fetch_array($consulta);
			if($row['usuario']){
				$_SESSION['userCliente'] = $row['usuario'];								        

			}
	}  
}
if(@!$_SESSION["userCliente"]){
	header('Location: http://localhost/panel/');
?>
<?php 
}else if($_SESSION["userCliente"]){
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
			<title>Acceso a panel de control</title>
    		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">           
  			<script src="../jquery.min.js"></script>
  			<script src="../js/bootstrap.min.js"></script>
		</head>
		<body>  	
      		<div class="col-md-12">
        		<h1>Panel de control paginas web!!</h1>
        		<a href="../php/logout.php"><label>Salir</label></a>
      		</div>      
    		<footer>
    			<p id="text_footer">Desarrollado por <a href="http://scriptmedia.co">Script Media</a></p>
    		</footer>      
		</body>    
	</html>
<?php 
}
