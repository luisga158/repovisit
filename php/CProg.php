<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CProg
 *
 * @author Gabriel
 */
class CProg {
    private $opcion;
    private $accion;
    private $arparam;
    private $tertbldet = array(
        array('Nombre_Campo','null','tipo','clave','bdter','dirterglobal'),
        array('Marca_temporal','no','timestamp','','',''),
        array('Tipo_de_persona','no','tpter','','origen',''),
        array('Tipo_de_documento_de_identidad','no','tpdocar','','',''),
        array('Numero_de_identidad','no','numero','unico','IdTer-nitemp','Nit'),
        array('Nombre_o_Razon_Social','no','texto','','name-emp','RznScl-1erNom-2oNom-1erAp-2oAp'),
        array('Telefonos','si','texto','','tels-telemp',''),
        array('Correo_electronico','si','mail','','mail',''),
        array('Direccion','si','texto','','dir-diremp','Dir'),
        array('Pais','si','texto','','','CodPais'),
        array('Ciudad','si','city','','city','CodMun-CodCiudad'),
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
    private $bdtertblrel = array(
        array('Tipo_de_persona','origen'),
        array('Numero_de_identidad','IdTer','nitemp'),
        array('Nombre_o_Razon_Social','name','emp'),
        array('Telefonos','tels','telemp'),
        array('Correo_electronico','mail'),
        array('Direccion','dir','diremp'),
        array('Ciudad','city')
    );
    // relacion de campos de dirterglobal con terceros
    private $gbltertblrel = array(
        array('Numero_de_identidad','Nit'),
        array('Primer_Nombre','1erNom'),
        array('Otros_Nombres','2oNom'),
        array('Primer_Apellido','1erAp'),
        array('Otros_Apellidos','2oAp'),
        array('Nombre_o_Razon_Social','RznScl'),
        array('Direccion','Dir'),
        array('Ciudad','CodMun'),
        array('Pais','CodPais')
    );
    
    public function __construct($opcion, $accion, $arparam) {
        $this->opcion = $opcion;
        $this->accion = $accion;
        $this->arparam = $arparam;
        // inicio case $opcion
        switch ($opcion){
            // 1.- Opcion infrm
            case 'infrm':
            switch ($accion){
                // inicio case $accion para opcion infrm
                // 1.1.- Accion repovisita
                case 'repovisita':
                    include("config.php");
                    include_once("Cobjdb.php");
                    // parametro id usado en case, se toma de $arparam
                    $id = $this->arparam;
                    $arcol = array();
                    $obj = new Cobjdb("terceros", $database, $server, $db_user, $db_pass);
                    $arnot = array("Marca_temporal");
                    $obj->setArcolno($arnot);
                    // Si el tercero esta creado, ya esta listo
                    if ($obj->idResponse($id) == 'terceros') {
                        $rpvst = new Cobjdb("repovisita", $database, $server, $db_user, $db_pass);
                        $arno = array("Marca_temporal", "Ord");
                        $rpvst->setArcolno($arno);
                        $arcol = $obj->getrowdata($id,3);
                        $nm = array($arcol[4],'','','','');
                        $at = array('readonly','','','','');
                        echo $rpvst->drawForm($nm,$at);
                        break;
                    } else if ($obj->idResponse($id) == 'bdter') {  // no usa la funcion dataterenrtn de $obj llena datos manual 
                                                                    // es mas facil ya que datreturn es una funcion muy compleja
                        $objbd = new Cobjdb("bdter", $database, $server, $db_user, $db_pass);
                        $arcol = $objbd->getrowdata($id,'IdTer');
                        $arhdbdter = $objbd->getHddata();
                        $tmptpper = '';
                        if ($arcol[12]=='BDN'){
                            $tmptpper='Natural';
                        } else if ($arcol[12]=='De empresas'){
                            $tmptpper='Juridica';
                        }
                        $tmptels = '';
                        if (!($arcol[3]=='')) { $tmptels = $arcol[3]; }
                        if (!($arcol[9]=='')) {
                            if ($tmptels == ''){ $tmptels = $arcol[9]; 
                            } else { $tmptels = $tmptels.', '.$arcol[9]; }
                        }
                        $tmpdir = '';
                        if (!($arcol[10]=='')) { $tmpdir = $arcol[10]; }
                        if (!($arcol[7]=='')) {
                            if ($tmpdir == ''){ $tmpdir = $arcol[7]; 
                            } else { $tmpdir = $tmpdir.', '.$arcol[7]; }
                        }
                        $arfill = array('',$tmptpper,'',$arcol[0],$arcol[1],$tmptels,$arcol[4],$tmpdir,'',$arcol[8],'','','','','','','','','','','','','','','','','');
                        $lngfill = count($arfill);
                        $atfill = array();
                        for ($i=0; $i<$lngfill;$i++){
                            array_push($atfill,'');
                        }
                        $obj->drawFormdtTypes($arfill,$atfill,$this->tertbldet);
                        break;
                    } else if ($obj->idResponse($id) == 'dirterglobal') { // usa la funcion dataterenrtn de $obj
                        $objbd = new Cobjdb("dirterglobal", $database, $server, $db_user, $db_pass);
                        $arcol = $objbd->getrowdata($id,'Nit');
                        $arhdgblter = $objbd->getHddata();
                        $tmp = $arcol[6];
                        if ($arcol[6] == '') {
                            $tmp = $tmp.$arcol[4].' ';
                            if ((!$arcol[5] == '')) { $tmp = $tmp.$arcol[5].' '; }
                            $tmp = $tmp.$arcol[2];
                            if ((!$arcol[3] == '')) { $tmp = $tmp.' '.$arcol[3]; }
                        }
                        $tmp2 = $arcol[8].$arcol[9];
                        // retorna los 27 datos
                        $arcol[6] = $tmp;
                        $arcol[8] = $tmp2;
                        $arfill = $obj->dataterenrtn('dirterglobal',$arcol,$arhdgblter,$this->tertbldet,$this->gbltertblrel);
                        $lngfill = count($arfill);
                        $atfill = array();
                        for ($i=0; $i<$lngfill;$i++){
                            array_push($atfill,'');
                        }
                        $obj->drawFormdtTypes($arfill,$atfill,$this->tertbldet);
                        //$obj->drawForm($arfill,$atfill);
                        break;
                    } else if ($obj->idResponse($id) == 'null') {
                        $nm = array('','','','','','','','','','','','','','','','','','','','','','','','','','','');
                        $at = array('','','','','','','','','','','','','','','','','','','','','','','','','','','');
                        echo $obj->drawFormdtTypes($nm,$at,$this->tertbldet);
                        break;
                    }
                    
                case 'creatercero':
                    include("config.php");
                    include_once("Cobjdb.php");
                    // parametro $arrtrn datos para llenar formulario, se toma de $arparam
                    $arrtrn = $this->arparam;
                    $arcol = array();
                    $obj = new Cobjdb("terceros", $database, $server, $db_user, $db_pass);
                    $arnot = array("Marca_temporal");
                    $obj->setArcolno($arnot);
                    $arhdbdter = $objbd->getHddata();
                    $arfill = array('','','','','','','','','','','','','','','','','','','','','','','','','','','');
                    if (is_array($arrtrn)){
                        $cantarno = 0;
                        $lng = count($arhdbdter);
                        for ($i=0; i<$lng; $i++){
                            if (!(in_array($this->hddata[$i], $this->arcolno))) {
                                $arcol[$i] = $arrtrn[$i-$cantarno];
                            } else {
                                $arcol[$i] = '';
                                $cantarno++;
                            }
                        }
                        $arfill = $arcol;
                    }
                    $lngfill = count($arfill);
                    $atfill = array();
                    for ($i=0; $i<$lngfill;$i++){
                        array_push($atfill,'');
                    }
                    $obj->drawFormdtTypes($arfill,$atfill,$this->tertbldet);
                    break;
                case '2': break;
            }
            case 'outfrm':                  // opcion outfrm
            switch ($accion){               // inicio case $accion para opcion outfrm
                case 'vertabla':            // accion vertabla
                    include("config.php");
                    include_once("Cobjdb.php");
                    $obj = new Cobjdb("", $database, $server, $db_user, $db_pass);
                    $obj->seltblFrmshw();
                    break;
                case '1': break;
                case '2': break;
            }
            case 'showsome':                  // opcion showsome
            switch ($accion){               // inicio case $accion para opcion outfrm
                case 'verdbsel':            // accion vertabla
                    include("config.php");
                    include_once("Cobjdb.php");
                    $obj = new Cobjdb("", $database, $server, $db_user, $db_pass);
                    echo $obj->showrCObjeto();
                    break;
                case '1': break;
                case '2': break;
            }
        }
    }
    
    public function getOpcion() {
        return $this->opcion;
    }

    public function getAccion() {
        return $this->accion;
    }

    public function getArparam() {
        return $this->arparam;
    }

    public function setOpcion($opcion) {
        $this->opcion = $opcion;
    }

    public function setAccion($accion) {
        $this->accion = $accion;
    }

    public function setArparam($arparam) {
        $this->arparam = $arparam;
    }
    
}
?>