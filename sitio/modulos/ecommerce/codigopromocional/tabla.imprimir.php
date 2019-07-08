<br>
<div id="capa_impresion" align=center CLASS="TEXT1">
<a href="javascript:imprimir();">Imprimir</a> | <a href="javascript:window.close();">Cerrar Esta ventana</a>
</div>
<table bgcolor="#fff" cellpadding="0" cellspacing="0" align="center" width=100% border="0" >

	<?
		while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
	<tr >

		<td width=30%>
			<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:310px; height: 59px; text-align:center">
			<tr>
			<td style="width: 310px; height:59px; font-family: arial; font-size: 20px;">
			<span style="font-family: arial;font-size: 10px;">V&aacute;lido hasta el  <? echo $result->fields[dsfechaf]?></span><br> 	
			<strong> <? echo $result->fields[codigo]?></strong></td>
			</tr>
			</table>	
		</td>
		<td width=30%>
			<table align="center" border="0" cellpadding="0" cellspacing="0" style=" text-align:center" height="65px">
			<tr>
			<td style="font-family: arial; font-size: 36px; width: 138px;">
			<? echo $result->fields[dsdescuento]?>%</td>
			</tr>
			</table>
		</td>
		<td width=40%>
			<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:190px; height: 79px; font-family: arial;font-size: 10px;">
			<tr>
			<td align=center>
			<?
			$sql = "select id,dsm,dsimg FROM ecommerce_tblpatrocinadores WHERE 1";						
			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){
			$resultx->fields[dsimg];	
			}$resultx->Close();
			?>
			<img src="<? echo $rutaImagen;?><? echo $resultx->fields[dsimg];?>" width=190 height=78 border=0 align="absmiddle">
			<br>
			<? echo $resultx->fields[dsm];?>
			</td>
			</tr>
			</table>	

		</td>

	</tr>
			<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
</table>