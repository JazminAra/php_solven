<?php
	include('../up-bib.php');
?>
<meta charset="UTF-8">
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
