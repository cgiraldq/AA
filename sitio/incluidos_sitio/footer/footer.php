
	<?//include("incluidos_sitio/menu/menu.inferior.php");?>
<footer>


	<section class="footer_derecho">


		

<?include("incluidos_sitio/footer/ecommerce.categorias.php");?>
		 <?include("incluidos_sitio/footer/menu.informacion.php");?>

	 <?include("incluidos_sitio/footer/form.hazparte.php");?>




	</section>


	<section class="footer_izquierdo">


		<article class="cont_logo_remate">
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
			<img src="/contenidos/images/remate/<? echo $img; ?>">
		</article>
		     	
		<?
			} // fin si
				$result->Close();
		?>
		</article>
		 <?include("incluidos_sitio/footer/info.contacto.php");?>
		 <?include("incluidos_sitio/footer/redes.sociales.php");?>



	</section>
<?include($rut."incluidos_sitio/footer/derechos.php");?>
</footer>


<? // espacio para el google analitycs UA-8875306-1?>
<script type="text/javascript">
var _gaq = _gaq || []; _gaq.push(['_setAccount', '<? echo $codgoogle;?>']); _gaq.push(['_setDomainName', '<? echo $dsdominio;?>']); _gaq.push(['_setAllowLinker', true]); _gaq.push(['_trackPageview']);
(function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();
</script>
<? // fin espacio para el google analitycs?>



