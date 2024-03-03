<?php

	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{

		include('../conexion/conexion.php');
		$link = Conectarse();
		
		/* Ingreso primero los datos del libro*/
		
		$sql = "INSERT INTO libro (codLibro, numero, titulo, autor, fuente)			
				VALUES 
				('".$_POST["signatura"]."',
				 '".$_POST["numeracion"]."',
				 '".$_POST["titulo"]."',
				 '".$_POST["autor"]."',
				 '".$_POST["fuente"]."'); 
				";	
				
		mysqli_query($link,$sql) or die("Error al momento de insertar el Libro ");	
		$id_libro =  mysqli_insert_id();
		
		
		
		
		/* Busco los Datos del Estudiante *
		/* Si no esta lo Inserto */
		$sql = "SELECT * FROM estudiante WHERE codEstudiante like '".$_POST["codigo"]."';";
		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
		if($row = mysqli_fetch_array($result,MYSQLI_BOTH))
		{
			echo "Codigo de Usuario ya Existe";
		}
		else
		{
			$sql = "INSERT INTO estudiante (codEstudiante, nombres, apellidos, escuela, sexo, domicilio) 
					VALUES
					('".$_POST["codigo"]."',
					 '".$_POST["nombre"]."',
					 '".$_POST["apellido"]."',
					 '".$_POST["escuela"]."',
					 '".$_POST["sexo"]."',
					 '".$_POST["domicilio"]."')
					";					
			mysqli_query($link,$sql) or die("Error al momento de insertar el Estudiante ");	
		}
		
		
		
		/*  Ahora Guardare los datos del Prestamo */
		$sql = "INSERT INTO deudalibro (codEstudiante, idLibro, 
										fechaPrestamo, fechaRegistro, fechaActualizacion, 
										registrador, situacion, observacion)
				VALUES
				('".$_POST["codigo"]."',
				 '".$id_libro."',
				 '".$_POST["fecha"]."',
				 NOW(),
				 NOW(),
				 '".$_SESSION["id"]."',
				 'P',
				 '".$_POST["observacion"]."')
				";
				
		mysqli_query($link,$sql) or die("Error al momento de insertar deuda Libro ");
		
		echo '<script language="javascript">
			alert("Registro Guardado Correctamente");
			location.href = "../buscar/reporte_alumno.php?codigo='.$_POST["codigo"].'";
			</script>;';			
	
	}
	else
	{
		echo '<script language="javascript">
			alert("No ha iniciado Sesion");
			location.href = "../index.php";
			</script>;';
	}	
	

?>

