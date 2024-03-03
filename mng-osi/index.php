<?php
	include('../up-osi.php');
?>

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
					<a>Administrar</a>
				</dir>
			</div>
			
			
			<!-- Aqui colocaremos todos los Datos del Alumno-->
			<fieldset>
				<div id="icon">
                    <a href="s_hist.php"><img src="../imagenes/iconos/search.png" /><br />Buscar Historial</a>
                </div>
                <div id="icon">
                    <a href="s_mor.php"><img src="../imagenes/iconos/search_user.png" /><br />Mostrar Morosos</a>
                </div>
                <div id="icon">
                    <a href="s_usu.php"><img src="../imagenes/iconos/users.png" /><br />Usuarios</a>
                </div>
                <div id="icon">
                    <a href="s_ava.php"><img src="../imagenes/iconos/search_avanced.png" /><br />Busqueda Avanzada</a>
                </div>
			</fieldset>

<?php

	include('../down.php');

?>