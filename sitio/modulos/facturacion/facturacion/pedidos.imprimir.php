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
 Impresion de Datos de facturacion
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$tabla="tblfacturase";
// proceso de refacturacion
$mensajeData="";
$filasdatos=8; // datos del ciclo
// consecutivo
$idpedido=$_REQUEST['idpedido'];
$inn=$_REQUEST['inn'];
$mod=$_REQUEST['mod'];
if ($idpedido=="") {
	$idpedido=ultimadata("idpedido",$tabla);
	$des="";
} else { 
	$des="";
}	

$ceros="";
for ($i=1;$i<=(6-strlen($idpedido));$i++) { 
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
		$idorden=$fila->idroden;
		
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
		
	} else { 
		$idcliente="";
		$dsfechac=$fechaBase;
		$dsfechav=$fechaBase;
		$dsobs="";
		$idorden="";
		$dsvendedor="";
		$dsorden="";
//		
		$dssubtotal="";		
		$dsiva="";		
		$dstotal="";		
//
		$dsbase="";				
		$dsrete="";		
		$dsdesct="";		
		$dsreteiva="";		
		
	}
	mysql_free_result($vermas);
}

?>
<html>
<head>
<title><? echo $AppNombre;?> Facturacion</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<script language="javascript" src="../../incluidos/ajax.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/resultoperaciones.php");?>
<br>

<table width=100%  border="0" align=center  cellpadding=2 cellspacing=1 bgcolor="#CCCCCC" class="textnegro3">
		<tr bgcolor="<? echo $fondos[3];?>" align="center" class="textnegrotiti" >
		<td valign=top bgcolor="#FFFFFF" class="textbold" >LOGO</td>
		<td align="center" valign=top bgcolor="#FFFFFF" class="textbold" >FACTURA CAMBIARIA DE COMPRAVENTA</td>
		<td valign=top align="center" >&nbsp;</td>
		</tr>
</table>
<br>
	
<table width=100%  border="0" align=center  cellpadding=2 cellspacing=1 bgcolor="#CCCCCC" class="textnegro3">
		<tr  >
		<td valign=top bgcolor="#FFFFFF" class="textbold" >
		Nro.		</td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" >
<? echo $idpedidox;?>		</td>
		<td valign=top bgcolor="#FFFFFF" class="textbold" >
		Fecha </td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" >
<? echo $dsfechac;?>		</td>
		</tr>		
		<tr  >
		  <td valign=top bgcolor="#FFFFFF" class="textbold" > Orden Nro.</td>
		  <td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo $dsorden;?>
		  <td valign=top bgcolor="#FFFFFF" class="textbold"  >
		Fecha de vencimiento</td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2"  >
<? echo $dsfechav;?></td>
</tr>

<tr  >
		<td valign=top bgcolor="#FFFFFF" class="textbold" >Forma de pago </td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" >&nbsp;</td>
		
		<td valign=top bgcolor="#FFFFFF" class="textbold" >
		VENDEDOR		</td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" >
<? echo seldato("dsnombre","id","tblusuariose",$dsvendedor,1);?></td>
</tr>
		
		<tr  >
		<td valign=top bgcolor="#FFFFFF" class="textbold" >
		Tercero:</td>		
		<td  colspan="3" valign=top bgcolor="#FFFFFF" class="textnegro2">
	<? echo seldato("dsnombre","id","tblclientes",$idcliente,1);?>	</td>
		</tr>
</table>
<? //////////////////////////////////////// CUERPO CENTRAL ///////////////////////////////?>		
<br>
<table width=100%  border="0" align=center  cellpadding=2 cellspacing=1 bgcolor="#CCCCCC">
		<tr bgcolor="<? echo $fondos[3];?>" align="center" class="textnegrobl">
<td width="10%" valign=top bgcolor="#FFFFFF" class="textbold">REFERENCIA</td>
<td width="10%" valign=top bgcolor="#FFFFFF" class="textbold">UNIDAD</td>
<td valign=top bgcolor="#FFFFFF" class="textbold" >DESCRIPCION</td>
<td width="10%" valign=top bgcolor="#FFFFFF" class="textbold">VALOR</td>
<td width="10%" valign=top bgcolor="#FFFFFF" class="textbold">CANTIDAD</td>
<td width="20%" valign=top bgcolor="#FFFFFF" class="textbold">SUBTOTAL</td>
		</tr>

<?
$totales=0;
for ($i=0;$i<=$filasdatos;$i++) { ?>
 <?
	$sql="select a.* ";
	$sql.=" from tblfacturasc a ";
	$sql.="  where a.dspedido='$idpedido' and idpos='$i'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$fila=mysql_fetch_object($vermas);
		$totales=$totales+$fila->dscant;
		$dsref=$fila->dsref;
		$dscant=$fila->dscant;
		$dsun=$fila->dsunidad;
		$dsvalor=$fila->dsvalor;
		$dsdesc=$fila->dsdesc;
		$dssubtotalx=$fila->dssubtotal;
		$idproducto=$fila->idproducto;
	} else { 
		$dsref="";
		$idproducto="";
		$dscant="";
		$dsun="";
		$dsvalor="";
		$dsdesc="";
		$dssubtotalx="";		
	}
	mysql_free_result($vermas);
		?>
<tr class="textnegro3"  align=center>
<td bgcolor="#FFFFFF" class="textnegro2"><? echo $dsref?>&nbsp;</td>
<td bgcolor="#FFFFFF" class="textnegro2"><? echo $dsun;?>&nbsp;</td>
<td bgcolor="#FFFFFF" class="textnegro2"><? echo $dsdesc;?>&nbsp;</td>
<td bgcolor="#FFFFFF" class="textnegro2"><? echo $dsun;?>&nbsp;</td>
<td bgcolor="#FFFFFF" class="textnegro2"><? echo $dscant;?>&nbsp;</td>
<td bgcolor="#FFFFFF" class="textnegro2">
<? 
if ($dssubtotalx<>"") echo number_format($dssubtotalx,0,"",".");?>
&nbsp;</td>
</tr>
<? 	} // FIN FOR?>
</table>
<br>

<table width=100%  border="0" align=center  cellpadding=2 cellspacing=1 bgcolor="#CCCCCC" class="textnegro1" style="table-layout:fixed">

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
<td width="12%" valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>SUBTOTAL</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo number_format($dssubtotal,0,"",".");?></td>
</tr>

		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
<td width="10%" valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>DESCUENTO</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo number_format($dsdesct,0,"",".");?></td>
</tr>



	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
		<td width="10%" valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>IVA</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo number_format($dsiva,0,"",".");?></td>
</tr>


	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
		<td width="10%" valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>RETEFUENTE</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo number_format($dsrete,0,"",".");?></td>
</tr>
	<tr bgcolor="<? echo $fondos[3];?>" align="left">		
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
		<td width="10%" valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>RETE IVA</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2" ><? echo number_format($dsreteiva,0,"",".");?></td>
</tr>
		<tr bgcolor="<? echo $fondos[3];?>" align="left">
<td colspan="5" valign=top bgcolor="#FFFFFF" >&nbsp;</td>		
		<td valign=top bgcolor="#FFFFFF" class="textnegro2"><strong>TOTAL</strong></td>
		<td valign=top bgcolor="#FFFFFF" class="textnegro2"><? echo number_format($dstotal,0,"",".");?></td>
		</tr>
</table>



<br>


	
</body>
</html>
<? include ("../../incluidos/cerrarconexion.php"); ?>
<script language="javascript">
<!--
window.print();
//-->
</script>
