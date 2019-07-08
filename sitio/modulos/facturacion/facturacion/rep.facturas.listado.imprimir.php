<?
$exp=$_REQUEST['exp'];
$border=0;
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
Reporte de relacion de facturas para imprimir
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
include ("modulos.funciones.facturacion.php");
// mensajes de recuperacion de claves
$tabla="tblfacturase";
$idaniox=$_REQUEST['idaniox'];
$idmesx=$_REQUEST['idmesx'];
//$db->debug=true;
$iddiax=$_REQUEST['iddiax'];
if ($iddiax<>"") { 
	if (strlen($iddiax)<2) $iddiax="0".$iddiax;
}  else { 
	$iddiax=date("d"); // al dia de generacion de la factura
}


if ($idaniox=="") $idaniox=date("Y");
if ($idmesx=="") $idmesx=date("m");

// fecha base de calculo
if (intval($idmesx)<date("m") && $iddiax=="") $iddiax=31;
$idfechabase=$idaniox.$idmesx.$iddiax;

// parametros de busqueda
	$codigos[0]="idpedido";
	$codigos[1]="dsorden";
	$codigos[2]="dsrazon";
	$codigos[3]="dsnit";
	$codigos[4]="dstele";

	$nombres[0]="Numero";
	$nombres[1]="Nro Orden";
	$nombres[2]="Tercero";
	$nombres[3]="NIT";
	$nombres[4]="Telefono";
// armando campos
$idactivox1=$_REQUEST['idactivox1'];
$paramx=$_REQUEST['paramx'];
$ordenar=$_REQUEST['ordenar'];
$dsvendedor=$_REQUEST['dsvendedor'];

?>
<html>
<head>
	<title><? echo $AppNombre;?> Administración: Reporte de relacion de facturas</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
</head>
<body color="#ffffff"  topmargin=0 leftmargin=0>
<?

?>	

<div id="capa_impresion" align=center class="text1">
<a href="javascript:imprimir();">Imprimir</a> | <a href="javascript:window.close();">Cerrar Esta ventana</a>
</div>


			<? include ("rep.facturas.listado.encabezado.imprimir.php");
			
	$bloqueabc=1;
	$mostrarestados=1;
	$mostrarfechasad=1;
	$cargau=1; // mostrasr usuarios
	$strSQL="select c.*,a.dsnombres";
	$strSQL.="";
	$strSQL.=" from $tabla c,tblclientes a ";
	$strSQL.=" where c.id > 0 and a.dsidentificacion=c.dsnit ";
	if($idactivox1<>"Todos" && $idactivox1<>"") $strSQL.=" and c.idactivo=$idactivox1 ";
	if($idactivox1=="Todos") $strSQL.=" and c.idactivo>=0 ";
	if($idmesx<>"") $strSQL.=" and c.idmes=$idmesx ";
	if($idaniox<>"") $strSQL.=" and c.idanio=$idaniox ";
	if($idaniox<>"" && $idmesx<>"" && $_REQUEST['iddiax']<>"") $strSQL.=" and c.idfechac=".$idaniox.$idmesx.$iddiax;
	if($_REQUEST['param']<>"") 	{
		if ($_REQUEST['campo']<>"idpedido" && $_REQUEST['campo']<>"dsorden") {
			$strSQL.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";			
		 } else { 
			$strSQL.=" and c.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
		}
	}
	
	$strSQL.=" and c.idactivo not in (3) ";
	if ($ordenar<>"") { 
		$strSQL.=" order by  a.dsnombre asc, c.idpedido asc ";
	} else {
		$strSQL.=" order by  c.idpedido asc ";
	}

	//echo $strSQL;

	$vermas=$db->Execute($strSQL);
	if (!$vermas->EOF){
			$xdssubtotal=0;
			$xdsdesct=0;
			$xdsiva=0;
			$xdsrete=0;
			$xdsreteiva=0;
			$xdstotal=0;
			$totalfac=0;
			while(!$vermas->EOF) {
				$color=$fondos[4];
				$colorx=$fondos[3];
				$totalfac++;
				
				
			$xdssubtotal=$xdssubtotal+$vermas->fields[20];
			$xdsdesct=$xdsdesct+$vermas->fields[27];
			$xdsiva=$xdsiva+$vermas->fields[22];
			$xdsrete=$xdsrete+$vermas->fields[23];
			$xdsreteiva=$xdsreteiva+$vermas->fields[24];
			$xdstotal=$xdstotal+$vermas->fields[28];
			?>

			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed">					
			<tr class=imprimir_tit_datos align="center" >		
					<td width="5%" align="center"><? echo $vermas->fields[38]."-".$vermas->fields[3];?></td>
					<!--td align="center" width="10%"><? //echo  fila->dsnit;?></td-->
					<td width="30%" align="center"><? echo $vermas->fields[7];?></td>
					<td align="center" ><? echo $vermas->fields[13];?></td>
					<td align=center ><? echo number_format($vermas->fields[20],0,",",".");?></td>
					<td  ><? echo number_format($vermas->fields[27],0,",",".");?></td>
					<td  ><? echo number_format($vermas->fields[22],0,",",".");?></td>
					<td  ><? echo number_format($vermas->fields[23],0,",",".");?></td>
					<td  ><? echo number_format($vermas->fields[24],0,",",".");?></td>
					<!--td  ><? echo number_format($fila->dsreteica,0,",",".");?></td-->
					<td  ><? echo number_format($vermas->fields[28],0,",",".");?></td>
  </tr>
</table>				


<?		$vermas->MoveNext();
		} // fin while 

	?>
<hr color="#CCCCCC" size="1" >

	<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" border=0>					
	<tr class=imprimir_tit_datos align=center >		
			<td width="5%" align="center" >
			<strong>&nbsp;</strong></td>
			<!--td align="center" width="10%" ><strong>&nbsp;</strong></td-->			
			<td width="30%" align="center" ><strong>TOTAL</td>
			<td align="center" ><strong><? echo $totalfac?></strong></td>

			<td  ><? echo number_format($xdssubtotal,0,",",".");?></td>
			<td  ><? echo number_format($xdsdesct,0,",",".");?></td>
			<td  ><? echo number_format($xdsiva,0,",",".");?></td>
			<td  ><? echo number_format($xdsrete,0,",",".");?></td>
			<td  ><? echo number_format($xdsreteiva,0,",",".");?></td>
			<!--td  ><? //echo number_format($xdsreteica,0,",",".");?></td-->
			<td><? echo number_format($xdstotal,0,",",".");?></td>
  </tr>
</table>				
	<?

	} // fin si 
	$vermas->Close();


include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
?>
</body>
</html>

<script language="javascript">
<!--
function imprimir(){
	document.getElementById('capa_impresion').style.display='none';
	window.print();
}
//-->
</script>

