<article id='compra_asistida' class="cuerpo_tab">
<!-- 	<article class="txt_qsomos">
	<h2>Compra Asistida</h2>
		<p>
			Millones de personas hoy compran en internet con seguridad. Comprar en l&iacute;nea le permite escoger entre millones de productos y miles de tiendas alrededor del mundo.  Contamos con personal especializado para ayudarle a tomar las mejores decisiones a la hora de adquirir productos y servicios.
 				<br><br>
			Usted puede solicitar el servicio de compra asistida a trav&eacute;s de nuestro Chat, en el centro de experiencias con atenci&oacute;n personalizada o solicitando asesor&iacute;a v&iacute;a mail, en los siguientes casos.
		</p>
</article>
<article class="cont_compra_asistida">
	<?
		$titulos = array(
			'0' => "Nunca has comprando por internet",
			'1' => "Si usted no tiene Tarjeta de Cr&eacute;dito",
			'2' => "Si usted tiene Tarjeta de Cr&eacute;dito Internacional pero no desea usarla",
			'3' => "Compras en tiendas o Almacenes de Colombia",
			);
		$txttitulos = array(
			'0' => "Podemos orientarlo para que su experiencia resulte satisfactoria y obtenga ahorros significativos.",
			'1' => "Tambi&eacute;n puede comprar por internet, contamos con diversas modalidades de pago para que usted pueda realizar sus compras. ",
			'2' => "Podemos recibir su tarjeta de cr&eacute;dito o tarjeta debito nacional y realizar las compra por usted en la tienda que elija en Estados Unidos o Europa.",
			'3' => "Nuestra compa&ntilde;&iacute;a es proveedor registrado de pagos en Colombia y es adem&aacute;s proveedor de plataformas de comercio electr&oacute;nico para importantes compa&ntilde;&iacute;as colombianas.  Usted puede consultar a nuestro departamento de servicio para comprar en comercios nacionales o si requiere implementar soluciones de comercio electr&oacute;nico para su empresa.",
			);


	?>
	<?for ($i=0; $i < 4; $i++) { ?>
		<h3 class="titu_pregunta"><span><?echo $i?></span> <?echo $titulos[$i]?></h3>
		<article class="txt_pregunta">
			<? if (is_File("../contenidos/images/compra_asistida/".$i.".jpg")){?>
				<img src="../contenidos/images/compra_asistida/<?echo $i?>.jpg" alt="">
			<?}?>
			<p>
				<?//echo $i?>
				<?echo $txttitulos[$i]?>
			</p>
			<div style="clear:both;"></div>
		</article>
	<?}?>
</article>

<article class="txt_qsomos">
	<p><strong>LA ASISTENCIA EN COMPRAS Y ASESOR&Iacute;A INTEGRAL TIENE UN COSTO DE 10% SOBRE LOS PRODUCTOS ADQUIRIDOS.</strong></p>
</article> -->
</article>