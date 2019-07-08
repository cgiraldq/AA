<article id='pedidos' class="cuerpo_tab">
	
	
	<article class="cont_pedidos">
	<table width="100%" class="tbl_pedidos" border="0" cellspacing="0" cellspadding="0">
		<tr>
			<th>PEDIDOS RECIENTES</th>
			<th>REFERENCIA</th>
			<th>FECHA</th>
			<th>VALOR</th>
			<th>ESTADO</th>
			<th></th>
		</tr>


		<?for ($i=0; $i < 3; $i++) { ?>
		<tr >
			<td>Campaña #12</td>
			<td>000234567</td>
			<td>12/08/2014</td>
			<td>$350.000</td>
			<td>Despachado</td>
			<td><a href="" class="detalle_table">ver detalle</a></td>
		</tr>
		<?}?>
	</table>

	<h2>SALDOS</h2>
	<?include("incluidos_sitio/ecommerce/productos/productos.vertical.php");?>


	</article>

	<?include("incluidos_sitio/aside/aside.php");?>

</article>