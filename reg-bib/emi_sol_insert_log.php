<?php
	// Mis variables de Session
	session_start();
    
	if (isset($_SESSION['k_username'])) 
	{
		//Guardare los datos en la base de datos si el usuario es del tipo B
		if($_SESSION["tipo"] == 'A')
		{
			$fecha = $_SESSION["date"];
            
            include('../conexion/conexion.php');
            $link = Conectarse();
            
            $sql  = "INSERT INTO log_estudiante (log_estudiante, log_usuario, log_fecha_hora, log_tipo) VALUES (";
			$sql .= "'".$_POST['cod_oculto']."',";
            $sql .= "'".$_SESSION['usuario']."',";
            $sql .= "'".date("y/m/d",$fecha)." ".date("H:i:s", $fecha)."',";
            $sql .= "1); ";
    
            mysqli_query($link,$sql) or die("La siguiente consulta contiene 2");

			echo '<script language="javascript">
            				location.href = "../reg-bib/?stream=sol";
			     </script>;';
            //header("Location: ../reg?stream=sol");
		}
	}
?>