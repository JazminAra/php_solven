<?php 
	
	include('../conexion/conexion.php');
	$link = Conectarse();	
	
	$sql = "SELECT est_codigo FROM estudiante; ";
	$result = mysqli_query($link,$sql) or die("JOJOJO");
	$bandera = false;
	
	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){		
		if ($_GET["q"] == $row["est_codigo"]){
			$bandera = true;
		}			
	}
	
	if($bandera){
		echo '<span style="color: blue; font-size:16px; ">Estudiante Registrado</span>';
	}
	else{
		echo '<span style="color: red; font-size:16px; ">No Existe</span>';		
	}
	

?>