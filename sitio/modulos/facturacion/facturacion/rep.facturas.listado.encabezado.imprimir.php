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
Encabezado Generico de impresion
*/
?>

<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2">
			<tr class="imprimir_tit" >
					<td valign=top align=left>
					<? echo $AppNombre;?>
					</td>
					</td>
			</tr>
		</table>


	<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2">
			<tr class="imprimir_tit" >
					<td valign=top align=left>
RELACIONES DE FACTURAS <? if ($_REQUEST['iddiax']<>""){?> <? echo $_REQUEST['iddiax'] ?>,<? } ?> MES <? echo strtoupper(nombre_mes(intval($idmesx)));?> <? echo $idaniox?>
<br>
<? if ($dsvendedor<>"") {?>
Vendedor: <? echo seldato("dsnombre","id","tblusuariose",$dsvendedor,1)?>
<? } ?>
					</td>
					<td align="right" class="imprimir_tit_datos">
					Fecha de impresi&oacute;n: <? echo date("d/m/Y h:i:s a")?>
					</td>
			</tr>
		</table>
<br>


			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>" >
								
			<tr class="imprimir_tit_datos" align="center">


			<td width="5%" ><strong>Num</strong></td>
			<!--td width="10%" ><strong>NIT</strong></td-->			
			<td width="30%" ><strong>Tercero</strong></td>
			<td ><strong>Fecha </strong></td>
			<td ><strong>SubTotal</strong></td>
			<td ><strong>Descuento</strong></td>
			<td ><strong>IVA</strong></td>
			<td ><strong>Retefuente</strong></td>
			<td ><strong>ReteIva</strong></td>
			<!--td ><strong>ReteICA</strong></td-->
			<td ><strong>Total</strong></td>
			</tr>
</table>
<hr color="#CCCCCC" size="1" >
