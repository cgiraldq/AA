<article class="cont_prod_detalle">

	<?if ($idtipo==2) { ?><h1><? echo $dsproducto?></h1><? } ?>


	<form action="#" method=post name="producto_detalle">

		<section class="cont_izq">
	    <!--************inicio galeria por producto*************-->
		<ul>
		<?
		$rutaImagen="/contenidos/images/ecommerce_productos/";
		$sqlimg="select id,dsimg";
		$sqlimg.=" from ecommerce_tblproductoximg where 1";
		$sqlimg.="  and iddestino=$idrelacion order by id asc limit 0,1 ";
		$resultimg = $db->Execute($sqlimg);
		$valacceso=0;
		if (!$resultimg->EOF) {
		$valacceso=1;
		while (!$resultimg->EOF) {
		$dsimg=$resultimg->fields[1];	?>
		<?if ($dsimg<>"") { ?>
		<!--li class='zoom' id='zoom_producto'>
			<img src="<? echo $rutaImagen.$dsimg;?>" />
		</li-->
		<?}
		$resultimg->MoveNext();
		 }
    	 }else{
    	 	?>
    	 	<li class='zoom' id='zoom_producto'><img src="<?echo  $rutbase?>/images/img_sin.png">
    	 	</li>

    	 	<?
    	 }
		$resultimg->Close();
	    ?>
		</ul>

		<? if ($valacceso==1){?>

			<div class="sp-wrap">
				<?
				$sqlimg="select id,dsimg";
				$sqlimg.=" from ecommerce_tblproductoximg where 1";
				$sqlimg.="  and iddestino=$idrelacion order by id asc ";
				$resultimg = $db->Execute($sqlimg);
				if (!$resultimg->EOF) {
				while (!$resultimg->EOF) {
				$dsimg=$resultimg->fields[1];
				if ($dsimg<>"") { ?>

				<a href="<? echo $rutaImagen.$dsimg;?>"><img src="<? echo $rutaImagen.$dsimg;?>"></a>

				<?

				}
				$resultimg->MoveNext();
		    	 }
				}
				$resultimg->Close();

				?>
			</div>
		<? } ?>

		<!--************fin galeria por producto*************-->

		<? if ($dsvideo<>"") echo $dsvideo; ?>
		<?include($rut."incluidos_sitio/sindicacion/sindicacion.php"); ?>
		</section>

		<section class="cont_info">

		<?if ($idtipo<>2) { ?><h1><? echo $dsproducto?></h1><? } ?>
			<?include("calculo.precios.wear.php");?>
			<h3>REF: <? echo $dsreferencia?></h3>
	        <? if ($pordescuentom>0) {?>
			<article class="cont_porcen">
			<p> -<? echo number_format($pordescuentom,0)?>%</p>
			</article>
			<? } ?>
			<p class="descripcion"><? echo reemplazar($dsd2)?></p>

	   		<?$tallasx=seldato('count(*)','idorigen','ecommerce_tbltallasxtblproductos',$idproducto." and dsunidad > 0",1);?>
	   		<?if($tallasx>0){
	   			

	   			?>
			
	   		<!--//================== inicio listado de tallas por producto =========================================//-->
			<ul class="cont_tallas">
			<h3>TALLAS:</h3>
			<select  name="idtalla" id="idtalla" onchange="valor_talla(<?echo $idproducto?>)" onclick="ocultar('mensaje')">
			<option value="">--Seleccione--</option>
	   		</select>
			</ul>
	   		<!--//================== fin  listado de tallas por producto =========================================//-->
	   		<div id="mensaje"></div><!--mensaje de error-->
	   		<input type="hidden" name=precio id="precio"><!--precio por color-->
	   		<input type="hidden" name=talla  id="talla" ><!-- id  de la talla seleccionada-->
	   		<input type="hidden" name="color" id="color"><!-- id  de la color seleccionado-->
	   		<!--//================== inicio listado de colores por producto =========================================//-->
	   		<div id="idcolor"></div>
	   		<!--//================== fin listado de colores por producto =========================================//-->


			<p class="disponible" style="display:" id="dis_p">
				<img src="<? echo $rutbase;?>/images/chulo.png" alt="Producto disponible">Producto disponible
			</p>
			<?}else{?>
			<!--p class="nodisponible">Producto no disponible</p-->
			<!--=============== descomentar p cuando se publique =================-->
			<?}?>			



			<?if ($idnat == 2) {?>
				<p class="p_inter">IMPORTADO</p>
			<? } ?>
			<? if ($dsentrega<>"" && $idtipo<>2) {?>
			<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rutbase;?>/images/reloj.png" alt="Tiempo de Entrega"><? echo $dsentrega?></p>
			<? } ?>
					<p class="tienpo_entrega">
					<?/* if ($idtipo<>2 && $dsunidadesdispo>0) {?>
						<? if ($dsflete>0) {?>
							* incluye transporte a punto de venta
						<? } else { ?>
							* No incluye transporte
						<? } ?>
					<? } */?>
					</p>
					<h5 style="display:none?>" id="tex_h5"></h5>
					<p class="precio1" id="preciox_m"></p>
					<p class="ahorro" id="dsdescuento" style="display:none?>"></p>

		<?//if($tallasx>0)?><!--p class="ahorro" ><span>Precios $ <?echo number_format($preciomenor)?> -  $ <?echo number_format($preciomayor)?></span></p-->
		<?//if($tallasx>0)include("boton.adicionar.wear.php");?>
		<?include("boton.adicionar2.php");?>



		<input type="hidden" name="idconsec" value="<? echo $idconsec;?>">


		</form>
	</section>

<?$dirredes="http://".$autorizado."/contenidos/".$dsruta?>
<?
include($rut."incluidos_sitio/ecommerce/productos/productos.detalle.opciones.php");
?>


<?
if ($idproveedor<>"") {
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_proveedores/";

	$sql="select dsm,dsd,dsimg from ecommerce_tblproveedores where id=$idproveedor";
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

</article>
