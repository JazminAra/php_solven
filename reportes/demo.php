<?php

	
	
	$cervezas=$_POST["primero"]; 

   	//recorremos el array de cervezas seleccionadas. No olvidarse q la primera posición de un array es la 0 

   	for ($i=0;$i<count($cervezas);$i++) 
      	 { 
      	 echo "<br> Select2 " . $i . ": " . $cervezas[$i]; 
      	 } 
	
?>