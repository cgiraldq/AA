<article class="paginador">
	<ul>
		<?
		//for($i=$cant_paginas;$i>=1;$i--)
		for($i=1;$i<=$cant_paginas;$i++)
		{
		$class="";
		$style="";
		if ($_REQUEST['pagina']==$i)
		 $class="class='activo'";
		?>
			<li>
				<a <? echo $class.$style;?> href="<? echo $rutaPaginacion."pagina=".$i?>#ancla">XXX<? echo $i?></a>
			</li>
			<?

			}
		?>
	</ul>
</article>