<?php

	session_start();

	if (isset($_SESSION['k_username'])) 
	{

		include('../conexion/conexion.php');
		$link = Conectarse();
        
        if($_POST['hidden_band'] == "student"){
            
            $sql = "SELECT e.id_estudiante AS id FROM estudiante e WHERE e.est_codigo = '".$_POST['hidden_cod']."'; ";
        
            $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
            $row = mysqli_fetch_array($result,MYSQLI_BOTH);          
        }
        else{
            $sql = "SELECT p.id_persona AS id FROM persona p WHERE p.per_dni = '".$_POST['hidden_cod']."'; ";

            $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
            $row = mysqli_fetch_array($result,MYSQLI_BOTH);  
        }

        $id_individuo = $row['id'];
		
		/* Ingreso primero los datos del libro*/
		
		$sql = "INSERT INTO libro (lib_codigo, lib_numero, lib_titulo, lib_autor, lib_fuente) VALUES "; 
		$sql .= "('".$_POST["signatura"]."', ";
		$sql .= "'".$_POST["numeracion"]."', ";
        $sql .= "'".$_POST["titulo"]."', ";
	    $sql .= "'".$_POST["autor"]."', ";
        $sql .= "'".$_POST["fuente"]."'); "; 
        				
		mysqli_query($link,$sql) or die("Error al momento de insertar el Libro ");	
		$id_libro =  mysqli_insert_id($link);
				
		/*  Ahora Guardare los datos del Prestamo */
        
        if($_POST['hidden_band'] == "student"){
            
            $sql = "INSERT INTO detalle_deuda (det_id_alumno, det_cod_libro, det_cod_articulo, det_cod_tipo, ";
            $sql .= "det_fecha_prestamo, det_fecha_registro, det_usuario, det_observacion, det_estado) VALUES ";
    		$sql .= "('".$id_individuo."', ";
    	    $sql .= "'".$id_libro."', ";
            $sql .= "0, ";
            $sql .= "'A', ";
    	    $sql .= "'".$_POST["fecha"]."', ";
            $sql .= "NOW(), ";
            $sql .= "'".$_SESSION["usuario"]."', ";
            $sql .= "'".$_POST["observacion"]."', ";
            $sql .= "'P'); ";
        }
        else{
            
            $sql = "INSERT INTO detalle_deuda_anonimo (det_id_persona, det_cod_libro, det_cod_articulo, det_cod_tipo, ";
            $sql .= "det_fecha_prestamo, det_fecha_registro, det_usuario, det_observacion, det_estado) VALUES ";
    		$sql .= "('".$id_individuo."', ";
    	    $sql .= "'".$id_libro."', ";
            $sql .= "0, ";
            $sql .= "'A', ";
    	    $sql .= "'".$_POST["fecha"]."', ";
            $sql .= "NOW(), ";
            $sql .= "'".$_SESSION["usuario"]."', ";
            $sql .= "'".$_POST["observacion"]."', ";
            $sql .= "'P'); ";
        }


        mysqli_query($link,$sql) or die("Error al momento de insertar deuda Libro ");
		
		echo '<script language="javascript">
			alert("Registro Guardado Correctamente");
			location.href = "des_mor.php?codigo='.$_POST['hidden_cod'].'";
			</script>';
	}
	else
	{
		echo '<script language="javascript">
			alert("No ha iniciado Sesion");
			location.href = "../index.php";
			</script>;';
	}	
	

?>

