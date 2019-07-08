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
 Plantilla de carga de edicion de facturas
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$tabla="tblfacturase";
$mensajeData="Ingreso de factura";
// consecutivo
$idpedido=$_REQUEST['idpedido'];

// datos de refacturacion
$idpedidoy=$_REQUEST['idpedidoy'];
$idclientey=$_REQUEST['idclientey']; 
//fin datos de refacturacion

$inn=$_REQUEST['inn'];
$mod=$_REQUEST['mod'];
if ($inn<>"") { 
	$dsobs=($_REQUEST['dsobs']); // codigo de producto
	$sql="select * from $tabla where idpedido='$idpedido'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		// actualizar los datos
		$sql=" update $tabla set ";
		$sql.="dsobs='$dsobs'";		
		$sql.=" where idpedido='$idpedido' ";


		if (mysql_db_query($dbase,$sql,$db)) {
		 $Mensaje=" Factura $idpedido actualizada en el sistema.";
		 $Mensaje.=" <br>";
		 $Mensaje.="<a class=formabot1 href=\"javascript:irAPaginaDN('facturar.imprimir.html.php?idpedido=$idpedido&idcliente=$idcliente','','');\">Ver Esta factura</a>&nbsp;";
 		 $Mensaje.=" | &nbsp;<a href='".$pagina."' class=formabot1>Nueva Factura</a><br>";
		} else { 
			$Mensaje="Problemas al insertar:<br>";
			$Mensaje.="Sistema Dice: ".mysql_error();
		}

	}
	mysql_free_result($vermas);
	////////////// FIN DATOS A LA TABLA AUXILIAR DE COLORES /////////////////////////////
	// if ($h>0) $Mensaje.=", junto con su detalle asociado";
	$mod=1;
}

if ($idpedido=="") {
	$idpedido=ultimadata("idpedido",$tabla);
	$des="";
} else { 
	$des="";
}	

$ceros="";
for ($i=1;$i<=($posdatos-strlen($idpedido));$i++) { 
	$ceros.="0";
}
$idpedidox=$ceros.$idpedido;
if ($idpedido<>"") { 
	// traer los datos de la tabla
	$sql="select * from $tabla where idpedido='$idpedido'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$fila=mysql_fetch_object($vermas);
		$idcliente=$fila->idcliente;
		$dsfechac=$fila->dsfechac;		
		$idorden=$fila->idorden;
		$dsobs=$fila->dsobs;
		$dsvendedor=$fila->dsvendedor;
		$dsfechav=$fila->dsfechav;
		$dssubtotal=$fila->dssubtotal;		
		$dsiva=$fila->dsiva;		
		$dstotal=$fila->dstotal;		
		$dsbase=$fila->dsbase;				
		$dsrete=$fila->dsrete;		
		$dsdesct=$fila->dsdesct;		
		$dsreteiva=$fila->dsreteiva;		
		$dsreteica=$fila->dsreteica;		
	}
	mysql_free_result($vermas);
}

?>
<html>
<head>
<title><? echo $AppNombre;?> Editar Facturacion</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<script language="javascript" src="../../incluidos/ajax.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	document.u.submit();
 }
//-->
</SCRIPT>
</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php");?>
<? include ("../../incluidos/resultoperaciones.php");?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
		<form action="<? echo $pagina;?>" method=post name=u>
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="#CCCCCC" class="textbold" style="border-bottom:<? echo $fondos[20];?>" >
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td colspan=6 align="right" valign=top bgcolor="#FFFFFF" class="link_negro1">
			  	<input type=button name=enviar value="Regresar" class="formbt1" onClick="irAPaginaD('default.php');">
				</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		Factura Nro.		</td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1" colspan=3>
		<input type="text" name="idpedidox" class="link_negro1"  value="<? echo $idpedidox;?>" maxlength="10" size="10" readonly>
		<input type="hidden" name="idpedido" value="<? echo $idpedido;?>">
		</td>
		
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		Fecha (AAAA/MM/DD)		</td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<input type="text" name="dsanioc" class="link_negro1"  value="<? echo $_SESSION['i_dsanio'];?>" maxlength="4" size="2" readonly>
 /
