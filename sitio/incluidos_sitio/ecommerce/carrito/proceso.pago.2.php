
<section class="cont_carrito">
	<h1>Proceso de Pago - Paso 2</h1>

	<article class="mensaje_pedido">
		<? echo $mensaje?>
	</article>

	<form action="">

	<? include ("proceso.pago.2.detalle.php");?>

<?
if ($mostrarbotones==1) {
?>


<nav class="cont_carrito_btns_centro">
	<input type="button" onclick="imprimir_pedido('proceso.pago.impresion.php?idpedido=<? echo $idpedido?>&imp=1','800','600');" value="Imprimir el Pedido" class="btn_general">
	<input type="button" onclick="irAPaginaD('salir.php');" value="Ir a principal" class="btn_general fin_compra">
	<input type="button" onclick="irAPaginaD('salir.php?rr=1');" value="Regresar a zona privada" class="btn_general fin_compra">
</nav>

<? } ?>

	</form>
</section>