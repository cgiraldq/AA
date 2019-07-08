<article class="cont_noticas_centro_detalle">


	<article class="slec_categoria">
		<a href="" style="text-decoration: none;">
			<article class="todas_cat">
				<img src="<? echo $rut?>images/carrito.png" alt="">
				<span>VER TODAS LAS CATEGOR&iacute;AS</span>
			</article>
		</a>
		<form action="">
			<label>Categor&iacute;a:</label>
			<select name="" id="">
				<option value="">Categor&iacute;a 1</option>
				<option value="">Categor&iacute;a 2</option>
			</select>
		</form>
	</article>
	<?include("incluidos_sitio/productos/miga.producto.php");?>


	<section class="bloq_titulo_producto">
		<article class="sombra">

		</article>
		<section class="capa_img">

			<ul id="example3">
				<?for ($i=0; $i < 4; $i++) { ?>
				<li>
					<img class="etalage_thumb_image" src="../contenidos/images/productos/<?echo $i;?>.jpg" /> <!-- Tama&ntilde;o Recomendado Imagen Peque&ntilde;a de 80 x 80-->
					<img class="etalage_source_image" src="../contenidos/images/productos/<?echo $i;?>.jpg" /><!-- Tama&ntilde;o Recomendado Imagen Grande de 900 x 900 -->
				</li>
				<?}?>
			</ul>
			<a href="galeria.producto.leigh.php?lightbox[width]=800&lightbox[height]=600&id=5" class="lightbox gal_liet_pro">Abrir Galer&iacute;a del Producto</a>
			<!-- <a href="?lightbox[width]=800&lightbox[height]=600#wrapper" class="lightbox gal_liet_pro">Abrir Galer&iacute;a del Producto</a> -->


		</section>

		<section class="cont_info" id="abr">
			<h1>Titulo del producto ropa con texto de dos lineas</h1>
			<p>Lorem ipsum Aliqua amet dolore magna nisi fugiat in culpa quis pariatur reprehenderit dolor et eiusmod dolor aute amet cupidatat enim id dolore anim commodo amet elit.</p>

			<section class="detale_ropa">
				<article class="color">
					<form action="">
						<label for="">Color</label>
						<select name="" id="">
		                    <option value="" style="background: #000; color:#000;">Negro</option>
		                    <option value="" style="background: #Fc0; color:#fc0;">Amarillo</option>
		                    <option value="" style="background: #FF2626; color:#FF2626;">Rojo</option>
		                </select>
					</form>
				</article>
				<article class="talla">
					<form action="">
						<label for="">Tallas</label>
						<select name="" id="">
		                    <option value="">16 m</option>
		                    <option value="">17 m</option>
		                    <option value="">18 m</option>
		                    <option value="">19 m/H</option>
		                    <option value="">20 m</option>
		                </select>
					</form>
					<a href="guia.tallas.php?lightbox[width]=960&lightbox[height]=700&id=5" class="lightbox">Gu&iacute;a de Tallas</a>
				</article>
			</section>

			<section class="cont_precio">
				<article class="in_precio">
				<h5>HOY</h5>
				<p class="precio">$75.000</p>
				<p class="ahorro">Ahorras <span>$ 29.000</span></p>
				<p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Producto disponible">Producto disponible</p>
				<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rut;?>images/reloj.png" alt="Tiempo de Entrega">6 D&iacute;as</p>
				<p class="tienpo_entrega">* No incluye Tansporte</p>
				</article>
				<article class="tiempo_ofert">
					<h4>Tiempo Restante</h4>
					<p>11:22:05</p>
				</article>
			</section>

			<article class="cont_ofert">
				<ul class="btns_tienda">
					<li><a href="carrito.php" class="btn_tienda">A&ntilde;adir</a></li>
				</ul>
				<section class="inf_ofeta">
					<article class="porcen">
						<p>50%</p>
					</article>
					<article class="text">
						<h4>Descuento</h4>
						<p>Lorem ipsum Enim voluptate ullamco ut aliqua nostrud.</p>
					</article>
				</section>
			</article>
		</section>
	</section>

	<article class="noticas_centro_detalle">

		<h2>Descripci&oacute;n</h2>
		<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum dictum orci, vitae aliquam mi molestie ullamcorper. Cras augue turpis, varius vitae faucibus in, feugiat et purus. Curabitur convallis ullamcorper sem sed pellentesque. Nullam magna purus, molestie id adipiscing non, interdum vitae risus. Sed est ligula, fringilla tempus dapibus ut, vestibulum et felis. Nulla sodales metus in ipsum egestas et tempor leo suscipit. Morbi nec quam lorem. Cras ut aliquet sapien. Donec vulputate, risus non rutrum luctus, elit sem condimentum neque, eu fringilla magna nisi eget lectus.</p>
		<p>Nunc lobortis urna eu lorem pellentesque vitae facilisis tellus rutrum. Nullam placerat elementum felis quis faucibus. Sed varius adipiscing felis vel dignissim. Proin gravida tortor a ligula consectetur id mattis lectus mattis. Ut lectus urna, volutpat ut aliquet sit amet, malesuada vitae magna. Phasellus lobortis nunc non diam euismod sed rutrum nunc venenatis. Etiam odio lectus, sollicitudin id commodo nec, faucibus ac dolor. Praesent lacinia turpis eget magna pellentesque ut cursus est scelerisque. Quisque pharetra pharetra neque, iaculis molestie elit consectetur ut. Pellentesque ut nulla risus. Duis nisl nulla, varius sed volutpat a, lacinia sed tellus.</p>
		<div style="clear:both;"></div>
	</article>

	<nav class="cont_botenes">
		<ul class="botones tabs">
			<li><a href="#cvideo" class="btn_general">Video</a></li>
			<li><a href="#caracteristicas_pro" class="btn_general">Caracter&iacute;sticas</a></li>
			<li><a href="#descargar_docs" class="btn_general">Descargar Documento</a></li>
			<li><a href="#frm_recom_pro" class="btn_general">Recomendar</a></li>
			<li><a href="#frm_contactar_pro" class="btn_general">Contactar</a></li>
		</ul>
	</nav>
</article>



<?
	include("incluidos_sitio/productos/video.producto.php");
	include("incluidos_sitio/productos/formulario.contactar.producto.php");
	include("incluidos_sitio/productos/formulario.recomendar.producto.php");
	include("incluidos_sitio/productos/caracteristicas.producto.php");
	include("incluidos_sitio/productos/descargar.doc.producto.php");

?>




