<?php	
	include('../conexion/conexion.php');
	$link = Conectarse();
	$_valor = $_GET['valor'];
		
	switch($_valor)
	{
		case 'opcion1':
			$sql = "SELECT * FROM escuela WHERE esc_estado = 1 ORDER BY esc_nombre; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
			
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["id_escuela"], 'data' => $row["esc_nombre"]);

			break;
			
		case 'opcion2':
			$sql = "SELECT * FROM facultad fac_estado ORDER BY fac_nombre; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["id_facultad"], 'data' => $row["fac_nombre"]);

			break;
			
		case 'opcion3':
			$sql = "SELECT * FROM oficina WHERE ofi_tipo = 'tipo001' AND ofi_estado = 1 ORDER BY ofi_nombre; ";	
			$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
				$_arreglo[] = array('id' => $row["id_oficina"], 'data' => $row["ofi_nombre"]);

			break;
	}
	echo json_encode($_arreglo);
?>