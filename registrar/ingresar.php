<?php
	include('../up.php');
?>
			<div id="titulo">
				<dir id="tituloin">
					<a>Registrar Alumno Moroso</a>
				</dir>
			</div>
			
			
			<!-- Aqui cargamos los codigos JavaScript -->
					
				
			
			
						
			<!-- Agregamos la conexion a la base de Datos -->						
			
			<?php				
				include('../conexion/conexion.php');
				$link = Conectarse();
			?>
			
			<form action="insertar.php" method="POST" onSubmit="return Valida(this);" >
			
				<!-- Aqui colocaremos todos los Datos del Alumno-->
				<fieldset>
					<legend>
						<a>Datos Personales</a>
					</legend>
	
					<div id="madre">
						<div id="izquierda">
							<a>Codigo Carnet </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha">
							<input class="campo" type="text" name="codigo" value="" onkeyup = "compUsuario(event)" >
							<img src="../imagenes/help.gif">
							<div id="DivDestino" ></div><br>
						</div>	
					</div>					
					<div id="madre">
						<div id="izquierda"><a>Apellidos </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="apellido" value="" ><br></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>Nombres </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="nombre" value="" ><br></div>		
					</div>
					
					
					
															
					<div id="madre">
						<div id="izquierda"><a>Escuela </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha">
							<select class="combo" name="escuela" id="combox" onchange="SeleccionandoCombo(this);">
								<?php
									
									$sql = "SELECT * FROM escuela; ";	
							  		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
							  		echo '<option value="null" >Seleccione Escuela</option>';	
									  
									while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
										echo '<option value="'.$row["codEscuela"].'">'.$row["nombre"].'</option>';															
								?>
							</select>
						<br>
						</div>		
					</div>
					<div id="madre">
						<div id="izquierda"><a>Facultad:</a><br></div>					
						<div id="derecha"><input id="celdax" class="campo" type="text" name="facultad" value="" disabled="true" ><br></div>		
					</div>	
					
					
					<script type="text/javascript">
					
					function LlenarCombo(json)
					{	
						document.getElementById('celdax').value = json[0].data;
					}
					function SeleccionandoCombo(combo1)
					{
						
					
						if(combo1.options[combo1.selectedIndex].value != "")
						{
							combo1.disabled = true;
							
							$.ajax({
								type: 'get',
								dataType: 'json',
								url: 'ajax.php',
								data: {valor: combo1.options[combo1.selectedIndex].value},
								success: function(json){
									
									LlenarCombo(json);
									combo1.disabled = false;
								}
							});
						}
					}
					</script>
					
															
					<div id="madre">
						<div id="izquierda"><a>Sexo </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha">
							<input type="radio" name="sexo" value="H">Hombre
							<input type="radio" name="sexo" value="M">Mujer
						</div>		
					</div>						
					<div id="madre">
						<div id="izquierda"><a>Domicilio:</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="domicilio" value="" ><br></div>		
					</div>										
						
				</fieldset>
				
				
				
				<!-- Aqui colocaremos todos los Datos del Libro-->
				<fieldset>
					<legend>
						<a>Datos del Libro</a>
					</legend>
					<div id="madre">
						<div id="izquierda"><a>Signatura </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="signatura" value="" ><br></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>N Ingreso:</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="numeracion" value="" ><br></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>Titulo </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="titulo" value="" ><br></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>Autor </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="autor" value="" ><br></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>Fuente:</a><br></div>					
						<div id="derecha"><input class="campo" type="text" name="fuente" value="" ><br></div>		
					</div>																	
						
	
					
				</fieldset>	
				
				<!-- Aqui colocaremos todos los Datos del Prestamo -->
				<fieldset>
					<legend>
						<a>Datos Prestamo</a>
					</legend>
					<div id="madre">
						<div id="izquierda"><a>Fecha (dd/mm/aa)</a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br></div>	
						<div id="derecha">
							<input type="text" name="fecha" class="campotiempo" id="datepicker" readonly="readonly" /><br>
						</div>	
					</div>						
					<div id="madre2">
						<div id="izquierda"><a>Observaciones (max. 100):</a><br></div>					
						<div id="derecha"><textarea class="textarea" name="observacion" ></textarea><br></div>	
						<br>
					</div>														
				</fieldset>				
				
				<!--  Capa para los botones principales -->
				<div id="capaboton">
					<div id="capabotonhija">
						<input type="reset" value="Limpiar" name="limpiar" class="limpiar" >
						<input type="button" value="Cancelar" name="cancelar" class="cancelar" 
							   onClick="location.href='../demo/mantenimiento.php'">
						<input type="submit" value="Registrar" name="registrar" class="aceptar" >	
					</div>
						
				</div>			
			</form>		
		

<?php

	include('../down.php');

?>
