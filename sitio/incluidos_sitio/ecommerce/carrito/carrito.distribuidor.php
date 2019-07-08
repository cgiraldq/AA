<article class="cont_carrito_distribuidor">

	<h1>Carrito distribuidor</h1>

	<table  width="100%" class="cbz_carrito_distribuidor" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<tr>
			<td class="campo1">
				<article class="codigo_carrito">
						<h3>CÓDIGO PROMOCIONAL</h3>
				        <form action="/<? echo $rutbase?>/ecommerce.buscador.php" method=post name="ecoomerce_frm_buscador">
						<!--label for="search">Buscador</label-->
						<input type="text" name="dsbusqueda" id="dsbusqueda" placeholder="Código">
						<input type="submit" value="IR">
					</form>
				</article>
			</td>

			<td class="campo2">
				<h1>PEDIDOS DEL DISTRIBUIDOR</h1>
			</td>
		</tr>
	</table>

	<nav class="cont_carrito_btns_derecha">
		<input type="button" value="Realizar pedido" class="btn_general" onclick="validar_distribuidor()" >
	</nav>
	<form action="carrito.distribuidor2.php" method="POST" name="forma_carrito">
	<table width="100%" class="" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<?   $preciomindistrib=seldato("dspreciomindistrib","id"," tblclientes",$_SESSION['i_idcliente'],1);// ?><!--VALOR MINIMO DE COMPRA DISTRIBUIDOR-->
		<tr class="carrito_distribuidor">
			<td> Img producto</td>
			<td>Ref</td>
			<td >Producto</td>
			<td>Unidad</td>
			<td>Unidades disponibles</td>
			<td>Cantidad</td>
			<td>Valor Unitario</td>
			<td>Valor</td>
		</tr>
			<?
			//$db->debug=true;
			// armazon de productos
			$xprecio=2;
            $sql="select a.id,a.dsm ";
            $sql.=" from ecommerce_tblcategoria a";
            $sql.=" where a.id >0 and a.idactivo not in (2,9) ";
            $sql.=" order by a.dsm asc ";
          	//echo $sql;
            $rutaPaginacion="idcat=".$_REQUEST['idcat']."&search=".$_REQUEST['search'];
			//echo $sql;
            $maxregistros=12;
            include("incluidos_modulos/paginar.variables.php");
 			$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
			?>
			<?
			$i=0;
            while (!$result->EOF /*&& ($contar<$maxregistros)*/) {

            $idc=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            ?>
    		<tr class="titulo_categoria">
    			<td></td>
				<td colspan="7" class="campo"><? echo $dsm ?></td><!--CATEGORIA-->
    	 	</tr>
    	 	<?
    	 	// armazon de productos
            $sqld="select a.id,a.dsm ";
            $sqld.=" from ecommerce_tblsubcategoriasxcategoria a,ecommerce_tblcategoriaxsubcategoria b";
            $sqld.=" where a.id >0 and a.idactivo not in (2,9) ";
            $sqld.=" and b.iddestino=".$idc." and a.id=b.idorigen";
            $sqld.=" order by a.dsm asc ";
           	//echo $sqld;
			//echo $sqld;
   			$resultd=$db->Execute($sqld);
 			//$db->debug=true;
            if(!$resultd->EOF){
			?>
			<?
	    while (!$resultd->EOF) {
			$idsub=reemplazar($resultd->fields[0]);
			$dsmc=reemplazar($resultd->fields[1]);
            ?>
	    	<tr class="titulo_subcategoria">
	    		<td></td>
				<td colspan="7" class="campo"><? echo $dsmc ?></td><!--Subcategoria-->
	    	</tr>
			<?
    	 	// productos
    	 	$rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
            $sqls="select a.id,a.dsm,a.dsimgcarrito,a.dsreferencia,a.dsunidad,a.dsunidadesdispo,a.precio2,a.dsruta,iva";
            $sqls.=" from ecommerce_tblproductos a,ecommerce_tblsubcategoriaxtblproducto b";
            $sqls.=" where a.id >0 and a.idactivo not in (9,2) and  a.id=b.idorigen and b.iddestino=".$idsub;
            $sqls.=" order by a.dsm asc ";
           	//echo $sqls."<br>";
   			$results=$db->Execute($sqls);
 			//$db->debug=true;
            if(!$results->EOF){
			?>
			<?
	        $contar=0;
	       	$xsubtotal=0;
          	$xdescuento=0;
          	$xiva=0;
          	$xfletes=0;
          	$xvalorseguro=0;
            while (!$results->EOF) {

     	    $idp=reemplazar($results->fields[0]);
            $dsms=reemplazar($results->fields[1]);
            //$dsimgcarrito=reemplazar($results->fields[2]);
            $dsimgcarrito=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idp,1);
            $dsreferencia=reemplazar($results->fields[3]);
            $dsunidad=reemplazar($results->fields[4]);
            $dsunidadesdispo=reemplazar($results->fields[5]);
            $preciodistribuidor=reemplazar($results->fields[6]);
            $dsporiva=$results->fields[8];
            $dsruta=$results->fields[7];
            $dsrutax=$rutalocal."/producto/";
            $dsrutax.=$dsruta;
            if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
            if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];


            //***********************promociones********************************-//
            			 $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino= $idp or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                       // echo "<br>".$sqldes."<br>--productos";
                        $result_des=$db->Execute($sqldes);
                        if(!$result_des->EOF){
                        $xpromoproducto=1;
                        $promodescuento=($result_des->fields[1]);
                        $idpreciox=($result_des->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tbltblproductoxcategoria',$idp,1)."'";
                       // echo "<br>".$sqldes."<br>--Categoria";
                        $resultY=$db->Execute($sqldes);
                        if(!$resultY->EOF){
                        $xpromocatecoria=1;
                        $promodescuento=($resultY->fields[1]);
                        $idpreciox=($resultY->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.=" ecommerce_tblpromocionesxsubcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$idp,1)."'";
                        //echo $sqldes."<br>--Sub";
                        $resultx=$db->Execute($sqldes);
                        if(!$resultx->EOF){
                        $xpromosubcategoria=1;
                        $promodescuento=($resultx->fields[1]);
                        $idpreciox=($resultx->fields[2]);
                        }$resultx->Close();//  Fin Subcategoria
                        }$resultY->Close();// Fin  promocion Categoria
                        }$result_des->Close();// Fin  promocion producto

   				//***********************promociones********************************-//
                        $preciodistribuidor;
                       	$iva1=$preciodistribuidor*($dsporiva/100);
                       	$valopromo=$preciodistribuidor*($promodescuento/100);
                       	$preciodistribuidor=$preciodistribuidor-$valopromo;
            			$preciodistribuidor=$preciodistribuidor+$iva1;
                        $promodescuento="";



            ?>
            <? if($preciodistribuidor>0 && $dsunidadesdispo>0 ) {?>
			<tr class="campo_producto">
			<td class="campo_img">
				<a href="<? echo $dsrutax ?>"><?if ($dsimgcarrito<>"") { ?>
				<img src="<? echo $rutaImagen.$dsimgcarrito;?>"><? } ?>
				</a>
			</td>
							<td><? echo $dsreferencia ?></td>
							<td><? echo $dsms ?></td>
							<input type="hidden" name="nombreprod[]" value="<? echo $dsms ?>">

							<td><? if($dsunidad<>""){ ?>X <? echo $dsunidad ?><? }else{ ?><?} ?></td>
							<td ><? if($dsunidadesdispo<>""){ ?><? echo $dsunidadesdispo ?><? }else{ ?><? } ?></td>
							<input type="hidden" name="unidadispo[]" value="<? echo $dsunidadesdispo ?>">
							<td>
								<!--select>
								  <option value="140">140</option>
								  <option value="180">180</option>
								  <option value="220">220</option>
								  <option value="300">300</option>
								</select-->
							<input type="text"  name="cantidad[]" size="5" value="<? echo $cantidad[$i];?>" onBlur="calcularsubtotal(<? echo $i?>);" onKeypress="calcularsubtotal(<? echo $i?>);">
							<input type="hidden" name="unidadesdispo[]" value="<? echo $dsunidadesdispo ?>">
							</td>
							<td><? echo $preciodistribuidor ?>
							<input type="hidden" name="valorunitario[]" value="<? echo $preciodistribuidor ?>" onBlur="calcularsubtotal(<? echo $i?>);" onKeypress="calcularsubtotal(<? echo $i?>);">
							</td>
							<td><input type="text" name="total[]" value="<? echo $total[$i];?>" id="total[]" onBlur="calcularsubtotal(<? echo $i?>);" onKeypress="calcularsubtotal(<? echo $i?>);">
							<input type="hidden" name="idpro[]" value="<? echo $idp ?>" />
							<input type='hidden' name='idpos[]' class='forma2' value='<? echo $i;?>' id='idpos[]'>
							</td>

		</tr>
		<? }?>
		 <?
        $i++;
        $results->MoveNext();
        }
		?>
		<?
			// fin armazon de productos
			}
			$results->Close();
			?>
			<?
				$resultd->MoveNext();
				}
			?>
			<?
			// fin armazon de productos
				}
				$resultd->Close();
			?>
	    <?
        $contar++;
        $result->MoveNext();
        }
		?>
