
<section class="cont_carrito">
	<h1>PROCESO DE PAGO - PASO 2</h1>

	<!--article class="mensaje_pedido">
		<? echo $mensaje?>
		</article-->

	<form action="">

	<? include ("proceso.pago.2.detalle.php");?>

<?
if ($mostrarbotones==1) {
?>

	<br >

<table width="100%"  class="tbl_productos" border-collapse="0" border-spacing="0">
<tfoot>
			<tr>
				<td colspan="8" class="btns">

<input type="button" onclick="imprimir_pedido('proceso.pago.impresion.php?idpedido=<? echo $idpedido?>&imp=1','800','600');" value="Imprimir el Pedido" class="ver_mas">
<input type="button" onclick="irAPaginaD('salir.php');" value="TERMINAR" class="finalizar_compra">
	</td>

			</tr>

		</tfoot>
	</table>

<? } ?>

	</form>
</section>