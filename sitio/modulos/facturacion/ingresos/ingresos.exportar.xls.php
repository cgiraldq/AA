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
 Exportacion a word
*/
$idpedido=$_REQUEST['idpedido'];
header("Content-type: application/octet-stream");
$nombre="factura_".$idpedido.".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblfacturasc";
$idcliente=$_REQUEST['idcliente'];

?>
<html>
<head>
<title><? echo $AppNombre;?> Impresion Factura <? echo $idpedido;?></title>
<link rel="stylesheet" type="text/css" href="<? echo $rutaImpresion;?>incluidos/estilos.css">	
</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
			<?
			$border=1;
			$cellspacing=0;
			include ("facturar.plantilla.php");
			?>
			<br>
<br>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
<script language="javascript">
<!--
window.print();
//-->
</script>
