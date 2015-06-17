<?php
$conexion = mysqli_connect("localhost", "amphpziw_hermes", "Hermesinteligente5", "amphpziw_hermesinteligente");
/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

/* revisar existencia del usuario con la contraseña en la bd */
$sqlCmd = "SELECT nombreUsuario,password,email FROM usuario WHERE nombreUsuario LIKE '".mysqli_real_escape_string($conexion, $usuarioEnviado)."' AND password='".mysqli_real_escape_string($conexion, $passwordEnviado)."' LIMIT 1";
$sqlQry = mysqli_query($conexion,$sqlCmd);
if(mysqli_num_rows($sqlQry)>0)
{
$login=1;
}
else
{
$login=0;
}

/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a");
$resultados["generador"] = "Enviado desde metin2imperio.com" ;

/* verifica que el usuario y password concuerden correctamente */
if( $login==1 ){
/*esta informacion se envia solo si la validacion es correcta */
$resultados["mensaje"] = "Validacion Correcta";
$resultados["validacion"] = "ok";

}else{
/*esta informacion se envia si la validacion falla */
$resultados["mensaje"] = "Usuario y password incorrectos";
$resultados["validacion"] = "error";
}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>