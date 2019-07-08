<article class="galeria_header">
	<ul id="galeria_header">
		<?for ($i=0; $i < 5; $i++) { ?>
		<?if ($i % 2 ==0) {?>
			<li>
				<article class="cont_gal_header">
					<? if (is_File("../contenidos/images/noticias/".$i.".jpg")){?>
						<a href=""><img src="../contenidos/images/noticias/<?echo $i?>.jpg" alt=""></a>
					<?}?>
					<article class="text">
						<h2>Donec vitae nisl turpis <?echo $i?></h2>
						<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
						<a href="" class="vermas">ver m&aacute;s</a>
					</article>
				</article>
			</li>
		<?}else{?>

			<? if (is_File("../contenidos/images/banner/banner".$i.".jpg")){?>
			<li>
					<img src="../contenidos/images/banner/banner<?echo $i;?>.jpg" alt="">
			</li>
			<?}?>
		<?}}?>
	</ul>
	<!-- <article class="clearfix"></article>
	<a id="prev_galeria_header" class="prev" href="#"><img src="<?echo $rut?>images/right.png" alt=""></a>
	<a id="next_galeria_header" class="next" href="#"><img src="<?echo $rut?>images/left.png" alt=""></a> -->
</article>