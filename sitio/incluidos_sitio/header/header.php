<header>
		<?
		//echo $pagina;
		$sql="select dsimg1";
		$sql.=" from tblremate a where idactivo=1";
		//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	$img=$result->fields[0];
		?>
		<article class="logo_encabezado">

			<a href="<? echo $rutalocal;?>/index.php"><img src="<? echo $rutalocalimag;?>/contenidos/images/remate/<? echo $img; ?>"></a>
		</article>
		<?
			} // fin si
				$result->Close();
		?>

	<article class="centro_header">

		<article  class="cont_derecha">
			<?include("incluidos_sitio/header/redes.sociales.php");?>
			<?//include("incluidos_sitio/header/cms.buscador.php");?>
		</article>

		<article  class="cont_derecha">
			<?//include("incluidos_sitio/header/redes.sociales.php");?>
			<?include("incluidos_sitio/header/ecommerce.buscador.php");?>
			<?//include("incluidos_sitio/header/inicio.sesion.php");?>
			<?//include("incluidos_sitio/header/inicio.sesion.redes.sociales.php");?>
		</article>

		<article class="asistencia">
			<a href="http://www.mercadotex.com/adrianaarango.php?pais=1&idioma=es&archivo=spanish.php&marca=19" target="_blank">
				<img src="<?echo $rutbase?>/images/carrito.png" alt="">
			</a>
			<?//include("incluidos_sitio/header/inicio.sesion.php");?>
		</article>


	</article>

</header>