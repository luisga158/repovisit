<?php
/**
 * Description:
 * -. Variables y funciones usadas en el programa
 *
 * @author Gabriel
 */
/*
 * Funciones:
 *
 * sriptmenun($n)   -> Escribe el script del menu variando según $n
 *
 * Constantes 
 * $tpdocar        -> array de tipos de documento
 * $tpperr         -> array de tipos de persona
 * $tertbldet      -> detalle de la tabla de tercero
 * $bdtertblrel    -> relacion de campos de bdter con terceros
 * $gbltertblrel   -> relacion de campos de terglobal con terceros
 *
*/
// array de tipos de documento
$tpdocar = array(
    array('Registro civil de nacimiento',11),
    array('Tarjeta de identidad',12),
    array('Cédula de ciudadanía',13),
    array('Certificado de la Registraduría para sucesiones ilíquidas de personas naturales que no tienen ningún documento de identificación.',14),
    array('Tipo de documento que identifica una sucesión ilíquida, expedido por la notaria o por un juzgado.',15),
    array('Tarjeta de extranjería',21),
    array('Cédula de extranjería',22),
    array('NIT',31),
    array('Identificación de extranjeros diferente al NIT asignado DIAN',33),
    array('Pasaporte',41),
    array('Documento de identificación extranjero',42),
    array('Sin identificación del exterior o para uso definido por la DIAN.',43),
    array('Documento de Identificación extranjero Persona Jurídica',44),
    array('Carné Diplomático: Documento expedido por el Ministerio de Relaciones Exteriores a los miembros de la misiones diplomáticas y consulares, con el que se deben identificar ente las autoridades nacionales',46)
);
// array de tipos de persona
$tpper = array('natural','juridica');
// detalles de la tabla de terceros y relaciones 
$tertbldet = array(
    array('Nombre_Campo','null','tipo','clave','bdter','dirterglobal'),
    array('Marca_temporal','no','timestamp','','',''),
    array('Tipo_de_persona','no','tpter','','origen',''),                                           //1
    array('Tipo_de_documento_de_identidad','no','tpdocar','','',''),
    array('Numero_de_identidad','no','numero','unico','IdTer,nitemp','Nit'),
    array('Nombre_o_Razon_Social','no','texto','','name,emp','RznScl-1erNom,2oNom,1erAp,2oAp'),
    array('Telefonos','si','tels','','tels,telemp',''),
    array('Correo_electronico','si','mail','','mail',''),
    array('Direccion','si','dir','','dir,diremp','Dir'),
    array('Pais','si','pais','','','CodPais'),
    array('Ciudad','si','city','','city','CodMun,CodCiudad'),
    array('Es_Cliente','si','verify','','',''),
    array('Es_Proveedor','si','verify','','',''),
    array('Es_Acreedor','si','verify','','',''),
    array('Primer_Nombre','si','texto','','','1erNom'),
    array('Otros_Nombres','si','texto','','','2oNom'),
    array('Primer_Apellido','si','texto','','','1erAp'),
    array('Otros_Apellidos','si','texto','','','2oAp'),
    array('ICA_Cali','si','verify','','',''),
    array('Forma_de_pago','si','texto','','',''),
    array('Nombre_Representante_Legal','si','texto','','',''),
    array('Tipo_de_Identificacion_Representante_Legal','si','tpdocar','','',''),
    array('No_Identificacion_Representante_Legal','si','numero','','',''),
    array('Campo_Libre_1','si','texto','','',''),
    array('Campo_Libre_2','si','texto','','',''),
    array('Campo_Libre_3','si','texto','','',''),
    array('Campo_Libre_4','si','texto','','',''),
    array('Campo_Libre_5','si','texto','','','')
);
// relacion de campos de bdter con terceros
$bdtertblrel = array(
    array('Numero_de_identidad','IdTer','nitemp'),
    array('Nombre_o_Razon_Social','name','emp'),
    array('Telefonos','tels','telemp'),
    array('Correo_electronico','mail'),
    array('Direccion','dir','diremp'),
    array('Ciudad','city'),
    array('Informativo','origen')
);
// relacion de campos de dirterglobal con terceros
$gbltertblrel = array(
    array('Numero_de_identidad','Nit'),
    array('Primer_Nombre','1erNom'),
    array('Otros_Nombres','2oNom'),
    array('Primer_Apellido','1erAp'),
    array('Otros_Apellidos','2oAp'),
    array('Nombre_o_Razon_Social','RznScl'),
    array('Direccion','Dir'),
    array('Ciudad','CodMun,CodCiudad'),
    array('Pais','CodPais')
);
/**
  * funcion que determina el script del menu:
  *     $n = 1 -> hide capa
  *     $n = 2 -> hide capastscrl 
  * se puede añadir mas opciones y pte crear funcion para dibujar menu de bones según un parametro
**/
function sriptmenun($n){
    echo '<script type="text/javascript">
			$(document).ready(function() {';
    if ($n==0) {
                echo '$("#capastscrl").hide();';
    } else if ($n==1) {
                echo '$("#capa").hide();';
    }
                echo '$("#botoncid").click(function(event) {      // muestra el formulario para introducir un dato
                    $("#capastscrl").hide();                // funcion  para repovisita
                    $("#capa").load("php/am.php?op=frmsimple&q=0");
                    $("#capa").show();					
				});
				$("#botonlbd").click(function(event) {      // btn para mostrar tabla terceros, debe permitir elegir tabla mejorar
                    $("#capastscrl").hide();
                    $("#capa").show();
					$("#capa").load("php/am.php?op=vertabla&q=0");
				});
                $("#botonreld").click(function(event) { // Oculta capas
                    $("#capastscrl").load("");
                    $("#capastscrl").hide();
                    $("#capa").load("");
                    $("#capa").hide();
                });
			});
		</script>
    ';    
}
// funcion que dibuja un conjunto de botones según el valor de ($n)
/* botoncid:      primera funcion para consultar id y procesar el reporte visita
                    carga en capa < php/am.php?op=frmsimple&q=0 >
   botonlbd:      carga en capa < php/am.php?op=vertabla&q=0 >
                    Permite seleccionar una tabla de la bd y la muetras devolviendo el parametro:
                    listdblcl: Usado para mostrar la tabla, mediante un cambio en el script de menu
   botonreld:     Oculta y carga las capas en limpio
 */  
