<?php
	include('../up-bib.php');
?>
<meta charset="utf-8">
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
					<a>Mostrar Morosos</a>
				</dir>
			</div>
            
			<!-- FORMULARIO PARA HACER LA BUSQUEDA DE LOS MOROSOS -->
			<fieldset>
			     <form action="s_mor.php" method="POST">
					<div id="reportame">
						<div id="rep_izq">								
							<select name="opcion" class="rcombo" id="combo1" onchange="SeleccionandoCombo(this, 'combo2');">
								<option value="">Elige una Opcion</option>
								<option value="opcion1">Escuela</option>
								<option value="opcion2">Facultad</option>
								<option value="opcion3">Biblioteca</option>
							</select><br />								
						</div>
						<div id="rep_der">
						<select style="float:left;" id="combo2" name="primero" class="rcombo2"></select>																			
						</div>
                         <div id="tiempo_der">									
							<a>Ingresar Fecha</a>
							<input type="checkbox" name="habilitar" id="habilitar" />
							<br />
							<div id="rep_der2">
								<a>Desde: </a>
								<input type="text" name="datepicker" class="campotiempo2" id="datepicker" readonly="readonly" />																				
								<br /><br />
								<a>Hasta: </a>
								<input type="text" name="datepicker2" class="campotiempo2" id="datepicker2" readonly="readonly" />
							</div>								
						</div>						
					</div>
	
					<!-- Script para ocultar la capa de las fechas -->
			

 <script src="javascript/jquery.js"> </script>
 <script src="javascript/javascript.js"> </script>
 <script src="javascript/jquery.mins.js" > </script>
 <script src="javascript/jquery-ui-es.js"> </script>
 <script src="javascript/jquery-ui.min.js"> </script> 
				
			<script  type="text/javascript">
						$(document).ready(function(){
					  		  $("#habilitar").click(function(evento){
					       	      if ($("#habilitar").attr("checked")){
							         $("#rep_der2").css("display", "block");
							      }else{
									 $("#rep_der2").css("display", "none");
					           }
								   });
								});									
					</script>
                    
                    <!-- Aqui cargamos los codigos JavaScript -->
				
					
		<script  type="text/javascript">
					function LimpiarCombo(combo){
						while(combo.length > 0){
							combo.remove(combo.length-1);
						}
					}
					function LlenarCombo(json, combo){
						//combo.options[0] = new Option('Selecciona un Item', '');
						for(var i=0;i<json.length;i++){
							combo.options[combo.length] = new Option(json[i].data, json[i].id);
						}
					}
					function SeleccionandoCombo(combo1, combo2){
						combo2 = document.getElementById(combo2); //con jquery: $("#"+combo2)[0];
						LimpiarCombo(combo2);
						//LimpiarCombo(combo3);
						if(combo1.options[combo1.selectedIndex].value != ""){
							combo1.disabled = true;
							combo2.disabled = true;
							$.ajax({
								type: 'get',
								dataType: 'json',
								url: 's_mor_ajax.php',
								data: {valor: combo1.options[combo1.selectedIndex].value},
								success: function(json){
									LlenarCombo(json, combo2);
									combo1.disabled = false;
									combo2.disabled = false;
								}
							});
						}
						else
						{
							combo2.disabled = true;
						}
					}
					</script>					
					
					<!-- Cerramos los codigos JavaScript -->					
							
					<!-- ------------------------------------------------>

			</fieldset>

            <!--  Capa para el boton buscar -->
			<div id="capaboton">
				<div id="capabotonhija">
					<input type="submit" value="Buscar" class="aceptar" >							
				</div>			
			</div>					
        </form>
        
        <!-- Reporte de la seleccion si hubieramos seleccionado alguna de los select --> 
        <?php
			if($_POST){
			 echo '<fieldset>
			         <legend>
						<a>Resultados de la Busqueda</a>	
					</legend>';	
							
			include('../conexion/conexion.php');
			$link = Conectarse();
							
														
			/*************SI SELECCIONO LA ESCUELA ES LA OPCION 1******************/
							
			switch($_POST['opcion']){

			// -------------------------------CASE 1--------------------------------------
			
    		case 'opcion1':
																									
	                       	echo 
								'<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
									<tr class="celda">
										<td class="">N&deg;</td>
										<td class="">Codigo Estudiante</td>
										<td class="">Apellidos y Nombres</td>
										<td class="">Titulo del Libro</td>
										<td class="">Biblioteca</td>
										<td class="">Escuela</td>
									</tr>';	
																							
							if(!empty($_POST["primero"])){ //pregunto si ha seleccionado algun dato
						         $array = $_POST["primero"];
			                     $contador = 1;
			                     $_SESSION["total_res"] = 0;
 								 
								 $sql = "SELECT es.esc_nombre, e.est_codigo, e.est_apellidos, e.est_nombres, ";
								 $sql .= "o.ofi_nombre, LEFT(l.lib_titulo, 30) AS titulo, d.det_estado ";
								 $sql .= "FROM escuela es ";
								 $sql .= "INNER JOIN estudiante e ON es.id_escuela = e.est_escuela ";
								 $sql .= "INNER JOIN detalle_deuda d ON e.id_estudiante = d.det_id_alumno ";
								 $sql .= "INNER JOIN usuario u ON d.det_usuario = u.id_usuario ";
								 $sql .= "INNER JOIN oficina o ON u.usu_oficina = o.id_oficina ";
								 $sql .= "INNER JOIN libro l ON d.det_cod_libro = l.id_libro ";
								 $sql .= "WHERE d.det_estado = 'P' AND ";
								 $sql .= "e.est_estado = 1 AND ";
								 $sql .= "es.id_escuela =  '".$array."' ORDER BY est_apellidos; "; 
	
								 $result = mysqli_query($link,$sql) or die("Error Aqui");
								 $variable = array();  
												
								 while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
								    
                                    //lleno mi temporal de sesion reportes	
												
									$_SESSION["total_res"] = $contador;		
														
									$arreglo[$contador][1] = $row["est_codigo"];
                                    $arreglo[$contador][2] = $row["est_apellidos"]." ".$row["est_nombres"];
									$arreglo[$contador][3] = $row["titulo"];
									$arreglo[$contador][4] = $row["ofi_nombre"];
									$arreglo[$contador][5] = $row["esc_nombre"];
																									
									echo
                                      '<tr class="puntero">
									 	 <td>'.$contador++.'</td>
										 <td>'.$row["est_codigo"].'</td>
										 <td class="alinear_izquierda">'.strtoupper($row["est_apellidos"]." ".$row["est_nombres"]).'</td>
										 <td class="alinear_izquierda">'.strtoupper($row["titulo"]).'</td>
										 <td>'.$row["ofi_nombre"].'</td>
										 <td>'.$row["esc_nombre"].'</td>
										</tr>';
													
									$_SESSION["resultados"] = $arreglo; 
                                 }//fin del while				
								 include('../fecha_hora/date.php');
																												
	                       }//fin if - de la pregunta si escogio algo del select
	                       else{
	                           echo
								  '<tr class="puntero">
								      <td class=""><a><i>vacio</i></a></td>
							          <td class=""><a><i>vacio</i></a></td>
							          <td class=""><a><i>vacio</i></a></td>
								      <td class=""><a><i>vacio</i></a></td>
									  <td class=""><a><i>vacio</i></a></td>
									  <td class=""><a><i>vacio</i></a></td>
								  </tr>';
												
								$_SESSION["total_res"] = 0;												
												
							     echo '<div id="situacion"><a>Seleccione una o mas Escuelas</a></div>';
	                       }
									
						   /********** Agregamos la copa de indicadores ***************/
						  ?>
									
									
	                       <div id="indicadores">
						      	<a style="font-size: 13px;">Total de Alumnos: <b> <?php  echo $_SESSION["total_res"]; ?></b></a>
	                       </div>
			
 						<?php
									
							echo 
	          					'</table>
																	
			     					<form action="../librerias/pdf/pdf.php" method="POST" target="_blank">
										<div id="capaboton">
											<div id="capabotonhija">
												<input type="submit" value="Convertir PDF" class="aceptar" >
											</div>
										</div>
									</form>';
										
							 break;
									
							/******* Fin del case opcion1 ESCUELA *******/
									
									
            // -------------------------------CASE 2---------------------------------------	
			case 'opcion2':
							echo 
								'<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
									<tr class="celda">
										<td class="">N&deg;</td>
										<td class="">Codigo Estudiante</td>
										<td class="">Apellidos y Nombres</td>
										<td class="">Titulo del Libro</td>
										<td class="">Biblioteca</td>
										<td class="">Escuela</td>
									</tr>';	
																							
							if(!empty($_POST["primero"])){ //pregunto si ha seleccionado algun dato
							
							     $array = $_POST["primero"];
								 $contador = 1;
								 $_SESSION["total_res"] = 0;
                                        
                                 $sql = "SELECT es.esc_nombre, e.est_codigo, e.est_apellidos, e.est_nombres, ";
								 $sql .= "o.ofi_nombre, LEFT(l.lib_titulo, 30) AS titulo, d.det_estado ";
								 $sql .= "FROM escuela es ";
								 $sql .= "INNER JOIN estudiante e ON es.id_escuela = e.est_escuela ";
								 $sql .= "INNER JOIN detalle_deuda d ON e.id_estudiante = d.det_id_alumno ";
								 $sql .= "INNER JOIN usuario u ON d.det_usuario = u.id_usuario ";
								 $sql .= "INNER JOIN oficina o ON u.usu_oficina = o.id_oficina ";
								 $sql .= "INNER JOIN libro l ON d.det_cod_libro = l.id_libro ";
								 $sql .= "WHERE d.det_estado = 'P' AND ";
								 $sql .= "e.est_estado = 1 AND ";
								 $sql .= "es.esc_facultad =  '".$array."' ORDER BY est_apellidos ; "; 
                                        
                                 $result = mysqli_query($link,$sql) or die("Error");
												
								 while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){		
									//lleno mi temporal de sesion reportes	
													
									$_SESSION["total_res"] = $contador;		
													
									$arreglo[$contador][1] = $row["est_codigo"];
									$arreglo[$contador][2] = $row["est_apellidos"]." ".$row["est_nombres"];
									$arreglo[$contador][3] = $row["titulo"];
									$arreglo[$contador][4] = $row["ofi_nombre"];
									$arreglo[$contador][5] = $row["esc_nombre"];
											
									echo
									   '<tr class="puntero">
									       	<td>'.$contador++.'</td>
											<td>'.$row["est_codigo"].'</td>
											<td class="alinear_izquierda">'.strtoupper($row["est_apellidos"]." ".$row["est_nombres"]).'</td>
											<td class="alinear_izquierda">'.strtoupper($row["titulo"]).'</td>
											<td>'.$row["ofi_nombre"].'</td>
											<td>'.$row["esc_nombre"].'</td>
										</tr>';
												
									$_SESSION["resultados"] = $arreglo; 
												
							     }//fin del while				
                                            
								 include('../fecha_hora/date.php');
										
				             }//fin if - de la pregunta si escogio algo del select
							else{
							     echo
								    '<tr>
										<td class=""><a><i>vacio</i></a></td>
										<td class=""><a><i>vacio</i></a></td>
										<td class=""><a><i>vacio</i></a></td>
										<td class=""><a><i>vacio</i></a></td>
										<td class=""><a><i>vacio</i></a></td>
										<td class=""><a><i>vacio</i></a></td>
									</tr>';
												
							     $_SESSION["total_res"] = 0;													
												
								 echo '<div id="situacion"><a>Seleccione una o mas Facultades</a></div>';
							}
									
							/********** Agregamos la copa de indicadores ***************/
							?>
							<div id="indicadores">
								<a style="font-size: 13px;">Total de Alumnos: <b> <?php  echo $_SESSION["total_res"]; ?></b></a>
							</div>
									
									
							<?php
								echo 
									'</table>	
									<form action="../librerias/pdf/pdf.php" method="POST" target="_blank">
										<div id="capaboton">
											<div id="capabotonhija">
												<input type="submit" value="Convertir PDF" class="aceptar" >
											</div>
										</div>
									</form>';
										
									break;
									
								/******* Fin del case opcion2 FACULTAD *******/
									
								
								
            // -------------------------------CASE 3-------------------------------------
							
			case 'opcion3':																							
                            echo 
			                     '<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
									<tr class="celda">
										<td class="">N&deg;</td>
										<td class="">Codigo Estudiante</td>
										<td class="">Apellidos y Nombres</td>
										<td class="">Titulo del Libro</td>
										<td class="">Biblioteca</td>
										<td class="">Escuela</td>
									</tr>';	
																							
							if(!empty($_POST["primero"])){ //pregunto si ha seleccionado algun dato
								
							    $array = $_POST["primero"];
								$contador = 1;
								$_SESSION["total_res"] = 0;
										
							    $sql = "SELECT es.esc_nombre, e.est_codigo, e.est_apellidos, e.est_nombres, ";
								$sql .= "o.ofi_nombre, LEFT(l.lib_titulo, 30) AS titulo, d.det_estado ";
								$sql .= "FROM escuela es ";
								$sql .= "INNER JOIN estudiante e ON es.id_escuela = e.est_escuela ";
								$sql .= "INNER JOIN detalle_deuda d ON e.id_estudiante = d.det_id_alumno ";
								$sql .= "INNER JOIN usuario u ON d.det_usuario = u.id_usuario ";
								$sql .= "INNER JOIN oficina o ON u.usu_oficina = o.id_oficina ";
								$sql .= "INNER JOIN libro l ON d.det_cod_libro = l.id_libro ";
								$sql .= "WHERE d.det_estado = 'P' AND ";
								$sql .= "e.est_estado = 1 AND ";
								$sql .= "u.usu_oficina =  '".$array."' ORDER BY est_apellidos; "; 
                                       
                                $result = mysqli_query($link,$sql) or die("Error");
								$variable = array();  
												
								while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
									   
                                   //lleno mi temporal de sesion reportes	
													
								   $_SESSION["total_res"] = $contador;		
														
								   $arreglo[$contador][1] = $row["est_codigo"];
								   $arreglo[$contador][2] = $row["est_apellidos"]." ".$row["est_nombres"];
								   $arreglo[$contador][3] = $row["titulo"];
								   $arreglo[$contador][4] = $row["ofi_nombre"];
					               $arreglo[$contador][5] = $row["esc_nombre"];
																									
								   echo
										'<tr class="puntero">
											<td>'.$contador++.'</td>
											<td>'.$row["est_codigo"].'</td>
											<td class="alinear_izquierda">'.strtoupper($row["est_apellidos"]." ".$row["est_nombres"]).'</td>
											<td class="alinear_izquierda">'.strtoupper($row["titulo"]).'</td>
											<td>'.$row["ofi_nombre"].'</td>
											<td>'.$row["esc_nombre"].'</td>
										</tr>';
													
										$_SESSION["resultados"] = $arreglo; 
													
									}//fin del while				
                                                
									include('../fecha_hora/date.php');
																												
								}//fin if - de la pregunta si escogio algo del select
								else{
									echo
									   '<tr>
									       	<td class=""><a><i>vacio</i></a></td>
											<td class=""><a><i>vacio</i></a></td>
											<td class=""><a><i>vacio</i></a></td>
											<td class=""><a><i>vacio</i></a></td>
											<td class=""><a><i>vacio</i></a></td>
											<td class=""><a><i>vacio</i></a></td>
										</tr>';
												
									$_SESSION["total_res"] = 0;	
												
									echo '<div id="situacion"><a>Seleccione una o mas Escuelas</a></div>';
								}
									
									
								/********** Agregamos la copa de indicadores ***************/
								?>	
									
								<div id="indicadores">
								    <a style="font-size: 13px;">
										Total de Alumnos: <b> <?php  echo $_SESSION["total_res"]; ?></b>
									</a>
								</div>
									
									
								<?php
									
									
								echo 
								    '</table>
									<form action="../librerias/pdf/pdf.php" method="POST" target="_blank">
										<div id="capaboton">
											<div id="capabotonhija">
												<input type="submit" value="Convertir PDF" class="aceptar" >
											</div>
										</div>
									</form>';
										
								break;
									
									/******* Fin del case opcion3 BIBLIOTECA *******/

								
								
								
																	
								// -------------------------------default	
								default:
									echo '<div id="situacion"><a>No has seleccionado ninguna Categoria *</a></div>';									
							}
																					
						}
						
					echo '</fieldset>';				
					?>	


<?php

	include('../down.php');

?>