<?
// fin armazon de productos
//$db->debug=false;
        include("incluidos_modulos/index.paginar.php");
}
        $result->Close();
?>
</table>

	<table width="100%" class="cont_subtotales_distribuidor" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<tr>
			<td><p>Subtotal</p></td>
			<td class="precio"><p>$1'854.000</p></td>
		</tr>

		<tr>
			<td><p>Descuento pronto pago (Valores superiores a 2'000.000)</p></td>
			<td class="precio"><p>$1'854.000 </p></td>
		</tr>

		<tr>
			<td><p>IVA</p></td>
			<td class="precio"><p>3%</p></td>
		</tr>

	</table>

	<table width="100%" class="cont_total_distribuidor" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<tr>
			<td></td>

			<td>TOTAL A PAGAR</td>
			<td>
				<input type="text" name="totalvalor" value="<? echo $dstotal ?>" onBlur="totales();">
				<input type='hidden' name='preciomindistrib' class='forma2' value='<? echo $preciomindistrib;?>' id='preciomindistrib'>
			</td>
		</tr>
	</table>

	<nav class="cont_carrito_btns_derecha">
			<input type="button" value="Realizar pedido" class="btn_general" onclick="validar_distribuidor()" >
	</nav>

</form>
</article>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">


function totales(){
	// vector valor
	var total=0;
	var subtotal=0;
	var totalbaseiva=0;

	var iva=0;
	var ivax=0;
	descuento=0;
	for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
			var y=document.forma_carrito.elements['cantidad[]'][i].value;
			var x=document.forma_carrito.elements['valorunitario[]'][i].value;
			if (x=="") x=0;
	if (y>0) {
			var z=(parseFloat(x)*parseFloat(y));
			document.forma_carrito.elements['total[]'][i].value=redondear(z);
			subtotal=subtotal+z;
	}
		}
	totalx=(eval(redondear(subtotal)));
	document.forma_carrito.totalvalor.value=redondear(totalx);
	}



