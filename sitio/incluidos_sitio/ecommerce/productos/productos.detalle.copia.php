<article class="cont_noticas_centro_detalle">


	<article class="slec_categoria">
		<a href="categoria.productos.php" style="text-decoration: none;">
			<article class="todas_cat">
				<img src="<? echo $rut?>images/carrito.png" alt="">
				<span>VER TODAS LAS CATEGOR&iacute;AS</span>
			</article>
		</a>

<? 	include("incluidos_sitio/productos/combo.categorias.php");?>

	</article>



	<?if ($idtipo==2) { ?><h1><? echo $dsproducto?></h1><? } ?>
	<section class="bloq_titulo_producto">
	<form action="#" method=post name="producto_detalle">


		<article class="sombra">

		</article>
		<section class="capa_img">
<?if ($idtipo<>2) { ?>

			<ul id="example3">

				<?if ($dsimg2<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg2;?>" />
				<?if ($dsimg3<>"") { ?>

					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg3;?>" />
				<? } ?>
				</li>
				<?}
$mostrarmas=1; // poor defecto mostrar
if ($dsimg4=="" && $dsimg7=="") $mostrarmas=0;
if ($mostrarmas==1){
				?>

				<?if ($dsimg5<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg5;?>" />
				<?if ($dsimg6<>"") { ?>

					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg6;?>" />
				<? } ?>
				</li>
				<?}?>
				<?if ($dsimg8<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg8;?>" />
				<?if ($dsimg9<>"") { ?>

					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg9;?>" />
				<? } ?>
				</li>
				<?}
}
				?>



			</ul>

<? } else { ?>

				<?if ($dsimg2<>"") { ?>
				<article class="cont_img_servicio">
					<img src="<? echo $rutaImagen.$dsimg2;?>" />
				</article>
				<? } ?>

<? } ?>



			<a href="galeria.producto.leigh.php?lightbox[width]=800&lightbox[height]=600&idproducto=<? echo $idproducto?>" class="lightbox gal_liet_pro">Abrir Galer&iacute;a</a>
			<!-- <a href="?lightbox[width]=800&lightbox[height]=600#wrapper" class="lightbox gal_liet_pro">Abrir Galer&iacute;a del Producto</a> -->
			<?if ($idnat == 2) {?>
			<article class="p_inter"><p>IMPORTADO</p></article>
			<? } ?>


		</section>

		<section class="cont_info" id="abr">
			<?if ($idtipo<>2) { ?><h1><? echo $dsproducto?></h1><? } ?>
			<p><? echo $dsd; ?></p>

<?
$idconsec=$_REQUEST['idconsec'];
if ($idconsec>0) {
			$sql="select dstalla,dscolor";
			$sql.=" from tbltemporalcompras where idconsec=$idconsec ";
			$sql.=" and dsfecha='".$_SESSION['dsfechacompra']."' and idcliente='".$_SESSION['idcomprador']."' and idtienda=$idtienda ";

			$resuktt=$db->Execute($sql);
			if(!$resuktt->EOF){
			$dstalla=($resuktt->fields[0]);
			$dscolor=($resuktt->fields[1]);
			}
			$resuktt->Close();

}

	include($rut."incluidos_sitio/productos/productos.tallas.colores.php");
