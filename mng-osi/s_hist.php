<?php
	include('../up-osi.php');
	include('../reg-osi/MLwebservice.php');
?>

        <div id="submenu">
            <a href="s_hist.php">Buscar Historial</a>
            <a href="s_mor.php">Mostrar Morosos</a>
            <a href="s_usu.php">Usuarios</a>
            <a href="s_ava.php">Busqueda Avanzada</a>
        </div>
        <!-- FIN MENU -->
	    <div id="cuerpo">
			<div id="titulo">
				<dir id="tituloin">
					<a>Buscar Historial</a>
				</dir>
			</div>
			
			
						<!-- Formulario para busqueda de alumno por codigo-->
			<fieldset>
                <form action="s_hist.php" method="GET">	
					<div id="madre">
						<div id="izquierda"><a>Codigo:</a><br /></div>					
						<div id="derecha"><input class="campo" type="text" name="codigo" value="" />
						  <input type="submit" value="Buscar" name="registrar" class="aceptar" />
                        </div>	
						
					</div>										
				</form>
			</fieldset>
            
            <!-- Aqui colocaremos todos los Datos del Alumno-->
        <?php
            if($_GET){

                echo '<fieldset>
                        <legend>
                            <a>Datos de la Busqueda</a>
                        </legend>';
                        
                include('../conexion/conexion.php');
                $link = Conectarse();

// Cambios de ML 
$sql = "select count(est_codigo) as cont from estudiante where est_codigo='".$_GET['codigo']."';";
$rs = mysqli_query($link,$sql); 

$rw = mysqli_fetch_array($rs);                    
$cnt = $rw['cont'];

if($cnt == 0){	
	$alumno = wserv_alumno($_GET['codigo']);	
	
	if($alumno['per_sexo'] == 0 || $alumno['per_sexo'] == 'F' ){
		$alumno['per_sexo'] = 'F';
	}else{
		$alumno['per_sexo'] = 'M';
	}

	switch ($alumno['escuela']) { 
		case 'ADMINISTRACION':
		$escuela = 'esc_admin';
		break;
		case 'INGENIERIA AGRICOLA':
		$escuela = 'esc_agrico';
		break;
		case 'INGENIERIA AGROINDUSTRIAL':
		$escuela = 'esc_agroin';
		break;
		case 'AGRONOMIA':
		$escuela = 'esc_agron';
		break;
		case 'INGENIERIA AMBIENTAL':
		$escuela = 'esc_ambi';
		break;
		case 'ANTROPOLOGIA ':
		$escuela = 'esc_antro';
		break;
		case 'ARQUEOLOGIA':
		$escuela = 'esc_arqu';
		break;
		case 'ARQUITECTURA Y URBANISMO':
		$escuela = 'esc_arqurb';
		break;
		case 'CIENCIAS BIOLOGICAS':
		$escuela = 'esc_biol';
		break;
		case 'CIENCIAS DE LA COMUNICACION':
		$escuela = 'esc_cccc';
		break;
		case 'INGENIERIA CIVIL':
		$escuela = 'esc_civil';
		break;
		case 'CONTABILIDAD Y FINANZAS':
		$escuela = 'esc_conta';
		break;
		case 'DERECHO Y CIENCIAS POLITICAS':
		$escuela = 'esc_dere';
		break;
		case 'ECONOMIA':
		$escuela = 'esc_econ';
		break;
		case 'ENFERMERIA': 
		$escuela = 'esc_enfer';
		break;
		case 'ESTADISTICA':
		$escuela = 'esc_esta';
		break;
		case 'ESTOMATOLOGIA':
		$escuela = 'esc_esto';
		break;
		case 'FARMACIA Y BIOQUIMICA':
		$escuela = 'esc_farm';
		break;
		case 'FISICA':
		$escuela = 'esc_fisi';
		break;
		case 'HISTORIA':
		$escuela = 'esc_histo';
		break;
		case 'INGENIERIA INDUSTRIAL':
		$escuela = 'esc_indu';
		break;
		case 'INFORMATICA':
		$escuela = 'esc_info';
		break;
		case 'INGENIERIA DE MATERIALES':
		$escuela = 'esc_ingmat';
		break;
		case 'INGENIERIA QUIMICA':
		$escuela = 'esc_ingquim';
		break;
		case 'EDUCACION INICIAL':
		$escuela = 'esc_inic';
		break;
		case 'MATEMATICAS':
		$escuela = 'esc_mate';
		break;
		case 'INGENIERIA MECANICA':
		$escuela = 'esc_meca';
		break;
		case 'INGENIERIA MECATRONICA':
		$escuela = 'esc_mecatro';
		break;
		case 'MEDICINA':
		$escuela = 'esc_med';
		break;
		case 'INGENIERIA METALURGICA':
		$escuela = 'esc_meta';
		break;
		case 'MICROBIOLOGIA Y PARASITOLOGIA':
		$escuela = 'esc_micro';
		break;
		case 'INGENIERIA DE MINAS':
		$escuela = 'esc_mina';
		break;
		case 'BIOLOGIA PESQUERA':
		$escuela = 'esc_pesq';
		break;
		case 'CIENCIA POLITICA Y GOBERNABILIDAD':
		$escuela = 'esc_polgob';
		break;
		case 'CIENCIAS POLITICAS Y GOBERNABILIDAD':
		$escuela = 'esc_polgob';
		break;
		case 'POSTGRADO':
		$escuela = 'esc_post';
		break;
		case 'EDUCACION PRIMARIA':
		$escuela = 'esc_prim';
		break;
		case 'EDUCACION SECUNDARIA':
		$escuela = 'esc_sec';
		break;
		case 'EDUCACION  SECUNDARIA -  CIENCIAS DE LA MATEMATICA':
		$escuela = 'esc_sec_ccmm';
		break;
		case 'ESC. EDUC. SEC: ESP. CIENCIAS MATEMATICAS':
		$escuela = 'esc_sec_ccmm';
		break;
		case 'ESC. EDUC. SEC. ESP. FISICA, QUIMICA Y BIOLOGIA':
		$escuela = 'esc_sec_cnfqb';
		break;
		case 'ESC. EDUC. SEC. ESP. FILOSOFIA, PSICOLOGIA Y CC. SOCIALES':
		$escuela = 'esc_sec_fpcs';
		break;
		case 'EDUCACION  SECUNDARIA -  HISTORIA Y GEOGRAFIA':
		$escuela = 'esc_sec_hyg';
		break;
		case 'EDUCACION  SECUNDARIA -  IDIOMAS':
		$escuela = 'esc_sec_idio';
		break;
		case 'EDUCACION  SECUNDARIA -  LENGUA Y LITERATURA': 
		$escuela = 'esc_sec_lyl';
		break;
		case 'INGENIERIA DE SISTEMAS':
		$escuela = 'esc_siste';
		break;
		case 'TRABAJO SOCIAL':
		$escuela = 'esc_trasoc';
		break;
		case 'TURISMO':
		$escuela = 'esc_turis';
		break;
		case 'ZOOTECNIA':
		$escuela = 'esc_zoo';
		break;
	}   

	switch ($alumno['sed_nombre']) { 
		case "TRUJILLO":                                            
			$idsede = 1;
			break;
		case "VALLE JEQUETEPEQUE":   
			$idsede = 2;
			break;
		case "HUAMACHUCO": 
			$idsede = 4;
			break;
		case "SGTO. DE CHUCO":     
			$idsede = 6;
			break;
		case "SANTIAGO DE CHUCO": 
			$idsede = 6;
			break;
	} 
	
	$sql = "INSERT INTO estudiante (est_codigo, est_nombres, est_apellidos, est_escuela, est_sexo, est_domicilio, est_sede, est_estado)
					VALUES
					('".$_GET['codigo']."',
					 '".$alumno['per_nombres']."',
					 '".$alumno['per_apellidos']."',
					 '".$escuela."',
					 '".$alumno['per_sexo']."',
					 '".$alumno['per_direccion']."',
					 '".$idsede."',
                     1); ";	
	//echo 'SEDE '.$alumno['sed_nombre'];					 
	mysqli_query($link,$sql) or die("Error al momento de insertar el Estudiante "); 					 	
}


// Cambios de ML -- FIN
				
				$sql  = "SELECT COUNT(d.det_estado) AS cuenta FROM estudiante e ";
                $sql .= "INNER JOIN detalle_deuda d ON d.det_id_alumno = e.id_estudiante ";
                $sql .= "WHERE d.det_estado = 'P' AND e.est_codigo like '".$_GET['codigo']."'; ";
	
			  	$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
                
                if($row3 = mysqli_fetch_array($result,MYSQLI_BOTH)){
                    
                    $bandera = $row3['cuenta'];
                    
					//Pregunto si bandera es diferente de cero entonces tiene deuda
					if($bandera != 0){
					   $arreglo[0][1] = "Moroso"; 
                       echo '<div id="situacion2"><a>Moroso</a></div>';
                    }							
					else{ 
					   $arreglo[0][1] = "No Debe"; 
                       echo '<div id="situacion3"><a>No debe</a></div>'; 
                    }							
													
					//Obtenemos los datos de nuestro alumno:
					$sql  = "SELECT e.est_nombres, e.est_apellidos, e.est_sexo, e.est_domicilio, ";
                    $sql .= "es.esc_nombre AS escuela, f.fac_nombre AS facultad ";
                    $sql .= "FROM estudiante e ";
                    $sql .= "INNER JOIN escuela es ON e.est_escuela = es.id_escuela ";
                    $sql .= "INNER JOIN facultad f ON es.esc_facultad = f.id_facultad ";
                    $sql .= "WHERE e.est_codigo like '".$_GET['codigo']."';";
                    	
				  	$result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
						  
					$row2 = mysqli_fetch_array($result2);
						
					//LLenamos los datos del alumno
					$datos[0] = $_GET['codigo'];
					$datos[1] = $row2["est_nombres"];
					$datos[2] = $row2["est_apellidos"];
					$datos[3] = $row2["est_sexo"];
					$datos[4] = $row2["est_domicilio"];
					$datos[5] = $row2["escuela"];
					$datos[6] = $row2["facultad"];
						
					$_SESSION["alum-datos"] = $datos;
						
					echo '
					<div id="madreb">
						<div id="izquierdab"><a>Codigo:</a><br></div>					
						<div id="derechab">'.$_GET['codigo'].'<br></div>		
					</div>
					<div id="madreb">
						<div id="izquierdab"><a>Nombres:</a><br></div>					
						<div id="derechab">'.$row2["est_nombres"].'<br></div>		
					</div>	
					<div id="madreb">
						<div id="izquierdab"><a>Apellidos:</a><br></div>					
						<div id="derechab">'.$row2["est_apellidos"].'<br></div>		
					</div>	
					<div id="madreb">
						<div id="izquierdab"><a>Sexo:</a><br></div>					
						<div id="derechab">'.$row2["est_sexo"].'<br></div>		
					</div>	
					<div id="madreb">
						<div id="izquierdab"><a>Domicilio:</a><br></div>					
						<div id="derechab">'.$row2["est_domicilio"].'<br></div>		
					</div>	
					<div id="madreb">
						<div id="izquierdab"><a>Escuela:</a><br></div>					
						<div id="derechab">'.$row2["escuela"].'<br></div>		
					</div>
					<div id="madrebfinal">
						<div id="izquierdab"><a>Facultad:</a><br></div>					
						<div id="derechab">'.$row2["facultad"].'<br></div>		
					</div>																																			
					';							
						
					echo 
					'<table border=1 cellspacing=0 cellpadding=2 >
						<tr class="celda">
							<td class="">N&deg;</td>
							<td class="">Codigo del Bien</td>
							<td class="">Responsable</td>
							<td class="">Oficina</td>
							<td class="">Detalles</td>
							<td class="">Situaci&oacute;n</td>
                        </tr>';
							
							
					echo '<script>
							function preguntar(id,codigo,situacion){
							 
							     var actualizar = confirm("Desea cambiar estado?");
							     if(actualizar){       
								    location.href = "des_mor_change_status.php?id="+id+"&codigo="+codigo+"&estado="+situacion;
                                 }							 
							}

							function launch(newURL, newName, newFeatures, orgName){
	                           
                               var remote = open(newURL, newName, newFeatures);
							   if (remote.opener == null)
  	                                 remote.opener = window;
				  	           remote.opener.name = orgName;
							   return remote;
							}
								
							function launchRemote(id){
						      
                               alto = 350;
							   ancho = 450;								
							   var posicion_x; 
							   var posicion_y; 
							   posicion_x=(screen.width/2)-(ancho/2); 
							   posicion_y=(screen.height/2)-(alto/2); 									
											
							   myRemote = launch("../common/book_data.php?id="+id, 
							            		"myRemote",		 
												"height="+alto+","+
												"width="+ancho+","+
												"channelmode=0,"+
												"dependent=0,"+
												"directories=1,"+
												"fullscreen=0,"+
												"location=1,"+
												"menubar=0,"+
												"resizable=0,"+
												"scrollbars=0,"+
												"status=0,"+
												"toolbar=0,"+
												"left="+posicion_x+","+
												"top="+posicion_y,
												"myWindow");
							}									
							</script>'
							;																				
				  	$contador = 1;
                      
                    $sql  = "SELECT d.det_fecha_prestamo, d.det_estado, d.id_detalle_deuda, l.id_libro, l.lib_codigo, ";
                    $sql .= "l.lib_numero, l.lib_titulo, l.lib_autor, l.lib_fuente, ";
                    $sql .= "u.usu_nombres, u.usu_apellidos, u.usu_oficina, o.ofi_nombre ";
                    $sql .= "FROM estudiante e ";
                    $sql .= "INNER JOIN detalle_deuda d ON d.det_id_alumno = e.id_estudiante ";
                    $sql .= "INNER JOIN libro l ON d.det_cod_libro = l.id_libro ";
                    $sql .= "INNER JOIN usuario u ON d.det_usuario = u.id_usuario ";
                    $sql .= "INNER JOIN oficina o ON u.usu_oficina = o.id_oficina ";
                    $sql .= "WHERE e.est_estado = 1 AND "; 
                    $sql .= "e.est_codigo = '".$_GET['codigo']."'; ";

                    $result = mysqli_query($link,$sql) or die("Error en consulta 1");  
                    
                    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
                        
                        //Llenamos la variable de session
								
						$_SESSION["total_res"] = $contador;
		
						$arreglo[$contador][1] = $row["lib_codigo"];
						$arreglo[$contador][2] = $row["usu_apellidos"]." ".$row["usu_nombres"];
						$arreglo[$contador][3] = $row["usu_oficina"];								
						$arreglo[$contador][5] = $row["id_libro"];
								
						echo '<tr>
						    	<td>'.$contador++.'</td>	
						      	<td>'.$row["lib_codigo"].'</td>
								<td>'.$row["usu_apellidos"]." ".$row["usu_nombres"].'</td>
								<td>'.$row["ofi_nombre"].'</td>
								<td><a href="javascript:launchRemote(\''.$row["id_libro"].'\')">Detalle del Bien</a></td>';
										
								if($row["det_estado"] == 'P'){  //Veremos si devolvio el libro
                                    $arreglo[$contador][4] = "Debe";
									echo '<td>Debe</td>';
								}
								else{
									$arreglo[$contador][4] = "Devolvio";
									echo '<td>Devolvio</td>';
								}
												
						echo '</tr>';
                        
                    }									
                    echo '</table>';
                    
                    $_SESSION["resultados"] = $arreglo;	
						
					include('../fecha_hora/date.php');					
			
			 }
			 else{
			     echo '<div id="situacion"><a>No Existe el Estudiante</a></div>';						
			 }

             echo '</fieldset>';
            }    
            ?>
            


<?php

	include('../down.php');

?>