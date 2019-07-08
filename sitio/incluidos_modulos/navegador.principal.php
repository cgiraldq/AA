		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu();
			});
		</script>

	<div id="page" style="display:none">
<?include($rutxx."../../incluidos_modulos/btn.menu.php");?>
<?include($rutxx."../../incluidos_modulos/modulos.menus.php");?>
</div>

       <div class="site-overlay"></div>

        <div id="container">

     <section class="cont_header">
            <?  include($rutxx."../../incluidos_modulos/modulos.encabezado.php");?>
     </section>

 		<article class="buscador_consola">
		    <form action="<? echo $rutxx?>../buscador/resultados/default.php">
				<input type="text" name="param" placeholder="Buscar Modulo">
				<input type="submit" value="">
			</form>
		</article>

     		<? include($rutxx."../../incluidos_modulos/modulos.mensajes.php");?>
