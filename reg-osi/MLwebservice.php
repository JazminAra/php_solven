<?php
$codalumno2 = isset($_POST['codalumno']) ? $_POST['codalumno'] : '';

function wserv_alumno($codalumno){
    $consulta = array('getdatosalumnosuv', 'getdatosalumnosga');
    for($i=0; $i <= 1; $i++){
        $curl[$i] = curl_init();
        $url[$i] = 'https://apps-bkn.unitru.edu.pe/intranet/api/'.$consulta[$i];   
        $options[$i] = array(
            CURLOPT_URL => $url[$i],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{ "codalumno": "'.$codalumno.'" }',
            CURLOPT_HTTPHEADER => array(
            'x-access-token: eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTYyMjcyOTA3NSwiaWF0IjoxNjIyNzI5MDc1fQ.tPwD1MJQ0hi2vXq2dZrmFyBP46onrAC0fDNbb3s04ac',
            'Content-Type: application/json'
            ),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ); 
        curl_setopt_array($curl[$i], $options[$i]);
        $response[$i] = curl_exec($curl[$i]);
        $resp[$i]=json_decode($response[$i]);
        $bool[$i] = $resp[$i]->success;

        if($bool[$i] == true){            
            if($i == 1){
                $per['per_apellidos'] = $resp[$i]->data->per_apellidos; 
                $per['sed_nombre'] = strtoupper($resp[$i]->data->sed_nombre);
                $per['per_direccion'] = $resp[$i]->data->per_direccion;
            } else{               
                $per['per_apellidos'] = $resp[$i]->data->per_apepaterno.' '.$resp[$i]->data->per_apematerno; 
                $per['sed_nombre'] = str_replace("SEDE ", "", strtoupper($resp[$i]->data->sed_descripcion));
                $per['per_direccion'] = $resp[$i]->data->per_direccionlocal;
            } 
            $per['per_nombres'] = $resp[$i]->data->per_nombres;            
            $per['escuela'] = str_replace(" 2018", "",str_replace("ESCUELA DE ", "", str_replace("ESCUELA PROFESIONAL DE ", "",str_replace(array('á', 'é', 'í', 'ó', 'ú'), array('A', 'E', 'I', 'O', 'U'),str_replace(array('Á', 'É', 'Í', 'Ó', 'Ú'), array('A', 'E', 'I', 'O', 'U'), strtoupper($resp[$i]->data->escuela))))));
            $per['per_sexo'] = $resp[$i]->data->per_sexo;                       
        }
        curl_close($curl[$i]);
        
    }
    return $per;
}

$alumno = wserv_alumno($codalumno2);
echo json_encode($alumno);

?>