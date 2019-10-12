<!DOCTYPE html>
<!-- 
        Esta es la inerfaz que nos muestra el contenido deseado en el programa, creando clases y usandolas 
        podemos mejorarla 
-->
<html>
<head>
</head>
<body>
<?php
    include("CProg.php");    
    if ((isset($_GET['op'])) && (isset($_GET['q']))) { 
        $op = $_GET['op']; 
        $q = $_GET['q']; 
        switch ($op){               // inicio case $accion para opcion infrm
            case 'repovisita':
                $objprg = new CProg('infrm',$op,$q); 
                break;
            case 'vertabla':
                $objprg = new CProg('outfrm',$op,$q); 
                break;
            case 'frmsimple':
                include("funcvarprog.php");
                drawSimplFrm(0);
                break;
            case 'verdbsel':
                $objprg = new CProg('showsome',$op,$q); 
                break;
            case 'drwtblinfo':
                $objprg = new CProg('showsome',$op,$q); 
                break;
        }
    }
?>
</body>
</html>