?>

            <article class="cont_precio">
				<article class="in_precio">
				<h5>HOY</h5>
		<? if ($id==416 || $id==414 || $id==415) {?>

					<p class="precio">$ <? echo number_format($preciodescuentom,0); ?></p>
					<? if ($precio1>0 && $preciodescuento>0) { ?><p class="ahorro">Ahorras <span>$ <? echo number_format($precio1m-$preciodescuentom,0)?></span></p><? } ?>
		<? } else {?>
					<p class="precio">$ <? echo number_format($preciomostrar+$precio2+$iva+$valorseguro,0); ?></p>
					<? if ($precio1>0 && $preciodescuento>0) { ?><p class="ahorro">Ahorras <span>$ <? echo number_format($precio1-$preciodescuento+$iva,0)?></span></p><? } ?>

		<? } ?>

					<? if ($dsdisponible==1 && ($idactivo<>2 && $idactivo<>9 && $idactivo<>5) ){?>
					<? if ($idtipo<>2) {?>
					<p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Producto disponible">Producto disponible</p>
					<? } else { ?>
					<p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Servicio disponible">Servicio disponible</p>

					<? } ?>
					<? } ?>
                    <? if ($dsentrega<>"" && $idtipo<>2) {?>
					<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rut;?>images/reloj.png" alt="Tiempo de Entrega"><? echo $dsentrega?></p>
					<? } ?>
					<p class="tienpo_entrega">
                          <? if ($idtipo<>2) {?>
                          <? if ($precio2>0) {?>
                                          * incluye transporte a punto de venta

                          <? } else { ?>
                                          * No incluye transporte
                          <? } ?>
                          <? } ?>

					</p>
				</article>
				<article class="tiempo_ofert">
					<!--h4>Tiempo Restante</h4>
					<p>11:22:05</p-->
				</article>
			</article>

			<article class="cont_ofert">
				<ul class="btns_tienda">
<?
	include($rut."incluidos_sitio/productos/boton.adicionar.php");
?>
				</ul>
								<? if ($preciodescuento>0) {?>

				<section class="inf_ofeta">

					<article class="porcen">

						<p><? echo number_format($pordescuentom,0) ?>% <span>Descuento</span></p>
					</article>
<!-- 					<article class="text">

	<h4></h4>
	<p></p>
</article> -->
				</section>
			<? } ?>

			</article>
<input type="hidden" name="idconsec" value="<? echo $idconsec;?>">
</form>
		</section>
	</section>
<?include("incluidos_sitio/sindicacion/sindicacion.php");?>

<? if ($dsd2<>""){ ?>
	<article class="noticas_centro_detalle">

		<h4 class="title_text">Descripci&oacute;n <? if ($idtipo==2) echo "del servicio";?></h4>
		<p><? echo $dsd2 ?></p>

        <? if ($dscondiciones<>"" && $idtipo==2) {?>
       	<h4 class="title_text">Condiciones</h4>
		<p><? echo $dscondiciones?></p>

        <? } ?>
		<div style="clear:both;"></div>

<?
if ($idproveedor<>"") {
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/proveedores/";

	$sql="select dsm,dsd,dsimg from tblproveedores where id=$idproveedor";
	                        $result=$db->Execute($sql);
                        if(!$result->EOF){
                      $dsm=reemplazar($result->fields[0]);
                      $dsd=reemplazar($result->fields[1]);
                      $dsimg=reemplazar($result->fields[2]);

?>
	<section class="info_empresa">
		<article class="sombra"></article>
		<h2><? echo $dsm?></h2>
		<? if ($dsimg<>""){?>
		<img src="<? echo $rutaImagen.$dsimg?>" alt="" class="logo">
		<? } ?>
		<p><? echo $dsd;?></p>
		<!--article class="info_contacto">
			<p><span>Ubicaci&oacute;n:</span> Calle 00 nº 00 - 00</p>
			<p><span>Tel&eacute;fono:</span> 000 00 00</p>
			<p><span>Sitio Web:</span> www.nombreempresa.com</p>
		</article-->
		<div style="clear:both;"></div>
	</section>

<?
	                  }
                        $result->Close();


}
?>

	</article>
<? }
	include("incluidos_sitio/productos/productos.detalle.opciones.php");

?>


</article>



<?
	if ($dsvideo<>"") include("incluidos_sitio/productos/video.producto.php");
	include("incluidos_sitio/productos/formulario.recomendar.producto.php");
	if ($dscondiciones<>"" && $idtipo<>2)  include("incluidos_sitio/productos/caracteristicas.producto.php");
	if ($dsdoc<>"")  include("incluidos_sitio/productos/descargar.doc.producto.php");

?>




