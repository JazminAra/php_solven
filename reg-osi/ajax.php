<?php
	$_valor = $_GET['valor'];
	
	if($_valor != "null")
	{
		include('../conexion/conexion.php');
		$link = Conectarse();
		
		$sql = "SELECT fac_nombre FROM escuela, facultad WHERE id_escuela like '".$_valor."' AND esc_facultad like id_facultad;";	
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