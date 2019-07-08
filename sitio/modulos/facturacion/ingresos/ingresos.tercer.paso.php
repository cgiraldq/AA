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
 Paso de impresion de datos para el recibo de caja
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblfacturasc";
$idrecibo=$_REQUEST['idrecibo'];
$idpedido=$_REQUEST['idpedido'];
// validaciones de datos
	$mensajeData="Paso 3. Vista previa para el recibo Nro. $idrecibo";
	// armando vector de campos
	// insertando
?>
<html>
<head>
<title><? echo $AppNombre;?> Ingresos: Previa para imprimir</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php");?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>" >
		<!--form action="ingresos.tercer.paso.php" method=post name=u onSubmit="return valI();"-->
		<form action="default.php" method=post name=u>
		
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top colspan=6 class="link_negro1">

<input type=SUBMIT name=enviar value="REGRESAR" class="formbt1" >

<input type=button name=enviar value="IMPRIMIR" class="formbt1" onClick="irAPaginaDN('ingresos.imprimir.html.php?idrecibo=<? echo $idrecibo;?>','','');">

<input type=button name=enviar value="NUEVO" class="formbt1" onClick="irAPaginaD('../ingresos/ingresos.primer.paso.php');" title="Click para ingresar un nuevo recibo">

<input type=button name=enviar value="FACTURACION" class="formbt1" onClick="irAPaginaD('../facturacion/default.php');" title="Click para el principal de facturas">


				</td>
		</tr>
			<tr bgcolor="<? echo $fondos[3];?>" align=center>
			<td valign=top colspan=6 class="link_negro1"align="center">
			<?
			$border=0;
			$cellspacing=1;
			include ("ingresos.plantilla.php");
			?>
			<br>
			</td>
			</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
