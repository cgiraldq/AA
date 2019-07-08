<article class="cont_noticas_centro_detalle">
	<article class="noticas_centro_detalle">
		<h2>titulo de la noticia</h2>
		<h3>Sub titulo <?echo $i;?></h3>
		<?
		$i =mt_rand (1,10);
		if (is_File("../contenidos/images/noticias/".$i.".jpg") && $i % 2 ==1){?>
			<a href=""><img src="../contenidos/images/noticias/<?echo $i?>.jpg" alt="Sub titulo <?echo $i;?>"></a>
		<?}else{?>
			<iframe width="649" height="365" src="http://www.youtube.com/embed/ll1VjKPhWtY?list=UU55-mxUj5Nj3niXFReG44OQ" frameborder="0" allowfullscreen></iframe>
		<?}?>
		<!--p class="fecha">22/02/2012</p-->
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum dictum orci, vitae aliquam mi molestie ullamcorper. Cras augue turpis, varius vitae faucibus in, feugiat et purus. Curabitur convallis ullamcorper sem sed pellentesque. Nullam magna purus, molestie id adipiscing non, interdum vitae risus. Sed est ligula, fringilla tempus dapibus ut, vestibulum et felis. Nulla sodales metus in ipsum egestas et tempor leo suscipit. Morbi nec quam lorem. Cras ut aliquet sapien. Donec vulputate, risus non rutrum luctus, elit sem condimentum neque, eu fringilla magna nisi eget lectus.</p>
		<p>Nunc lobortis urna eu lorem pellentesque vitae facilisis tellus rutrum. Nullam placerat elementum felis quis faucibus. Sed varius adipiscing felis vel dignissim. Proin gravida tortor a ligula consectetur id mattis lectus mattis. Ut lectus urna, volutpat ut aliquet sit amet, malesuada vitae magna. Phasellus lobortis nunc non diam euismod sed rutrum nunc venenatis. Etiam odio lectus, sollicitudin id commodo nec, faucibus ac dolor. Praesent lacinia turpis eget magna pellentesque ut cursus est scelerisque. Quisque pharetra pharetra neque, iaculis molestie elit consectetur ut. Pellentesque ut nulla risus. Duis nisl nulla, varius sed volutpat a, lacinia sed tellus.</p>
		<div style="clear:both;"></div>
	</article>

	<?include("incluidos_sitio/sindicacion/sindicacion.php");?>

</article>

<?include("incluidos_sitio/noticias/otras.noticias.php");?>
