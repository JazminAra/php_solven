<?php
	$_valor = $_GET['valor'];
	
	if($_valor != "null")
	{
		include('../conexion/conexion.php');
		$link = Conectarse();
		
		$sql = "SELECT facultad.nombre FROM escuela, facultad WHERE codEscuela like '".$_valor."' AND facultad like codFacultad;";	
		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");			
		$row = mysqli_fetch_array($result,MYSQLI_BOTH);
		$prueba[] = array('data' => $row["nombre"]);		
	}
	else
	{
		$prueba[] = array('data' => '');
	}

	echo json_encode($prueba);
?>