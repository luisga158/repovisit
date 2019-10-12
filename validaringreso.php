<?php 
include("config.php");
$tituloPage = "Validando ingreso";
/* 
* Inicia variables para validar usuario en blanco
* 1.- Paso 1 para reducir ataques
*/
$usrlcl = $passlcl = '';
/*************************************************************************************** 
* Conexion con el servidor lcl 
* config.php determina los datos y por talto la conexion
*****************************************************************************************/
$link = mysqli_connect($server, $db_user, $db_pass);
// Seleccion de Base de Datos
mysqli_select_db($link, $database);
/*************************************************************************************** 
*
* Conexion externa
* usando el mismo config con variables diferentes
* Asi:                                      $link = mysqli_connect($serverext, $db_userext, $db_passext); 
* y para la seleccion de Base de Datos:     mysqli_select_db($link, $databaseext);      
*
*****************************************************************************************/
/* 
* Limpia adtos recibidos y los almacena en las variables iniciadas en blanco al principio
* 2.- Paso 2 para reducir ataques, test_imput, es la función que limpia los datos, reduciendo ataques.
*/ 
$usrlcl = test_input($_POST['Usuarioin']);
$passlcl = test_input($_POST['Passin']);
//Toma todos los datos de la tabla usuarios
$result = mysqli_query($link, "SELECT * FROM usuarios WHERE Usuario='$usrlcl'");
//$result = mysqli_query($link, "SELECT * FROM usuarios WHERE Usuario='$_POST[Usuarioin]'");

if ($fila = mysqli_fetch_array($result)){
	if ($fila['Pass'] == $passlcl) {
		// El Usuario y su contrasena son correctas
        session_start();
        $_SESSION["autentica"] = "SIP";
        echo "<script>alert('Bienvenido. A ingresado con éxito.');";
        echo "location.href = 'program.php';</script>";
        //echo "location.href = 'play.php';</script>";
    } else {
        $_SESSION["autentica"] = "NOP";
        echo "<script>alert('La contraseña no corresponde. Regrese para Intentar de nuevo.');";
        echo "location.href = 'index.html';</script>";
    }
} else {
    $_SESSION["autentica"] = "NOP";
    echo "<script>alert('El Usuario no se encuentra creado. Regrese para Intentar de nuevo.');";
    echo "location.href = 'index.html';</script>";
}
/***************************************************************************************
* Para evitar el envío de datos invasores, scripts de ataque y otros:
* La funcion test_input realiza tres tareas:
* 1.- Con trim quita espacios innecesarios
* 2.- Con stripslashes quita barras invertidas (\)
* 3.- Con htmlspecialchars convierte caracteres usados en ataques en su código html
*       haciendolos inofensivos.
***************************************************************************************/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>