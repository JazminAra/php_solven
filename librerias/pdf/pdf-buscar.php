<?php
	
	// Mis variables de Session
	session_start();
	
	if (isset($_SESSION['k_username'])) 
	{
		
		if($_SESSION["tipo"] == 'B')
		{
			$arreglo = $_SESSION["resultados"];
			$datos = $_SESSION["alum-datos"];

			$membrete = $_SESSION["ficha"][0];
			$membrete.= " ".$_SESSION["ficha"][1];
			$membrete.= ", ".$_SESSION["ficha"][2]."\n";	
			$membrete.= "Jefe del Sistema de Bibliotecas";
			
			$titulo2 = $_SESSION["ficha"][3]."\n\n\n";
			
			
			// AQUI LLAMO A LA EXTENSION DEL PDF	
			include ('class.ezpdf.php');
			$pdf =& new Cezpdf('A4');
			$pdf->ezSetCmMargins(1,1,1.5,1.5);
			$pdf->selectFont('./fonts/Helvetica.afm');
			
			$conjunto = array();
			
			//LLENADO DE LA SITUACION DEL ALUMNO
			
			$titulo = "<b>Solvencia Bibliotecas - UNT</b>";
			
			$situacion = $arreglo[0][1]."\n";
			
			//LLENADO DE LA TABLA DE DATOS
		
			$cad = array(
				array("Codigo" 		, $datos[0]), 
				array("Nombres" 	, $datos[1]), 
				array("Apellidos" 	, $datos[2]), 
				array("Sexo" 		, $datos[3]), 
				array("Domicilio" 	, $datos[4]),
				array("Escuela" 	, $datos[5]),
				array("Domicilio" 	, $datos[6])				 					   				   
						 );
			
			$options = array(
						'shadeCol'=>array(0.9,0.9,0.7),
						'xOrientation'=>'center',
						'width'=>300,
						'fontSize' => 12,
						'showHeadings'=>0,				
						'showLines'=>1
							);	
							
			$option_situacion = array(
						'justification' => 'center',
							);	
			
			
			
			
			/********************* Redaccion del documento **********************/
			
			$pdf->ezText($titulo, 15, $option_situacion);
			$pdf->ezText($titulo2, 10, $option_situacion);
			
			$pdf->ezText($situacion, 18, $option_situacion);
			
			//Reporte del Alumno (tabla)
			
			$pdf->ezTable($cad, '', '', $options);
			$pdf->ezText("\n\n\n", 10);
			
			//Fecha y Hora
			
			$fecha = $_SESSION["date"]; 
			$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y",$fecha)."                             ".
						 "<b>Hora:</b> ".date("H:i:s", $fecha)."\n\n\n\n\n\n", 12);
			
			// Firma
			$pdf->ezText("----------------------------------------------------------- ", 12 ,$option_situacion);
			$pdf->ezText($membrete, 10, $option_situacion);				
			
			
		}
		else
		{
			$pdf->ezText("No tiene acceso a este contenido", 15);
		}
	
	}
	else
	{
		$pdf->ezText("No tiene acceso a este contenido", 15);
	}
	
	$pdf->ezStream();
	

?>

