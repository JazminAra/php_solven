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
					<a>Crear Nuevo Usuario</a>
				</dir>
			</div>
			
            <div id="stream-msn">
                <a>Todas las personas seran registradas con su DNI!!</a>
            </div>
            
            <fieldset>			
    			
    			<?php				
    				include('../conexion/conexion.php');
    				$link = Conectarse();
    			?>
    			
    			<form action="new_mor_insert.php" method="POST" onSubmit="return ValidaUsuario(this);" >
    			
    				<!-- Aqui colocaremos todos los Datos del Alumno-->
    				<fieldset>
    					<legend>
    						<a>Datos Personales</a>
    					</legend>
    	
    					<div id="madre">
    						<div id="izquierda">
    							<a>DNI </a>
    							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
    						<div id="derecha">
    							<input class="campo" type="text" name="dni" value="" onkeyup = "compUsuario(event)" />
    							<div id="DivDestino" ></div><br />
    						</div>	
    					</div>
                        <div id="madre">
    						<div id="izquierda"><a>Elige una opción </a>
    							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
    						<div id="derecha">
    							<input type="radio" name="tipo" value="1" />Profesor &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;
                                <input type="radio" name="tipo" value="3" />Complementación Académica<br />
    						</div>
                            <div id="izquierda">
                            </div>
                            <div id="derecha">
                                <input type="radio" name="tipo" value="2" />Administrativo
                                <input type="radio" name="tipo" value="4" />Segunda Especialización
                            </div>	
    					</div>				
    					<div id="madre">
    						<div id="izquierda"><a>Apellidos </a>
    							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
    						<div id="derecha"><input class="campo" type="text" name="apellido" value="" /><br /></div>		
    					</div>	
    					<div id="madre">
    						<div id="izquierda"><a>Nombres </a>
    							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
    						<div id="derecha"><input class="campo" type="text" name="nombre" value="" /><br /></div>		
    					</div>	
    					<div id="madre">
    						<div id="izquierda"><a>Sexo </a>
    							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
    						<div id="derecha">
    							<input type="radio" name="sexo" value="M" />Masculino
    							<input type="radio" name="sexo" value="F" />Femenino
    						</div>		
    					</div>						
    					<div id="madre">
    						<div id="izquierda"><a>Domicilio:</a><br /></div>					
    						<div id="derecha"><input class="campo" type="text" name="domicilio" value="" /><br /></div>		
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
				
			</fieldset>
				

<?php

	include('../down.php');

?>