<?php

/**
 * ================================================================================
 * Resumen:
 * ================================================================================
 * Variables: 
 * --------------------------------------------------------------------------------
 * -. De conexion y construccion:       host, user, pass - db
 * -. De lectura o seleccion sql:       db, tablenm
 * -. Información de campos:            tpar, lenar, banar, hddata  -> Son arrays con tipo, largo, flags, y encabezados de tabla
 * -. De tabla o base de datos:         data, tblsdb, numfilas, numcols -> Datos de la tabla con medidas o arrays de db y tablas
 * -. Para formularios:                 arcolno, se especifica con setArcolno($ar)
 *                                      donde $ar contiene los nombres de los encabezados a no mostrar al dibujar formulario
 * -. Para datos tipicos de arcolno:    tstmp, y ord -> encabezados de la tabla correpondientes al timestamp y el ordinal autoincrement
 *                                      en caso de tenerlos, se especifican con setTstmp($ts) y setOrd($o)
 *                                  o todo con setdtno($ar,$tm,$or)
 * --------------------------------------------------------------------------------
 *      Nota: Si la tabla tiene campos que el usuario no debe ver o llenar en el formulario, es necesario despues de su construccion
 *          especificar dichos datos con arcolno, tstmp, y ord.
 *      Para facilitar esto esta la function setdtno($ar,$tm,$or),donde $ar es arcolno, $tm y $or el encabezado de timestamp y ordinal.
 *          Si no tenemos timestamp u ordinal en la tabla los definimos vacios ('').
 * --------------------------------------------------------------------------------
 ** Tipos de variables SQL e información relevante
 * --------------------------------------------------------------------------------
 * -. Array pata tipos de variables MySql:  $tiposVarsql
 * -. Arrays con informacion relevante para creacion SQL:   $arTpsVar, $InfoTpsVar, $TpsVarNum, $LongTpsVarNum
 *          $TpsVarNumDec, $LongTpsVarNumDec, $TpsVarDateTime, $LongTpsVarDateTime, $TpsVarCadenas, $TpsVarSets
 *          $LongTpsVarSets
 *                          -> Arrays sacados de MyApp en Java, y son usados para fijar el tipo de dato de un campo.
 *                              Tambien siver como auxiliares para validar los tipos de campos y sus datos
 * --------------------------------------------------------------------------------
 ** Arrays auxiliares para llenar datalist
 * --------------------------------------------------------------------------------
 * -. Array de tipos de datos:          arcoldttipe -> para reconocer la presentacion de los campos en el formulario
 * -. Arrays para Tipos de datos Enum:  $tpper, $tpdocar -> lbl's en arcoldttipe correspondientes: 'tpter', 'tpdocar'
 *
 * -. Arrays para ciudad de tabla codmundane ya existente en mi base de datos:  $cityar, $cityNm, $cityCd
 *              Donde cityar contiene todos los campos, cityNm los nombres con municipio, y cityCd los codigos de los municipios
 *              Si la tabla no existe no carga datos en dichos arrays
 * --------------------------------------------------------------------------------
 * Constructor
 * --------------------------------------------------------------------------------
 * 1.- construct($tablenm, $db, $host, $user, $pass)
 *      -> constrido el objeto sin tabla solo carga data y tblsdb
 *      -> constrido el objeto con tabla carga data, hddata, numfilas, numcols
 *          - ademas de tpar, lenar, banar
 *          - si la tabla codmundane existe carga $cityar, $cityNm, $cityCd
 * --------------------------------------------------------------------------------
 * Getters and Setters
 * --------------------------------------------------------------------------------
 *      getData() return $this->data;
 *      getNumfilas() return $this->numfilas;
 *      getNumcols() return $this->numcols;
 *      getHddata() return $this->hddata;
 *      getTblsdb() return $this->tblsdb;
 *      getTablenm() return $this->tablenm;
 *      getArcolno() return $this->arcolno;
 *      setArcolno($ar) $this->arcolno = $ar;   ->  Encabezados que no se deben mostrar en el formulario
 *      setTstmp($ts) $this->tstmp = $ts;       ->  Nombre para encabezado de timestamp = que en arcolno
 *      setOrd($o) $this->ord = $o;             ->  Nombre para encabezado de ordinal = que en arcolno
 *      setdtno($ar,$tm,$or)                    ->  Pasa los tres parametros si los hay con una sola funcion
 * --------------------------------------------------------------------------------
 * Metodos:
 * --------------------------------------------------------------------------------
 * -. showrCObjeto:             -> Lista de bases de datos sin tabla, con tabla dibuja tabla
 * -. drawtblinfo:              -> Muestra los encabezados y atributos de la tabla
 * -. getrowdata($id,$colid)    -> Devuelve registro en array. id = valor a buscar, colid = encabezado donde buscar.
 * -. drawrowdata($id,$colid)   -> Draw registro  en array. id = valor a buscar, colid = encabezado donde buscar.
 * -. idResponse($id)           -> Busca id en las tablas y retorna el nombre de la tabla donde lo encontro o null si no lo encuentra
 * -. idtblfind($id,$artbls,$arids) ->  Regresa el nombre de la 1a. tabla donde encontro el $id, de lo contrario retorna null
 *                                      artbls = tablas donde buscar y arids = nombres de los campos donde buscar.
 * -. idtblsfind($id,$artbls,$arids) -> Regresa un array con el nombre de las tablas donde encontro el $id, de lo contrario retorna null
 *                                      artbls = tablas donde buscar y arids = nombres de los campos donde buscar.
 * --------------------------------------------------------------------------------
 *  Primeros forms
 * --------------------------------------------------------------------------------
 * -. seltblFrmshw !action=program.php¡    -> Draw selector de tablas con botón, al regresar con los datos Draw table, 
 *                                            Dibuja la tabla seleccionada con valor Post listdblcl.
 *                                            El cual es recibido y procesado por program.php
 * -. seltblFrmshwact($action)             -> Draw selector de tablas con botón, al regresar con los datos Draw table, 
 *                                            y regresa con valor Post listdblcl. Para procesar con el archivo $action.
 *                                            Este proceso es igual al anterior con la diferencia de especificar el archivo que procesa.
 * --------------------------------------------------------------------------------
 *  Para dibujar formularios: ( Forms mejorados )
 * --------------------------------------------------------------------------------
 *  1.1.- Para una lista de datos:
 *
 * -. dataLst($arlist,$nmlst,$txtin,$pos) -> Para dibujar un datalist (permite definir las opciones con $arlist)
 *            $nmlst define el nombre de la lista (header in table) y $txtin el placehlder o texto que se muestra en el campo
 *                                      $pos es el index del campo de ser 1 le atribuye autofocus.
 *                                      Este objeto al escribir muesra las opciones, pero permite opciones fuera de la lista
 *                                      por lo que necesita validación, igual todos los formularios deben ser validados.
 *
 *                                      Para ello se le debe entregar un array con detalles sobre el proceso de los datos.
 * ... Para ello esta la function evalForm vista más adelante.
 ***
 *  1.2.- Para dibujar campo según tipo
 *
 * -. darwTpField($tpdt,$dtfill,$atfill,$pos,$nm)   -> Draw field de frm con tipo, Funcion auxiliar para drawFormdtTypes, 
 *          que dibuja un campo de tipo $tpdt, que llena con $dtfill, y según $atfill, dandole valor a tabindex segun $pos
 *              y con el nombre $nm. Si $atfill es 'readonly' no permite modificar el dato del campo (No aplica para datalist)
 *          ...
 *          $tpdt es el tipo de dato que debe corresponder a los tipos en $arcoldttipe. $dtfill,$atfill son dato y atributo de tenerlos.
 *      para llenar el dato de campo actual, si $atfill es 'readonly' no permite modificar el dato del campo, esto no aplica para datalist.
 **
 *  1.- Para dibujar formulario con campos segun tipos
 **
 *
 * -. drawFormdtTypes($tblfill,$tblfillat,$tbldet) -> $tblfill array con datos para autofill y $tblfillat array con atributos 
 *          para los datos, usando los datos de $tbldet puede identificar los tipos de datos almacenados en $arcoldttipe.
 **      IMPORTANTE: $tblfill y $tblfillat, deben tener tantos datos como la tabla actual
 *       $tbldet, debe contener todos los encabezados de la tabla actual en la primera columna
 *       y una fila inicial con encabezados, usada para relacionar con otras tablas.
 **         ACCION: ../enviar.php, datos post: _tablenm -> nombre tabla actual del form y _action -> grabar
 * --------------------------------------------------------------------------------
 *
 ********************************************************************************************************************************
 * Ejemplo de $tbldet:
 ********************************************************************************************************************************
 * Obs: La Fila 1 o 0 contiene los Titulos (Nombre_Campo = Nombre head in db, null = si o no, tipo = indicador de tipo relacionado
        con tabla local $arcoldttipe (si no se especifica text default), clave = unico o '' (si unico se debe evaluar antes de procesar)
        bdter y dirterglobal son otras tablas de consulta con datos para el autofill facilitando la creacion, p/la tbl act de terceros.
 *** Desmenuzando:
        Los Encabezados de dicha tabla (p/el ej. 'terceros') estan en la columna 'Nombre_Campo', y deben corresponder con los nombres 
            en la tabla mysql (En este caso uso phpMyadmin y XAMMP, las cuales son compatibles con mi CPanel, para subir y usar).
        Las columnas 0-3 (1-4) ('Nombre_Campo','null','tipo','clave') son necesarias para any formdraw, evalForm y procForm.
        Pero las columnas 4-5 (5-6) ('bdter','dirterglobal') son tablas que como se dijo antes, de contener datos sobre el nuevo
        registro a crear, son usados con autofill making faster creation (Para lo cual es necesario pasar tablas relacionales. Ver Abajo).
 ***
                        $tertbldet = array(
                           array('Nombre_Campo','null','tipo','clave','bdter','dirterglobal'),
                           array('Marca_temporal','no','timestamp','','',''),
                           array('Tipo_de_persona','no','tpter','','origen',''),
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
                           array('ICA_Cali','no','verify','','',''),
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
 ********************************************************************************************************************************
 * Ejemplos de Tablas relacionales:
 ********************************************************************************************************************************
 ** Tabla relacional para bdter ( 'bdter' es una de las tablas del array $tertbldet )
 *
 Veamos pues que 'bdter' en su array de relacion, contiene en cada fila los nombres de los encabezados coincidentes entre 
 la tabla terceros y bdter. De haber mas campos en 'bdter' donde consultar en caso de que estar vacios, se pueden especificar
 como se observa en el ejemplo actual
 **
                        $bdtertblrel = array(
                               array('Tipo_de_persona','origen'),
                               array('Numero_de_identidad','IdTer','nitemp'),
                               array('Nombre_o_Razon_Social','name','emp'),
                               array('Telefonos','tels','telemp'),
                               array('Correo_electronico','mail'),
                               array('Direccion','dir','diremp'),
                               array('Ciudad','city')
                        );
 ** Tabla relacional para dirterglobal ( 'dirterglobal' es una de las tablas del array $tertbldet )
 Vemos la similitud con el caso anterior
 **
                        $gbltertblrel = array(
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
 ********************************************************************************************************************************
 Problema. Solución:
 Las bases de datos necesitan transformar los datos por tener formatos diferentes.
 Esto ya esta resuelto en gran parte en la Clase CProg que a la larga se ha convertido en el nucleo de la aplicación.
 Para ello consultar $opcion = 'infrm', $accion = 'repovisita', if ($obj->idResponse($id) == 'bdter')
 y if ($obj->idResponse($id) == 'dirterglobal')            
 ********************************************************************************************************************************
 Fin de Ejemplos
 * --------------------------------------------------------------------------------
 ** 
        Metodos Continuacion
 **
 * --------------------------------------------------------------------------------
 * -. evalForm($arrtrn,$tbldet)  -> Evalua los datos entregados por un formulario $arrtrn, basado en $tbldet
 *
 * -. drawForm($nm,$at) ->          $nm array con datos para autofill y $at array con atributos para los datos
 *                                  El numero de datos debe ser igual a (count($this->hddata) - count($this->arcolno))
 *
 * -. gethdscmpsForm !sin arcolno para dibujar form¡    -> retorna los encabezados de la tabla exepto los arcolno
 *
 * -. getDataDocs($arrfrm) -> retorna datos para docs
 *
 * -. procForm($arrfrm) !graba datos¡,  -> funcion para grabar los datos del formulario
 *
 * -. dataterenrtn($tblnm,$regter,$hdreg,$tertbldet,$tblrel) este proceso se creo para facilitar el procesa datos de un formulario
 *                                                           sin embargo no parece ser muy adecuado ya que es mas rapido llenar los datos
 * ================================================================================
 *
 * @author Luis Gabriel Hernández - alias or nickname: luisga158
 *
 */