function calcularsubtotal(pos){
	for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
			if (i==pos) {
	var y=document.forma_carrito.elements['cantidad[]'][i].value;
				if (y>0) {
							var x=document.forma_carrito.elements['valorunitario[]'][i].value;
							var z=(parseFloat(x)*parseFloat(y));
							document.forma_carrito.elements['total[]'][i].value=redondear(z);
				}
				break;
		}
}
	totales();
}




function validar_distribuidor() {
			var total=document.forma_carrito.totalvalor.value
			var compara=document.forma_carrito.preciomindistrib.value;
if (total=="") {
			alertify.alert("<b>Seleccione al menos un producto</b>", function () {
					//aqui introducimos lo que haremos tras cerrar la alerta.
					//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
				});
		return;
		/*
	alert("Seleccione al menos un producto");
	return;
	*/
}
if(eval(document.forma_carrito.totalvalor.value)<=eval(document.forma_carrito.preciomindistrib.value)) {
		alertify.alert("<b>Su compra mínima  debe ser de :  "+compara+"  </b><br>", function () {
					//aqui introducimos lo que haremos tras cerrar la alerta.
					//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
				});
		return;
}
/*if( parseInt(total)<=parseInt(compara)) {
	alert("Su compra mínima  debe ser de "+compara);
	return;
}
*/
//document.forma_carrito.submit();

				//un alert

		for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
						//var unidadesdispo= document.getElementById(["unidaddispo"][i]).value;
						//var unidadesdispo=document.forma_carrito.elements['unidaddispo[]'][i].value;
					//alert(total);
				//alert(compara);
				if(eval(document.forma_carrito.elements['cantidad[]'][i].value)>eval(document.forma_carrito.elements['unidadispo[]'][i].value)) {


							//	var iva=document.u.elements['dssubtotal[]'][i].value*(document..elements['dsivax[]'][i].value/100);
							var nombreproduc = document.forma_carrito.elements['nombreprod[]'][i].value
					/*alertify.log("Su compra minima debe ser de "+compara+"");
					return false;*/
					alertify.alert("<b>La cantidad del producto "+ nombreproduc +" debe ser menor a las unidades disponibles.</b><br>", function () {
					//aqui introducimos lo que haremos tras cerrar la alerta.
					//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
					});
					return;
				}
		}
//}

document.forma_carrito.submit();
}
//un alert
</SCRIPT>
