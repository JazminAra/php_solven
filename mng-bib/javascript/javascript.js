
//Validacion del Alumno

function createRequestObject()
{
	var peticion;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer")
	{
		peticion = new ActiveXObject("Microsoft.XMLHTTP");
    }
	else
	{
		peticion = new XMLHttpRequest();
	}
	return peticion;
}

var http = new Array();

function ObtDatos(url)
{
	var act = new Date();
    http[act] = createRequestObject();
    http[act].open('get', url);
    http[act].onreadystatechange = function() 
								   {
								   		if (http[act].readyState == 4) 
										{
            								if (http[act].status == 200 || http[act].status == 304) 
											{
  												var texto
												texto = http[act].responseText
                    							var DivDestino = document.getElementById("DivDestino");
                    							DivDestino.innerHTML = "<div id='error'>"+texto+"</div>";                
											}
										}
								   }
	http[act].send(null);
}

function compUsuario(Tecla) 
{
	Tecla = (Tecla) ? Tecla: window.event;
    input = (Tecla.target) ? Tecla.target : 
    Tecla.srcElement;
    if (Tecla.type == "keyup") 
	{
		var DivDestino = document.getElementById("DivDestino");
        DivDestino.innerHTML = "<div></div>";
        if (input.value) 
		{
			ObtDatos("new_mor_login.php?q=" + input.value);
        } 
     }
}

function student(Tecla) 
{
	Tecla = (Tecla) ? Tecla: window.event;
    input = (Tecla.target) ? Tecla.target : 
    Tecla.srcElement;
    if (Tecla.type == "keyup") 
	{
		var DivDestino = document.getElementById("DivDestino");
        DivDestino.innerHTML = "<div></div>";
        if (input.value) 
		{
			ObtDatos("new_student_login.php?q=" + input.value);
        } 
     }
}




function ValidaUsuario( formulario ) 
{
	
	//-----------------------------------Validacion DNI
	if (formulario.dni.value.length != 8 ) 
	{
		alert("El DNI debe tener 8 digitos.");
		formulario.dni.focus();
		return (false);
	}
    
    
    //---------------------------------Validacion Tipo
	var s="no";

	for ( var i = 0; i < formulario.tipo.length; i++ ){
		if ( formulario.tipo[i].checked ){
			s= "si";
			break;
		}
	}
	if ( s == "no" ){
		alert( "Seleccione una Opcion en el Campo \"Eligir Opción\"" );
		return (false);
	}

	//-----------------------------------Validacion Apellidos
	if (formulario.apellido.value.length < 4) 
	{
		alert("Escriba por lo menos 4 caracteres en el \"Apellidos\" ");
		formulario.apellido.focus();
		return (false);
	}
	if (formulario.apellido.value.length > 40) 
	{
		alert("Los Apellidos del Alumno no pueden tener mas de 40 caracteres ");
		formulario.apellido.focus();
		return (false);
	} 
		
	
	//---------------------------------Validacion Nombres	
	if (formulario.nombre.value.length < 4) 
	{
		alert("Escriba por lo menos 4 caracteres en el \"Nombre\" ");
		formulario.nombre.focus();
		return (false);
	}
	if (formulario.nombre.value.length > 40) 
	{
		alert("Los Nombres del Alumno no pueden tener mas de 40 caracteres ");
		formulario.nombre.focus();
		return (false);
	} 
	
   	
   	
   	//---------------------------------Validacion Sexo
	var s="no";

	for ( var i = 0; i < formulario.sexo.length; i++ )
	{
		if ( formulario.sexo[i].checked )
		{
			s= "si";
			break;
		}
	}
	if ( s == "no" )
	{
		alert( "Seleccione una Opcion en el Campo \"Sexo\"" );
		return (false);
	}
	
	//---------------------------------Validacion Domicilio	
	if (formulario.domicilio.value.length > 50 ) 
	{
		alert("El Domicilio del Alumno no puede tener mas de 50 caracteres");
		formulario.domicilio.focus();
		return (false);
	}	


 	
	 		
	return true;
}



// Validacion del Formulario

function Valida( formulario ) 
{
 	//---------------------------------Validacion Signatura	
	if (formulario.signatura.value.length == 0) 
	{
		alert("Signatura del Libro esta Vacio");
		formulario.signatura.focus();
		return (false);
	}
	if (formulario.signatura.value.length > 20) 
	{
		alert("La Signatura del Libro no puede tener mas de 20 caracteres");
		formulario.signatura.focus();
		return (false);
	}  	 
	 
	//---------------------------------Validacion N Ingreso	
	if (formulario.numeracion.value.length > 20 ) 
	{
		alert("El Numero de Ingreso no puede tener mas de 20 caracteres");
		formulario.numeracion.focus();
		return (false);
	}	
		  
 	//---------------------------------Validacion Titulo
	if (formulario.titulo.value.length < 4 ) 
	{
		alert("Escriba por lo menos 4 caracteres en el \"Titulo del Libro\" ");
		formulario.titulo.focus();
		return (false);
	}
	if (formulario.titulo.value.length > 400) 
	{
		alert("El Titulo del Libro no puede tener mas de 400 caracteres");
		formulario.titulo.focus();
		return (false);
	} 		 	
		
 	//---------------------------------Validacion Autor
	if (formulario.autor.value.length < 4 ) 
	{
		alert("Escriba por lo menos 4 caracteres en el \"Autor del Libro\" ");
		formulario.autor.focus();
		return (false);
	}
	if (formulario.autor.value.length > 45 ) 
	{
		alert("El Autor del Libro no puede tener mas de 45 caracteres");
		formulario.autor.focus();
		return (false);
	}
	
	//---------------------------------Validacion Fuente
	if (formulario.fuente.value.length > 50 ) 
	{
		alert("La Fuente del Libro no puede tener mas de 50 caracteres");
		formulario.fuente.focus();
		return (false);
	}			
		
 	//---------------------------------Validacion Fecha
	if (formulario.fecha.value.length == 0 ) 
	{
		alert("La \"Fecha\" de Prestamo no puede estar vacio..!!");
		formulario.fecha.focus();
		return (false);
	}
	
	//---------------------------------Validacion Observacion
	if (formulario.observacion.value.length > 100 ) 
	{
		alert("La Observacion no puede tener mas de 100 caracteres");
		formulario.observacion.focus();
		return (false);
	}
	
	return true;
}







