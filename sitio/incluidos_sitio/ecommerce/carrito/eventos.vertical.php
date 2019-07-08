<article class="cont_noticas_centro_vertical">
	<article class="txt_qsomos">
		<h1>Eventos</h1>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
	</article>
	<?include("incluidos_sitio/eventos/eventos.destacado.php");?>
	<article id="bloques">
	<?for ($i=0; $i < 5; $i++) { ?>
	<article class="noticas_centro_vertical">

		<? if (is_File("../contenidos/images/eventos/".$i.".jpg") && $i % 2 ==0){?>
			<a href=""><img src="../contenidos/images/eventos/<? echo $i;?>.jpg" alt="titulo de la Eventos <? echo $i;?>"></a>
		<?}?>

		<a href="eventos.detalle.php"><h2>titulo de la Eventos <? echo $i;?></h2></a>
		<h3>Sub titulo</h3>
		<p class="fecha">22/02/2012</p>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
		<a href="eventos.detalle.php" class="more" title="ver m&aacute;s"></a>
		<br style="clear:both;">
	</article>
	<?}?>
	</article>
	<article class="paginador">
		<ul>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#" class="activo">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
		</ul>
	</article>
</article>


