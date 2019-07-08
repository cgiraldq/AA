<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");
$rc4 = new rc4crypt();
$titulomodulo="Enviando al cliente correo con sus datos y los casilleros";
$idclientepago=$_REQUEST['idclientepago'];
$paso=$_REQUEST['paso'];

if ($_REQUEST['inn']=="1") include("casillero.envio.correo.php");
$tabla="tblclientes";

$dstitulo_b="Envio de su(s) Casillero(s) de la tienda";
$dscausa_b="
Apreciado Sr(a) -Nombre-
Cordial Saludo,

El presente mensaje es para darle la bienvenido al servicio de nuestros casilleros. Le recordamos las direccion donde debe enviar su mercancia:


MIAMI
-dscodigousa-
Nombre / Name: -Nombre-
Dirección / Address: 5066 nw 74 avenue
Ciudad / City: Miami
Estado / State: Florida
Código Postal / Zip code: 33166

LONDRES
-dscodigouk-
Nombre / Name: -Nombre-
Dirección / Address: 42 Braganza street, Unit 5
Ciudad / City: London, SE17 3RJ, KENNINGTON LONDON, UK

";

?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
$rutamodulo="<a href='../clientesregistrados/default.php' class='textlink' title='Regresar a Cliente'>Regresar a Clientes</a>  /  ";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");

include("ingreso.envio.correo.php");
include("../../incluidos_modulos/modulos.remate.php");

?>
</body>
</html>
