<?php
    
    session_start();

	include('../conexion/conexion.php');
	$link = Conectarse();
    
    if (isset($_SESSION['k_username'])){
        
        $fecha = $_SESSION["date"];
        
        if($_GET['band'] == "student"){
            
           	if($_GET['estado'] == "P"){
        		$sql  = "UPDATE detalle_deuda SET det_estado = 'D' WHERE id_detalle_deuda = '".$_GET['id']."'; ";
                
                $sql2  = "INSERT INTO log_estudiante (log_estudiante, log_usuario, log_fecha_hora, log_tipo) VALUES (";
    			$sql2 .= "'".$_GET['ind']."',";
                $sql2 .= "'".$_SESSION['usuario']."',";
                $sql2 .= "'".date("y/m/d",$fecha)." ".date("H:i:s", $fecha)."',";
                $sql2 .= "2); ";		
        	}
        	else{
        		$sql = "UPDATE detalle_deuda SET det_estado = 'P' WHERE id_detalle_deuda = '".$_GET['id']."'; ";
                
                $sql2  = "INSERT INTO log_estudiante (log_estudiante, log_usuario, log_fecha_hora, log_tipo) VALUES (";
    			$sql2 .= "'".$_GET['ind']."',";
                $sql2 .= "'".$_SESSION['usuario']."',";
                $sql2 .= "'".date("y/m/d",$fecha)." ".date("H:i:s", $fecha)."',";
                $sql2 .= "3); ";
        	}
        }
        else{//ES UNA PERSONA
            
       	    if($_GET['estado'] == "P"){
        		$sql = "UPDATE detalle_deuda_anonimo SET det_estado = 'D' WHERE id_detalle_deuda = '".$_GET['id']."'; ";
                
                $sql2  = "INSERT INTO log_persona (log_persona, log_usuario, log_fecha_hora, log_tipo) VALUES (";
    			$sql2 .= "'".$_GET['ind']."',";
                $sql2 .= "'".$_SESSION['usuario']."',";
                $sql2 .= "'".date("y/m/d",$fecha)." ".date("H:i:s", $fecha)."',";
                $sql2 .= "2); ";
        	}
        	else{
        		$sql = "UPDATE detalle_deuda_anonimo SET det_estado = 'P' WHERE id_detalle_deuda = '".$_GET['id']."'; ";
                
                $sql2  = "INSERT INTO log_persona (log_persona, log_usuario, log_fecha_hora, log_tipo) VALUES (";
    			$sql2 .= "'".$_GET['ind']."',";
                $sql2 .= "'".$_SESSION['usuario']."',";
                $sql2 .= "'".date("y/m/d",$fecha)." ".date("H:i:s", $fecha)."',";
                $sql2 .= "3); ";
        	}
        }
       
        mysqli_query($link,$sql) or die("La siguiente consulta contiene 1");
        mysqli_query($sql2) or die("La siguiente consulta contiene 2");
    	
     
        
    	echo '<script language="javascript">
    			alert("Registro Actualizado");
    			location.href = "des_mor.php?codigo='.$_GET['codigo'].'";
    		</script>;';
        
        
    }
    
?>