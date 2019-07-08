<article class="cont_noticas_centro_horizontal">
	<article class="txt_qsomos">
		<h1>Noticias</h1>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
	</article>
	<?for ($i=0; $i < 5; $i++) { ?>
	<article class="noticas_centro_horizontal">
		<? if (is_File("../contenidos/images/noticias/".$i.".jpg") && $i % 2 ==1){?>
			<a href=""><img src="../contenidos/images/noticias/<?echo $i?>.jpg" alt=""></a>
		<?}else{?>
			<iframe width="320" height="180" src="http://www.youtube.com/embed/ll1VjKPhWtY?list=UU55-mxUj5Nj3niXFReG44OQ" frameborder="0" allowfullscreen></iframe>
		<?}?>
			<h2>titulo de la noticia <?echo $i?></h2>
			<h3>Sub titulo</h3>
			<p class="fecha">22/02/2012</p>
			<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
			<a href="noticias.detalle.php" class="more" title="ver m&aacute;s"></a>
			<br style="clear:both;">
		</article>
	<?}?>
	<?include("incluidos_sitio/paginador/paginador.php");?>
</article>