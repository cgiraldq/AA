<?
$exp=$_REQUEST['exp'];
$border=0;
/*
| ----------------------------------------------------------------- |
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
Relacion de facturas. Agrupar por tercero
*/
if ($exp=="1") { 
header("Content-type: application/octet-stream");
$nombre="ventas_agrupadas_".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
$border=1;
$colspan=10;
}

$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
// mensajes de recuperacion de claves
//$db->debug=true;
$titulomodulo="REPORTES. RELACION DE FACTURAS AGRUPADAS";
$tabla="tblfacturase";
$idaniox=$_REQUEST['idaniox'];
$idmesx=$_REQUEST['idmesx'];
$iddiax=$_REQUEST['iddiax'];
if (strlen($iddiax)<2 && $iddiax<>"") $iddiax="0".$iddiax;
if ($idaniox=="") $idaniox=$_SESSION['i_dsanio'];
//if ($idmesx=="") $idmesx=$_SESSION['i_dsmes'];

// parametros de busqueda
	$codigos[0]="idpedido";
	$codigos[1]="dsorden";
	$codigos[2]="dsnombre";
	$codigos[3]="dsnit";
	$codigos[4]="dstel";

	$nombres[0]="Numero";
	$nombres[1]="Nro Orden";
	$nombres[2]="Tercero";
	$nombres[3]="NIT";
	$nombres[4]="Telefono";
// armando campos
$idactivox1=$_REQUEST['idactivox1'];
$paramx=$_REQUEST['paramx'];
$strSQLx=$_REQUEST['strSQLx'];
$ordenar=$_REQUEST['ordenar'];
$dsvendedor=$_REQUEST['dsvendedor'];

if ($idaniox=="") $idaniox=date("Y");
//if ($idmesx=="") $idmesx=date("m");


