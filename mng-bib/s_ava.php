<?php
	include('../up-bib.php');
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


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
					<a>Busqueda Avanzada</a>
				</dir>
			</div>
 

		
			
			<!-- Aqui colocaremos todos los Datos del Alumno-->
			<fieldset>
				
				<form action="s_ava.php" method="POST">	
					<div id="madre">
						<a>Nombres: </a><input class="campo" type="text" name="names" value="" >
						<a>Apellidos: </a><input class="campo" type="text" name="apellidos" value="" >
						<input type="submit" value="Buscar" name="registrar" class="aceptar" >
					</div>											
				</form>
					
			</fieldset>

			<!-- Aqui colocaremos todos resultados de la busqueda -->
			
			<?php
			
			if($_POST){
			
				if( (strlen($_POST['names']) >= 3) && (strlen($_POST['apellidos']) >= 3))
				{					
					echo '
					<fieldset>
					
			  		<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
						<tr class="celda">
							<td>N&deg;</td>
							<td>Codigo</td>
							<td>Nombres</td>
							<td>Apellidos</td>
							<td>Escuela/Tipo</td>
							<td>Domicilio</td>
						</tr>';
							
					include('../conexion/conexion.php');
					$link = Conectarse();
					
                    //BUSQUEDA PARA LOS ESTUDIANTES---------------------------------------------------------------
                    				
					$sql  = "SELECT * FROM estudiante e ";
                    $sql .= "JOIN escuela es ON e.est_escuela = es.id_escuela "; 
                    $sql .= "WHERE e.est_nombres LIKE \"%".$_POST['names']."%\" AND "; 
                    $sql .= "e.est_apellidos LIKE \"%".$_POST['apellidos']."%\" ;";
					                    
			  		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");

			  		$contador = 1;
			  		while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
						echo '
						<tr class="puntero">
							<td>'.$contador++.'</td>
							<td>'.$row['est_codigo'].'</td>
							<td class="alinear_izquierda">'.strtoupper($row['est_nombres']).'</td>
							<td class="alinear_izquierda">'.strtoupper($row['est_apellidos']).'</td>
							<td>'.$row['esc_nombre'].'</td>
							<td class="alinear_izquierda">'.strtoupper($row['est_domicilio']).'</td>
						</tr>';
					}
                    
                    //BUSQUEDA PARA LAS PERSONAS CON DNI---------------------------------------------------------
                    
                    $sql  = "SELECT * FROM persona p ";
                    $sql .= "JOIN tipo_persona t ON p.per_tipo = t.id_tipo_persona "; 
                    $sql .= "WHERE p.per_nombres LIKE \"%".$_POST['names']."%\" AND "; 
                    $sql .= "p.per_apellidos LIKE \"%".$_POST['apellidos']."%\" ;";
                    
			  		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");

			  		while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
						echo '
						<tr class="puntero">
							<td>'.$contador++.'</td>
							<td>'.$row['per_dni'].'</td>
							<td class="alinear_izquierda">'.strtoupper($row['per_nombres']).'</td>
							<td class="alinear_izquierda">'.strtoupper($row['per_apellidos']).'</td>
							<td>'.$row['tip_per_nombre'].'</td>
							<td class="alinear_izquierda">'.strtoupper($row['per_domicilio']).'</td>
						</tr>';
					}
								
					echo '
					</table>
			  		
					</fieldset>';	
				}
			}
			
			?>            
 <script src="./javascript/jquery.js"> </script>
 <script src="./javascript/javascript.js"> </script>
 <script src="./javascript/jquery.min.js" > </script>
 <script src="./javascript/jquery-ui-es.js"> </script>
 <script src="./javascript/jquery-ui.min.js"> </script>

<?php

	include('../down.php');

?>
