<?php    
	include('../up-osi.php');
?>

        <div id="submenu">
            <a href="new_student.php">Crear Nuevo Estudiante</a>
            <a href="publicar_wall.php">Publicar Muro</a>
        </div>
        <!-- FIN MENU -->

        <script type="text/javascript" src="../librerias/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
          	tinyMCE.init({
          		// General options
           		mode : "textareas",
           		theme : "advanced",
           		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
           
           		// Theme options
           		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect",
           		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
           		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
           		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
           		theme_advanced_toolbar_location : "top",
           		theme_advanced_toolbar_align : "left",
           		theme_advanced_statusbar_location : "bottom",
           		theme_advanced_resizing : true,
           
           		// Example word content CSS (should be your site CSS) this one removes paragraph margins
           		content_css : "css/word.css",
           
          		// Drop lists for link/image/media/template dialogs
           		template_external_list_url : "lists/template_list.js",
           		external_link_list_url : "lists/link_list.js",
           		external_image_list_url : "lists/image_list.js",
           		media_external_list_url : "lists/media_list.js",
           
           		// Replace values for the template plugin
           		template_replace_values : {
           			username : "Some User",
           			staffid : "991234"
           		}
           	});
        </script>
        
        
	    <div style="margin-top:8px;">
			<div id="titulo">
				<dir id="tituloin">
					<a>Publicar en el Muro</a>
				</dir>
			</div>
            
            <fieldset>			
            
      			<form action="publicar_wall_insert.php" method="POST" onSubmit="return Valida(this);" >
    			
    				<!-- Aqui colocaremos todos los Datos del Alumno-->
    				<fieldset>
    					<legend>
    						<a>Datos Personales</a>
    					</legend>
                        
                        <p>Escriba el mensaje que desea colocar en pantalla de inicio del Sistema</p>
                        
                        <textarea id="elm1" name="editor" rows="15" cols="80" style="width: 100%"></textarea>
                        
                        <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                    	
    				</fieldset>	
    				<!--  Capa para los botones principales -->
        			<div id="capaboton">
        				<div id="capabotonhija">
        					<input type="reset" value="Limpiar" name="limpiar" class="limpiar" />
        					<input type="button" value="Cancelar" name="cancelar" class="cancelar" 
        						   onClick="location.href='../demo/inicio-osi.php'" />
        					<input type="submit" value="Registrar" name="registrar" class="aceptar" />	
        				</div>
        						
        			</div>			
     			</form>	
				
			</fieldset>
            
        </div>    
				

<?php

	include('../down.php');

?>

