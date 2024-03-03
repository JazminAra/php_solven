<?php
	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ES" lang="ES">
<head>
	<title>.:.Detalles del Libro.:.</title>
    <style type="text/css" title="currentStyle" media="screen">
		@import "../css/estilos_libro.css";
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2"> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					
</head>

<body>
	<?php
		include('../conexion/conexion.php');
		$link = Conectarse();
									
		$sql = "SELECT * FROM libro,detalle_deuda_anonimo WHERE id_libro like det_cod_libro AND id_libro like '".$_GET['id']."'; ";	
		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");	
		$numrow = mysqli_num_rows($result);
		
		if($numrow == 0){
			$sql = "SELECT * FROM libro,detalle_deuda WHERE id_libro like det_cod_libro AND id_libro like '".$_GET['id']."'; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");				
		}
		
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		
		
	?>	
	<div id="principal">
		<div id="titulo">
			<a>DATOS DEL LIBRO/BIEN</a>
		</div>
		<div id="madre">
			<div id="izquierda"><a>Codigo:</a><br /></div><div id="derecha"><?php echo $row['lib_codigo']; ?><br /></div>		
		</div>
		<div id="madre">
			<div id="izquierda"><a>Numero:</a><br /></div><div id="derecha"><?php echo $row['lib_numero']; ?><br /></div>		
		</div>
		<div id="madreb">
			<div id="izquierda"><a>Titulo:</a><br /></div><div id="derechab"><?php echo $row['lib_titulo']; ?><br/></div>		
		</div>
		<div id="madre">
			<div id="izquierda"><a>Autor:</a><br /></div><div id="derecha"><?php echo $row['lib_autor']; ?><br /></div>		
		</div>
		<div id="madrec">
			<div id="izquierda"><a>Fuente:</a><br /></div><div id="derechac"><?php echo $row['lib_fuente']; ?><br /></div>		
		</div>
        <div id="madre">
			<div id="izquierda"><a>Fecha:</a><br /></div><div id="derecha"><?php echo $row['det_fecha_prestamo']; ?><br /></div>		
		</div>
        <div style="background: #ffc776;  margin-top: 3px;">
            <a style="background: #ff9232;"><b>Observacion:</b></a><br /><a><?php echo $row['det_observacion']; ?></a>
        </div>
    </div>

<?php	 
   
	}
	else
	{
		echo '<script language="javascript">
			alert("No ha iniciado Sesion");
			location.href = "../index.php";
			</script>;';
	}
	
?>	


</body>
</html>
		  		