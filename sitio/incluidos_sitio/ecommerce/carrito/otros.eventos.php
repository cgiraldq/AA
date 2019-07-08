<article class="cont_noticas_centro_detalle">
	<article class="cont_noticias_relacionadas">
		<h3>Otras Eventos</h3>
		<ul>
		<?for ($i=0; $i < 5; $i++) { ?>
			<li>
				<a href="">
					<article>
						<?if (is_File("../contenidos/images/eventos/".$i.".jpg") && $i % 2 ==1){?>
							<img src="../contenidos/images/eventos/<?echo $i?>.jpg" alt="Sub titulo <?echo $i;?>">
						<?}?>
						<h2>Donec vitae nisl turpis</h2>
						<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc...</p>
						<div style="clear:both;"></div>
					</article>
				</a>
			</li>
		<?}?>
		</ul>
	</article>
</article>