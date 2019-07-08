<article class="galeria_patrocinador">
	<h2>Patrocinadores</h2>
	<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in.</p>
	<ul id="galeria_patrocinador">
		<?for ($i=0; $i < 16; $i++) { ?>
				<? if (is_File("../contenidos/images/patrocinadores/".$i.".jpg")){?>
			<li>

						<img src="../contenidos/images/patrocinadores/<?echo $i?>.jpg" alt="Titulo de la Foto <?echo $i;?>, Sirve para el SEO">

			</li>
				<?}?>
		<?}?>
	</ul>

	<a id="prev_galeria_patrocinar" class="prev" href="#"><img src="<?echo $rut?>images/right.png" alt=""></a>
	<a id="next_galeria_patrocinar" class="next" href="#"><img src="<?echo $rut?>images/left.png" alt=""></a>
</article>