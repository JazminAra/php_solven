<? 
if (!$_POST)
{ 
?> 
	<form action="prueba.php" method="POST"> 
	    Nombre: <input type="text" name="nombre"><br> 
	    Apellidos: <input type="text" name="apellidos"><br> 
	    Email: <input type="text" name="email"> <br> 
	    Cerveza: <br> 
	    <select multiple name="cerveza[]"> 
	       <option value="SanMiguel">San Miguel</option> 
	       <option value="Mahou">Mahou</option> 
	       <option value="Heineken">Heineken</option> 
	       <option value="Carlsberg">Carlsberg</option> 
	       <option value="Aguila">Aguila</option> 
	    </select><br> 
	    <input type="submit" value="Enviar datos!" > 
	</form> 
	<? 
}
else
{ 

   	echo "Nombre: ". $_POST["nombre"]; 
   	echo "<br>Apellidos: ". $_POST["apellidos"]; 
   	echo "<br>E-mail: ". $_POST ["email"];
   	
   	   
	if(!empty($_POST["cerveza"])) 
	{
		$cervezas=$_POST["cerveza"]; 

	   	//recorremos el array de cervezas seleccionadas. No olvidarse q la primera posici�n de un array es la 0 
	
	   	for ($i=0;$i<count($cervezas);$i++) 
	    { 
	    	 echo "<br> Cerveza " . $i . ": " . $cervezas[$i]; 
	    } 		
	}

	
   	



} 
?>