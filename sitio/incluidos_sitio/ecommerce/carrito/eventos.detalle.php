<article class="cont_noticas_centro_detalle">
	<?$i = rand(0,5);?>
	<article class="noticas_centro_detalle">
		<? if (is_File("../contenidos/images/eventos/".$i.".jpg")){?>
			<img src="../contenidos/images/eventos/<?echo $i;?>.jpg" alt="">
		<?}?>
		<h1>titulo de la eventos <?echo $i;?></h1>
		<h3>Sub titulo</h3>
		<p class="fecha">22/02/2012</p>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum dictum orci, vitae aliquam mi molestie ullamcorper. Cras augue turpis, varius vitae faucibus in, feugiat et purus. Curabitur convallis ullamcorper sem sed pellentesque. Nullam magna purus, molestie id adipiscing non, interdum vitae risus. Sed est ligula, fringilla tempus dapibus ut, vestibulum et felis. Nulla sodales metus in ipsum egestas et tempor leo suscipit. Morbi nec quam lorem. Cras ut aliquet sapien. Donec vulputate, risus non rutrum luctus, elit sem condimentum neque, eu fringilla magna nisi eget lectus.</p>
		<p>Nunc lobortis urna eu lorem pellentesque vitae facilisis tellus rutrum. Nullam placerat elementum felis quis faucibus. Sed varius adipiscing felis vel dignissim. Proin gravida tortor a ligula consectetur id mattis lectus mattis. Ut lectus urna, volutpat ut aliquet sit amet, malesuada vitae magna. Phasellus lobortis nunc non diam euismod sed rutrum nunc venenatis. Etiam odio lectus, sollicitudin id commodo nec, faucibus ac dolor. Praesent lacinia turpis eget magna pellentesque ut cursus est scelerisque. Quisque pharetra pharetra neque, iaculis molestie elit consectetur ut. Pellentesque ut nulla risus. Duis nisl nulla, varius sed volutpat a, lacinia sed tellus.</p>
		<div style="clear:both;"></div>
	</article>
</article>