<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2008
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com>
  Juan Felipe S�nchez <graficoweb@comprandofacil.com>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Impresion de pantalla
*/
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/class.rc4crypt.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$idcliente=$_REQUEST['idcliente'];
$idpedido=$_REQUEST['idpedido'];
$border=0;
$cellspacing=2;
$filename = "facturar.plantilla.php";
///////
ob_start();
include $filename;
$contents = ob_get_contents();
ob_end_clean();
///////
$handle = printer_open($rutaImpresora);
printer_set_option($handle, PRINTER_MODE, "raw");
printer_write($handle,$contents);
printer_close($handle);
include ("../../incluidos/cerrarconexion.php");
?>