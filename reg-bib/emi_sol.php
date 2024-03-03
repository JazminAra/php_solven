<?php
	include('../up-bib.php');
?>

        <div id="submenu">
            <a href="reg_mor.php">Registrar Moroso</a>
            <a href="new_mor.php">Nuevo Usuario</a>
            <a href="emi_sol.php">Emitir Solvencia</a>
            <a href="des_mor.php">Desmarcar Moroso</a>
        </div>
        <!-- FIN MENU -->
	    <div id="cuerpo">
			<div id="titulo">
				<dir id="tituloin">
					<a>Emitir Solvencia</a>
				</dir>
			</div>
			
			<!-- Formulario para busqueda de alumno por codigo-->
			<fieldset>
                <form action="emi_sol.php" method="POST">	
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
            if($_POST){

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
                $sql .= "WHERE e.est_codigo like '".$_POST['codigo']."';";

				$result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                
                if($row2 = mysqli_fetch_array($result2)){
                    
                    //EXISTE EN LA TABLA ESTUDIANTE
                    $bandera = "student";

                }
                else{
                    
                    $sql  = "SELECT p.id_persona AS id_individuo, p.per_nombres AS nombres, p.per_apellidos AS apellidos, ";
                    $sql .= "p.per_sexo AS sexo, p.per_domicilio AS domicilio, t.tip_per_nombre AS tipo, p.per_tipo ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN tipo_persona t ON p.per_tipo = t.id_tipo_persona ";
                    $sql .= "WHERE p.per_dni like '".$_POST['codigo']."'; ";
                    
                    $result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                    
                    if($row2 = mysqli_fetch_array($result2)){
                        
                        //EXISTE EN LA TABLA PERSONA
                        $bandera = "person";
                        
                    }
                    else{
                        //NO EXISTE EN NINGUNA TABLA
                        echo '<script language="javascript">
            				location.href = "../reg-bib/?stream=null";
        				</script>;';
                        //header("Location: ../reg/?stream=null"); 
                    }
                }
                //-----------------------------------------------------------------------------------------------
						
				if($bandera == "student"){
				    
				    $sql  = "SELECT COUNT(d.det_estado) AS cuenta FROM estudiante e ";
                    $sql .= "INNER JOIN detalle_deuda d ON d.det_id_alumno = e.id_estudiante ";
                    $sql .= "WHERE d.det_estado = 'P' AND e.est_codigo like '".$_POST['codigo']."'; ";
                    	
                    $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
				}
                
                if($bandera == "person"){
                    
                    $sql  = "SELECT COUNT(d.det_estado) AS cuenta ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN detalle_deuda_anonimo d ON d.det_id_persona = p.id_persona ";
                    $sql .= "WHERE d.det_estado = 'P' AND p.per_dni like '".$_POST['codigo']."'; ";

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
					<div id="derechab"><?php echo $_POST['codigo']; ?><br /></div>		
				</div>
				<div id="madreb">
					<div id="izquierdab"><a>Nombres:</a><br /></div>					
					<div id="derechab"><?php echo $row2['nombres']; ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Apellidos:</a><br /></div>					
					<div id="derechab"><?php echo $row2['apellidos']; ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Sexo:</a><br /></div>					
					<div id="derechab"><?php echo $row2['sexo']; ?><br /></div>		
				</div>	
				<div id="madreb">
					<div id="izquierdab"><a>Domicilio:</a><br /></div>					
					<div id="derechab"><?php echo $row2['domicilio']; ?><br /></div>		
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

			     	/*MODULO PARA FILTRAR LOS ALUMNOS PARA LA EMISION DE LA SOLVENCIA DE CADA ALUMNO*/

				     if($historial == 0){ // PREGUNTO SI ES MOROSO
                     
                        if($bandera == "student"){

                            $sql  = "SELECT f.fac_dependencia ";
    						$sql .= "FROM estudiante e ";
    						$sql .= "INNER JOIN escuela es ON e.est_escuela = es.id_escuela ";
    						$sql .= "INNER JOIN facultad f ON es.esc_facultad = f.id_facultad ";
    						$sql .= "WHERE e.est_codigo = '".$_POST['codigo']."'; ";

    						$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
    						$row = mysqli_fetch_array($result,MYSQLI_BOTH);
                            
                            /**********************************************************************/
							
							//echo $row['fac_dependencia']."-".$_SESSION["oficina"];
    						
    				     	if($row['fac_dependencia'] == $_SESSION["oficina"]){ // PREGUNTO SI ALUMNO PERTENECE A LA FACULTAD
    							
                                //OBTENGO LA FECHA Y HORA EXACTA AL MOMENTO DE DARLO COMO NO DEUDOR
    							include('../fecha_hora/date.php');
    							$_SESSION['cod'] = $_POST['codigo'];
    							$_SESSION['names'] = $row2['apellidos'].", ".$row2['nombres'];
    							$_SESSION['facu'] = $row2['facultad'];
    							$_SESSION['escu'] = $row2['escuela'];
                                
                                echo '
    							
    							<script>
    								
    								function pregunta(){ 
    							         if (confirm(\'Esta seguro de enviar la generar la solvencia?\')){ 
    									   alert("Registro Guardado con Exito.");
                                           window.open (\'../librerias/pdf/pdf-certificado.php\');
                                           document.formulario.submit();
    							         } 
                                    } 
    							</script>
    							
    							<form name="formulario" action="emi_sol_insert_log.php" method="POST" >
    								<div id="capaboton">
    									<div id="capabotonhija">
                                            <input type="hidden" name="cod_oculto" value="'.$row2['id_individuo'].'" />
    										<input type="button" value="Expedir Solvencia" class="solvencia" onclick="pregunta()">
    									</div>
    								</div>
    							</form>';
    						}
    						else{ 
    							
    							echo '<div id="capaboton">
    									<div id="capabotonhija">
    										<a style="font-size: 14px;"><i>El alumno NO pertenece a su Biblioteca</i></a>
    									</div>
    								</div>';
    						}
    						
    			         /****************************************************************/	
    
                        }
                        else{// SI ES UNA PERSONA SIEMPRE LO VA A EMITIR BIBLIOTECA CENTRAL
                            
                            if("bib_cent" == $_SESSION["oficina"]){
                                
                                //OBTENGO LA FECHA Y HORA EXACTA AL MOMENTO DE DARLO COMO NO DEUDOR
    							include('../fecha_hora/date.php');
    							$_SESSION['cod'] = $_POST['codigo'];
    							$_SESSION['names'] = $row2['apellidos'].", ".$row2['nombres'];
    							$_SESSION['facu'] = "(EMITIDO POR LA BIBLIOTECA CENTRAL)";
    							$_SESSION['escu'] = "(EMITIDO POR LA BIBLIOTECA CENTRAL)";
                                
                                echo '
    							
    							<script>
    								
    								function pregunta(){ 
    							         if (confirm(\'Esta seguro de enviar la generar la solvencia?\')){ 
    									   alert("Registro Guardado con Exito.");
                                           window.open (\'../librerias/pdf/pdf-certificado.php\');
                                           document.formulario.submit();
    							         } 
                                    } 
    							</script>
    							
    							<form name="formulario" action="emi_sol_insert_log.php" method="POST" >
    								<div id="capaboton">
    									<div id="capabotonhija">
                                            <input type="hidden" name="cod_oculto" value="'.$row2['id_individuo'].'" />
    										<input type="button" value="Expedir Solvencia" class="solvencia" onclick="pregunta()">
    									</div>
    								</div>
    							</form>';
                            }
                            else{
								if("bib_educ" == $_SESSION["oficina"] && ($row2['per_tipo'] == 3 || $row2['per_tipo'] == 4)){
                                
                                //OBTENGO LA FECHA Y HORA EXACTA AL MOMENTO DE DARLO COMO NO DEUDOR
    							include('../fecha_hora/date.php');
    							$_SESSION['cod'] = $_POST['codigo'];
    							$_SESSION['names'] = $row2['apellidos'].", ".$row2['nombres'];
    							$_SESSION['facu'] = "EDUCACION Y CIENCIAS DE LA COMUNICACION";
    							$_SESSION['escu'] = "(EMITIDO POR LA BIBLIOTECA DE EDUCACION Y CIENCIAS DE LA COMUNICACION)";
                                
                                echo '
    							
    							<script>
    								
    								function pregunta(){ 
    							         if (confirm(\'Esta seguro de enviar la generar la solvencia?\')){ 
    									   alert("Registro Guardado con Exito.");
                                           window.open (\'../librerias/pdf/pdf-certificado.php\');
                                           document.formulario.submit();
    							         } 
                                    } 
    							</script>
    							
    							<form name="formulario" action="emi_sol_insert_log.php" method="POST" >
    								<div id="capaboton">
    									<div id="capabotonhija">
                                            <input type="hidden" name="cod_oculto" value="'.$row2['id_individuo'].'" />
    										<input type="button" value="Expedir Solvencia" class="solvencia" onclick="pregunta()">
    									</div>
    								</div>
    							</form>';
                            }
							else{
                                
                                echo '<div id="capaboton">
    									<div id="capabotonhija">
    										<a style="font-size: 14px;"><i>El alumno pertenece a la Biblioteca Central</i></a>
    									</div>
    								</div>'; 
								}									
                            }
                            
                        }
				     	
				     	
					 }
					 else{
					 	
						echo '<div id="capaboton">
									<div id="capabotonhija">
										<a style="font-size: 14px;"><i>NO puede generar Solvencia</i></a>
									</div>
							</div>';
					 }
				 

            }  
            echo '</fieldset>';
              
        ?>
				

<?php

	include('../down.php');

?>