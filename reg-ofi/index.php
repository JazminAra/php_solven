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
                
                echo '</div>';
            }
            
            
            ?>
			
			<!-- Aqui colocaremos todos los Datos del Alumno-->
			<fieldset>
				<div id="icon">
                    <a href="reg_mor.php"><img src="../imagenes/iconos/reg_mor.png" /><br />Registrar Moroso</a>
                </div>
                <div id="icon">
                    <a href="new_mor.php"><img src="../imagenes/iconos/add_user.png" /><br />Crear Nuevo Usuario</a>
                </div>
                <div id="icon">
                    <a href="des_mor.php"><img src="../imagenes/iconos/user_check.png" /><br />Desmarcar Moroso</a>
                </div>

			</fieldset>
				

<?php

	include('../down.php');

?>