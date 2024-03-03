<?php

	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{
		if($_SESSION["tipo"] == 'D')
		{
            if($_POST['editor']){
                
                include('../conexion/conexion.php');
                $link = Conectarse();
                
                $_sql = "INSERT INTO mensaje(msn_cuerpo, msn_estado, msn_fecha) VALUES ('".$_POST['editor']."',1,NOW())";
                mysqli_query($link,$_sql);
               
                header("Location: ../reg-osi/?stream=msn");
            }      
   		}else{
			echo '<script language="javascript">
				alert("No tiene acceso a este sitio..!!");
				location.href = "../perfiles/logout.php";
				</script>;';			
		}
	}else{
		echo '<script language="javascript">
			alert("No ha iniciado Sesion");
			location.href = "../index.php";
			</script>;';
	}
	
?>
