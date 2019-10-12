<?php 
//Reanudamos la sesión 
@session_start(); 
//Validamos si existe realmente una sesión activa o no 
if($_SESSION["autentica"] != "SIP")
{ 
  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
  echo "<script>alert('Por favor inicie sesión para continuar.');";
  echo "location.href = 'index.html';</script>";
  exit(); 
}
?>