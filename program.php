<?php
include("php/look.php");
include("php/funcvarprog.php");
//error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <!-- Implementando accesibibildad (compatibilidad) metadatos y modelo de pagina -->
    <head>
        <!-- Metadatos basicos de cabecera -->
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> <!-- Para HTML4-->
        <meta charset="UTF-8" /> <!-- Para HTML5-->
        <meta name="viewport" content="width=device-width, initial-scale=1" />        
        <title>Programa CompuLG</title>
        <link href="http://www.iconj.com/icon.php?pid=sz8zcy10pc" rel="shortcut icon" />
        <meta name="description" content="Programa CompuLG" />
	    <meta http-equiv="content-language" content="es" />
        <!-- link rel="canonical" href="index.html" / -->
        <!-- rel canonical to change in publish <link rel="canonical" href="https://luisgabrielhernandez.tk/index.html" /> -->
        <meta itemprop="name" content="Programa CompuLG"/>
        <meta itemprop="description" content="Programa CompuLG" />
        <meta itemprop="image" content="https://i.imgur.com/d7dL3sY.jpg" />
        <!-- Metadatos keywords (Palabras clave buscadores) -->
        <meta name="keywords" content="Programa CompuLG" />
        <meta name="description" content="Programa CompuLG" />
        <meta name="author" content="Luis Gabriel Hernandez Valderrama" />
        <!-- Para refrescar las paginas, util al consultar info online no usado aquí <meta http-equiv="refresh" content="30" /> -->
        <!-- libreria y estilo bottstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- Estilo para imagenes de contacto >
        <link rel="stylesheet" href="https://luisgabrielhernandez.tk/tdsena/css/library.css" /-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Estilos modificados para esta plantilla y su adaptacion -->
        <link rel="stylesheet" href="program.css" />
        <!-- para llenado y respuesta interactiva -->
        <script src="https://www.w3schools.com/lib/w3.js"></script>
    </head>
    <body>
        <!-- inicio cabecera -->
        <div class="hdcont">          
                <!-- Menu botones laterales derecha -->
                <div class="boton_share_contain">
                    <a href="php/salirlg.php" id="btn_salir_flotante">
                        <img class="img_share" src="https://i.imgur.com/g8HotJA.jpg" alt="Salir" title="Salir" /></a>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://wa.me/573154383999" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/m30McN6.png" alt="WhatsApp" title="Enviar Mensaje WhatsApp" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="tel:+573154383999" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/Y6gZu6o.png" alt="Llamar" title="Llamar" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="mailto:contacto@compulg.site" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/uNc2WIL.png" alt="Enviar Correo" title="Enviar Correo" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://m.me/CompuLG158" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/xrfPu0N.png" alt="Enviar Mensaje Mesenger" title="Enviar Mensaje Mesenger" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://www.facebook.com/CompuLG158/" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/Jn9cpwD.png" alt="Ver pagina Facebook" title="Ver pagina Facebook" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://maps.app.goo.gl/xpCge" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/MYPDtox.png" alt="Como llegar" title="Como llegar" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://www.linkedin.com/in/luisga158" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/sUc8hac.png" alt="Perfil LinkedIn" title="Perfil LinkedIn" /></a><br/></div>
                    <div style="position: relative; margin-top: 10px;">
                        <a href="https://twitter.com/CompuLGHV" target="_blank" style="color:#FFFFFF;"><img class="img_share" src="https://i.imgur.com/nyRGyLn.png" alt="Perfil de Twitter" title="Perfil de Twitter" /></a><br/></div>
                </div>
                <!-- Menu derecho, Titulo cabecera e imagen de logo -->
                <header>
                    <span class="hdclgttl">CompuLG - Todo en Computadores</span>
                    <span class="hdclgltlttl">CompuLG</span>
                    <img src="https://i.imgur.com/Ik1TAEA.png" alt="logo de compulg" class="hdclg" />
                </header>
            </div><br /><br />
        <!-- fin cabecera -->
        <!-- inicio de contenido interactivo -->
        <!-- Script para acciónes sobre el botón con id=boton y actualizamos el div con id=capa -->
        <!-- Este código php permite modificar el script de reaccion del menú -->
        <!-- listdblcl es el valor seleccionado por Ver Tabla -->
        <?php
            if (isset($_POST["listdblcl"])){
                sriptmenun(1);
            } else {
                sriptmenun(0);
            }
        ?>		
        <!-- div principal class="progcont" que contiene la vista de programa -->
        <div class="progcont">
            <!-- div menu class="mnprog" id="botones" que contiene los botones que interactuan -->
            <div class="mnprog" id="botones">
                <?php
                    $nlcl = 0;
                    if (isset($_POST["mnbtnsn"])){ /* Queda la opcion abierta para cambiar el menu de botones con el parametro mnbtnsn */
                        $nlcl = $_POST["mnbtnsn"];
                    }
                    btnsmenun($nlcl);
                ?>
            </div><br />
            <!-- div form id="capa" para contenido dinamico -->
            <div id="capa" class="capast">
                <?php
                    if (isset($_POST["Numid"])){
                        if (isset($_POST["q"])){
                            $q = $_POST["q"]; 
                            if ($q == 0) {
                                include_once("php/CProg.php");
                                $id = $_POST['Numid'];
                                $objprg = new CProg('infrm','repovisita',$id); 
                            }
                        }
                    }
                    if (isset($_POST["Formarr"])){
                        include_once("php/CProg.php");
                        $id = $_POST['Formarr'];
                        $objprg = new CProg('infrm','creatercero',$id); 
                    }   
                ?>
            </div>
            <!-- div form id="capastscrl" para contenido con scrool el código php permite modificar el contenido -->
            <!-- listdblcl es el valor seleccionado por Ver Tabla -->
            <div id="capastscrl" class="capastscrl">
                <?php
                    if (isset($_POST["listdblcl"])){
                        include_once("php/Cobjdb.php");
                        include("config.php");
                        $tblnm = $_POST['listdblcl'];
                        $objtnm = new Cobjdb($tblnm, $database, $server, $db_user, $db_pass);
                        $objtnm->showrCObjeto();
                    }
                ?>
            </div>
        </div>
</body>
</html>