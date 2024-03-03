<?php
	
	// Mis variables de Session
	session_start();
	$arreglo = $_SESSION["resultados"];
	$fecha = $_SESSION["date"];

	// AQUI LLAMO A LA EXTENSION DEL PDF	
	include ('class.ezpdf.php');
	$pdf =& new Cezpdf('A4');
	$pdf->ezSetCmMargins(1,1,1.5,1.5);
	$pdf->selectFont('./fonts/Helvetica.afm');

	
	$conjunto = array();
	
	for( $i=1; $i<=$_SESSION["total_res"]; $i++)
	{
		$array = array( $i, 
						$arreglo[$i][1], 
						$arreglo[$i][2], 
						$arreglo[$i][3]);
		array_push($conjunto, $array);
	}
	
	
	$titles = array(
					'<b>Numero</b>',
					'<b>Codigo</b>',
					'<b>Apellidos y Nombres</b>',
					'<b>Fecha y Hora</b>'
				);
	$options = array(
					'shadeCol'=>array(0.9,0.9,0.7),
					'xOrientation'=>'center',
					'width'=>450,					
					'fontSize' => 8
				);	
	

	$txttit = "<b>Solvencia Biblioteca - UNT</b>\n";
	$txttit.= "Reporte de Alumnos con con Solvencia Emitida \n";

	$pdf->ezText($txttit, 12);
	
	$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y",$fecha)."     <b>Hora:</b> ".date("H:i:s", $fecha)."\n", 10);
	$pdf->ezText("Total de Alumnos ".$_SESSION["total_res"]."\n\n", 10);
	
	
	$pdf->ezTable($conjunto, $titles, '', $options);

	$pdf->ezStream();
	
?>
