	<nav class="btn_ecommerce_detalle">

		<ul class="tabs">
			<? if($dsd<>""){ ?>
			<li><a href="#descripcion" ><? echo reemplazar($dsd2txt)?></a></li>
			<? } ?>
			<?if($dscarac<>""){?>
			<li><a href="#caracteristicas" ><? echo reemplazar($dscaractxt)?></a></li>
			<?}?>
			<? if($dscondiciones<>""){ ?>
			<li><a href="#garantias" ><? echo reemplazar($dsdcondicionestxt)?></a></li>
			<? } ?>
			<!--li><a href="#calcularenvio">Calculador de envio</a></li-->
			<li><a href="#frm_recom_pro" >Recomendar</a></li>
			<li><a href="#frm_contactar_pro" onClick="irAPaginaD('<?echo $rutbase?>/contacto.php?dsreferencia=<? echo $dsproducto?>&idproducto=<? echo $idproducto?>');" >Contáctenos</a></li>
		</ul>

				<? //include($rut."incluidos_sitio/ecommerce/productos/descripcion.producto.php")  ;?>
				<? include($rut."incluidos_sitio/ecommerce/productos/caracteristicas.producto.php")  ;?>
				<? include($rut."incluidos_sitio/ecommerce/productos/garantias.producto.php")  ;?>

				<? include($rut."incluidos_sitio/ecommerce/productos/envio.producto.php")  ;?>
				<?include($rut."incluidos_sitio/ecommerce/productos/formulario.recomendar.producto.php");;?>
				<? include($rut."incluidos_sitio/ecommerce/productos/descargar.doc.producto.php")  ;?>
	</nav>
