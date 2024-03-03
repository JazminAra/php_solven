<?php
	include('../up-osi.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#campcod").change(function(){  
            codalumn =  $(this).val();               
            console.log(codalumn);
                    $.ajax({
                                type: 'ajax',
                                method: 'POST',
                                url: 'MLwebservice.php',
                                datatype: 'json',
                                data: {codalumno:  codalumn},
                                success: function(data)
                                {                                                                          
                                    var obj = jQuery.parseJSON(data); 
                                    console.log(obj);
                                    $('#campape').val(obj.per_apellidos);                                        
                                    $('#campnom').val(obj.per_nombres);  
                                    $('#campdir').val(obj.per_direccion);  
                                    $("#campsexh").removeAttr('checked');  
                                    $("#campsexm").removeAttr('checked');  
                                    if(obj.per_sexo == 'M' || obj.per_sexo == '1'){                                        
                                        $('#campsexh').attr('checked', 'checked');
                                    }else{
                                        $('#campsexm').attr('checked', 'checked');
                                    }       
                                    $("#combox option").removeAttr('selected');                                                       
                                    $("#combox option").removeAttr('selected');
                                    switch (obj.sed_nombre) { 
                                        case "TRUJILLO":                                            
                                            $("#combox option[value='1']").attr("selected",true); 
                                            break;
                                        case "VALLE JEQUETEPEQUE":   
                                            $("#combox option[value='2']").attr("selected",true);                                           
                                            break;
                                        case "HUAMACHUCO": 
                                            $("#combox option[value='4']").attr("selected",true);                                           
                                            break;
                                        case "SGTO. DE CHUCO":     
                                            $("#combox option[value='6']").attr("selected",true); 
                                            break;
                                        case "SANTIAGO DE CHUCO": 
                                            $("#combox option[value='6']").attr("selected",true); 
                                            break;
                                    } 
                                    switch (obj.escuela) { 
                                        case 'ADMINISTRACION':
                                        $("#combox option[value='esc_admin']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA AGRICOLA':
                                        $("#combox option[value='esc_agrico']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA AGROINDUSTRIAL':
                                        $("#combox option[value='esc_agroin']").attr("selected",true); 
                                        break;
                                        case 'AGRONOMIA':
                                        $("#combox option[value='esc_agron']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA AMBIENTAL':
                                        $("#combox option[value='esc_ambi']").attr("selected",true); 
                                        break;
                                        case 'ANTROPOLOGIA ':
                                        $("#combox option[value='esc_antro']").attr("selected",true); 
                                        break;
                                        case 'ARQUEOLOGIA':
                                        $("#combox option[value='esc_arqu']").attr("selected",true); 
                                        break;
                                        case 'ARQUITECTURA Y URBANISMO':
                                        $("#combox option[value='esc_arqurb']").attr("selected",true); 
                                        break;
                                        case 'CIENCIAS BIOLOGICAS':
                                        $("#combox option[value='esc_biol']").attr("selected",true); 
                                        break;
                                        case 'CIENCIAS DE LA COMUNICACION':
                                        $("#combox option[value='esc_cccc']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA CIVIL':
                                        $("#combox option[value='esc_civil']").attr("selected",true); 
                                        break;
                                        case 'CONTABILIDAD Y FINANZAS':
                                        $("#combox option[value='esc_conta']").attr("selected",true); 
                                        break;
                                        case 'DERECHO Y CIENCIAS POLITICAS':
                                        $("#combox option[value='esc_dere']").attr("selected",true); 
                                        break;
                                        case 'ECONOMIA':
                                        $("#combox option[value='esc_econ']").attr("selected",true); 
                                        break;
                                        case 'ENFERMERIA': 
                                        $("#combox option[value='esc_enfer']").attr("selected",true); 
                                        break;
                                        case 'ESTADISTICA':
                                        $("#combox option[value='esc_esta']").attr("selected",true); 
                                        break;
                                        case 'ESTOMATOLOGIA':
                                        $("#combox option[value='esc_esto']").attr("selected",true); 
                                        break;
                                        case 'FARMACIA Y BIOQUIMICA':
                                        $("#combox option[value='esc_farm']").attr("selected",true); 
                                        break;
                                        case 'FISICA':
                                        $("#combox option[value='esc_fisi']").attr("selected",true); 
                                        break;
                                        case 'HISTORIA':
                                        $("#combox option[value='esc_histo']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA INDUSTRIAL':
                                        $("#combox option[value='esc_indu']").attr("selected",true); 
                                        break;
                                        case 'INFORMATICA':
                                        $("#combox option[value='esc_info']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA DE MATERIALES':
                                        $("#combox option[value='esc_ingmat']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA QUIMICA':
                                        $("#combox option[value='esc_ingquim']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION INICIAL':
                                        $("#combox option[value='esc_inic']").attr("selected",true); 
                                        break;
                                        case 'MATEMATICAS':
                                        $("#combox option[value='esc_mate']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA MECANICA':
                                        $("#combox option[value='esc_meca']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA MECATRONICA':
                                        $("#combox option[value='esc_mecatro']").attr("selected",true); 
                                        break;
                                        case 'MEDICINA':
                                        $("#combox option[value='esc_med']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA METALURGICA':
                                        $("#combox option[value='esc_meta']").attr("selected",true); 
                                        break;
                                        case 'MICROBIOLOGIA Y PARASITOLOGIA':
                                        $("#combox option[value='esc_micro']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA DE MINAS':
                                        $("#combox option[value='esc_mina']").attr("selected",true); 
                                        break;
                                        case 'BIOLOGIA PESQUERA':
                                        $("#combox option[value='esc_pesq']").attr("selected",true); 
                                        break;
                                        case 'CIENCIA POLITICA Y GOBERNABILIDAD':
                                        $("#combox option[value='esc_polgob']").attr("selected",true); 
                                        break;
                                        case 'CIENCIAS POLITICAS Y GOBERNABILIDAD':
                                        $("#combox option[value='esc_polgob']").attr("selected",true); 
                                        break;
                                        case 'POSTGRADO':
                                        $("#combox option[value='esc_post']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION PRIMARIA':
                                        $("#combox option[value='esc_prim']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION SECUNDARIA':
                                        $("#combox option[value='esc_sec']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION  SECUNDARIA -  CIENCIAS DE LA MATEMATICA':
                                        $("#combox option[value='esc_sec_ccmm']").attr("selected",true); 
                                        break;
                                        case 'ESC. EDUC. SEC: ESP. CIENCIAS MATEMATICAS':
                                        $("#combox option[value='esc_sec_ccmm']").attr("selected",true); 
                                        break;
                                        case 'ESC. EDUC. SEC. ESP. FISICA, QUIMICA Y BIOLOGIA':
                                        $("#combox option[value='esc_sec_cnfqb']").attr("selected",true); 
                                        break;
                                        case 'ESC. EDUC. SEC. ESP. FILOSOFIA, PSICOLOGIA Y CC. SOCIALES':
                                        $("#combox option[value='esc_sec_fpcs']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION  SECUNDARIA -  HISTORIA Y GEOGRAFIA':
                                        $("#combox option[value='esc_sec_hyg']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION  SECUNDARIA -  IDIOMAS':
                                        $("#combox option[value='esc_sec_idio']").attr("selected",true); 
                                        break;
                                        case 'EDUCACION  SECUNDARIA -  LENGUA Y LITERATURA': 
                                        $("#combox option[value='esc_sec_lyl']").attr("selected",true); 
                                        break;
                                        case 'INGENIERIA DE SISTEMAS':
                                        $("#combox option[value='esc_siste']").attr("selected",true); 
                                        break;
                                        case 'TRABAJO SOCIAL':
                                        $("#combox option[value='esc_trasoc']").attr("selected",true); 
                                        break;
                                        case 'TURISMO':
                                        $("#combox option[value='esc_turis']").attr("selected",true); 
                                        break;
                                        case 'ZOOTECNIA':
                                        $("#combox option[value='esc_zoo']").attr("selected",true); 
                                        break;
                                    }                                                                                                 
                                
                                }
                            });   
                });

})
</script>
        <div id="submenu">
            <a href="new_student.php">Crear Nuevo Estudiante</a>
        </div>
        <!-- FIN MENU -->
	    <div id="cuerpo">
			<div id="titulo">
				<dir id="tituloin">
					<a>Crear Nuevo Usuario</a>
				</dir>
			</div>
			
            <div id="stream-msn">
                <a>LLENAR NOMBRES Y APELLIDOS CON MAYUSCULAS</a>
            </div>
            
            <fieldset>			
    			
    			<?php				
    				include('../conexion/conexion.php');
    				$link = Conectarse();
    			?>
    			
  			<form action="new_student_insert.php" method="POST" onSubmit="return Valida(this);" >
			
				<!-- Aqui colocaremos todos los Datos del Alumno-->
				<fieldset>
					<legend>
						<a>Datos Personales</a>
					</legend>
	
					<div id="madre">
						<div id="izquierda">
							<a>Codigo Carnet</a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha">
							<input class="campo" type="text" name="codigo" value="" onkeyup = "student(event)" id="campcod">
							<div id="DivDestino" ></div><br />
						</div>	
					</div>					
					<div id="madre">
						<div id="izquierda"><a>Apellidos </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha"><input class="campo" type="text" name="apellido" value="" id="campape"/><br /></div>		
					</div>	
					<div id="madre">
						<div id="izquierda"><a>Nombres </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha"><input class="campo" type="text" name="nombre" value="" id="campnom"/><br /></div>		
					</div>
					
					
					
															
					<div id="madre">
						<div id="izquierda"><a>Escuela </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha">
							<select class="combo" name="escuela" id="combox" onchange="SeleccionandoCombo(this);">
								<?php
									
									$sql = "SELECT * FROM escuela; ";	
							  		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
							  		echo '<option value="null" >Seleccione Escuela</option>';	
									  
									while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
										echo '<option value="'.$row["id_escuela"].'">'.$row["esc_nombre"].'</option>';															
								?>
							</select>
						<br />
						</div>		
					</div>															
					<div id="madre">
						<div id="izquierda"><a>Sexo </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha">
							<input type="radio" name="sexo" value="H" id="campsexh"/>Hombre
							<input type="radio" name="sexo" value="M" id="campsexm"/>Mujer
						</div>		
					</div>
                    <div id="madre">
						<div id="izquierda"><a>Sede </a>
							<a style="color:#f64141; font-size:12px;">(*)</a><br /></div>					
						<div id="derecha">
							<select class="combo" name="sede" id="combox" onchange="SeleccionandoCombo(this);">
								<?php
									
									$sql = "SELECT * FROM sede; ";	
							  		$result = mysqli_query($link,$sql) or die("La siguiente consulta contiene ");
							  		echo '<option value="null" >Selecione Sede</option>';	
									  
									while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
										echo '<option value="'.$row["id_sede"].'">'.$row["sed_nombre"].'</option>';															
								?>
							</select>
						<br />
						</div>		
					</div>						
					<div id="madre">
						<div id="izquierda"><a>Domicilio:</a><br /></div>					
						<div id="derecha"><input class="campo" type="text" name="domicilio" value="" id="campdir"/><br /></div>		
					</div>										
						
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
				

<?php

	include('../down.php');

?>