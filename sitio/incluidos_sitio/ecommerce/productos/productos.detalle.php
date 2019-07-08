<article class="cont_prod_detalle">

	<?if ($idtipo==2) { ?><h1><? echo $dsproducto?></h1><? } ?>


	<form action="#" method=post name="producto_detalle">

		<section class="cont_izq">
	    <!--************inicio galeria por producto*************-->
		<ul>
		<?
		$rutaImagen=$rutaFuenteImagenes."/../contenidos/images/ecommerce_productos/";
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
		
		</section>

		<section class="cont_info">

		<?if ($idtipo<>2) { ?><h1><? echo $dsproducto?></h1><? } ?>

			<!--h3 class="nombre_categoria">Nombre categoría</h3-->

			<h3>Ref: <? echo $dsreferencia?></h3>
	        <? if ($preciodescuentom>0) {?>
			<article class="cont_porcen">
			<p> -<? echo number_format($pordescuentom,0)?>%</p>
			</article>

			<p class="descripcion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua.</p>

			<? } ?>
	   		<!--//================== inicio listado de tallas por producto =========================================//-->



	   		<p class="precio1" id="preciox_m">
					<? if($preciomostrar>0){ ?>$ <? echo number_format($preciomostrar+$dsflete+$iva+$valorseguro,0);?>
					</p>
					<? if ($precio1>0 && $preciodescuento>0) { ?>
					<p class="ahorro">Ahorras <span>$ <? echo number_format($preciodescuento,0)?></span></p><? } ?>
					<? }else{ ?>
					<? } ?>


				<?/* if ($dsdisponible==1 && $dsunidadesdispo>0 && ($idactivo<>2 && $idactivo<>9) && $precio1>0){?>
				<? if ($idtipo<>2) {?>
				<p class="disponible"><img src="<? echo $rutbase;?>/images/chulo.png" alt="Producto disponible">Producto disponible</p>
				<? } else { ?>
				<p class="disponible"><img src="<? echo $rutbase;?>/images/chulo.png" alt="Servicio disponible">Servicio disponible</p>
				<? } ?>
				<? } else {?>
				<p class="nodisponible">Producto no disponible</p>
				<?} */?>		



			<!--ul class="cont_tallas">
			<h3>Tallas:</h3>
			<select  name="idtalla" id="idtalla" onchange="valor_talla()" onclick="ocultar('mensaje')">
			<option value="">--Seleccione--</option>
			<?
			$sql ="select a.id,a.dsm,b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5";
			$sql.=" FROM ecommerce_tbltallas a,ecommerce_tbltallasxtblproducto b where b.idorigen=$idproducto and a.id=b.iddestino and a.idactivo not in (2,9)";
			$vermas_t=$db->Execute($sql);
	   		if(!$vermas_t->EOF){?>
			
	   		<?while (!$vermas_t->EOF) {
	   		$idtalla=$vermas_t->fields[0];
	   		$dsmtalla=$vermas_t->fields[1];
	   		if($tipocliente==1 || $tipocliente=="")$preciox=$idtalla."|".number_format($vermas_t->fields[2]+$dsflete+$iva+$valorseguro,0)."|".($vermas_t->fields[2]+$dsflete+$iva+$valorseguro);
	   		if($tipocliente==2)$preciox=$idtalla."|".number_format($vermas_t->fields[3]+$dsflete+$iva+$valorseguro,0)."|".($vermas_t->fields[3]+$dsflete+$iva+$valorseguro);
	   		if($tipocliente==3)$preciox=$idtalla."|".number_format($vermas_t->fields[4]+$dsflete+$iva+$valorseguro,0)."|".($vermas_t->fields[4]+$dsflete+$iva+$valorseguro);
	   		if($tipocliente==4)$preciox=$idtalla."|".number_format($vermas_t->fields[5]+$dsflete+$iva+$valorseguro,0)."|".($vermas_t->fields[5]+$dsflete+$iva+$valorseguro);
	   		if($tipocliente==5)$preciox=$idtalla."|".number_format($vermas_t->fields[6]+$dsflete+$iva+$valorseguro,0)."|".($vermas_t->fields[6]+$dsflete+$iva+$valorseguro);
	   		?>
			<option value="<?echo $preciox?>"><?echo $dsmtalla?></option>
			<?$vermas_t->MoveNext();
			}?>

			<?
	   		}$vermas_t->Close();
	   		?>
	   		</select>
			</ul-->
	   		<!--//================== fin  listado de tallas por producto =========================================//-->

	   		<div id="mensaje"></div><!--mensaje de error-->

	   		<!--//================== inicio listado de colores por producto =========================================//-->
	   		<!--ul class="cont_colores">
	   		<h3>Colores:</h3>
			<?
			$sqlx="select a.id,a.dsm,a.dsd FROM ecommerce_tblcolores a, ecommerce_tblcoloresxtblproducto b where b.idorigen=$idproducto and a.id=b.iddestino and a.idactivo not in (2,9)";
			$vermas_c=$db->Execute($sqlx);
	   		if(!$vermas_c->EOF){?>
	   		<?while (!$vermas_c->EOF) {
	   		$idcolor=$vermas_c->fields[0];
	   		$dsmcolor=$vermas_c->fields[1];
	   		$dscolor=$vermas_c->fields[2];
	   		?>
	   		<li>
				<input type="radio" name="idcolor" id="idcolor" onclick="ocultar('mensaje')"  title="<? echo $dsmcolor?>" value="<? echo $idcolor?>">
				<span title="<? echo $dsmcolor?>" style="background:<? echo $dscolor?>;"></span>
			</li>
	   		<?$vermas_c->MoveNext();
			}
	   		}$vermas_c->Close();
	   		?>
	   		</ul-->
	   		<!--//================== fin listado de colores por producto =========================================//-->



	   		




				


					<?if ($idnat == 2) {?>
						<p class="p_inter">IMPORTADO</p>
					<? } ?>


					<? if ($dsentrega<>"" && $idtipo<>2) {?>
						<p class="tienpo_entrega" title="Tiempo de Entrega"><img src="<? echo $rutbase;?>/images/reloj.png" alt="Tiempo de Entrega"><? echo $dsentrega?></p>
					<? } ?>
					<p class="tienpo_entrega">
					<? if ($idtipo<>2 && $dsunidadesdispo>0) {?>
						<? if ($dsflete>0) {?>
							* incluye transporte a punto de venta
						<? } else { ?>
							* No incluye transporte
						<? } ?>
					<? } ?>
					</p>

					<? if ($preciodescuento>0) {?>
					
					<? } ?>
					
					<ul class="btn_comprar">
				<li>
				<? if ($dsurlpago<>"") {?>
									<a href="<? echo $dsurlpago?>" target="_blank" class="btn_carrito"><p>Comprar</p></a>

				<?} else {
					?>
									<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_carrito"><p>Comprar</p></a>

					<?					
				}
				?>
				</li>
					</ul>	
				<!--?include($rut."incluidos_sitio/ecommerce/productos/boton.adicionar.php");?-->

			<input type="hidden" name="idconsec" value="<? echo $idconsec;?>">
		</form>

		<?include($rut."incluidos_sitio/sindicacion/sindicacion.php"); ?>


			<?//include("incluidos_sitio/index/destacado.php");?>

		</section>

<?$dirredes="http://".$autorizado."/contenidos/".$dsruta?>
<?
//include($rut."incluidos_sitio/ecommerce/productos/productos.detalle.opciones.php");
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

<br>

<!--?include("incluidos_sitio/ecommerce/productos/otros.productos.php");?-->


</article>

<script type="text/javascript">

function valor_talla(tipocliente){
var valor1=0;
var id;
var x = document.getElementById("idtalla").value;
if(x!=""){
var partir;
partir = x.split("|");
id=partir[0];
valor1=partir[1];
document.getElementById("preciox_m").innerHTML="$ "+valor1
}
}
</script>