<?php	
	include('../conexion/conexion.php');
	$link = Conectarse();
	$_valor = $_GET['valor'];
		
	switch($_valor)
	{
		case 'opcion1':
			$sql = "SELECT * FROM escuela ORDER BY nombre; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
			
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["codEscuela"], 'data' => $row["nombre"]);

			break;
			
		case 'opcion2':
			$sql = "SELECT * FROM facultad ORDER BY nombre; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["codFacultad"], 'data' => $row["nombre"]);

			break;
			
		case 'opcion3':
			$sql = "SELECT * FROM biblioteca ORDER BY facultad; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["codBib"], 'data' => $row["facultad"]);

			break;
	}
	echo json_encode($_arreglo);
?>