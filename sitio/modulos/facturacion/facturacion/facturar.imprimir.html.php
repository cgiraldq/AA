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
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Impresion de pantalla
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
include ("modulos.funciones.facturacion.php");
$rc4 = new rc4crypt();
$tabla="tblfacturasc";
$idcliente=$_REQUEST['idcliente'];
$idpedido=$_REQUEST['idpedido'];
$no=$_REQUEST['no'];
if ($_REQUEST['inn']==1){
	$idactivo=1; // generando factura
}
// validaciones de datos
	// armando vector de campos
	// insertando
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<?include("javageneral.facturacion.php");?>
<div class="site-overlay"></div>
<div id="container">
<section class="cont_header">

<body color=#ffffff  topmargin=5 leftmargin=0>
<div id="capa_impresion" align=center CLASS="TEXT1">
<a href="javascript:imprimir();">Imprimir</a> | <a href="javascript:window.close();">Cerrar Esta ventana</a>
</div>
			<?
			$border=0;
			$cellspacing=1;
		
			include ("facturar.plantilla.php");
			?>
<? include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
include("../../../incluidos_modulos/navegador.principal.cerrar.php");
?>
</body>
</html>
<script language="javascript">
<!--
<? if ($no==""){?>
function imprimir(){
	document.getElementById('capa_impresion').style.display='none';
	window.print();
}
<? } ?>
//-->
</script>
