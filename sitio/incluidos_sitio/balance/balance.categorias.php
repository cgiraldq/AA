
	<h1><? echo $dstituloPagina?></h1>

<article class="bloque_texto">


	<?for ($i=0; $i < 5; $i++) { ?>


	<article class="convenios_categorias">
		<a href="">
			 <? if($dsimg<>""){?><img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg; ?>"><?}?>
		</a>

			<div>
				<h1>TITULO</h1>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				<a href=""class="ver_mas"><p>ver más</p></a>
			</div>
	</article>

	 <?}?>

</article>