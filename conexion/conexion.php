<?php

	function Conectarse()
	{
		$db_host="localhost"; 
		$db_nombre="bdsol"; 
		$db_user="root"; 
		$db_pass="";
		 
		$link=mysqli_connect($db_host, $db_user, $db_pass) or die ("Error conectando a la base de datos.");
		mysqli_set_charset($link,"utf8");
		mysqli_select_db($link,$db_nombre) or die("Error seleccionando la base de datos."); 
		return $link;
	}

?>
