<?php

	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{

		include('../conexion/conexion.php');
		$link = Conectarse();
		
        /* Busco los Datos del Estudiante *
		/* Si no esta lo Inserto */
		$sql = "SELECT * FROM persona WHERE per_dni = '".$_POST["dni"]."';";

		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
        
		if($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
		  
            echo '<script language="javascript">
        			location.href = "../reg-bib/?stream=new-fail";
    			</script>;';
			//header("Location: ../reg-bib/?stream=new-fail");
		}
		else{
			$sql = "INSERT INTO persona (per_dni, per_nombres, per_apellidos, per_tipo, per_sexo, per_domicilio, per_estado) 
					VALUES
					('".$_POST["dni"]."',
					 '".$_POST["nombre"]."',
					 '".$_POST["apellido"]."',
					 '".$_POST["tipo"]."',
					 '".$_POST["sexo"]."',
					 '".$_POST["domicilio"]."',
                     1); ";					
			mysqli_query($link,$sql) or die("Error al momento de insertar el Estudiante ");	
		}

		
		echo '<script language="javascript">
			alert("Registro Guardado Correctamente");
			location.href = "../reg-bib/?stream=new";
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

