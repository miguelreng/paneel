<?php
	session_start();
	if(@$_POST['usuario']){
		include_once("php/funcionesAcceso.php");
		$getDataAcceso = new accesoPanel;
		$consulta = $getDataAcceso->consultar($_POST['usuario'],$_POST['pass']);
		if($consulta){
			$row = mysqli_fetch_array($consulta);
			if($row['usuario']){
				$_SESSION['userCliente'] = $row['usuario'];		
      		$_SESSION['passCliente'] = $row['contrasena'];					
			}
		}
  		header('Location: http://localhost/panel/views/panel.php');  
	}
	if(@!$_SESSION["userCliente"]){  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
		<title>Acceso a panel de control</title>
     	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
     	<link rel="stylesheet" href="css/acceso.css">
 		<script src="js/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
 		<div class="row">
        	<div class="span4 well">
           	<form id="loginValidate" onSubmit="return acceso();" method="POST" action="">
            	<fieldset>
               	<legend>
                 		Ingresar al panel de control
               	</legend>
               	<div align="center">
                 		<div class="input-prepend">
                   		<span class="add-on"><i class="icon-user"></i></span>
                   		<input placeholder="Usuario" type="text" id="usuario" required="required" name="usuario" title="Usuario">
                 		</div>
            		</div>
               	<div align="center">
                 		<div class="input-prepend">
                   		<span class="add-on"><i class="icon-lock"></i></span>
                   		<input placeholder="Password" type="password" name="pass" required="required" title="Password" id="pass">
                 		</div>
               	</div>
               	<button id="btnIngresar" class="btn pull-right" style="margin-top: 15px">Ingresar</button>
             	</fieldset>
           	</form>
         </div>
		</div>
     	<div id="error">
         <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>&iexcl;Oh!</strong> Revisa tus datos e intenta de nuevo por favor.
         </div>
    	</div>
     	<footer>
     		<p id="text_footer">Desarrollado por <a href="http://scriptmedia.co">Script Media</a></p>
     	</footer>
     	<br>
     	<br>
     	<br>
     	<div>
     		<img id="img_colombia" src="img/logoazulpq.png">
     	</div>        
	</body>
 	<script>
		function acceso(){		
			var usuario = document.getElementById('usuario').value;
			var contrasena = document.getElementById('pass').value;
			var valid = false;
			$('#error').show(500);
			$('#error').html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
		
			$.ajax({
				crossDomain: true,
				type:'POST',
				url: "php/getDataAcceso.php?data=login&usuario="+usuario+"&contrasena="+contrasena,
				dataType: 'html',
				async: true,
				success: function(data) {
					var response = $.trim(data);
               //alert(response);
					if(response=="existe usuario"){
                  alert("Usuario:" + " " + usuario + " " + "Contraseña:" + " " + contrasena);
                  console.log("Existe usuario");                        
                  document.getElementById("loginValidate").submit();
                  //location.href="http://localhost/panel/views/panel.php";                        
					}else{
                  alert("No existe el usuario:" + " " + usuario);
						$('#error').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>              <strong>&iexcl;Oh!</strong> Revisa tus datos e intenta de nuevo por favor.</div>');
					}					
				},
			});            
			return valid;            
		}
	</script>
</html>
<?php 
}else if($_SESSION["userAlmacen"]&&$_SESSION['passCliente']){  
  ?>  
<?php
}else{
	header('Location: http://localhost/panel/views/panel.php');
}