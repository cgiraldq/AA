<?
/*
| ----------------------------------------------------------------- 
SISTEMA ADMINISTRATIVOS GERENCIALES
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Principal Recibos de caja
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Recibos de Caja";
// mensajes de recuperacion de claves
$tabla="tblrecibos";
	$codigos[0]="dsfactura";
	$codigos[1]="dsvalor";
	$codigos[2]="dsnumero";
	$codigos[3]="dsrazon";
	$codigos[4]="dsnit";
	$codigos[5]="dstele";
	$codigos[6]="dsbanco";
	//
	$nombres[0]="Factura";
	$nombres[1]="Valor";
	$nombres[2]="Nro Recibo";
	$nombres[3]="Tercero";
	$nombres[4]="NIT";
	$nombres[5]="Telefono";
	$nombres[6]="Banco";

$idrecibo=$_REQUEST['idrecibo'];
$anular=$_REQUEST['anular'];
if ($anular=="1" && $idrecibo<>"") { 
	
	// actualizar el recibo a 9999 en las 
	$sql=" update $tabla set ";
	$sql.=" dsrazon='ANULADO'";
	$sql.=",dsdir='ANULADO',dstele='ANULADO',dsciudad='ANULADO'";
	$sql.=",dsfecha='ANULADO',dsbanco='ANULADO',dsnit='ANULADO',dscom='ANULADO'";
	$sql.=",dsfactura='ANULADO' ";
	$sql.=",dsvalor='0' ";
	$sql.=",dsbanco='ANULADO' ";
	$sql.=",dstxtbanco='ANULADO' ";
	$sql.=" where dsnumero='$idrecibo' ";
	if ($db->Execute($sql)){ 
		$error=0;
		$mensajes=" Recibo $idrecibo anulado con exito";
			
	} else {
		$error=1;
		$mensajes=" Recibo $idrecibo no se pudo anular. <br>".mysql_error();
			
	} 
	
}
	
	
$idaniox=$_REQUEST['idaniox'];
//if ($idaniox=="") $idaniox=$_SESSION['i_dsanio'];
$idmesx=$_REQUEST['idmesx'];
//if ($idmesx=="") $idmesx=$_SESSION['i_dsmes'];

$dsvendedor=$_REQUEST['dsvendedor'];



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>

<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax']."&idconcursox=".$_REQUEST['idconcursox'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	?>

	<table width="100%" cellspacing="0" cellpadding="1" class="forma2" ID="Table2" style="margin: 10px 0 0 0;">
	<tr bgcolor="<? echo $fondos[5];?>">
	<td valign=top align=left>
		<h2 style="margin: 0;">Listado de recibos de caja</h2>
		</td>
		<td valign=top align=right>
		<!--a href="../reportes/rep.recaudo.php" title="Click para ver reporte" class="link11"><font class="btn_barra"><strong>Listado de ingresos</strong></font></a--> 
		<a href="../ingresos/ingresos.primer.paso.php" title="Click para crear un nuevo ingreso " class="link11"><font class="btn_barra"><strong>Nuevo Recibo de Caja</strong></font></a> 
	</td>
	</tr>
	</table>
			<?
// parametro adicional en caso que se lista por empresa
	$bloqueabc=1;
	$cargau=1; // abrir el listado de vendedores
	//include ($rutxx."../../incluidos_modulos/buscador.php"); 
	$strSQL="select sum(c.dsvalor) as total,";
	$strSQL.="c.idanio,c.idmes,c.dsrazon,c.dsdir,c.dstele,c.dsciudad,c.dsnumero,c.dsfecha,c.dsbanco,c.dsnit,c.dscom ";
	$strSQL.=",c.dsvendedor,c.dsanulado ";
	$strSQL.=" from $tabla c ";
	$strSQL.=" where c.id>0 ";
	if($idactivox1<>"Todos" && $idactivox1<>"") $strSQL.=" and c.idactivo=$idactivox1 ";
	if($idmesx<>"") $strSQL.=" and c.idmes=$idmesx ";
	if($idaniox<>"") $strSQL.=" and c.idanio=$idaniox ";	
	if($dsvendedor<>"") $strSQL.=" and c.dsvendedor='$dsvendedor' ";	
	if($_REQUEST['param']<>"") 	$strSQL.=" and c.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";

	$strSQL.=" group by c.idanio,c.idmes,c.dsrazon,c.dsdir,c.dstele,c.dsciudad,c.dsnumero,c.dsfecha,c.dsnit";
	$strSQL.=" ,c.dsbanco,c.dsvendedor";
	$strSQL.=" order by  c.dsnumero desc ";

//echo $strSQL;
//	 exit();

	$vermas=$db->Execute($strSQL);
	if ($_REQUEST['pag']==""){ 
		$pag = 1; // Por defecto, pagina 
	}else { 
		$pag=$_REQUEST['pag'];
	}	
	$cantidad1=$_REQUEST['cantidad'];
	if ($cantidad1==""){ $cantidad1=$_REQUEST['cantidad']; }
	if ($cantidad1==""){ 
		$tampag = 30;
	}else{
		$tampag = $cantidad1;
	}
	$reg1 = ($pag-1) * $tampag;
	if ($_REQUEST['pag']<>"-1"){ 
		if ($_REQUEST['idaniox']=="" && $_REQUEST['idmesx']=="") $strSQL.=" limit $reg1,$tampag";
	}

	$rutaPaginador=$pagina."?letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=$campo&idestadox=$idestadox&paramx=$paramx&idaniox=$idaniox&idmesx=$idmesx&dsvendedor=$dsvendedor&enca=$enca&cantidad=$tampag&pag=";
	 // pintando cabecera de datos

	$vermas=$db->Execute($strSQL);
	//include ($rutxx."../../incluidos_modulos/func.paginador.php");	
	//include ($rutxx."../../incluidos_modulos/func.tabla.paginador.php");	
?>
<br>

			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>">
			<tr class="text" bgcolor="<? echo $fondos[21];?>" align="center">
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="5%"><strong>Numero</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="15%"><strong>Cliente</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="10%"><strong>Fecha</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="10%"><strong>Valor</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="5%"><strong>Mes</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="5%"><strong>Año</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="30%"><strong>Tipo</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/fondo3.jpg" class="text1" width="10%"><strong>Banco</strong></td>
			<td align="center" background="<?echo $rutxx?>../../img_modulos/cf_diseno_r2_c3.jpg" class="text1"><strong style="color:#fff;">Opciones</strong></td>
			</tr>
			</table>

		<? 
		if (!$vermas->EOF) {
		$totalvalor=0;
			while(!$vermas->EOF) {
			$color=$fondos[4];
			$colorx=$fondos[10];
			
			// el calculo se hace de acuerdo a la naturaleza
			
			$sql="select dsvalor,dsnaturaleza from tblrecibos where dsnumero=".$vermas->fields[7];
			$vermasr=$db->Execute($sql);
			if (!$vermasr->EOF){
			$x=0;
				while(!$vermasr->EOF) {
					if ($vermasr->fields[1]==2) { 
						$x=$x+$vermasr->fields[0];
					} else { 
						$x=$x-$vermasr->fields[0];
					}
				$vermasr->MoveNext();
			}
			}
			$vermasr->Close();


			
			$totalvalor=$totalvalor+$x;
					?>
		<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1" style="border-color:#ccc;" > 			
		<tr class=forma2 bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');" onClick="mOut(this,'<? echo $colorx;?>');">		
		<td align="center" width="5%"><strong><? echo $vermas->fields[7];?></strong></td>
		<td align="center" width="15%"><? echo $vermas->fields[3];?></td>					
		<td align="center" width="10%"><? echo $vermas->fields[8];?></td>
		<td align="center" width="10%">$<? echo number_format($x,0);?> </td>
		<td align="center" width="5%"><? echo $vermas->fields[2];?></td>						
		<td align="center" width="5%"><? echo $vermas->fields[1];?></td>										
		<td align="center" width="30%"><? echo $vermas->fields[11];?></td>										
		<td align="center" width="10%"><? echo $vermas->fields[9];?></td>										
					
<td nowrap class="link_negro1"> 
<input type=button name=enviar value="VER" class="textlink2" onClick="irAPaginaDN('../ingresos/ingresos.imprimir.html.php?idrecibo=<? echo $vermas->fields[7];?>&no=1');" title="Click para ver el recibo">


<? if ($_SESSION['i_dsmes']==$vermas->fields[2]) { ?>
<!--input type=button name=enviar value="EDITAR" class="textlink2" onClick="irAPaginaD('../ingresos/ingresos.editar.paso.php?idrecibo=<? echo $vermas->fields[7];?>&enviar=Cargar&dsnit=<? echo $vermas->fields[10]?>');" title="Click para editar el recibo"-->
<? } ?>
<?//echo $vermas->fields[13]?>
<? if ($vermas->fields[13]==1) { ?>
<input type=button name=enviar value="AGREGAR FACTURA" class="textlink2" onClick="irAPaginaD('../ingresos/ingresos.editar.paso.php?facturar=1&idrecibo=<? echo $vermas->fields[7];?>&enviar=Cargar&dsnit=<? echo $vermas->fields[10]?>');" title="Click para editar el recibo">
<? } ?>



	 <input type=button name=enviar value="ANULAR" class="textlinkrojo" onClick="enviarconfirm('¿ Esta seguro que desea anular?','Este proceso no se puede devolver','','<? echo $pagina;?>?idrecibo=<? echo $vermas->fields[7];?>&anular=1')" title="Click para anular">



	 <input type=hidden name="id[]" value="<? echo $vermas->fields[7];?>" >
			  </td>		
  </tr>
</table>				
					<?
		$vermas->MoveNext();
	}
		?>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>">
			<form action="<? echo $pagina;?>" method="post" name=u>										
			<tr class="formbt2" bgcolor="<? echo $fondos[12];?>" align="center">
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td ><strong>TOTAL PANTALLA</strong></td>
			<td ><strong>$ <? echo number_format($totalvalor,0);?></strong></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>

			</tr>
			</table>
		<?
		} // fin si 
		$vermas->Close();
	
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>
