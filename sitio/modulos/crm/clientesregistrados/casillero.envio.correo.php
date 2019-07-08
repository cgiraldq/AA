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
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// procesos de envio de correos hacia el cliente
$titulo=$_REQUEST['dstitulo_b'];
$dsobs=$_REQUEST['dscausa_b'];
$fechanotificacion=$_REQUEST['dsfecha_b'];
//
$dsdiasorigen=$_REQUEST['dsdiasorigen'];
$dsdiasdestino=$_REQUEST['dsdiasdestino'];
//
$dsaprobo=$_REQUEST['dsaprobo'];
$dsnacionalizacion=$_REQUEST['dsnacionalizacion'];
//
$dsorigen=$_REQUEST['dsorigen'];
if ($dsorigen=="") $dsorigen=" Origen ";
$dsdestino=$_REQUEST['dsdestino'];
if ($dsdestino=="") $dsdestino=" Destino ";
//
$dsobs=formateo_texto($dsobs);
//
$asuntocf="Aviso de la tienda: ".$titulo;
$asuntocorreocliente=$titulo;
$mensajes=" <strong>Envio de correo hacia el cliente para el estado  $dsestado del pedido $idpedido </strong>";
include ("casillero.envio.correo.formato.php");
// envio generico de correos
include("casillero.envio.correo.procesos.php");
// fin envio generico de correos
// insercion en la tabla
?>