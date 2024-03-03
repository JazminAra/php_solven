<?php
	include('../up-ofi.php');
?>

        <div id="submenu">
            <a href="reg_mor.php">Registrar Moroso</a>
            <a href="new_mor.php">Nuevo Usuario</a>
            <a href="des_mor.php">Desmarcar Moroso</a>
        </div>
        <!-- FIN MENU -->
	    <div id="cuerpo">
			<div id="titulo">
				<dir id="tituloin">
					<a>Desmarcar Moroso</a>
				</dir>
			</div>
		
			<!-- Formulario para busqueda de alumno por codigo-->
			<fieldset>
                <form action="des_mor.php" method="GET">	
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
                
                //----------------------PREGUNTO EN QUE BASE DE DATOS ESTA Y SI EXISTE-------------------------------
                
                //Obtenemos los datos de nuestro alumno:
                $sql  = "SELECT e.id_estudiante AS id_individuo, e.est_nombres AS nombres, e.est_apellidos AS apellidos, ";
                $sql .= "e.est_sexo AS sexo, e.est_domicilio AS domicilio, ";
                $sql .= "es.esc_nombre AS escuela, f.fac_nombre AS facultad ";
                $sql .= "FROM estudiante e ";
                $sql .= "INNER JOIN escuela es ON e.est_escuela = es.id_escuela ";
                $sql .= "INNER JOIN facultad f ON es.esc_facultad = f.id_facultad ";
                $sql .= "WHERE e.est_codigo like '".$_GET['codigo']."';";
               	     
				$result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                
                if($row2 = mysqli_fetch_array($result2)){
                    
                    //EXISTE EN LA TABLA ESTUDIANTE
                    $bandera = "student";
                    
                }
                else{
                    
                    $sql  = "SELECT p.id_persona AS id_individuo, p.per_nombres AS nombres, p.per_apellidos AS apellidos, ";
                    $sql .= "p.per_sexo AS sexo, p.per_domicilio AS domicilio, t.tip_per_nombre AS tipo ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN tipo_persona t ON p.per_tipo = t.id_tipo_persona ";
                    $sql .= "WHERE p.per_dni like '".$_GET['codigo']."'; ";
                    
                    $result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                    
                    if($row2 = mysqli_fetch_array($result2)){
                        
                        //EXISTE EN LA TABLA PERSONA
                        $bandera = "person";
                        
                    }
                    else{
                        //NO EXISTE EN NINGUNA TABLA
                        echo '<script language="javascript">
            				location.href = "../reg-ofi/?stream=null";
        				</script>;';
                        //header("Location: ../reg/?stream=null"); 
                    }
                }
                
                //-----------------------------------------------------------------------------------------------
						
				if($bandera == "student"){
				    
				    $sql  = "SELECT COUNT(d.det_estado) AS cuenta FROM estudiante e ";
                    $sql .= "INNER JOIN detalle_deuda d ON d.det_id_alumno = e.id_estudiante ";
                    $sql .= "WHERE d.det_estado = 'P' AND e.est_codigo like '".$_GET['codigo']."'; ";
                    	
                    $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				}
                
                if($bandera == "person"){
                    
                    $sql  = "SELECT COUNT(d.det_estado) AS cuenta ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN detalle_deuda_anonimo d ON d.det_id_persona = p.id_persona ";
                    $sql .= "WHERE d.det_estado = 'P' AND p.per_dni like '".$_GET['codigo']."'; ";

                    $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
                }
                
                $row3 = mysqli_fetch_array($result,MYSQLI_BOTH);

                $historial = $row3['cuenta'];
                
                    
				//----------------------------Pregunto si bandera es diferente de cero entonces tiene deuda
                
				if( $historial != 0 ){

                   echo '<div id="situacion2"><a>Moroso</a></div>';
                }							
				else{ 

                   echo '<div id="situacion3"><a>No debe</a></div>'; 
                }
                ?>

                <div id="madreb">
					<div id="izquierdab"><a>Codigo:</a><br /></div>					
					<div id="derechab"><?php echo $_GET['codigo'] ?><br /></div>		
				</div>
				<div id="madreb">
					<div id="izquierdab"><a>Nombres:</a><br /></div>					
					<div id="derechab"><?php echo $row2['nombres'] ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Apellidos:</a><br /></div>					
					<div id="derechab"><?php echo $row2['apellidos'] ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Sexo:</a><br /></div>					
					<div id="derechab"><?php echo $row2['sexo'] ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Domicilio:</a><br /></div>					
					<div id="derechab"><?php echo $row2['domicilio'] ?><br /></div>		
				</div>
                <?php
                if($bandera == "student"){
                ?>
                    <div id="madreb">
    					<div id="izquierdab"><a>Escuela:</a><br /></div>
    					<div id="derechab"><?php echo $row2['escuela'] ?><br /></div>		
    				</div>
    				<div id="madrebfinal">
    					<div id="izquierdab"><a>Facultad:</a><br /></div>
    					<div id="derechab"><?php echo $row2['facultad'] ?><br /></div>		
    				</div>
                <?php
                }
                else{ //PERSON
                ?>
                    <div id="madreb">
    					<div id="izquierdab"><a>Escuela y Facultad:</a><br /></div>
    					<div id="derechab"><i>No tiene</i><br /></div>		
    				</div>
    				<div id="madrebfinal">
    					<div id="izquierdab"><a>Tipo:</a><br /></div>
    					<div id="derechab"><?php echo $row2['tipo'] ?><br /></div>		
    				</div>
                <?php
                }

					echo 
					'<table border=1 cellspacing=0 cellpadding=2 >
						<tr class="celda">
							<td class="">N&deg;</td>
							<td class="">Codigo del Bien</td>
							<td class="">Responsable</td>
							<td class="">Biblioteca/Oficina</td>
							<td class="">Detalles</td>
							<td class="">Situaci&oacute;n</td>
							<td class="">Cambiar</td>
                        </tr>';
							
							
					echo '<script>
							function preguntar(id ,codigo ,situacion, bandera, individuo){
							 
							     var actualizar = confirm("Desea cambiar estado?");
							     if(actualizar){       
								    location.href = "des_mor_change_status.php?id="+id+"&codigo="+codigo+"&estado="+situacion+"&band="+bandera+"&ind="+individuo;
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
                    
                    if($bandera == "student"){
                        
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
                        
                                                
                    }
                    else{ //ES PERSONA
                        
                        $sql  = "SELECT d.det_fecha_prestamo, d.det_estado, d.id_detalle_deuda, l.id_libro, l.lib_codigo, ";
                        $sql .= "l.lib_numero, l.lib_titulo, l.lib_autor, l.lib_fuente, ";
                        $sql .= "u.usu_nombres, u.usu_apellidos, u.usu_oficina, o.ofi_nombre ";
                        $sql .= "FROM persona p ";
                        $sql .= "INNER JOIN detalle_deuda_anonimo d ON d.det_id_persona = p.id_persona ";
                        $sql .= "INNER JOIN libro l ON d.det_cod_libro = l.id_libro ";
                        $sql .= "INNER JOIN usuario u ON d.det_usuario = u.id_usuario ";
                        $sql .= "INNER JOIN oficina o ON u.usu_oficina = o.id_oficina ";
                        $sql .= "WHERE p.per_estado = 1 AND "; 
                        $sql .= "p.per_dni = '".$_GET['codigo']."'; ";
                        
                        //echo $sql.'<br />';
                    }
                      
                    

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
								
								//echo "ofic1:".substr($_SESSION["oficina"],0,3)."- ";
								
								/*if(strcmp(substr($_SESSION["oficina"],0,3),'Lab'))
									echo "si";
								else
									echo "no";*/
                                
								//Filtro por Biblioteca		
								if($row["usu_oficina"] == $_SESSION["oficina"] || strcmp(substr($_SESSION["oficina"],0,3),'Lab')){
                                    echo   '<td><a href="javascript:preguntar(\''.$row["id_detalle_deuda"].'\',
									           			  \''.$_GET['codigo'].'\',
														  \''.$row["det_estado"].'\',
                                                          \''.$bandera.'\',
                                                          \''.$row2['id_individuo'].'\'
											     )">Cambiar</a></td>';
								}
								else{
								    echo '<td><a title="No tiene permisos">No tiene permisos</a></td>';
								}
												
						echo '</tr>';
                        
                    }									
                    echo '</table>';
                    
                    $_SESSION["resultados"] = $arreglo;	
						
					include('../fecha_hora/date.php');					
			
			 }

             echo '</fieldset>';
        
            ?>

<?php

	include('../down.php');

?>