function btnsmenun($n){
    if ($n == 0) {
        echo '<input name="botoncid" id="botoncid" type="button" value="Reporte" /> ';
        echo '<input name="botonlbd" id="botonlbd" type="button" value="Ver Tabla" /> ';
        echo '<input name="botonreld" id="botonreld" type="button" value="Refrescar" /> ';
    }
}
// funcion en proceso para quitar el div infrm de la página y hacerla más dinamica
function drawSimplFrm($q){
    echo '<form class="form" action="program.php" method="POST">';
    echo '<fieldset class="pure-group">';
    echo '<input type="text" maxlength="50" id="Numid" name="Numid" placeholder="Escribe El numero de identificacion:" size="auto" autofocus />';
    echo '<input name="Consultar al tercero" type="submit" value=" Consultar " tabindex="2"  />';
    echo '<input type="text" size="auto" name="q" value="'.$q.'" hidden />';
    echo '</fieldset><br />';
    echo '</form>';
}
// retorna la fecha en formato texto
function fechaTxt($dt){
    $fchtxt = '';
    $fechats = strtotime($dt); //pasamos a timestamp
    switch (date('w', $fechats)){
        case 0: $fchtxt = "Domingo"; break;
        case 1: $fchtxt = "Lunes"; break;
        case 2: $fchtxt = "Martes"; break;
        case 3: $fchtxt = "Miercoles"; break;
        case 4: $fchtxt = "Jueves"; break;
        case 5: $fchtxt = "Viernes"; break;
        case 6: $fchtxt = "Sabado"; break;
    }
    setlocale(LC_ALL,"es_ES@euro","es_CO","esp");
    $fecha = strftime("%d de %B de %Y", strtotime($dt));
    $fchtxt = $fchtxt.' '.$fecha;
    return $fchtxt;
}

