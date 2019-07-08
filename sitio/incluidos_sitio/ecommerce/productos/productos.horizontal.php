<article class="cont_noticas_centro_horizontal">
	<article class="txt_qsomos">
		<h1>Noticias</h1>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
	</article>
	<?for ($i=0; $i < 5; $i++) { ?>
	<article class="noticas_centro_horizontal">
		<? if (is_File("../contenidos/images/productos/".$i.".jpg") && $i % 2 ==0){?>
			<a href="productos.detalle.php"><img src="../contenidos/images/productos/<? echo $i?>.jpg" alt=""></a>
		<?}?>
			<h2>titulo de la noticia</h2>
			<h3>Sub titulo</h3>
			<p class="fecha">22/02/2012</p>
			<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
			<a href="productos.detalle.php" class="more" title="ver m&aacute;s"></a>
			<br style="clear:both;">
		</article>
	<?}?>
	<?include("incluidos_sitio/paginador/paginador.php");?>
</article>