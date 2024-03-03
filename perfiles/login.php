<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<meta-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>Login</title>
		<link href="../css/estilo-log.css" rel="stylesheet" type="text/css" />

	</head>
	
	<body>
	
		<div id="contenedor">
			<h2>LOGIN<img src="../imagenes/key2.png" /></h2>
		
		    <form action="validar_usuario.php" method="post">
		    	<div id="name">Usuario:</div>
		        <div id="field"><input name="usuario" class="form-login" title="Username" value="" size="30" maxlength="2048" />
		        </div>
		    	<div id="name">Password:</div>
		        <div id="field"><input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" />
		        </div>
		        
		        <div id="field-submit"><input type="submit" value="Entrar" name="enviar" class="enviar"></div>
		    	
			</form>
		</div>
		
		</div>
	
	</body>
</html>

