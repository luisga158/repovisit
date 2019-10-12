<?php
include("../config.php");
include_once("Cobjdb.php");
include("funcvarprog.php");
if (isset($_POST["tablenm"])){
    $tblpost = $_POST['tablenm'];
    if ($tblpost == 'terceros') {
        if (isset($_POST["action"])){
            $actionpost = $_POST['action'];
            if ($actionpost == 'grabar') {
                $obj = new Cobjdb($tblpost, $database, $server, $db_user, $db_pass);
                $arnot = array("Marca_temporal");
                $obj->setArcolno($arnot);
                $obj->setTstmp("Marca_temporal");
                $arrproc = $obj->gethdscmpsForm();
                $longitud = count($arrproc);
                $arrtrn = array();
                for ($i=0; $i < $longitud; $i++) {
                    $stin = $arrproc[$i];
                    if (isset($_POST[$stin])){ $arrtrn[$i] = $_POST[$stin];} // Validacion para las casillas de verificacion
                    else { $arrtrn[$i] = '0';}
                }
                if ($obj->evalForm($arrtrn,$tertbldet)){
                    $obj->procForm($arrtrn);
                    echo "<script>location.href = '../program.php';</script>";
                }
            }
        //  Para mas acciones
    }
    } else if ($tblpost == 'repovisita') {
        $obj = new Cobjdb($tblpost, $database, $server, $db_user, $db_pass);
        $arnot = array("Marca_temporal", "Ord");
        $obj->setdtno($arnot,"Marca_temporal", "Ord");
        $arrproc = $obj->gethdscmpsForm();
        $longitud = count($arrproc);
        $arrtrn = array();
        for ($i=0; $i < $longitud; $i++){
            $stin = $arrproc[$i];
            $arrtrn[$i] = $_POST[$stin];
        }
        $arrdocs = array();
        $arrdocs = $obj->getDataDocs($arrtrn);
        $ter = new Cobjdb("terceros", $database, $server, $db_user, $db_pass);
        $datater = array();
        $datater = $ter->getrowdata($arrdocs[1],'Nombre_o_Razon_Social');
        
        /*  PARMS PARA FUNCIONES
        *   ctaCobro($fch, $cte, $nit, $vlt, $vln, $cto)
        *   GenrepoVisita($fch, $cte, $obs, $cto)
        */
        // Genera documentos
        include("CtaCobro.php");
        include("ReportedeVisita.php");
        //include("functprog.php");
        $rtcta = 'ctacobro_'.utf8_encode($arrdocs[1]).$arrdocs[6].'.doc';
        $rtrepo = 'repovisita_'.utf8_encode($arrdocs[1]).$arrdocs[6].'.doc';
        ctaCobro(fechaTxt($arrdocs[0]), $arrdocs[1], number_format($datater[3],0,',','.'), convertir($arrdocs[3],$rtcta), number_format($arrdocs[3],0,',','.'),$arrdocs[2],$rtcta);
        GenrepoVisita(fechaTxt($arrdocs[0]), $arrdocs[1], $arrdocs[4], $arrdocs[2],$rtrepo);
        
        // :) READY    *******  GO
        // enviar correo con adjuntos
        sendMail($datater[5],$rtrepo,$rtcta);
        
        // :) READY    *******  GO
        // y guardar reporte
        $obj->procForm($arrtrn);
        echo "<script>location.href = '../program.php';</script>";
    }
    // redirecciona al terminar
    //echo "<script>location.href = '../program.php';</script>";
    
    // Falta crear un proceso que cada mes archive los documentos en subcarpetas    

}
//echo "<script>location.href = '../program.php';</script>";

/* Para consulta de tablas. Se implemento dentro la página para que fuese posible 
if (isset($_POST["listdblcl"])){
    $tblpost = $_POST['listdblcl'];
    $obj = new Cobjdb($tblpost, $database, $server, $db_user, $db_pass);
    $obj->showrCObjeto();
    echo $tblpost;
}*/
   
    
?>