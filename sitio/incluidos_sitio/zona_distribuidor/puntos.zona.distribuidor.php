<article class="cuerpo_zona_distribuidor"  id='puntos'>

	<h1>Bienvenido <?echo reemplazar($_SESSION['i_dsnombre']);?></h1>

<?
//$db->debug=true;
$sqlx=" select sum(dspuntos) as puntos,sum(dstotal) as totales,min(dsfechalarga) as fechai ";
$sqlx.=" from ecommerce_tblpagos where id>0 and idclientepago=".$_SESSION['i_idcliente'];
$resultx = $db->Execute($sqlx);
if (!$resultx->EOF) {
$puntos=$resultx->fields[0];
$totales=$resultx->fields[1];
$fechai=$resultx->fields[2];
}
$resultx->close();
?>

	<table style="width: 100%" class="cbz_puntos">
		<tr>
			<td class="cont_izq">
				<h2>PUNTOS</h2>
				<h3><?echo $puntos?></h3>
			</td>
			<td>
			<table style="width: 100%">
				<tr>
					<td>Total facturación: $ <?echo number_format($totales)?></td>
				</tr>
				<tr>
					<td><?echo $fechai." / ".date("Y/m/d")?></td>
				</tr>
				<tr>
					<td>PUNTOS A VENCERSE: 31 / 12 / 2014</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>




<?
$sql="select dsfechalarga,idpedido,idestado,dstotal,dsformadepago,dstotal,dsiva,dsdescuento ";
$sql.=",dsvalorseguro,dsmanejo,id,dspuntos ";
$sql.="from ecommerce_tblpagos where idclientepago=".$_SESSION['i_idcliente'];
$sql.=" and idtienda = 1 ";
$sql.="  and idestado not in (12)";
$sql.=" order by id desc ";
?>
<table width="100%" class="ecommerce_tbl_pedidos">
<?
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
	?>
<thead>
	<tr>
		<td>Pedidos recientes</td>
		<!--td>Referencia</td-->
		<td>Fecha</td>
		<td>Puntos</td>
		<td>Estado</td>
		<td>Ver</td>
	</tr>
</thead>
<?
while(!$resultx->EOF){
?>
<tbody>
	<tr>
		<!--td></td-->
		<td><?echo  $resultx->fields[1] ?></td>
		<td><?echo  $resultx->fields[0] ?></td>
		<td><?echo $resultx->fields[11]?></td>
		<?if($resultx->fields[2]==4){?>
		<td class="verde">Despachado</td>
		<?}elseif($resultx->fields[2]==2) {?>
		<td class="azul">Por despachar</td>
		<?}else{?>
		<td class="rojo">
		<?echo seldato('dsm','id','ecommerce_tblestadoscompra',$resultx->fields[2],2);?></td>
		<?}?>
		<td><a href="zona.distribuidor.php?idpedido=<?echo $resultx->fields[1]?>#pedidos_detalle">Ver detalle</a></td>
	</tr>
</tbody>


<?
$resultx->MoveNext();
}

} else { ?>
<tfoot>
<tr>
<td colspan=6>En estos momentos  no posee compras. Lo invitamos a visitar nuestro catalogo

</td>
</tr>

</tfoot>
<? }
$resultx->Close();
?>
</table>



<?
$titulobloque="REDIME TUS PUNTOS";
$idestado=7;
include("saldos.distribuidor.php");
?>























</article>