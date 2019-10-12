<?php 
//Reanudamos la sesión 
session_start();
$_SESSION["autentica"] = "NOP";
//Literalmente la destruimos 
session_destroy(); 
//Redireccionamos a index.php (al inicio de sesión) 
echo "<script>alert('Saliendo del programa. A cerrado sesion con exito.');";
echo "location.href = '../index.html';</script>";
?>