// -----------------------
function sendMail($t,$rta,$rta2){
$to = $t;
$subject = "Reporte de visita de CompuLG";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: servicios@compulg.site" . "\r\n";
 
$cont = "
<html>
<head>
<title>Reporte de visita</title>
</head>
<body>
<h1>Reporte de visita de CompuLG</h1>
<p>Reporte de visita - Cuenta de cobro y dem&aacute;s adjuntos necesarios</p>
<p>Es conveniente permitir ver las imagenes, ya que tienen solucion a posibles dudas.</p>
<p>Sin embargo si ya conoce los detalles es innecesario.</p>
<p>Los links descargaran los documentos en su computadora, al dar clic en ellos.</p>
<p>Pueden mostrar una advertencia de enlace sospechoso como muestra la imagen siguiente, dar clic en siguiente por favor.</p>
<img src='https://i.imgur.com/emUEf6g.png' title='Paso 0' /><br>
<p>Los documentos son generados en html por lo que de ser necesario debe:</p>
<p>1.- Habilitar edicion, como muestra la siguiente imagen </p>
<img src='https://i.imgur.com/erFWOK5.png' title='Paso 1' /><br>
<p>2.- Cambiar el modo de vista, como muestra la siguiente imagen, esto permite ver el documento en formato normal. </p>
<img src='https://i.imgur.com/o8CaiNr.png' title='Paso 2' /><br>
<a href='https://lg.compulg.site/prog/php/".$rta."' target='_blank' >Reporte de Visita</a><br>
<a href='https://lg.compulg.site/prog/php/".$rta2."' target='_blank' >Cuenta de cobro</a><br>
<a href='https://lg.compulg.site/prog/php/docs/Rut2019.pdf' target='_blank' >Rut</a><br>
<a href='https://lg.compulg.site/prog/php/docs/Certificadonodeclarante.docx' target='_blank' >Certificado de no declarante</a><br>
</body>
</html>";
$message = $cont;    
// echo $message;
mail($to, $subject, $message, $headers);    
}
// Conversion de numero a letras
function unidad($numuero){
    switch ($numuero) {
        case 9: { $numu = "NUEVE"; break; }
        case 8: { $numu = "OCHO"; break; }
        case 7: { $numu = "SIETE"; break; }
        case 6: { $numu = "SEIS"; break; }
        case 5: { $numu = "CINCO"; break; }
        case 4: { $numu = "CUATRO"; break; }
        case 3: { $numu = "TRES"; break; }
        case 2: { $numu = "DOS"; break; }
        case 1: { $numu = "UNO"; break; }
        case 0: { $numu = ""; break; }
    }
    return $numu;
}

function decena($numdero){
    if ($numdero >= 90 && $numdero <= 99) {
        $numd = "NOVENTA ";
        if ($numdero > 90)  $numd = $numd."Y ".(unidad($numdero - 90));
    } else if ($numdero >= 80 && $numdero <= 89) {
        $numd = "OCHENTA ";
        if ($numdero > 80) $numd = $numd."Y ".(unidad($numdero - 80)); }
    else if ($numdero >= 70 && $numdero <= 79) { 
        $numd = "SETENTA ";
        if ($numdero > 70) $numd = $numd."Y ".(unidad($numdero - 70));
    } else if ($numdero >= 60 && $numdero <= 69) {
        $numd = "SESENTA ";
        if ($numdero > 60) $numd = $numd."Y ".(unidad($numdero - 60));
    } else if ($numdero >= 50 && $numdero <= 59) {
        $numd = "CINCUENTA ";
        if ($numdero > 50) $numd = $numd."Y ".(unidad($numdero - 50));
    } else if ($numdero >= 40 && $numdero <= 49) {
        $numd = "CUARENTA ";
        if ($numdero > 40) $numd = $numd."Y ".(unidad($numdero - 40));
    } else if ($numdero >= 30 && $numdero <= 39) {
        $numd = "TREINTA ";
        if ($numdero > 30) $numd = $numd."Y ".(unidad($numdero - 30));
    } else if ($numdero >= 20 && $numdero <= 29) {
        if ($numdero == 20) $numd = "VEINTE ";
        else $numd = "VEINTI".(unidad($numdero - 20));
    } else if ($numdero >= 10 && $numdero <= 19) {
        switch ($numdero) { 
            case 10: { $numd = "DIEZ "; break; }
            case 11: { $numd = "ONCE "; break; }
            case 12: { $numd = "DOCE "; break; }
            case 13: { $numd = "TRECE "; break; }
            case 14: { $numd = "CATORCE "; break; }
            case 15: { $numd = "QUINCE "; break; }
            case 16: { $numd = "DIECISEIS "; break; }
            case 17: { $numd = "DIECISIETE "; break; }
            case 18: { $numd = "DIECIOCHO "; break; }
            case 19: { $numd = "DIECINUEVE "; break; }
        }
    } else $numd = unidad($numdero);
    return $numd;
}