if ($exp=="") { 
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<br>
<?
}
// parametro adicional en caso que se lista por empresa
	$bloqueabc=1;
	$mostrarestados=1;
	$mostrarfechasad=1;
	$cargau=1; // mostrasr usuarios
	if ($exp=="")   include ($rutxx."../../incluidos_modulos/buscador.php"); 
	$strSQL="select sum(c.dssubtotal) as subtotal,sum(c.dsbase)as base,sum(c.dsiva) as iva,sum(c.dsrete) as rete,";
	$strSQL.="sum(c.dsreteiva) as reteiva,sum(c.dstotal) as total,c.idanio,a.dsnombres,a.dsidentificacion,a.dsdireccion,a.dstelefono";
	$strSQL.="";
	$strSQL.=" from $tabla c,tblclientes a ";
	$strSQL.=" where c.id > 0 and a.id=c.idcliente ";
	if($idactivox1<>"Todos" && $idactivox1<>"") $strSQL.=" and c.idactivo=$idactivox1 ";
	if($idactivox1=="Todos") $strSQL.=" and c.idactivo>=0 ";
	if($idactivox1=="") $strSQL.=" and c.idactivo not in (3) ";
	if($idmesx<>"") $strSQL.=" and c.idmes=$idmesx ";
	if($idaniox<>"") $strSQL.=" and c.idanio=$idaniox ";
	if($idaniox<>"" && $idmesx<>"" && $iddiax<>"") $strSQL.=" and c.idfechac=".$idaniox.$idmesx.$iddiax;
	if($_REQUEST['param']<>"") 	{
		if ($_REQUEST['campo']<>"idpedido" && $_REQUEST['campo']<>"dsorden") {
			$strSQL.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";			
		 } else { 
			$strSQL.=" and c.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
		}
	}
	$strSQL.=" group by c.idanio,a.dsnombres,a.dsidentificacion,a.dsdireccion,a.dstelefono" ;
	$strSQL.=" order by  a.dsnombres asc";
	$strSQLx1=$strSQL;
	if ($strSQLx<>"") $strSQL=$strSQLx;
	$rutaPaginador=$pagina."?idprog=$idprog&$dsprog=$dsprog&letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=$campo&idestadox=$idestadox&paramx=$paramx&iddiax=$iddiax&idaniox=$idaniox&idmesx=$idmesx&idactivox1=$idactivox1&enca=$enca&cantidad=$tampag&ordenar=$ordenar&pag=";
	$rutaImpresionx="idprog=$idprog&$dsprog=$dsprog&letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idestadox=$idestadox&paramx=$paramx&iddiax=$iddiax&idaniox=$idaniox&idmesx=$idmesx&idactivox1=$idactivox1&dsvendedor=$dsvendedor";
	if($exp==""){
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	}
	$vermas=$db->Execute($strSQL);
	$x="cantidad";
	?>
	<br>
		<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2" border="<?echo $border?>">
			<tr bgcolor="<? echo $fondos[5];?>">
					<td valign=top align=left colspan="<?echo $colspan?>">
						<h2 style="margin: 0;">REPORTES. RELACION DE FACTURAS AGRUPADAS</h2>
					</td>
					<? if ($exp=="") {?>
					<td valign=top align=right>
					 <a href="../facturacion/rep.facturas.listado.php" title="Click para relacion de facturas" class="botones"><p >Relacion de facturas</p></a>											
					 <a href="../facturacion/<? echo $pagina?>?exp=1&strSQLx=<? echo $strSQLx1?>" title="Click para exportar a un archivo de excel" class="botones"><p >Exportar</p></a>							 		
					 <a href="../facturacion/default.php" title="Click para regresar" class="botones"><p >Regresar</p></a>											

					</td>
					<? } ?>
					
			</tr>
		</table>



			<table class="text1" width=100% align=center   border="<?echo $border?>" cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>" class="forma">
			<tr class="text_blanco" bgcolor="<? echo $fondos[12];?>" align="center">
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >A&Ntilde;O</td>			
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >NIT</td>			
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" width="20%" >Tercero</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >Direccion</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >Telefono</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >SubTotal</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >IVA</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >Retefuente</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >ReteIva</td>
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" >Total</td>
			</tr>
			</table>

		<? 
		if (!$vermas->EOF){
			while(!$vermas->EOF) {
				$color=$fondos[4];
				$colorx=$fondos[3];
				$totalfac++;
				
					?>
	<table class="text1" width=100% align=center  border="<?echo $border?>" cellpadding=2 cellspacing=1 style="table-layout:fixed">					
			<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">		
					<td align="center" class="link_negro1"><? echo $vermas->fields[6];?></td>
					<td align="center" class="link_negro1"><? echo $vermas->fields[8];?></td>
					<td width="20%" align="center" class="link_negro1"><? echo $vermas->fields[7];?></td>
					<td align="center" class="link_negro1"><? echo $vermas->fields[9];?></td>
					<td align="center" class="link_negro1"><? echo $vermas->fields[10];?></td>
					<? if ($exp=="") {?>			
					<td class="link_negro1" ><? echo number_format($vermas->fields[0],0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($vermas->fields[2],0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($vermas->fields[3],0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($vermas->fields[4],0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($vermas->fields[5],0,",",".");?></td>
  					<?} else {?>
					<td class="link_negro1" ><? echo $vermas->fields[0];?></td>
					<td class="link_negro1" ><? echo $vermas->fields[2];?></td>
					<td class="link_negro1" ><? echo $vermas->fields[3];?></td>
					<td class="link_negro1" ><? echo $vermas->fields[4];?></td>
					<td class="link_negro1" ><? echo $vermas->fields[5];?></td>
					<? } ?>
  			</tr>
		</table>				
					<?
					$vermas->MoveNext();
				} // fin while
		} // fin si 
		$vermas->Close();
		?>
		<br>
<?
include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
if ($exp=="") { 
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");?>
</body>
</html>
<? } ?>

