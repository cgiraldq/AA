<?$idpedido=$_REQUEST['idpedido'];?>
<article id="pedidos_detalle" class="cuerpo_zona_distribuidor">

<?if($idpedido<>""){?>
<h1>DETALLE DEL PEDIDO #<?echo $idpedido?></h1>
	<table width="100%" class="ecommerce_productos_distribuidor">
		<thead>
			<tr>
				<td><img src="images/carrito_zona.png"></td>
				<td>Producto</td>
				<td>Color</td>
				<td>Talla</td>
				<td>Precio</td>
				<td>Cantidad</td>
				<td>Subtotal</td>
			</tr>
		</thead>
<?
$sql="select a.idproducto,a.idcant,a.idprecio,a.dstotal,b.dsimgcarrito,b.dsm,b.precio1,precio2";
$sql.=",b.dsmarca,b.dsreferencia,a.dspordescuento,a.dsporiva,a.id,a.dsvalorenvio ";
$sql.=",b.dsentrega,b.dscondiciones ";
$sql.=",b.preciodescuento,b.peso ";
$sql.=" ,dsdireccionenvio";
$sql.=" ,dspara";
$sql.=" ,dsciudadenvio";//20
$sql.=" ,dsvalorenvio";
$sql.=" ,dstelefonoenvio";
$sql.=" ,dsmensajeenvio";
$sql.=" ,dsobsenvio";
$sql.=" ,dszonaenvio";
$sql.=" ,dstipoenvio";
$sql.=" ,dsfechaenvio";
$sql.=" ,dshoraenvio";
$sql.=" ,dstipodirenvio";
$sql.=" ,idconsec";
$sql.=" ,dstalla";
$sql.=" ,dscolor";
$sql.=" ,b.idtipo";//33
$sql.=" ,a.idcolor";//34
$sql.=" from ecommerce_tblcompras a, ecommerce_tblproductos b where a.idproducto=b.id ";
if ($idpedido=="") {
$sql.=" and idcliente='".$_SESSION['idcomprador_dis']."' and dsfecha='".$_SESSION['dsfechacompra_dis']."' ";
$sql.=" and idip='".$_SESSION['ipremota_dis']."' and a.idtienda=$idtienda  ";
} else {
$sql.=" and a.idpedido='".$idpedido."' ";
}
$result=$db->Execute($sql);
if(!$result->EOF){

$xsubtotal=0;
$xdescuento=0;
$xiva=0;
$xpeso=0;
$textoservicio=0;
while(!$result->EOF){?>

<tbody>
<tr>
<td>Ref:<?echo $result->fields[dsreferencia]?></td>
<td><?echo $result->fields[dsm]?></td>
<td><?echo $result->fields[dscolor]?></td>
<td><?echo $result->fields[dstalla]?></td>
<td>$<?echo number_format($result->fields[idprecio])?></td>
<td><?echo $result->fields[idcant]?></td>
<td>$<?echo number_format($result->fields[idprecio]*$result->fields[idcant])?></td>
</tr>
</tbody>



 <?$result->MoveNext();
}

  }
  $result->Close();
//$db->debug=true;
?>
	</table>
<?
$sql="select dssubtotal,dsiva,dsflete,dsdescuento,dsvalorseguro,dsmanejo,dsvalorasistido,dstotal";
$sql.=",dsformadepago,dsciudadflete,dstransad,id,dscodigo,dsdescuentocodigo,dsporcentajecodigo,dspuntos from ecommerce_tblpagos ";
$sql.=" where idpedido=".$idpedido."";
$result=$db->Execute($sql);
if(!$result->EOF){
$xtotal=$result->fields[7];
$xsubtotal=$result->fields[0];
$xdescuento=$result->fields[3];
$xiva=$result->fields[1];
$xfletes=$result->fields[2];
$xvalorseguro=$result->fields[4];
$xvalormanejo=$result->fields[5];
$xvalorasistido=$result->fields[6];
$formapago=$result->fields[8];
$dsciudadflete=$result->fields[9];
$dstransad=$result->fields[10];
$idpagos=$result->fields[11];
$dsdescuentocodigo=$result->fields[13];
$xdspunto=$result->fields[15];
}
$result->Close();

?>
<div class="aling_derecha">

<table class="total_distribuidor">
	<tr><td>Subtotal:</td>
		<td>$<?echo number_format($xsubtotal,0)?></td>
	</tr>
	<tr>
		<td>Descuento:</td>
		<td>$<?echo number_format($xdescuento,0)?></td>
		</tr>
	<tr>
		<td>Impuesto:</td>
		<td>$<?echo number_format($xiva,0)?></td>
	</tr>
	<tr>
		<td>Puntos:</td>
		<td><?echo $xdspunto?></td>
	</tr>
	<tr>
		<td class="p_total">Total:	</td>
		<td class="p_total">$<?echo number_format($xtotal,0)?></td>
	</tr>
</table>
</div>

<nav class="btn_derecha">
<a onclick="imprimir_pedido('proceso.pago.impresion.php?idpedido=<?echo $idpedido?>','900','600')" class="btn_general">IMPRIMIR DETALLE</a>
</nav>
<?}else{?>
<?
$sql="select dsfechalarga,idpedido,idestado,dstotal,dsformadepago dstotal,dsiva,dsdescuento ";
$sql.=",dsvalorseguro,dsmanejo,id ";
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
		<td>Valor</td>
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
		<td>$ <?echo number_format($resultx->fields[3],0)?></td>
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
<?}?>
</article>
