
<article class="cont_noticas_centro_detalle">


	<!--article class="slec_categoria">
		<a href="<?echo $rut?>categoria.productos.php" style="text-decoration: none;">
			<article class="todas_cat">
				<span>VER TODAS LAS CATEGOR&iacute;AS</span>
			</article>
		</a>

<? 	include($rut."incluidos_sitio/productos/combo.categorias.php");?>

	</article-->



	<?if ($idtipo==2) { ?><h1><? echo $dsproducto?></h1><? } ?>
	<section class="bloq_titulo_producto">
	<form action="#" method=post name="producto_detalle">
		<!--article class="sombra">
		</article-->
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



			<a href="<?echo $rutbase?>galeria.producto.leigh.php?lightbox[width]=800&lightbox[height]=600&idproducto=<? echo $idproducto?>" class="lightbox gal_liet_pro">Abrir Galer&iacute;a</a>

			<ul class="galeria_producto2">
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
				<li><a href="#"><img src="images/gorra1.jpg"></a></li>
			</ul>

			<iframe width="310" height="200" src="//www.youtube.com/embed/SOZwN4Qqb40" frameborder="0" allowfullscreen></iframe>

	</section>

		<section class="cont_info" id="abr">
			<?if ($idtipo<>2) { ?><h1><? echo $dsproducto?></h1><? } ?>
			<p class="unidades"> unidades X <? echo $dsunidad ?></p>
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

	//include($rut."incluidos_sitio/productos/productos.tallas.colores.php");
?>

            <article class="cont_precio">
            <? if ($preciodescuentom>0) {?>
						<article class="cont_porcen">
							<p> - <? echo number_format($pordescuentom,0)?>%</p>
						</article>
			<? } ?>
				<article class="in_precio">
					<!--h5>HOY</h5-->
					<? if ($preciodescuento>0) {?>
					<? } ?>
					<p class="precio"><? if($preciomostrar>0 && $dsunidadesdispo>0 ){ ?>$ <? echo number_format($preciomostrar+$precio2+$iva+$valorseguro,0); ?></p><? }else{ ?><p class="nodisponible">Producto no disponible</p><? } ?><!--Linea agregada 10/02/2014-->
						<!--p class="precio">$ <? //echo number_format($preciomostrar+$precio2+$iva+$valorseguro,0); ?></p-->
						<? if ($precio1>0 && $preciodescuento>0) { ?><p class="ahorro">Ahorras <span>$ <? echo number_format($precio1-$preciodescuento,0)?></span></p><? } ?>

					<?if ($idnat == 2) {?>
						<!--article class="p_inter"><p>IMPORTADO</p></article-->
					<? } ?>

					<? if ($dsdisponible==1 && ($idactivo<>2 && $idactivo<>9 && $idactivo<>5) ){?>
						<? if ($idtipo<>2) {?>
							<!--p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Producto disponible">Producto disponible</p-->
						<? } else { ?>
							<p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Servicio disponible">Servicio disponible</p>
						<? } ?>
					<? } ?>

					<? if ($dsentrega<>"" && $idtipo<>2) {?>
						<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rut;?>images/reloj.png" alt="Tiempo de Entrega"><? echo $dsentrega?></p>
					<? } ?>

					<p class="tienpo_entrega">
						*Este valor incluye el IVA.
					</p>

					<!--p class="tienpo_entrega">

					<? if ($idtipo<>2) {?>
						<? if ($precio2>0) {?>
							* incluye transporte a punto de venta
						<? } else { ?>
							* No incluye transporte
						<? } ?>
					<? } ?>

					</p-->
				</article>

			</article>

			<article class="cont_ofert">
				<ul class="btns_tienda">
					<?
						include($rut."incluidos_sitio/productos/boton.adicionar.php");
					?>
				</ul>
			</article>
<input type="hidden" name="idconsec" value="<? echo $idconsec;?>">
</form>

		</section>

<article class="noticas_centro_detalle">

		<h1 class="title_text">Cuidados de la prenda</h1>
		<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.
			Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500,
			cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una
			 galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. </p>
		<div style="clear:both;"></div>

	</article>

		<?$dirredes="http://".$autorizado."/contenidos/".$dsruta?>
<?
include($rut."incluidos_sitio/sindicacion/sindicacion.php");
include($rut."incluidos_sitio/productos/productos.detalle.opciones.php");
?>




<?
	if ($dsvideo<>"") include($rut."incluidos_sitio/productos/video.producto.php");
	include($rut."incluidos_sitio/productos/formulario.recomendar.producto.php");
	if ($dscondiciones<>"" && $idtipo<>2)  include($rut."incluidos_sitio/productos/caracteristicas.producto.php");
	if ($dsdoc<>"")  include($rut."incluidos_sitio/productos/descargar.doc.producto.php");

?>

<? if ($dsd2<>""){ ?>
	<!--article class="noticas_centro_detalle">

		<h4 class="title_text">Descripci&oacute;n <? if ($idtipo==2) echo "del servicio";?></h4>
		<p><? echo $dsd2 ?></p>

        <? if ($dscondiciones<>"" && $idtipo==2) {?>
       	<h4 class="title_text">Condiciones</h4>
		<p><? echo $dscondiciones?></p>

        <? } ?>
		<div style="clear:both;"></div>

	</article-->
<? }


?>

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
		<img src="<? echo $rut.$rutaImagen.$dsimg?>" alt="" class="logo">
		<? } ?>
		<p><? echo $dsd;?></p>
		<div style="clear:both;"></div>
	</section>

<?
	                  }
                        $result->Close();


}
?>



</section>

</article>






