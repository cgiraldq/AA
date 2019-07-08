<article class="cont_general">





<?
// TRAER LAS CATEGORIAS DE APPS
$sql="select ida,dsa from tblareasapps where idactivo=1 order by ida asc ";
		$result = $db->Execute($sql);
       //$atac="";
       if (!$result->EOF) {
       	while (!$result->EOF) {

?>
	<article class="cont_apps">

	<h1 class="titulo_apps2">APPS DISPONIBLES</h1>

		<ul class="apps_categorias">
				<?
					$sql="select dsnombre,dsobs,dsarchivo from tblapps where idactivo=1 and idcat=".$result->fields[0]." order by dsnombre asc ";
						$resultx= $db->Execute($sql);
				       //$atac="";
				       if (!$resultx->EOF) {
				       	while (!$resultx->EOF) {
				       		$dsnombre=reemplazar($resultx->fields[0]);
				       		$dsobs=reemplazar($resultx->fields[1]);
				       		$dsarchivo=reemplazar($resultx->fields[2]);


				?>

	<h1>SEO (SEARCH ENGINE OPTIMIZATION)</h1>

	<?for ($i=0; $i < 3; $i++) { ?>
		<li>
			<a href="formulario.php" >
			<? //if ($dsarchivo<>"") {?>
						<img src="../../img_modulos/1.jpg" title="" alt="">
			<? //} ?>

				<article>

					<h1>WEBCEO<? echo $dsnombre?></h1>
					<p>WEB CEO es un software que incluye herramientas especializadas en marketing de motores de búsqueda, análisis inteligente de tráfico Web, y mantenimiento del sitio Web. Con un poderoso módulo de sugerencias de palabras clave.<? echo $dsobs?></p>
					<nav>
						<a href="formulario.php" >SOLICITAR</a>
					</nav>
				</article>
			</a>

		</li>
	<?}?>



	<?
	$resultx->Movenext();

		}
	}
	$resultx->Close();
	?>

	</ul>



	</article>

		<hr class="img_hr">





<?

$result->Movenext();

	}
}
$result->Close();

?>


	</article>