function centena($numc){
    if ($numc >= 100) {
        if ($numc >= 900 && $numc <= 999) { 
            $numce = "NOVECIENTOS ";
            if ($numc > 900) $numce = $numce.(decena($numc - 900));
        } else if ($numc >= 800 && $numc <= 899) {
            $numce = "OCHOCIENTOS ";
            if ($numc > 800) $numce = $numce.(decena($numc - 800));
        } else if ($numc >= 700 && $numc <= 799) {
            $numce = "SETECIENTOS ";
            if ($numc > 700) $numce = $numce.(decena($numc - 700));
        } else if ($numc >= 600 && $numc <= 699) {
            $numce = "SEISCIENTOS ";
            if ($numc > 600) $numce = $numce.(decena($numc - 600));
        } else if ($numc >= 500 && $numc <= 599) {
            $numce = "QUINIENTOS ";
            if ($numc > 500) $numce = $numce.(decena($numc - 500));
        } else if ($numc >= 400 && $numc <= 499) {
            $numce = "CUATROCIENTOS ";
            if ($numc > 400) $numce = $numce.(decena($numc - 400));
        } else if ($numc >= 300 && $numc <= 399) {
            $numce = "TRESCIENTOS ";
            if ($numc > 300) $numce = $numce.(decena($numc - 300));
        } else if ($numc >= 200 && $numc <= 299) {
            $numce = "DOSCIENTOS ";
            if ($numc > 200) $numce = $numce.(decena($numc - 200));
        } else if ($numc >= 100 && $numc <= 199) {
            if ($numc == 100) $numce = "CIEN ";
            else  $numce = "CIENTO ".(decena($numc - 100));
        }
    } else $numce = decena($numc);
    return $numce;
}

function miles($nummero){
    if ($nummero >= 1000 && $nummero < 2000){
        $numm = "MIL ".(centena($nummero%1000));
    }
    if ($nummero >= 2000 && $nummero <10000){
        $numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
    }
    if ($nummero < 1000) $numm = centena($nummero);
    return $numm;
}

function decmiles($numdmero){
    if ($numdmero == 10000) $numde = "DIEZ MIL";
    if ($numdmero > 10000 && $numdmero <20000){
        $numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
    }
    if ($numdmero >= 20000 && $numdmero <100000){
        $numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
    }
    if ($numdmero < 10000) $numde = miles($numdmero);
    return $numde;
}

function cienmiles($numcmero){
    if ($numcmero == 100000) $num_letracm = "CIEN MIL";
    if ($numcmero >= 100000 && $numcmero <1000000){ 
        $num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
    }
    if ($numcmero < 100000) $num_letracm = decmiles($numcmero);
    return $num_letracm;
}

function millon($nummiero){
    if ($nummiero >= 1000000 && $nummiero <2000000){
        $num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
    }
    if ($nummiero >= 2000000 && $nummiero <10000000){
        $num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
    }
    if ($nummiero < 1000000)
        $num_letramm = cienmiles($nummiero);
    //LGmod    
    if ($num_letramm == "UN MILLON "){
        $num_letramm = $num_letramm.'de ';
    }
    return $num_letramm;
}

function decmillon($numerodm){
    if ($numerodm == 10000000) $num_letradmm = "DIEZ MILLONES";
    if ($numerodm > 10000000 && $numerodm <20000000){
        $num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
    }
    if ($numerodm >= 20000000 && $numerodm <100000000){
        $num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
    }
    if ($numerodm < 10000000) $num_letradmm = millon($numerodm);
    return $num_letradmm;
}

function cienmillon($numcmeros){
    if ($numcmeros == 100000000) $num_letracms = "CIEN MILLONES";
    if ($numcmeros >= 100000000 && $numcmeros <1000000000){
        $num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
    }
    if ($numcmeros < 100000000) $num_letracms = decmillon($numcmeros);
    return $num_letracms;
}

function milmillon($nummierod){
    if ($nummierod >= 1000000000 && $nummierod <2000000000){
        $num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
    }
    if ($nummierod >= 2000000000 && $nummierod <10000000000){
        $num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
    }
    if ($nummierod < 1000000000) $num_letrammd = cienmillon($nummierod);
    return $num_letrammd;
}

function convertir($numero){
    $num = str_replace(",","",$numero);
    $num = number_format($num,2,'.','');
    $cents = substr($num,strlen($num)-2,strlen($num)-1);
    $num = (int)$num;
    $numf = milmillon($num);
    //return " PESOS ".$numf." CON ".$cents."/100";
    return $numf;
}
?>