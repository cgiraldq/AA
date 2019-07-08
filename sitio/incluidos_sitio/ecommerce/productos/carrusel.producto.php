<article class="galeria_producto">
	<h2>Nombre del Producto</h2>
	<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in.</p>
	<ul id="galeria_producto">
		<?for ($i=0; $i < 16; $i++) { ?>
				<? if (is_File("../contenidos/images/productos/".$i.".jpg")){?>
			<li>

						<a class="customlightbox" href="../contenidos/images/productos/<?echo $i;?>.jpg" rel="group2"><img src="../contenidos/images/productos/<?echo $i?>.jpg" alt="Titulo de la Foto <?echo $i;?>, Sirve para el SEO"></a>

			</li>
				<?}?>
		<?}?>
	</ul>
	<a id="prev_galeria_producto" class="prev" href="#"><img src="<?echo $rut?>images/right.png" alt=""></a>
	<a id="next_galeria_producto" class="next" href="#"><img src="<?echo $rut?>images/left.png" alt=""></a>
</article>