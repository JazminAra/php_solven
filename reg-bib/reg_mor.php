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
					<a>Registrar Moroso</a>
				</dir>
			</div>

			<!-- Formulario para busqueda de alumno por codigo-->
			<fieldset>
                <form action="reg_mor.php" method="POST">	
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
                $sql  = "SELECT e.est_nombres AS nombres, e.est_apellidos AS apellidos, ";
                $sql .= "e.est_sexo AS sexo, e.est_domicilio AS domicilio, ";
                $sql .= "es.esc_nombre AS escuela, f.fac_nombre AS facultad ";
                $sql .= "FROM estudiante e ";
                $sql .= "INNER JOIN escuela es ON e.est_escuela = es.id_escuela ";
                $sql .= "INNER JOIN facultad f ON es.esc_facultad = f.id_facultad ";
                $sql .= "WHERE e.est_codigo like '".$_POST['codigo']."';";
               	     
				$result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                
                if($row2 = mysqli_fetch_array($result2)){//EXISTE EN LA TABLA ESTUDIANTE
                    $bandera = "student";
                }
                else{
                    $sql  = "SELECT p.per_nombres AS nombres, p.per_apellidos AS apellidos, ";
                    $sql .= "p.per_sexo AS sexo, p.per_domicilio AS domicilio, t.tip_per_nombre AS tipo ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN tipo_persona t ON p.per_tipo = t.id_tipo_persona ";
                    $sql .= "WHERE p.per_dni like '".$_POST['codigo']."'; ";
                    
                    $result2 = mysqli_query($link,$sql) or die("Error en la consulta 2");
                    
                    if($row2 = mysqli_fetch_array($result2)){//EXISTE EN LA TABLA PERSONA
                        $bandera = "person";
                        
                    }
                    else{//NO EXISTE EN NINGUNA TABLA
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
                else{
                    
                    $sql  = "SELECT COUNT(d.det_estado) AS cuenta ";
                    $sql .= "FROM persona p ";
                    $sql .= "INNER JOIN detalle_deuda_anonimo d ON d.det_id_persona = p.id_persona ";
                    $sql .= "WHERE d.det_estado = 'P' AND p.per_dni like '".$_POST['codigo']."'; ";

                    $result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
                }
                
                $row3 = mysqli_fetch_array($result,MYSQLI_BOTH);

                $historial = $row3['cuenta'];
                    
				//Pregunto si bandera es diferente de cero entonces tiene deuda
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
    					<div id="derechab"><?php echo $row2['escuela']; ?><br /></div>		
    				</div>
    				<div id="madrebfinal">
    					<div id="izquierdab"><a>Facultad:</a><br /></div>
    					<div id="derechab"><?php echo $row2['facultad']; ?><br /></div>		
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
    					<div id="derechab"><?php echo $row2['tipo']; ?><br /></div>		
    				</div>
                <?php
                }
                ?>
																																						
                <!--  FORMULARIO PARA EL LLENADO DE LOS DATOS DEL LIBRO -->
       			<form action="reg_mor_insert.php" method="POST" onSubmit="return Valida(this);" >
                    
                  <!-- TENGO QUE TENER EL CODIGO DEL ALUMNO OCULTO Y QUE SI ES ESTUDIANTE O PERSONA -->
                    <input type="hidden" value="<?php echo $_POST['codigo']; ?>" name="hidden_cod"/>
                    <input type="hidden" value="<?php echo $bandera; ?>" name="hidden_band"/>                            				
        				
        				<!-- Aqui colocaremos todos los Datos del Libro-->
        				<fieldset>
        					<legend>
        						<a>Ingrese los datos del Libro</a>
        					</legend>
        					<div id="madre">
        						<div id="izquierda"><a>Signatura </a>
        							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
        						<div id="derecha"><input class="campo" type="text" name="signatura" value="" /><br /></div>		
        					</div>	
        					<div id="madre">
        						<div id="izquierda"><a>N Ingreso:</a><br /></div>					
        						<div id="derecha"><input class="campo" type="text" name="numeracion" value="" /><br /></div>		
        					</div>	
        					<div id="madre">
        						<div id="izquierda"><a>Titulo </a>
        							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
        						<div id="derecha"><input class="campo" type="text" name="titulo" value="" /><br /></div>		
        					</div>	
        					<div id="madre">
        						<div id="izquierda"><a>Autor </a>
        							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
        						<div id="derecha"><input class="campo" type="text" name="autor" value="" /><br /></div>		
        					</div>	
        					<div id="madre">
        						<div id="izquierda"><a>Fuente:</a><br /></div>					
        						<div id="derecha"><input class="campo" type="text" name="fuente" value="" /><br /></div>		
        					</div>																	
		
        				</fieldset>	
        				
        				<!-- Aqui colocaremos todos los Datos del Prestamo -->
        				<fieldset>
        					<div id="madre">
        						<div id="izquierda"><a>Fecha (PRESTAMO):</a>
        							<a style="color:#f64141; font-size:12px;">(*)</a><br />
                                </div>	
        						<div id="derecha">
        						<!--	<input type="text" name="fecha" class="campotiempo" id="datepicker" readonly="readonly" /> -->
									<input type="date" name="fecha" class="campotiempo" id="fecha" />
									<br />
        						</div>	
        					</div>
        					<div id="madre2">
        						<div id="izquierda"><a>Observaciones (max. 100):</a><br /></div>
        						<div id="derecha"><textarea class="textarea" name="observacion" ></textarea><br /></div>	
        						<br />
        					</div>														
        				</fieldset>				
        				
        				<!--  Capa para los botones principales -->
        				<div id="capaboton">
        					<div id="capabotonhija">
        						<input type="reset" value="Limpiar" name="limpiar" class="limpiar" />
        						<input type="button" value="Cancelar" name="cancelar" class="cancelar" 
        							   onClick="location.href='../demo/mantenimiento.php'" />
        						<input type="submit" value="Registrar" name="registrar" class="aceptar" />	
        					</div>
        						
        				</div>			
        			</form>		

            <?php					

                echo '</fieldset>';
                }    
            ?>

<?php

	include('../down.php');

?>