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
 Paso final que permite ver la factura con sus datos antes del paso final
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblfacturasc";
$idcliente=$_REQUEST['idcliente'];
$idpedido=$_REQUEST['idpedido'];
if ($_REQUEST['inn']==1){
	$idactivo=1; // generando factura
}
// validaciones de datos
	$mensajeData="Paso 3. Revision de datos  para la factura Nro. $idpedido";
	// armando vector de campos
	// insertando
?>
<html>
<head>
<title><? echo $AppNombre;?> Facturacion: Revisando</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
<? if ($val==2){?>
location.href="facturar.cuarto.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>";
<? } ?>
     // validacion acceso
    function valI(){
	if (document.u.dsobs.value==""){
		alert("Ingrese las observaciones generales");
		return false;
	}

	if (document.u.dsobsfinal.value==""){
		alert("Ingrese las observaciones finales");
		document.u.dsobsfinal.focus();
		return false;
	}
	 return true;
  }
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
		<form action="facturar.cuarto.paso.php" method=post name=u onSubmit="return valI();">
			<tr bgcolor="<? echo $fondos[3];?>" align=center>
			<td valign=top colspan=6 class="forma2" align="center">
			<?
			$border=0;
			$cellspacing=1;
			include ("facturar.plantilla.php");
			// actualizar el total en la plantilla de facturas
			$sql="update tblfacturase  set dsvalor='$total',dsiva='$dsiva',dsdesct='$descuentos' ";
			$sql.="where idpedido=$idpedido";
			mysql_db_query($dbase,$sql,$db);			
			?>
			<br>
			</td>
			</tr>
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top colspan=6 class="forma2">
<input type=SUBMIT name=enviar value="FINALIZAR PROCESO" class=formabot1 >
<input type=button name=enviar value="Regresar - Actualizar Factura" class=formabot1 onClick="irAPaginaD('facturar.segundo.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>&mod=1');">
			
				<input type=button name=enviar value="Cancelar - Borrar Factura" class=formabot1 onClick="irAPaginaD('default.php?del=1&idpedido=<? echo $idpedido;?>');">
				<input type="hidden" name="totalcampos" value="<? echo $campo;?>">
				<input type="hidden" name="idcliente" value="<? echo $idcliente;?>">
				<input type="hidden" name="idpedido" value="<? echo $idpedido;?>">
				<input type="hidden" name="inn" value="1">
				</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
