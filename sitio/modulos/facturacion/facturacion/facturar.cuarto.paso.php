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
 Paso de opciones de impresion de la factura
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
$no=$_REQUEST['no']; // no actualizar
// validaciones de datos
if ($no=="") { 
	$idactivo=1;
	// Actualixar factura para facturado
	$sql="update tblfacturase set idactivo=$idactivo  where idpedido=".$idpedido;
	//mysql_db_query($dbase,$sql,$db);
}	
$mensajeData="Paso 4. Modos de impresión para la factura Nro. $idpedido";
// armando vector de campos
// insertando
?>
<html>
<head>
<title><? echo $AppNombre;?> Facturacion: Revisando</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
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
		<form action="default.php" method=post name=u>
		
		
			<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top colspan=6 class="forma2">
<input type=button name=enviar value="Imprimir Esta pantalla" class=formabot1 onClick="irAPaginaDN('facturar.imprimir.html.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>','','');">


<!--input type=button name=enviar value="Exportar Excel" class=formabot1 onClick="irAPaginaD('facturar.exportar.xls.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>');"-->


<!--input type=button name=enviar value="Enviar por email" class=formabot1 onClick="irAPaginaD('facturar.impresion.email.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>');" disabled-->

<!--input type=button name=enviar value="Generar PDF" class=formabot1 onClick="cargarformulario('u','facturar.exportar.PDF.php','<? echo $idpedido?>','<? echo $idcliente?>')" -->
<input type="hidden" name="idpedido">
<input type="hidden" name="idcliente">


				</td>
		</tr>
		
	
			<tr bgcolor="<? echo $fondos[3];?>" align=center>
			<td valign=top colspan=6 class="forma2" align="center">

			<? 
			 $sql="select * from tblclientes where id=$idcliente";
			 $vermasx=mysql_db_query($dbase,$sql,$db);
			 if (mysql_num_rows($vermasx)==1) { 
				 $nombrecliente=mysql_result($vermasx,"0","dsnombre");
			     $nombrecliente=ereg_replace(" ","",$nombrecliente);
			 }
			 
			  // nombre de la factura almacenada
			  $ruta="../../temas/facturas/";
			  $name="factura_".$idpedido."_".$nombrecliente.".pdf";
			  if (is_file($ruta.$name)) {

			?>
				<table width=80% align=center  cellpadding=5 cellspacing=1 class="textoimpresion">
					<tr bgcolor="<? echo $fondos[3];?>" >
						<td valign=top align="left" >
							Archivo disponible para descargar en pdf
							<a href="descargar.php?r=<? echo $ruta?>&nombre=<? echo $name?>">Descargar 
						    <img src="../../temas/tipoarchivos/pdf.gif" width="16" height="16" border="0"></a>
							<br>
						  (Si modifico la factura, debe generar nuevamente el PDF)							</td>
					</tr>
				</table>			
			
			 
			<? } ?>
			
			<?
			$border=0;
			$cellspacing=1;
			include ("facturar.plantilla.php");
			?>
			</td>
			</tr>
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top colspan=6 class="forma2">
<input type=SUBMIT name=enviar value="PRINCIPAL FACTURAS" class=formabot1 >
				</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
