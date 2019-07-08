<article class="cont_noticas_centro_detalle">


	<article class="slec_categoria">
		<a href="categoria.productos.php" style="text-decoration: none;">
			<article class="todas_cat">
				<img src="<? echo $rut?>images/carrito.png" alt="">
				<span>VER TODAS LAS CATEGOR&iacute;AS</span>
			</article>
		</a>
	

		<form action="#" method=post name="categorias">
			<label>Categor&iacute;a:</label>

<?
// listar categorias de la tienda
	$sql="select id,dsm from tblcategoria where idactivo not in (2) ";
	$sql.=" and idtipo=1 order by dsm ";

			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){

?>

			<select name="idcat" id="idcat" onChange="redirec_combo('categorias','productos.php','idcat')">
				<option value="">...Todos...</option>

<?
			while (!$resultx->EOF) {
			$idmx=$resultx->fields[0];
			$dsmx=$resultx->fields[1];
	

?>

				<option value="<? echo $idm?>" <? if ($idcat==$idmx) echo "selected";?>><? echo reemplazar($dsmx)?></option>
<?
		$resultx->MoveNext();
		} // fin while
	
?>


			</select>

<?
// fin listar lkas categorias de la tienda
			} 
			$resultx->Close();

?>	    	


	</article>

	

	<section class="bloq_titulo_producto">
		<article class="sombra">

		</article>
		<section class="capa_img">

			<ul id="example3">
				<?if ($dsimg1<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg1;?>" /> 
				<?if ($dsimg3<>"") { ?>
					
					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg3;?>" />
				<? } ?>	
				</li>
				<?}
$mostrarmas=1; // poor defecto mostrar
if ($dsimg4=="" && $dsimg7=="") $mostrarmas=0;
if ($mostrarmas==1){
				?>

				<?if ($dsimg4<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg4;?>" /> 
				<?if ($dsimg6<>"") { ?>
					
					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg6;?>" />
				<? } ?>	
				</li>
				<?}?>
				<?if ($dsimg7<>"") { ?>
				<li>
					<img class="etalage_thumb_image" src="<? echo $rutaImagen.$dsimg7;?>" /> 
				<?if ($dsimg9<>"") { ?>
					
					<img class="etalage_source_image" src="<? echo $rutaImagen.$dsimg9;?>" />
				<? } ?>	
				</li>
				<?}
}
				?>

			</ul>
			<a href="galeria.producto.leigh.php?lightbox[width]=800&lightbox[height]=600&idproducto=<? echo $idproducto?>" class="lightbox gal_liet_pro">Abrir Galer&iacute;a del Producto</a>
			<!-- <a href="?lightbox[width]=800&lightbox[height]=600#wrapper" class="lightbox gal_liet_pro">Abrir Galer&iacute;a del Producto</a> -->
			<?if ($idnat == 2) {?>
			<article class="p_inter"><p>IMPORTADO</p></article>
			<? } ?>


		</section>

		<section class="cont_info" id="abr">
			<h1><? echo $dsproducto?></h1>
			<p><? echo $dsd; ?></p>
            <article class="cont_precio">
				<article class="in_precio">
				<h5>HOY</h5>
					<p class="precio">$ <? echo number_format($preciodescuento,0); ?></p>
					<p class="ahorro">Ahorras <span>$ <? echo number_format($precio1-$preciodescuento,0)?></span></p>
					<? if ($dsdisponible==1 && ($idactivo<>2 && $idactivo<>9 && $idactivo<>5) ){?>
					<p class="disponible"><img src="<? echo $rut;?>images/chulo.png" alt="Producto disponible">Producto disponible</p>
					<? } ?>
                    <? if ($dsentrega<>"") {?>
					<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rut;?>images/reloj.png" alt="Tiempo de Entrega"><? echo $dsentrega?></p>
					<? } ?>	
					<p class="tienpo_entrega">* No incluye Tansporte</p>
				</article>
				<article class="tiempo_ofert">
					<!--h4>Tiempo Restante</h4>
					<p>11:22:05</p-->
				</article>
			</article>

			<article class="cont_ofert">
				<ul class="btns_tienda">
					<li><a href="adicionar.php?idproducto=<? echo $idproducto?>" class="btn_tienda">A&ntilde;adir</a></li>
				</ul>
				<section class="inf_ofeta">
					
					<article class="porcen">
								<? if ($preciodescuento>0) {?>

						<p><? echo number_format((($precio1/$preciodescuento)-1)*100,0) ?> %</p>
<? } ?>
					</article>
					<article class="text">
				<? if ($preciodescuento>0) {?>

						<h4>Descuento</h4>
						<p></p>
				<? } ?>		
					</article>
				</section>
			</article>
		</section>
	</section>
<? if ($dsd2<>""){ ?>
	<article class="noticas_centro_detalle">

		<h2>Descripci&oacute;n</h2>
		<p><? echo $dsd2 ?></p>
		<div style="clear:both;"></div>
	</article>
<? } ?>
	<nav class="cont_botenes">
		<ul class="botones tabs">
			<? if($dsvideo<>""){ ?>
			<li><a href="#cvideo" class="btn_general">Video</a></li>
			<? } ?>
			<? if($dscondiciones<>""){ ?>

			<li><a href="#caracteristicas_pro" class="btn_general">Caracter&iacute;sticas</a></li>
			<?  } ?>
			<? if($dsdoc<>""){ ?>

			<li><a href="#descargar_docs" class="btn_general">Descargar Documento</a></li>
			<? } ?>
			<li><a href="#frm_recom_pro" class="btn_general">Recomendar</a></li>

			<li><a href="contacto.php?dsreferencia=<? echo $dsproducto?>&idproducto=<? echo $idproducto?>" class="btn_general">Contactar</a></li>
		</ul>
	</nav>
</article>



<?
	if ($dsvideo<>"") include("incluidos_sitio/productos/video.producto.php");
	include("incluidos_sitio/productos/formulario.recomendar.producto.php");
	if ($dscondiciones<>"")  include("incluidos_sitio/productos/caracteristicas.producto.php");
	if ($dsdoc<>"")  include("incluidos_sitio/productos/descargar.doc.producto.php");

?>




