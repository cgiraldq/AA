<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados
$border=1;
if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>
<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1" >
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="<? //echo $border;?>0" cellpadding="2" cellspacing="1" align="center" class="text1" style="border-color:#ccc;"> 

<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Num,Tercero,Fecha,Obs,Subtotal,Descuento,Iva,Retefuente,Reteiva,Logistica,Total,Estado,Contabilizado";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$xdssubtotal=0;
$xdsdesct=0;
$xdsiva=0;
$xdsrete=0;
$xdsreteiva=0;
$xdstotal=0;
$xtotalflete=0;
	while (!$result->EOF && ($contar<$maxregistros)) {

		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
			
			if ($result->fields[29]<>3) { 
				$xdssubtotal=$xdssubtotal+$result->fields[20];
				$xdsdesct=$xdsdesct+$result->fields[27];
				$xdsiva=$xdsiva+$result->fields[22];
				$xdsrete=$xdsrete+$result->fields[23];
				$xdsreteiva=$xdsreteiva+$result->fields[24];
				$xdstotal=$xdstotal+$result->fields[28];
				$xtotalflete=$xtotalflete+$result->fields[37];
			}
			
		?>
  <tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>
  <td align="center"><strong><? echo $result->fields[38]."-".$result->fields[3];?></strong></td><!--Idpedido-->
  <td align="center"><? echo $result->fields[7];?></td><!--dsrazon-->
  <td align="center"><? echo $result->fields[13];?></td><!--dsfechac-->
  <td align="center">
	<img src="<?echo $rutxx;?>../../img_modulos/modulos/zoom_g.gif" title="<? echo $result->fields[30];?>">
  	


  </td><!--dsobs-->
  <td align="center"><? echo $result->fields[20];?></td><!--dssubtotal-->
  <td align="center"><? echo $result->fields[27];?></td><!--dsdesct-->
  <td align="center"><? echo $result->fields[22];?></td><!--dsiva-->
  <td align="center"><? echo $result->fields[23];?></td><!--dsrete-->
  <td align="center"><? echo $result->fields[24];?></td><!--dsreteiva-->
  <!--td align="center"><? //echo $result->fields[25];?></td--><!--dsreteica-->
  <td align="center"><? echo $result->fields[37];?></td><!--logistica-->
  <td align="center"><? echo number_format($result->fields[28],0,",",".")?></td><!--dstotal-->
  <td align="center">
	<? 
	if ($result->fields[29]==0) echo "Facturada";
	if ($result->fields[29]==2) echo "Cancelada";
	if ($result->fields[29]==1) echo "Abonando";
	if ($result->fields[29]==3) echo "Anulada";
	?>
	</td>
	<td align=center>
	[P]
	</td>
	<td width="25%" align=center> 
	<input type=button name=enviar value="REF" class="botones" onClick="irAPaginaD('../facturacion/pedidos.primer.paso.php?idpedidoy=<? echo $result->fields[3];?>&idclientey=<? echo $result->fields[5];?>');" title="Click para refacturar este cliente">
	<!--input type=button name=enviar value="EDIT" class="textlink2" onClick="irAPaginaD('../facturacion/pedidos.primer.paso.editar.php?idpedido=<? echo $result->fields[3];?>&idclientey=<? echo $result->fields[5];?>');" title="Click para editar las observaciones de esta factura"-->
	<input type=button name=enviar value="IMP" class="botones" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $result->fields[3];?>&idcliente=<? echo $result->fields[5];?>&enca=1&dsres=<?echo $result->fields[39]?>&dsprefijo=<?echo $result->fields[38]?>');" title="Click para imprimir ">
    <input type=hidden name="id[]" value="<? echo $result->fields[0];?>" >
    <input type=button name=enviar value="ANULAR" class="botones" onClick="enviarconfirm('¿ Esta seguro que desea anular?','Este proceso no se puede devolver','','<? echo $pagina;?>?pkid=<? echo $result->fields[0];?>&anular=1')" title="Click para anular">

    </td>	
	</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
	<tr class=forma2 align=center >		
	<td width="5%" align="center" class="link_negro1">
	<strong>&nbsp;</strong></td>
	<td width="10%" align="center" class="link_negro1"><strong>TOTAL</td>
	<td align="center" class="link_negro1">
	<strong>&nbsp;</strong></td>
	<td align="center" class="link_negro1">
	<strong>&nbsp;</strong></td>
	<td width="5%" ><? echo number_format($xdssubtotal,0,",",".");?></td>
	<td width="5%" ><? echo number_format($xdsdesct,0,",",".");?></td>
	<td width="5%" ><? echo number_format($xdsiva,0,",",".");?></td>
	<td width="5%" ><? echo number_format($xdsrete,0,",",".");?></td>
	<td width="5%" ><? echo number_format($xdsreteiva,0,",",".");?></td>
	<!--td width="5%" ><? //echo number_format($xdsreteica,0,",",".");?></td-->
	<td width="5%" ><? echo number_format($xtotalflete,0,",",".");?></td>
	<td width="7%" ><? echo number_format($xdstotal,0,",",".");?></td>
	<td width="7%">&nbsp;</td>		
	<td colspan=2 width="7%">&nbsp;</td>		


</form>
</table>
