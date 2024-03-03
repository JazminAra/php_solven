<?php

session_start();

function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");
	$mensaje = str_replace($nopermitidos, "", $mensaje);
	return $mensaje;
}

if(trim($_POST['usuario']) != "" && trim($_POST['password']) != "" ){
	
	include('../conexion/conexion.php');
	$link = Conectarse();
	
	$usuario = strtolower(htmlentities($_POST['usuario'], ENT_QUOTES));
	$password = $_POST['password'];
	
	$sql  = "SELECT * FROM usuario, oficina, ofi_tipo WHERE id_usuario like '".$usuario."' ";
    $sql .= "AND usu_oficina like id_oficina AND ofi_tipo like id_ofi_tipo;";
	$result = mysqli_query($link,$sql) or die("Error en la consulta"); 
		
	if($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
	   if($row['usu_estado'] == 1){
	       
           if($row["pass_usuario"] == $password){
		  
            $_SESSION["k_username"] = $row['usu_apellidos'].", ".$row['usu_nombres']." (".$row['ofi_nombre'].")";
      		  $_SESSION["oficina"] = $row['usu_oficina'];
      		  $_SESSION["usuario"] = $row["id_usuario"];
      		  $_SESSION["tipo"] = $row["usu_tipo"];
      			
      		  //Variables de sesion para llenar los reportes 
      		  $_SESSION["ficha"][0] = $row['usu_grado'];
      		  $_SESSION["ficha"][1] = $row['usu_apellidos'];
      		  $_SESSION["ficha"][2] = $row['usu_nombres'];
      		  //$_SESSION["ficha"][3] = $row['usu_facultad'];
      					
      		  if($_SESSION["tipo"] == 'A'){
      
                    header("Location: ../demo/inicio-bib.php"); //Inicio de las Bibliotecas
      		  }
      		  if($_SESSION["tipo"] == 'B'){
      		      
                    header("Location: ../demo/inicio-ofi.php");  //Inicio de las Oficinas
      		  }
      		  if($_SESSION["tipo"] == 'C'){
      
                    header("Location: ../demo/inicioc.php");
      		  }
                if($_SESSION["tipo"] == 'D'){
                  
                    header("Location: ../demo/inicio-osi.php");
      		  }
    	   }else{
        
            echo '<script language="javascript">
    				alert("Password incorrecto");
    				location.href = "login.php";
    			  </script>';
	       }
	       
	   }else{
	       
           echo '<script language="javascript">
    				alert("El usuario a sido desactivado");
    				location.href = "login.php";
    			  </script>';
	   }
       
       
    }else{
	   
       echo '<script language="javascript">
				alert("Usuario no registrado");
				location.href = "login.php";
			  </script>';
	}
	mysqli_free_result($result);
}else{
    
	echo '<script language="javascript">
				alert("No ha ingresado los datos");
				location.href = "login.php";
			  </script>';
}

mysqli_close($link);

?>
