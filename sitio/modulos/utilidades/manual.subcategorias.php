<section class="cont_general">

	<article class="cont_manual">

		<? include("manual.miga.php");?>

		<ul class="manual_lista">
			<?for ($i=0; $i < 4; $i++) { ?>
				<li>
					<a href="detalle.php">
						<article>
							<img src="../../img_modulos/manual.png">
						<h1> TITULO</h1>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.  </p>

							<nav>
								<a href="detalle.php">
									+ ver m&aacute;s
								</a>
							</nav>
						</article>

					</a>

				</li>
			<?}?>
		</ul>


	</article>


</section>