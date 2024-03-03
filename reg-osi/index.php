<?php
	include('../up-osi.php');
?>

        <div id="submenu">
            <a href="new_student.php">Crear Nuevo Estudiante</a>
            <a href="publicar_wall.php">Publicar Muro</a>
        </div>
        <!-- FIN MENU -->
	    <div id="cuerpo">
			<div id="titulo">
				<dir id="tituloin">
					<a>Registrar</a>
				</dir>
			</div>
			
            <?php
            
            if($_GET){
      
                if($_GET['stream'] == "sol"){ //Mensaje de emision de solvencia
                    echo '<div id="stream">';
                    echo '<a>La solvencia se emitio con exito...!!</a>';
                }
                if($_GET['stream'] == "new"){ //Mensaje de emision de solvencia
                    echo '<div id="stream">';
                    echo '<a>Se guardo el nuevo estudiante correctamente...!!</a>';
                }              
                if($_GET['stream'] == "null"){ //Mensaje de emision de solvencia
                    echo '<div id="stream-fail">';
                    echo '<a>No existe el estudiante</a>';
                }
                if($_GET['stream'] == "new-fail"){ //Mensaje de emision de solvencia
                    echo '<div id="stream-fail">';
                    echo '<a>El estudiante ya existe...!!</a>';
                }                                
                if($_GET['stream'] == "msn"){ //Mensaje de emision de solvencia
                    echo '<div id="stream">';
                    echo '<a>El mensaje se publico con exito...!!</a>';
                } 
                echo '</div>';
            }
            
            
            ?>
			
			<!-- Aqui colocaremos todos los Datos del Alumno-->
			<fieldset>
                <div id="icon">
                    <a href="new_student.php"><img src="../imagenes/iconos/add_student.png" /><br />Crear Nuevo Estudiante</a>
                </div>
                <div id="icon">
                    <a href="publicar_wall.php"><img src="../imagenes/iconos/publicar.png" /><br />Publicar Muro</a>
                </div>
			</fieldset>
				

<?php

	include('../down.php');

?>