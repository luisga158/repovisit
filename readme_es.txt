Cordial  saludo para todos.
=====================================================================================
Funcionamiento:
=====================================================================================
Primero que todo tiene una página de login.
De estar el usuario y la clave correctas va al programa de lo contrario muestra error.
Este es un programa que permite la creación de terceros, y reportes de visita.
Iniciando con la consulta del nit del tercero.
De estar creado procede al reporte de visita, cargando el nombre del tercero.
Enviando un correo al finalizar el reporte, con su cuenta de cobro, reporte de visita, (en formato doc) y documentos adicionales que se necesiten.
En lugar de adjuntar los archivos, los genera y guarda en el servidor para su archivo y envia los links de descarga en el correo.
Simplificando el envio de correos con adjuntos, y dejandonos un archivo.
Además tiene un sistema de consulta de un nit de tercero en multiples tablas, de no estar creado el tercero en la tabla principal que es terceros
Busca en las bases de dato adicionales y de hallar coincidencia usa esos datos para autorrellenar el formulario y facilitar su creación.
Tambien permite la consulta de tablas de la base de datos y muestra la seleccionada en pantalla.
Los modelos de las tablas estan en sql, para subir a phpmyadmin.
El programa cuenta con un archivo de seguridad basica llamado incluido en el archivo program.php para no permitir el acceso no autorizado.
=====================================================================================
Como usar:
=====================================================================================
Primero que todo modificar los archivos config.php y colocar los datos de para conexion con su servidor y base de datos.
Un config esta en el root y el otro en root/php.
Los modelos de las bases de datos estan en sql, subirlos a la base de datos que usaremos para el programa, tal como la llamamos en config.
Y la tabla codmundane.csv (esta en la carpeta csv), tiene los codigos DANE de Colombia, subir según su pais, con el mismo formato o modelo.
Y listo ya se puede ejecutar el programa.
Usuarios: administrador y user, contraseña 123
=====================================================================================
Modificaciones para documentos:
=====================================================================================
Para la cta de cobro en la linea 86 deben remplazar el scr o link por su firma.
En las lineas 73 y 74 su nombre e identificacion. Lineas 59 60 y 61, su nombre , identificacion y regimén.
Y en la linea 53 el logo. Lineas de la 81 a la 89 datos y link de su empresa.

Para Repo Visita reemplazar:
Linea 36 imagen de logo, linea 68 imagen firma y de la 70 a la 81 datos de la empresa o persona que factura.

Estos documentos son generados por los archivos en la carpeta php: ReportedeVisita.php y CtaCobro.php
Donde hay que realizar las modificaciones mencionadas.
=====================================================================================
Sobre el funcionamiento del programa
=====================================================================================
En la carpeta php el archivo funcvarprog.php, contiene variables y funciones usadas a
lo largo del programa.
Empezando con las funciones que cargan el menú y el script de los botones, lo que permite
atraves de variables post recibidas por program.php de haberlas, la modificacion del menu
y su presentacion además de la modificacion de la capa visible segun necesidad.
El archivo am.php (action manager), permite invocar aciones atravez de variables post 
Igual el archivo enviar.php, recibe variables post y procede segun datos recibidos.
La clase CProg es usada en am.php para procesar las acciones.
Y la clase CObjdb es usada en CProg para interactuar con las bases de datos.
El archivo enviar usa funciones de funcvarprog.php al igual que la clase CObjdb
ademas de CtaCobro.php y ReportedeVisita.php, para la generacion de documentos
y su envio.
Permitiendo tambien validar los datos antes de proceder, y de no pasar la validacion
muestra datos con error y boton de regresar, con el formulario con los datos que estaban
ya llenos.
=====================================================================================
Espero les baste con esos datos, pero luego daré mas detalles sobre su funcionamiento
=====================================================================================