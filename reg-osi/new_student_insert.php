<?php

	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{

		include('../conexion/conexion.php');
		$link = Conectarse();
		
        /* Busco los Datos del Estudiante *
		/* Si no esta lo Inserto */
		$sql = "SELECT * FROM estudiante WHERE est_codigo = '".$_POST["codigo"]."';";

		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
        
		if($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
		  
            echo '<script language="javascript">
        			location.href = "../reg-osi/?stream=new-fail";
    			</script>;';
			//header("Location: ../reg-bib/?stream=new-fail");
		}
		else{
			$sql = "INSERT INTO estudiante (est_codigo, est_nombres, est_apellidos, est_escuela, est_sexo, est_domicilio, est_sede, est_estado)
					VALUES
					('".$_POST["codigo"]."',
					 '".$_POST["nombre"]."',
					 '".$_POST["apellido"]."',
					 '".$_POST["escuela"]."',
					 '".$_POST["sexo"]."',
					 '".$_POST["domicilio"]."',
					 '".$_POST["sede"]."',
                     1); ";					
			mysqli_query($link,$sql) or die("Error al momento de insertar el Estudiante ");
		}

		
		echo '<script language="javascript">
			alert("Registro Guardado Correctamente");
			location.href = "../reg-osi/?stream=new";
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

