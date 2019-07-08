<?
$exp=$_REQUEST['exp'];
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
Relacion de facturas. Se omiten las anuladas
*/
$border=0;
$colspan=0;
if ($exp=="1") { 
header("Content-type: application/octet-stream");
$nombre="facturas_".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
$border=1;
$colspan=13;
}

$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$tabla="tblfacturase";
$titulomodulo="REPORTES. RELACION DE FACTURAS";
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
if ($exp=="") { 
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
}
?>
	<?
// parametro adicional en caso que se lista por empresa
	$bloqueabc=1;
	$mostrarestados=1;
	$mostrarfechasad=1;
	$cargau=1; // mostrasr usuarios
	if ($exp=="")   include ($rutxx."../../incluidos_modulos/buscador.php"); 
	
	$strSQL="select c.*,a.dsnombres";
	$strSQL.=" from $tabla c,tblclientes a ";
	$strSQL.=" where c.id > 0 and a.id=c.idcliente ";
	if($idactivox1<>"Todos" && $idactivox1<>"") $strSQL.=" and c.idactivo=$idactivox1 ";
	if($idactivox1=="Todos") $strSQL.=" and c.idactivo>=0 ";
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
	if ($ordenar<>"") { 
	$strSQL.=" order by  c.dsnombres asc, c.idpedido asc ";
	} else {
	$strSQL.=" order by  c.idpedido asc ";
	}
	$strSQLx1=$strSQL;
	if ($strSQLx<>"") $strSQL=$strSQLx;
	//echo $strSQL;
	if ($exp=="") { 
	$rutaPaginador=$pagina."?idprog=$idprog&$dsprog=$dsprog&letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=$campo&idestadox=$idestadox&paramx=$paramx&iddiax=$iddiax&idaniox=$idaniox&idmesx=$idmesx&idactivox1=$idactivox1&enca=$enca&cantidad=$tampag&ordenar=$ordenar&pag=";
	$rutaImpresionx="idprog=$idprog&$dsprog=$dsprog&letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idestadox=$idestadox&paramx=$paramx&iddiax=$iddiax&idaniox=$idaniox&idmesx=$idmesx&idactivox1=$idactivox1&dsvendedor=$dsvendedor";
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	}
	$vermas=$db->Execute($strSQL);
	$x="cantidad";
	?>
	<br>
	
		<table width="100%" cellspacing="0" cellpadding="1" class="forma2" ID="Table2" style="margin: 10px 0 0 0;" border="<?echo $border?>">
		<tr bgcolor="<? echo $fondos[5];?>">
		<td valign=top align=left colspan="<?echo $colspan?>">
		<h2 style="margin: 0;">REPORTES. RELACION DE FACTURAS</h2>
		</td>
		<? if ($exp=="") {?>
		<td valign=top align=right>

        <a href="../facturacion/rep.facturas.agrupar.php" title="Click para agrupar por tercero" class="botones"><p >Agrupar por tercero</p></a>											
		<a href="../facturacion/<? echo $pagina?>?exp=1&strSQLx=<? echo $strSQLx1?>" title="Click para exportar a un archivo de excel" class="botones"><p >Exportar</p></a>						
        <a href="javascript:irAPaginaDN('../facturacion/rep.facturas.listado.imprimir.php?<? echo $rutaImpresionx; ?>');" title="Click para imprimir" class="botones"><p >Imprimir</p></a>											 
		<a href="../facturacion/default.php" title="Click para regresar" class="botones"><p >Regresar</p></a>											

		</td>
		<? } ?>
		</tr>
		</table>



			<table class="text1" width=100% align=center   border="<?echo $border?>" cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>" class="forma">
			<tr >
			<td  align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" width="5%" >Num</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >Estado</td>			
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >NIT</td>			
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   width="20%" >Tercero</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >Concepto</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >Fecha C</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >SubTotal</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >Descuento</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >IVA</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >Retefuente</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >ReteIva</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1"   >ReteICA</td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" 	>Total</td>
			</tr>
			</table>
	
		<? 
		if (!$vermas->EOF){
			$xdssubtotal=0;
			$xdsdesct=0;
			$xdsiva=0;
			$xdsrete=0;
			$xdsreteiva=0;
			$xdstotal=0;
			$totalfac=0;
			$contar=0;
			while(!$vermas->EOF) {
				if ($contar%2==0) {
					$fondo=$fondo1;
					} else {
					$fondo=$fondo2;
					}
				$color=$fondos[4];
				$colorx=$fondos[3];
				$totalfac++;
				
			$dssubtotal=$vermas->fields[20];
			$dsdesct=$vermas->fields[27];
			$dsiva=$vermas->fields[22];	
			$dsrete=$vermas->fields[23];
			$dsreteiva=$vermas->fields[24];
			$dstotal=$vermas->fields[28];
			$estado="Facturado";
			if ($vermas->fields[29]==3) {
				$estado="Anulado";
				$dssubtotal=0;
				$dsdesct=0;
				$dsiva=0;	
				$dsrete=0;
				$dsreteiva=0;
				$dstotal=0;
					
			}
			
			$xdssubtotal=$xdssubtotal+$dssubtotal;
			$xdsdesct=$xdsdesct+$dsdesct;
			$xdsiva=$xdsiva+$dsiva;
			$xdsrete=$xdsrete+$dsrete;
			$xdsreteiva=$xdsreteiva+$dsreteiva;
			$xdstotal=$xdstotal+$dstotal;
					?>
<table class="text1" width=100% align=center  border="<?echo $border?>" cellpadding=2 cellspacing=1 style="table-layout:fixed">					
			<tr class=forma2  bgcolor="<? echo $fondo;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">		
					<td width="5%" align="center" bgcolor="<? echo $fondos[12]?>" class="text_blanco">
					<? echo $vermas->fields[38]."-".$vermas->fields[3];?>					</td>
					<td align="center" class="link_negro1"><? echo $estado;?></td>
					
					<td align="center" class="link_negro1"><? echo $vermas->fields[6];;?></td>
					<td width="20%" align="center" class="link_negro1"><? echo $vermas->fields[7];?></td>
					<td align="left" class="link_negro1"><? echo $vermas->fields[30];?></td>
					
					<td align="center" class="link_negro1"><? echo $vermas->fields[13]?></td>
					
					<td class="link_negro1" ><? echo number_format($dssubtotal,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dsdesct,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dsiva,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dsrete,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dsreteiva,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dsreteica,0,",",".");?></td>
					<td class="link_negro1" ><? echo number_format($dstotal,0,",",".");?></td>
  </tr>
</table>				
					<?

				$vermas->MoveNext();
				$contar++;
				} // fin while
	 

?>
<table class="text1" width=100% align=center border="<?echo $border?>" cellpadding=2 cellspacing=1 style="table-layout:fixed">					
	<tr class=forma2 align=center >		
			<td width="5%" align="center" class="link_negro1">
			&nbsp;</td>
			<td align="center" class="link_negro1">&nbsp;</td>
			
			<td align="center" class="link_negro1">&nbsp;</td>
						
			<td width="20%" align="center" class="link_negro1">TOTAL</td>
			<td align="center" class="link_negro1">&nbsp;</td>
			
			<td align="center" class="link_negro1"><? echo $totalfac?></td>

			<td class="link_negro1" ><? echo number_format($xdssubtotal,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdsdesct,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdsiva,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdsrete,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdsreteiva,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdsreteica,0,",",".");?></td>
			<td class="link_negro1" ><? echo number_format($xdstotal,0,",",".");?></td>
  </tr>
</table>				

<?

		} // fin si 
		$vermas->Close();
		?>
<br>


<?


include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); 
if ($exp=="") { 
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<?}?>