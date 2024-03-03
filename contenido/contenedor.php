<?php
	/************* LIMITADORES ********************/
?>

<div id="cuerpo">
	<div id="titulo">
		<dir id="tituloin">
			<a>Home</a>
		</dir>
	</div>

	<fieldset>
	
		<!-- ************* capa izquierda los banners ***********-->
		<div id="inicio-left">
			<a href="http://unitru.edu.pe" title="Pagina Oficial UNT" target="_black" >
				<img src="../imagenes/unt.jpg" />
			</a>
			<a href="http://osi.unitru.edu.pe" title="Oficina de Sistemas e Informatica" target="_black">
				<img src="../imagenes/osi.jpg" />
			</a>
            <div id="reset">
                <fieldset>
                    <a>Se recomienda utilizar el navegador Google Chrome o Mozilla Firefox. </a><br /><br />
                    <a href="http://www.mozilla.org/es-ES/firefox/new/" target="_blank"><img src="../imagenes/mozilla.gif" width="50" height="50" title="Descargar Mozilla" /></a>
                    <a href="https://www.google.com/chrome/index.html?hl=es" target="_blank"><img src="../imagenes/chrome.gif" width="50" height="50" title="Descargar Chrome" /></a>
                </fieldset>
            </div>
		</div>
		<!-- ************* capa derecha las noticias ***********-->
		<div id="inicio-right">
			<div id="encabezado">
				<div id="header_one">
					<a>Aviso</a>
				</div>
				<div id="header_two">
					<a>SE LES HACE DE CONOCIMIENTO A TODOS LOS DIRECTORES DE BIBLIOTECA QUE EL SISTEMA DE EMISION DEL CERTIFICADO
                    DE NO ADEUDO ESTA VIGENTE A PARTIR DEL DIA LUNES 5 DE MARZO DEL 2012, TAMBIEN INFORMAMOS QUE DURANTE EL PERIODO
                    DE TRANSICION LLEVEN UN CONTROL DETALLADO DE LOS ALUMNOS A QUIEN SE LES EMITIO LA SOLVENCIA. GRACIAS
                </a><br />
				</div>
			</div>
		</div>
		
		<div id="inicio-right">
			<div id="encabezado">
				<div id="header_one">
					<a>Presentacion</a>
				</div>
				<div id="header_two">
					<a>Este Sistema tiene como objetivo principal gestionar el CERTIFICADO DE NO ADEUDO que tramitan lo egresados, profesionales y otros que solicitan el mencionado documento con fines de tramitar: duplicado del carnet de biblioteca, grados y títulos.</a><br />
					<a>La Oficina de Sistemas e InformÃ¡tica (OSI) ha desarrollado esta herramienta web con la finalidad de agilizar los trámites administrativos llevados a cabo por los alumnos ante las bibliotecas y oficinas de la Universidad Nacional de Trujillo.</a>
				</div>
			</div>
		</div>
        
        <!-- COLOCAREMOS LAS ACTUALIZACIONES DE NUESTRO EDITOR -->
        <style type="text/css">
            #msn {
                padding:3px;
                margin-bottom: -1px;
                font-size: 12px;
            }
            
            #msn:hover {
                background: #f1f1f1;
            }
            
        </style>
        <div id="inicio-right">
			<div id="encabezado">
				<div id="header_one">
					<a style="color: #ffac26;">Actualizaciones</a>
				</div>
				<div id="header_two">
					<a>
                <?php
                    include('../conexion/conexion.php');
                    $link = Conectarse();
                    
                    $_sql = "SELECT *, DATE_FORMAT(msn_fecha,'%d/%m/%Y') AS fecha FROM mensaje;";
                    $result = mysqli_query($link,$_sql);
                    
                    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
                        echo '<div id="msn">';
                        echo '&nbsp;&nbsp;<img src="../imagenes/nuevo.gif" class="msn_img">';
                        echo '&nbsp;&nbsp;'.$row['fecha'];
                        echo '&nbsp;&nbsp;&nbsp;'.strip_tags($row['msn_cuerpo']);
                        echo '</div>';
                    }
                    
                    
                    
                ?>
                    </a>
				</div>
			</div>
		</div>	
		
		<!-- ------------------------------------------------------------------------------------ -->
		
    <script src="../javascript/jsCarousel-2.0.0.js" type="text/javascript"></script>
    <link href="../css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />		
    <script type="text/javascript">
        $(document).ready(function() {

            $('#carouselv').jsCarousel({ onthumbnailclick: 
				function(src) { alert(src); }, 
					autoscroll: true, 
					masked: false, 
					itemstodisplay: 3, 
					orientation: 'v' }
			);
            
            $('#carouselh').jsCarousel({ onthumbnailclick: 
				function(src) { alert(src); }, 
					autoscroll: false, 
					circular: true, 
					masked: false, 
					itemstodisplay: 5, 
					orientation: 'h' }
			);
            
            $('#carouselhAuto').jsCarousel({ onthumbnailclick: 
				function(src) {  }, 
					autoscroll: true, 
					masked: true, 
					itemstodisplay: 7, 
					orientation: 'h' }
			);
        });       
        
    </script>
        <div id="demo-right">
            <div id="hWrapperAuto">
                <div id="carouselhAuto">
                     <div>
                        <a href="http://www.admisionunt.com/" target="_black"><img alt="" src="../imagenes/carrusel/admision123.gif" /><br /><span class="thumbnail-text">Admision</span></a>
                     </div>
                     <div>
                        <a href="http://www.reclamaciones.unitru.edu.pe/" target="_black"><img alt="" src="../imagenes/carrusel/lreclamaciones.jpg" /><br /><span class="thumbnail-text">Reclamaciones</span></a>
                     </div>
                     <div>
                      	<a href="http://transparencia.unitru.edu.pe/index2.php" target="_black"><img alt="" src="../imagenes/carrusel/trans.png" /><br /><span class="thumbnail-text">Transparencia</span></a>
                     </div>
                     <div>
                        <a href="http://www.universia.edu.pe/" target="_black"><img alt="" src="../imagenes/carrusel/UNIVERSIA.gif" /><br /><span class="thumbnail-text">Universia</span></a>
                     </div>                          
                     <div>
                        <a href="http://www.bibliotecasunt.unitru.edu.pe/" target="_black"><img alt="" src="../imagenes/carrusel/BIBLIOTECA.gif" /><br /><span class="thumbnail-text">Biblioteca</span></a>
                     </div>
                     <div>
                        <a href="http://www.cepunt.com/" target="_black"><img alt="" src="../imagenes/carrusel/cepunt12.gif" /><br /><span class="thumbnail-text">Cepunt</span></a>
                     </div>
                     <div>
                        <a href="http://www.cidunt.com.pe/" target="_black"><img alt="" src="../imagenes/carrusel/CIDUNT.gif" /><br /><span class="thumbnail-text">Cidunt</span></a>
                     </div>
                     <div>
                        <a href="http://oia.unitru.edu.pe/index.php" target="_black"><img alt="" src="../imagenes/carrusel/convenios.gif" /><br /><span class="thumbnail-text">Convenios</span></a>
                     </div>
                     <div>
                        <a href="http://www.cunnp.edu.pe" target="_black"><img alt="" src="../imagenes/carrusel/cunnp.png" /><br /><span class="thumbnail-text">CUNNP</span></a>
                     </div>           
                     <div>
                        <a href="http://www.aplicaciones.unitru.edu.pe" target="_black"><img alt="" src="../imagenes/carrusel/INTRAUNITRU.gif" /><br /><span class="thumbnail-text">Intranet</span></a>
                     </div>          
                     <div>
                        <a href="http://usee.unitru.edu.pe/" target="_black"><img alt="" src="../imagenes/carrusel/usee.jpg" /><br /><span class="thumbnail-text">USEEt</span>
                     </div>
                     <div>
                        <a href="http://www.virtualeducaperu.org/" target="_black"><img alt="" src="../imagenes/carrusel/ruivep.png" /><br /><span class="thumbnail-text">RUIVE</span></a>
                     </div>
                </div>
                    </div>
                </div>
                <!-- -->
	</fieldset>
 </div>
<?php
	/************** LIMITADORES ******************/
?>