class Cobjdb {
    // De conexion y construccion
    private $host;
    private $user;
    private $pass;
    // De lectura o seleccion sql
    private $db;
    private $tablenm;
    // Información de campos
    private $tpar = array();
    private $lenar = array();
    private $bandar = array();
    private $hddata;
    // De tabla o base de datos
    private $data;    
    private $tblsdb;
    private $numfilas;
    private $numcols;
    // Para formularios, columnas exepcion para dibujar form
    private $arcolno = array();
    private $tstmp;
    private $ord;
    // array de tipos de variables MySql, estos datos aun no estan en uso son para la creacion de tablas desde el programa
    // Que de momento no esta implementado
    /*private $tiposVarsql = array ('VARCHAR','INT','REAL','BOOLEAN','YEAR','DATE','TIME','DATETIME','DOUBLE','DECIMAL','BIT','SERIAL','TIMESTAMP','BINARY','VARBINARY','TINYBLOB','TINYTEXT','BLOB','TEXT','MEDIUMBLOB','MEDIUMTEXT','LONGBLOB','LONGTEXT','ENUM','SET');
    // Tipos de variables SQL e información relevante
    private $arTpsVar = array('Numéricos', 'Numéricos decimales', 'Fecha y Hora', 'Cadenas', 'Conjuntos');
    private $InfoTpsVar = array('M = 0_255, indica el ancho máximo de visualización para los tipos enteros, por defecto es 1.','M = 0_255, indica el ancho máximo de visualización para los tipos enteros, por defecto es 1; D = 0_30, numero de decimales, por defecto es 0.','fsp(fractional seconds storage= 0: 0 bytes; 1,2: 1 byte; 3-4: 2 bytes; 5-6: 3 bytes) = 0_6, la cantidad de números a mostrar en las fracciones de segundos.','M es el numero de caracteres máximo a almacenar. M + 1 = numero de bytes, para mas de 255, se añade otro byte.');
    private $TpsVarNum = array('TINYINT(M)', 'SMALLINT(M)', 'MEDIUMINT(M)', 'INT(M)', 'BIGINT(M)');
    private $LongTpsVarNum = array('1 byte: 0_255, -128_127', '2 bytes: 0_65.535, -32.768_32.767', '3 bytes: 0_16.777.215, -8.388.608_8.388.607', '4 bytes: 0_4.294.967.295, -2.147.483.648_2.147.483.647');
    private $TpsVarNumDec = array('DOUBLE(M:255max,D:30max)', 'DECIMAL(M:65max,D:30max)', 'BIT(M)');
    private $LongTpsVarNumDec = array('8 bytes: -1.7976931348623157e+308_-2.2250738585072014e-308, 2.2250738585072014e-308_1.7976931348623157e+308','n bytes: Depende de el valor de M:1_65', '8 bytes: Depende de el valor de M: 1_64');
    private $TpsVarDateTime = array('YEAR(4)', 'DATE', 'TIME(fsp)', 'DATETIME(fsp)', 'TIMESTAMP(fsp)');
    private $LongTpsVarDateTime = array('1 byte', '3 bytes: 1000-01-01_9999-12-31','3 bytes + fsp: -838:59:59.000000_838:59:59.000000',
    '5 bytes + fsp: 1000-01-01 00:00:00.000000_9999-12-31 23:59:59.999999', '4 bytes + fsp(: 1970-01-01 00:00:01.000000_2038-01-19 03:14:07.999999');
    private $TpsVarCadenas = array('CHAR(M)', 'VARCHAR(M)', 'TINYTEXT', 'TEXT(M)', 'MEDIUMTEXT', 'LONGTEXT');
    private $LongTpsVarCadenas = array('M bytes: 0_255. Por defecto es 1','M bytes: 0_21.844.','Máximo 255(2e8 − 1) caracteres',
        'M Máximo 65.535(2e16 − 1 caracteres, por defecto 255', 'Máximo 16.777.215(2e24 − 1)', 'Máximo  4.294.967.295(2e32 − 1)');
    private $TpsVarSets = array('ENUM("value1","value2",...)', 'SET("value1","value2",...)');
    private $LongTpsVarSets = array('1 or 2 bytes: segun la cantidad de elementos enumerados, máximo 65.535 miembros', 
        '1, 2, 3, 4, or 8 bytes: segun la cantidad de elementos fijados, máximo 64 miembros');*/
    // array de tipos reconocidos para saber como dibujar el dato en el formulario
    private $arcoldttipe = array('timestamp','tpter','tpdocar','numero','texto','tels','mail','dir','pais','city','verify');
    // array de tipos de persona
    private $tpper = array('Natural','Juridica');
    // array de tipos de documento
    private $tpdocar = array(
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
    private $cityar = array();
    private $cityNm = array();
    private $cityCd = array();
    /* Si $tablename="" carga todas las bases de datos en $data y los nombres de las tablas en $tblsdb
    /* Si tablename devuelve los names de las cols en $hddata, y el contenido de la tabla por columnas en $data
    /* al igual que el numero de filas y columnas en numfilas, y numcols.    */
    /* 
    * ================================================================================
    * Constructor, no requiere arcolno, usar setArcolno($ar) para uso de forms
    * en caso de que halla columnas que no se deban ver en el formulario
    * ================================================================================
    */
    public function __construct($tablenm, $db, $host, $user, $pass) {
        $this->tablenm = $tablenm;
        $this->db = $db;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $con = mysqli_connect($host, $user, $pass, $db);
        if(!$con){
            echo 'Ha sucedido un error inesperado en la conexión de la base de datos';
            }
        if ($tablenm == ''){
            if(!$result = mysqli_query($con, "show databases;")) die(); //si la conexión cancelar programa
            $rawdata = array(); //creamos un array
            //////guardamos en un array multidimensional todos los datos de la consulta
            $i=0;
            while($row = mysqli_fetch_array($result)) {
                $rawdata[$i] = $row['Database'];
                $i++;
            }
            $this->data = $rawdata;            
            if(!$result = mysqli_query($con, "show tables;")) die();
            $rawtbl = array();
            $i=0;
            while($row = mysqli_fetch_array($result)) {
                $rawtbl[$i] = $row[0];
                $i++;
            }            
            $this->tblsdb = $rawtbl;
        } else {
            // para cargar las tablas de la base de datos en 
            if(!$result = mysqli_query($con, "show tables;")) die();
            $rawtbl = array();
            $i=0;
            while($row = mysqli_fetch_array($result)) {
                $rawtbl[$i] = $row[0];
                $i++;
            }            
            $this->tblsdb = $rawtbl;
            // para cargar la tabla en data
            mysqli_select_db($con,$db);
            // condicionales para los formularios inicia arcolno vacio
            $this->arcolno = array();
            $query = "SELECT * FROM ".$tablenm;
            $result = mysqli_query($con,"SELECT * FROM ".$tablenm);
            $this->numfilas = $result->num_rows;
            $this->numcols = $result->field_count;
            // toma los encabezados en $infocampo
            $info_campo = $result->fetch_fields();
            $i=0;
            foreach ($info_campo as $valor) {
                $this->hddata[$i] = $valor->name;
                $this->tpar[$i] = $valor->type;
                $this->lenar[$i] = $valor->length;
                $this->bandar[$i] = $valor->flags;
                $i++;
            }
            $longitud = count($this->hddata);
            $rawdat = array();
            $j=0;
            $result = mysqli_query($con,"SELECT * FROM ".$tablenm);
            while($row = mysqli_fetch_array($result)) {                
                $rawdat[$j] = $row;
                $j++;
            }
            $this->data = $rawdat;
            // cargamos la tabla de codmundane si existe
            if (in_array('codmundane',$rawtbl)){
                $rawauxcity = array();
                $j=0;
                $result = mysqli_query($con,"SELECT * FROM codmundane");
                while($row = mysqli_fetch_array($result)) {
                    $rawauxcity[$j] = $row;
                    $j++;
                }
                $this->cityar = $rawauxcity;
                $rowaux = array();
                $lng = count($this->cityar);
                for ($i=0; $i < $lng; $i++){
                    $rowaux = $this->cityar[$i];
                    $this->cityNm[$i] = $rowaux[3];
                    $this->cityCd[$i] = $rowaux[1];
                }
            }
        }
        $close = mysqli_close($con);
    }
    /* Getters and Setters */
    public function getData() {
        return $this->data;
    }

    public function getNumfilas() {
        return $this->numfilas;
    }

    public function getNumcols() {
        return $this->numcols;
    }
    
    public function getHddata() {
        return $this->hddata;
    }
    
    public function getTblsdb() {
        return $this->tblsdb;
    }
    
    public function getTablenm() {
        return $this->tablenm;
    }    
    // condicionales para los formularios
    public function setArcolno($ar) {
        $this->arcolno = $ar;
    }    
    public function getArcolno() {
        return $this->arcolno;
    }
    public function setTstmp($ts){
        $this->tstmp = $ts;
    }
    public function setOrd($o){
        $this->ord = $o;
    }
    public function setdtno($ar,$tm,$or){
        $this->arcolno = $ar;
        $this->tstmp = $tm;
        $this->ord = $or;
    }
    /* End Getters and Setters */
    // Si no hay tabla muestra 
    public function showrCObjeto() {
        if (isset($_POST["listdblcl"])){
            $tblpost = $_POST['listdblcl'];
            $this->tablenm = $tblpost;
        }
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if(!$con){
            echo 'Ha sucedido un error inesperado en la conexión de la base de datos';
            }
        if ($this->tablenm == ''){
            echo '<select name="listdblcl">';    
            $i=0;
            foreach ($this->data as &$valor){
                echo '<option value="'.$i.'">'.$valor.'</option>';
            $i++;
            }
            echo "</select><br />";
            echo '<select name="listdblcl">';    
            $i=0;
            foreach ($this->tblsdb as &$valor){
                echo '<option value="'.$i.'">'.$valor.'</option>';
            $i++;
            }
            echo "</select><br />";
        } else {
            if ($this->numfilas > 0){
                echo "<table>
                <tr>";
                // datos encabezado
                $longitud = count($this->hddata);
                for ($i=0; $i < $longitud; $i++){
                    echo '<th>'.$this->hddata[$i].'</th>';
                }
                $rawr = $this->data;
                echo "</tr>";
                // datos de tabla
                for ($j=0; $j < $this->numfilas; $j++){
                    $rawd = $rawr[$j];
                    echo "<tr>";
                    for ($i=0; $i < $longitud; $i++){
                        echo "<td>" .utf8_encode($rawd[$i]). "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                echo "<br />";
            }
        }
        $close = mysqli_close($con);
    }
    // Muestra los encabezados y atributos de la tabla
    public function drawtblinfo(){
        if (!($this->tablenm == "")){
            if ($this->numfilas > 0){
                echo "<table>";
                // datos encabezado
                echo '<tr>';
                echo '<th>Nombre</th>';
                echo '<th>Largo</th>';
                echo '<th>Tipo</th>';
                echo '<th>Flags</th>';
                echo "</tr>";
                $longitud = count($this->hddata);
                for ($i=0; $i < $longitud; $i++){
                    echo '<tr>';
                    echo '<th>'.$this->hddata[$i].'</th>';
                    echo '<th>'.$this->lenar[$i].'</th>';
                    echo '<th>'.$this->tpar[$i].'</th>';
                    echo '<th>'.$this->bandar[$i].'</th>';
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }
    // Devuelve registro en array. id = valor a buscar, colid = encabezado donde buscar.
    public function getrowdata($id,$colid){
        $longitud = count($this->hddata);
        $arrtrn = array();
        $rawr = $this->data;
        for ($j=0; $j < $this->numfilas; $j++){
            $rawd = $rawr[$j];
            if ($rawd[$colid] == $id){
                $j = $this->numfilas-1;
                for ($i=0; $i < $longitud; $i++){
                    $arrtrn[$i] = $rawd[$i];
                }
            }
        }
        return $arrtrn;
    }
    // Draw registro  en array. id = valor a buscar, colid = encabezado donde buscar.
    public function drawrowdata($id,$colid){
        echo "<table>
                <tr>";
        $longitud = count($this->hddata);
        for ($i=0; $i < $longitud; $i++){
            echo '<th>'.$this->hddata[$i].'</th>';
        }
        $rawr = $this->data;
        echo "</tr>";
        for ($j=0; $j < $this->numfilas; $j++){
            $rawd = $rawr[$j];
            if ($rawd[$colid] == $id){
                $j = $this->numfilas;
                echo "<tr>";
                for ($i=0; $i < $longitud; $i++){
                    echo "<td>" .utf8_encode($rawd[$i]). "</td>";
                }
                echo "</tr>";
            }
        }
        echo "<table>";
    }
    // Busca id en las tablas y retorna el nombre de la tabla donde lo encontro o null si no lo encuentra
    public function idResponse($id){
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        mysqli_select_db($con,$this->db);
        $result = mysqli_query($con,"SELECT * FROM terceros WHERE Numero_de_identidad = '$id'");
        if ($row = mysqli_fetch_array($result)){
            return 'terceros';
        } else {
            $result = mysqli_query($con,"SELECT * FROM bdter WHERE IdTer = '$id'");
            if ($row = mysqli_fetch_array($result)){
                return 'bdter';
            } else {
                $result = mysqli_query($con,"SELECT * FROM dirterglobal WHERE Nit = '$id'");
                if ($row = mysqli_fetch_array($result)){
                    return 'dirterglobal';
                } else {
                    return 'null';
                }
            }
        }
        $close = mysqli_close($con);
    }
    // Draw selector de tablas con botón, al regresar con valor dela tabla seleccionada en Post listdblcl, y dibuja la tabla.
    // Recibida y procesada por program.php
    public function seltblFrmshw(){
         echo '<form class="form" action="program.php" method="POST">';
         echo '<fieldset class="pure-group">';
         echo '<select name="listdblcl">';         
         foreach ($this->tblsdb as &$valor){
             echo '<option value="'.$valor.'" name="tablesel">'.$valor.'</option>';
         }
         echo "</select><br />";
         echo '</fieldset>';
         echo '<input type="submit" value=" Seleccionar " />';
         echo '</form>';
    }
    // Draw selector de tablas con botón, al regresar con valor Post tablesel dibuja la tabla seleccionada.
    // Recibida y procesada por $action
    public function seltblFrmshwact($action){
         echo '<form class="form" action="'.$action.'" method="POST">';
         echo '<fieldset class="pure-group">';
         echo '<select name="listdblcl">';         
         foreach ($this->tblsdb as &$valor){
             echo '<option value="'.$valor.'" name="tablesel">'.$valor.'</option>';
         }
         echo "</select><br />";
         echo '</fieldset>';
         echo '<input type="submit" value=" Seleccionar " />';
         echo '</form>';
    }
    /** Para dibujar formularios:
        1.1.- Draw dataLst, es uno de los tipos de datos que se pueden dibujar en un form. Permite definir las opciones con $arlist.
        $nmlst define el nombre de la lista (header in table) y $txtin el placehlder o texto que se muestra en el campo
        $pos es el index del campo de ser 1 le atribuye autofocus.
    **/
    public function dataLst($arlist,$nmlst,$txtin,$pos){
        $lnglst = count($arlist);
        if ($pos==1) {
            echo '<input list="'.$nmlst.'" name="'.$nmlst.'" tabindex="'.$pos.'" type="text" placeholder="'.$txtin.'" autofocus>';
        } else {
            echo '<input list="'.$nmlst.'" name="'.$nmlst.'" tabindex="'.$pos.'" type="text" placeholder="'.$txtin.'">';
        }
        echo '<datalist id="'.$nmlst.'">';
        for($i=0; $i<$lnglst; $i++){
            echo '<option value="'.$arlist[$i].'"></option>';
        }
        echo '</datalist>';
    }
    /* 1.2.- Draw field de frm con tipo, Funcion auxiliar para drawFormdtTypes, que dibuja un campo de tipo $tpdt, que llena con $dtfill,
        y según $atfill, dandole valor a tabindex segun $pos y con el nombre $nm. 
        Si $atfill es 'readonly' no permite modificar el dato del campo (No aplica para datalist) 
    Tipos definidos 'tpter','tpdocar','numero','texto','tels','mail','dir','pais','city','verify' */
    public function darwTpField($tpdt,$dtfill,$atfill,$pos,$nm){
        switch ($tpdt){
            case 'tpter': 
                $this->dataLst($this->tpper,$nm,$dtfill,$pos);
                break;
            case 'tpdocar': 
                $tpdocarin = array();
                $auxrow = array();
                $lng = count($this->tpdocar);
                for ($i=0; $i<$lng; $i++) {
                    $auxrow = $this->tpdocar[$i]; 
                    $tpdocarin[$i] = $auxrow[0];
                }
                $this->dataLst($tpdocarin,$nm,$dtfill,$pos);
                break;                
            case 'numero': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'texto': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'mail': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'city':
                if (is_numeric($dtfill)){$dtfill=$this->cityNm[array_search($dtfill, $this->cityCd)];}
                $this->dataLst($this->cityNm,$nm,$dtfill,$pos);
                break;
            case 'verify': 
                echo '<input type="checkbox" size="auto" name="'.$nm.'" value="1" tabindex="'.$pos.'" />';
                break;  
        }        
    }
    
    
    /* $tblfill array con datos para autofill y $tblfillat array con atributos para los datos
    ***** usando los datos de $tbldet puede identificar los tipos de datos almacenados en $arcoldttipe
    **
    *   IMPORTANTE: $tblfill y $tblfillat, deben tener tantos datos como la tabla actual
    *       $tbldet, debe contener todos los encabezados de la tabla actual en la primera columna
    *       y una fila inicial con encabezados, usada para relacionar con otras tablas.
    **
    **** 1.- Para dibujar formulario con campos segun tipos             */
    public function drawFormdtTypes($tblfill,$tblfillat,$tbldet){
        $rowdet = array();
        $tipodato = '';
        $auxhd = '';
        echo '<form class="form" action="php/enviar.php" method="POST">';
        echo '<fieldset class="pure-group">';
        $setautofocus = false;
        $longitud = count($this->hddata);
        for ($i=0; $i < $longitud; $i++){
            if (!(in_array($this->hddata[$i], $this->arcolno))) {  // si el encabezado no esta en arcolno dibuja campo                <--
                echo '<h5>'.str_replace("_"," ",$this->hddata[$i]).'</h5>'; // encabezado segun tbl                                      |
                $rowdet = $tbldet[$i+1];    // rowdet toma de tbldet menos el titulo, y si esta en arcolno salta, ya que no entra por if >
                $tipodato = $rowdet[2];     // tipodato, la columna 2 debe contener el tipo de dato, segun $arcoldttipe
                $auxhd = $this->hddata[$i]; // Nombre del encabezado actual
                /* En la siguiente funcion se entrega $tipodato de $tbldet, $tblfill[$i] = Cont.p/fill field con atributo en $tblfillat[i] 
                    y $auxhd que es el encabezado actual y unica variable local, ademas de determinar el $i max. y dependiente de tblnm.
                ** Las otras tres son dependientes de los parametros entregados. Con los cuales hay que ser muy cuidadoso o fallará 
                ***** Ver ej. de $tbldet en los comentarios para formularios */
                $this->darwTpField($tipodato,$tblfill[$i],$tblfillat[$i],$i,$auxhd);    // funcion proces data type
            }
        }
        echo '</fieldset>';
        echo '<input type="text" size="auto" name="tablenm" value="'.$this->tablenm.'" hidden />';
        echo '<input type="text" size="auto" name="action" value="grabar" hidden />';
        echo '<input type="submit" value=" Enviar " tabindex="'.$i.'"  />';
        echo '</form>';
    }
    //
    public function evalForm($arrtrn,$tbldet){
        $long = count($this->hddata);
        $row = array();
        $cantarno = 0;
        $null = '';
        $tp = '';
        $clv = '';
        $rtrn = true;
        for ($i=0; $i<$long; $i++){
            if (!(in_array($this->hddata[$i], $this->arcolno))) {
                $row = $tbldet[$i+1];
                $null = $row[1];
                $tp = $row[2];
                $clv = $row[3];
                if ($arrtrn[$i-$cantarno]==''){
                    if ($null == 'no') {
                        echo '<form class="form" action="../program.php" method="POST">';
                        echo '<fieldset class="pure-group">';
                        echo '<h5>El campo '.str_replace("_"," ",$this->hddata[$i]).' es obligatorio.</h5>';;
                        echo '<input name="Regresar" type="submit" value=" Regresar " autofocus  />';
                        echo '<input type="text" size="auto" name="Numid" value="'.$arrtrn[2].'" hidden />';
                        echo '</fieldset><br />';
                        echo '</form>';
                        $rtrn = false;
                    }
                }
            } else {
                $cantarno++;
            }
        }
        return $rtrn;
    }
    // $nm array con datos para autofill y $at array con atributos para los datos
    // El numero de datos debe ser igual a (count($this->hddata) - count($this->arcolno))
    public function drawForm($nm,$at){
        echo '<form class="form" action="php/enviar.php" method="POST">';
        echo '<fieldset class="pure-group">';
        $setautofocus = false;
        $longitud = count($this->hddata);
        $contin = 0;
        for ($i=0; $i < $longitud; $i++){
            // si arcolno no es un array o el encabezado esta en arcolno dibuja
            if ((!(is_array($this->arcolno))) or (!(in_array($this->hddata[$i], $this->arcolno)))) {
                echo '<h5>'.str_replace("_"," ",$this->hddata[$i]).'</h5>';
                // si el primer dato no esta vacio lo dibuja segun atributo
                if ((!($nm[$contin]=="")) && ($contin==0)){
                    if ($at[$contin]=='readonly') {
        echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" value="'.utf8_encode($nm[$contin]).'" readonly="readonly" />';
                    } else {
                        echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" value="'.utf8_encode($nm[$contin]).'" />';
                    }
                    $i++;
                    $contin++;
                    echo '<h5>'.str_replace("_"," ",$this->hddata[$i]).'</h5>';
                // si no lo dibuja como autofocus
                } 
                if ($contin==0){
                    echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" tabindex="'.$contin.'" autofocus />';
                    $setautofocus = true;
                    $contin++;
                    // si no es el primer dato
                } else {
                    // si tiene dato para llenar autofill segun atributo
                    if (!($nm[$contin]=="")) {
                        if ($at[$contin]=='readonly') {
        echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" value="'.utf8_encode($nm[$contin]).'" readonly="readonly" />';
                        } else {
        echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" value="'.utf8_encode($nm[$contin]).'" tabindex="'.$contin.'" />';
                        }
                        // si no tiene dato para llenar
                    } else {
                        if ($setautofocus) { 
                            echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" tabindex="'.$contin.'" />';
                        } else {
                    echo '<input type="text" size="auto" name="'.$this->hddata[$i].'" tabindex="'.$contin.'" autofocus />';
                            $setautofocus = true;
                        }
                    }
                }
                $contin++;
            }
        }
        echo '</fieldset>';
        echo '<input type="text" size="auto" name="tablenm" value="'.$this->tablenm.'" hidden />';
        echo '<input type="text" size="auto" name="action" value="grabar" hidden />';
        echo '<input id="btnobjdbfrm" type="submit" value=" Enviar " tabindex="'.$contin.'"  />';
        echo '</form>';
    }
    // retorna los encabezados de la tabla exepto los arcolno    
    public function gethdscmpsForm(){
        $arrtrn = array();
        $longitud = count($this->hddata);
        $icont = 0;
        for ($i=0; $i < $longitud; $i++){
            if (!(in_array($this->hddata[$i], $this->arcolno))){
                $arrtrn[$icont] = $this->hddata[$i];
                $icont++;
            }
        }
        return $arrtrn;
    }
    // funcion que returna los datos para procesar documentos
    public function getDataDocs($arrfrm){
        $arrtrn = array();
        $longitud = count($this->hddata);
        $conti = 0;
        $str = '';
        for ($i=0; $i < $longitud; $i++){            
            if (!(in_array($this->hddata[$i], $this->arcolno))){
                $arrtrn[$i] = utf8_decode($arrfrm[$conti]);
                $conti++;
            } else {
                if ($this->hddata[$i] == 'Marca_temporal'){
                    $fecha = date_create();
                    $tmstmp = date_format($fecha, 'Y-m-d H:i:s');
                    $arrtrn[$i] = $tmstmp;
                } elseif ($this->hddata[$i] == 'Ord') {
                    $arrtrn[$i] = $this->numfilas;
                }                
            }
        }
        return $arrtrn;
    }
    // funcion para grabar los datos del formulario
    public function procForm($arrfrm){
        $sql = "INSERT INTO ".$this->tablenm." (";
        $longitud = count($this->hddata);
        $longno = count($this->arcolno);
        for ($i=0; $i < $longitud; $i++){
            $sql = $sql.$this->hddata[$i];
            if ($i < ($longitud-1)) {
                $sql = $sql.", ";
            } else {
                $sql = $sql.") VALUES (";
            }
        }
        $longitud = count($this->hddata);
        $conti = 0;
        for ($i=0; $i < $longitud; $i++){            
            if (!(in_array($this->hddata[$i], $this->arcolno))){
                $sql = $sql."'".utf8_decode($arrfrm[$conti]);
                $conti++;
            } else {
                if ($this->hddata[$i] == $this->tstmp){ //'Marca_temporal'){
                    $fecha = date_create();
                    $tmstmp = date_format($fecha, 'Y-m-d H:i:s');
                    $sql = $sql."'".$tmstmp;
                } elseif ($this->hddata[$i] == $this->ord){ //'Ord') {
                    $sql = $sql."'".($this->numfilas+1);
                }                
            }
            if ($i < ($longitud-1)) {
                $sql = $sql."', ";
            } else {
                $sql = $sql."')";
            }
        }
        //echo $sql;
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {die("Connection failed: " . mysqli_connect_error());}
        mysqli_select_db($con, $this->db);
        $result = mysqli_query($con, "SELECT * FROM ".$this->tablenm);
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Registro agregado exitosamente.');</script>";
        } else {
            echo "<script>alert('no record.');</script>";      
        }
        mysqli_close($con);
    }
    // $tblnm, nombre de la tablas, regter -> datos del tercero conincidente, hdreg -> encabezados tabla, 
    // $tertbldet, y $tblrel son las relaciones con la tabla de terceros
    /* este proceso se creo para facilitar el procesa datos de un formulario, sin embargo no parece ser muy adecuado ya que es 
        mas rapido llenar los datos, esta en desuso */
    public function dataterenrtn($tblnm,$regter,$hdreg,$tertbldet,$tblrel){        
        $rowbk = array();
        $long = count($tertbldet);      // total filas array multi
        $rowhd = $tertbldet[0];         // guarda encabezados del array que estan en la fila 1, la col 1 tiene los hds en la base de datos
        $last = count($rowhd);          // Cantidad de columnas del array
        $colhd = array();               // Encabezados del array tertbldet columna 1 despues de Marca_Temporal no necesaria en form
        $auxrow= array();
        for ($i=1; $i<$long; $i++) {
            $auxrow = $tertbldet[$i];
            array_push($colhd,$auxrow[0]);
        }   
        for ($i=0; $i<$last; $i++) {
            if ($rowhd[$i]==$tblnm) {
                $place = $i;            // place -> columna donde esta tablnm en $tertbldet y si no esta vacia coincidencias posibles
            }
        }
        $pushSN = false;
        $long = count($colhd);
        // recorre $tertbldet despues de Marca_Temporal, no necesario para form
        for ($i=0; $i<$long; $i++) {
          if (!(in_array($this->hddata[$i], $this->arcolno))){  
            $auxrow = $tertbldet[$i+1];   // almacena fila del array $tertbldet
            $dtaux = $auxrow[$place];   // almacena dato de la fila en la columna place, si no esta vacio tiene correspondencia con $tblnm
            if (!($dtaux=='')) {        // en cuyo caso lo buscamos y agregamos si tiene datos
                // function para retornar el dato debido
                $lngtblrel = count($tblrel);            // num filas array de relacion
                for ($j=0; $j<$lngtblrel; $j++) {
                    $rowrel = $tblrel[$j];                          // almacena fila j de la tabla relacional
                    if ($colhd[$i] == $rowrel[0]) {               // Si coincide encabezado con el de relacion
                        $lnghdreg = count($hdreg);                  // largo del registro y encabezado al coincidir es la pocision del dato
                        for ($k=0; $k<$lnghdreg; $k++){
                            $longrowrel = count($rowrel);           // Si hay varias posibilidades busca primer coincidencia
                            for ($l=1; $l<$longrowrel; $l++) {
                                if ($hdreg[$k] == $rowrel[$l]) {    // Si el hd del reg conincide con el de rel
                                    if (!($regter[$k]=="")) {
                                        array_push($rowbk,$regter[$k]);
                                        $pushSN = true;
                                        $l = $longrowrel;
                                        $k = $lnghdreg;
                                        $j = $lngtblrel;
                                    }
                                }
                            }
                        }
                        if ($pushSN) {
                            $pushSN = false;
                        } else {
                            array_push($rowbk,'');
                        }
                    } else if ($j==($lngtblrel-1)){
                        array_push($rowbk,'');
                    }
                }
            } else {
                if ($i<$long) { array_push($rowbk,''); }
            }
          } else {
              array_push($rowbk,'');
          }
        }
        return $rowbk;
    }    
}
?>