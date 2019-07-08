<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
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
$rc4 = new rc4crypt();
$tabla="tblrecibos";
$no=$_REQUEST['no'];
$idrecibo=$_REQUEST['idrecibo'];
$idpedido=$_REQUEST['idpedido'];
$border="";
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body color="#ffffff"  >
<? //include($rutxx."../../incluidos_modulos/navegador.principal.php");?>


<div id="capa_impresion" align=center CLASS="TEXT1">

<!--a class=formabot1 href="facturar.imprimir.html.2.php?idpedido=<? echo $idpedido;?>">Imprimir Esta factura</a>
|
-->

<a href="javascript:imprimir();">Imprimir</a> | <a href="javascript:window.close();">Cerrar Esta ventana</a>
</div>


			<?
			$border=0;
			$cellspacing=0;
			include ("ingresos.plantilla.php");
			?>
<? include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
//include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	//include($rutxx."../../incluidos_modulos/modulos.remate.php");?>
</body>
</html>
<script language="javascript">
<!--
<? //if ($no==""){?>
function imprimir(){
	document.getElementById('capa_impresion').style.display='none';
	window.print();
/*
var OLECMDID = 6; 
var PROMPT = 6; 
var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
document.body.insertAdjacentHTML('beforeEnd', WebBrowser); 
WebBrowser1.ExecWB(OLECMDID, PROMPT); 
WebBrowser1.outerHTML = ""; 
*/
	
}
<? //} ?>
//-->
</script>
