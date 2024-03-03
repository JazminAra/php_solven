<?php
	
	// Mis variables de Session
   
	session_start();
	date_default_timezone_set("America/Lima");
	//-----------------------------------------------------
	/*
	echo '<pre>';
	echo $_SESSION['ficha'][0]; 
	echo $_SESSION['ficha'][1]; 
	echo $_SESSION['ficha'][2]; 
	print_r($_SESSION);
	echo '</pre>';
	*/
    //-----------------------------------------------------


	$fecha = $_SESSION["date"];   

	// AQUI LLAMO A LA EXTENSION DEL PDF	
	 include ('class.ezpdf.php');
         $pdf = new Cezpdf('A4');
         $pdf->ezSetCmMargins(2.5,1,2.5,2.5);
         $pdf->selectFont('./fonts/Helvetica.afm');

//	include ('class.ezpdf.php');
//	$pdf =& new Cezpdf('A4');
//	$pdf->ezSetCmMargins(2.5,1,2.5,2.5);
//	$pdf->selectFont('./fonts/Helvetica.afm');

	
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
                
    $center = array(
	           		'justification' => 'center'
				); 
				
	$right = array(
	           		'justification' => 'right'
				);                  
	
	$pdf->addJpegFromFile("../../imagenes/logo_unt.jpg",430,710,110);

	$pdf->addJpegFromFile("../../imagenes/pdf/fondo.jpg",30,260,550);

	//Colocar el codigo QR ---------------------------------------------------------------------------
	require('../phpqrcode/qrlib.php');

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

    $PNG_WEB_DIR = 'temp/';

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
               
    $filename = $PNG_TEMP_DIR.'test.png';


    //VALORES PARA GENERAR LA IMGEN QR
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 3;
    $url = date("YmdHis");

    // creo la imagen
    $filename = $PNG_TEMP_DIR.'test'.md5($url.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.jpg';
    QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 1);

    $pdf->addPngFromFile($filename,70,120,100);

	//------------------------------------------------------------------------------------------------


	//$pdf->ezImage("../../imagenes/logo_unt.jpg", 20, 100, 'none', 'right');
	
	$pdf->ezText("Universidad Nacional de Trujillo\n", 14, $center);
	$pdf->ezText("<u>CERTIFICADO DE NO ADEUDO</u>\n\n\n", 18, $center);    
    
    //$pdf->ezText("Otorgado a:       <b>".$_SESSION['names']."</b> \n", 14);
    $pdf->ezText(utf8_decode("Otorgado a:       <b>".$_SESSION['names']."</b> \n"), 14);
    
    $pdf->ezText(utf8_decode("Código de Estudiante:     <b>".$_SESSION['cod']."</b> \n"), 14);
    $pdf->ezText("Bachiller(  )           Titulo(  )            Duplicado(  )            Otros(  )_____________ \n", 12, $demo);
    $pdf->ezText("Facultad:    <b>".$_SESSION['facu']."</b> \n", 14);
	if(strlen($_SESSION['cod'])==8)
		$pdf->ezText("PREFORD: <b>".$_SESSION['escu']."</b> \n\n", 14);
    else
		$pdf->ezText(utf8_decode("Escuela Académica Profesional:    <b>".$_SESSION['escu']."</b> \n\n"), 14);
    
    //$pdf->setColor(1,0,1,0);
	
//	$pdf->ezText("Fecha:<b> ".date("d/m/Y",$fecha)."</b>     Hora:<b> ".date("H:i:s", $fecha)."</b>\n\n\n\n\n\n\n\n\n\n\n\n\n", 14);
	

        $pdf->ezText("Fecha:<b> ".date("d/m/Y",$fecha)."</b>     Hora:<b> ".date("H:i:s", $fecha)."</b>\n\n\n\n\n\n\n\n\n\n\n\n\n", 14);



	$pdf->ezText("________________________________________", 14, $center);
	$pdf->ezText(utf8_decode($_SESSION['ficha'][0])." ".utf8_decode($_SESSION['ficha'][1])." ".utf8_decode($_SESSION['ficha'][2]), 12, $center);
	$pdf->ezText("\n\n\n\n\n\n\n\n", 14, $right);
	
	$pdf->ezText(utf8_decode("Nota: Hoja Técnica para tramitar Grados, Títulos y otros, tendrá validez técnicamente por <b>15 DÍAS HÁBILES</b> a partir de su expedición."), 10);
	
//	$pdf->addJpegFromFile("../../imagenes/inicio.jpg", 50, 50);
	
	ob_end_clean();
	$pdf->ezStream();


	
?>
