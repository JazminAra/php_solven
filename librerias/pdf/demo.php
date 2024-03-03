

<?php


	session_start();

	$arreglo = $_SESSION["resultados"];
	
	$datos = $_SESSION["alum-datos"];
	
	echo $_SESSION["total_res"].'<br><br>';
	
	for( $i=1; $i<= $_SESSION["total_res"]; $i++)
	{
		echo $i.'<br>';
		echo $arreglo[$i][1].'<br>';
		echo $arreglo[$i][2].'<br>';
		echo $arreglo[$i][3].'<br><br>';
	}

?>