<input type="text" name="dsmesc" class="link_negro1"  value="<? echo $dsmes;?>" maxlength="2" size="1" >
/
<select name=dsdiac class="forma">
	<? for ($i=1;$i<=31;$i++) {
		$i1=$i;
		if ($i<10) $i1="0".$i;
		?>
	<option value="<? echo $i1?>" <? if ($i1==date("d")) echo selected?>><? echo $i1?></option>
	<? } ?>
	</select>



		</td>
		</tr>		
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">Observaciones</td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1" colspan=3>
<textarea name="dsobs" class="link_negro1" cols=60 rows=8><? echo $dsobs;?></textarea>

		</td>
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		Fecha de vencimiento </td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechav', this);" language="javaScript">			
		
<input type="text" name="dsfechav" class="link_negro1"  value="<? echo $dsfechav;?>" maxlength="10" size="10">

</td>
</tr>

</table>
<? //////////////////////////////////////// CUERPO CENTRAL ///////////////////////////////?>		
<br>

		<table width=100% align=center  cellpadding=1 cellspacing=2 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed" class="textnegro">		
		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="20%" class="link_negro1"><strong>SUBTOTAL</strong></td>
		<td valign=top ><input type="text" name="subtotalvalor" class="textnegro2" value="<? echo $dssubtotal;?>" size="15" onBlur="totales();"></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
<td valign=top width="10%" class="link_negro1"><strong>DESCUENTO</strong>
% <input type="text" name="portotaldescuento" class="textnegro2" size="3" onBlur="totales();" value="<? echo $dspordesct;?>" readonly>
</td>
		<td valign=top ><input type="text" name="totaldescuento" class="textnegro2" value="<? echo $dsdesct;?>" size="15" onBlur="totales();" maxlength="20" readonly></td>
</tr>



	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="link_negro1"><strong>IVA</strong></td>
		<td valign=top ><input type="text" name="totaliva" class="textnegro2" value="<? echo $dsiva;?>" size="15" onBlur="totales();"></td>
</tr>


	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="link_negro1"><strong>RETEFUENTE</strong></td>
		<td valign=top ><input type="text" name="totalrete" class="textnegro2" value="<? echo $dsrete;?>" size="15" onBlur="totales();"></td>
</tr>
	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="link_negro1"><strong>RETE IVA</strong></td>
		<td valign=top ><input type="text" name="totalreteiva" class="textnegro2" value="<? echo $dsreteiva;?>" size="15" onBlur="totales();"></td>
</tr>


	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top width="10%" class="link_negro1"><strong>RETE ICA</strong></td>
		<td valign=top ><input type="text" name="totalreteica" class="textnegro2" value="<? echo $dsreteica;?>" size="15" onBlur="totales();"></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td valign=top colspan="5" >&nbsp;</td>		
		<td valign=top class="link_negro1"><strong>TOTAL</strong></td>
		<td valign=top><input type="text" name="totalvalor" class="textnegro2" value="<? echo $dstotal;?>" size="15" onBlur="totales();"></td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
<td valign=top colspan="5" >&nbsp;</td>				
			<td valign=top align="right" colspan="2">
				<input type=button name=enviar value="Guardar" class="formbt1" onClick="valI();" >
				<input type=hidden name=inn value="1">
				<input type=hidden name=mod value="<? echo $mod;?>">
				<input type=button name=enviar value="Regresar" class="formbt1" onClick="irAPaginaD('default.php');">	
				<input type="hidden" name="dsfechac" value="<? echo $dsfechac;?>" >
<!--  DATOS DEL CLIENTE PARA PROCESOS DE IMPUESTOS -->				
<!--  FIN DATOS DEL CLIENTE PARA PROCESOS DE IMPUESTOS -->				

</td>
		</tr>
</table>
</form>	

	
<? include ("../../incluidos/inferior.php"); ?>
</body>
</html>
<? include ("../../incluidos/cerrarconexion.php"); ?>
