<?


 $rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
    		  $sql="select a.idproducto,a.idcant,a.idprecio,a.dstotal,b.dsimgcarrito,b.dsm,b.precio1,b.precio2,";
              $sql.="b.dsmarca,b.dsreferencia,a.dspordescuento,a.dsporiva,a.id";
              $sql.=",b.preciodescuento ";
              $sql.=",b.dsentrega,b.dscondiciones";

                $sql.=" ,dsdireccionenvio";
                $sql.=" ,dspara";
                $sql.=" ,dsciudadenvio";
                $sql.=" ,dsvalorenvio";
                $sql.=" ,dstelefonoenvio";
                $sql.=" ,dsmensajeenvio";
                $sql.=" ,dsobsenvio";
                $sql.=" ,dszonaenvio";
                $sql.=" ,dstipoenvio";
                $sql.=" ,dsfechaenvio";
                $sql.=" ,dshoraenvio";
                $sql.=" ,dstipodirenvio";
                $sql.=" ,idconsec";
                $sql.=" ,preciocompra";
                $sql.=" ,a.dstalla";
				$sql.=" ,a.dscolor";
				$sql.=" ,b.idtipo";
				$sql.=" ,b.dsunidad";
				$sql.=" ,b.dsunidadesdispo";
				$sql.=" ,b.id";
				$sql.=" ,b.dsruta";
				$sql.=" ,b.idnat";
				$sql.=" ,b.dsflete";
				$sql.=" ,b.precio3";
				$sql.=" ,b.precio4";
				$sql.=" ,b.precio5";
				$sql.=" ,a.idcolor";




              $sql.=" from ecommerce_tbltemporalcompras a, ecommerce_tblproductos b where a.idproducto=b.id ";
              $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
              $sql.=" and idip='".$_SESSION['ipremota']."'";
              $sql.=" and b.idactivo not in (2,9) and a.idtienda=$idtienda ";


                  //echo $sql;

?>
<section class="cont_carrito" id="cont_carrito">
<h1><? echo $dstituloPagina?></h1>

	<?
	$result=$db->Execute($sql);
	  if(!$result->EOF){
	?>

	<form action="inicio.sesion.php" method="POST" name="forma_carrito">

	<nav class="btn_seguir_comprando">
		<input type="button" value="SEGUIR COMPRANDO" class="btn_zona" onClick="irAPaginaD('ecommerce.categoria.php')">
	</nav>

	<table  width="100%" class="tbl_productos" border=0 border-collapse="0" border-spacing="0" cellspacing="0">

		<thead>
			<tr class="cbz_carrito">
				<td colspan="2" >Producto</td>
				<td class="campo">Unidades</td>
				<td>Unidades Disponibles</td>
				<td class="campo">Precio</td>
				<td class="campo">Cantidad</td>
				<td class="campo">Subtotal</td>
				<td colspan="2"></td>
			</tr>
		</thead>

		<tbody>
			<?
		$xsubtotal=0;
          $xdescuento=0;
          $xiva=0;
          $xfletes=0;
          $xvalorseguro=0;

            while(!$result->EOF){

                  $idproducto=reemplazar($result->fields[0]);
                  $dsm=reemplazar($result->fields[5]);


                  $idprecio=($result->fields[2]); // valor venta
                  $precio1=($result->fields[6]);
                  $precio2=($result->fields[38]);

                  $dsmarca=($result->fields[8]);
                  $dsreferencia=($result->fields[9]);
                  $dspordescuento=($result->fields[10]);
                  $dsporiva=($result->fields[11]);
                  $idx=($result->fields[12]);
                  $preciodescuento=($result->fields[13]);
                  $dsentrega=reemplazar($result->fields[14]);
                  $dscondiciones=reemplazar($result->fields[15]);

// datos de envio
$dsdireccionenvio=reemplazar($result->fields[16]);
$dspara=reemplazar($result->fields[17]);
$dsciudadenvio=reemplazar($result->fields[18]);
$dsvalorenvio=reemplazar($result->fields[19]);
// si esta dsvalorenvio, se debe sumar a una variable adicional de transporte que suma al final
$dstelefonoenvio=reemplazar($result->fields[20]);
$dsmensajeenvio=reemplazar($result->fields[21]);
$dsobsenvio=reemplazar($result->fields[22]);
$dszonaenvio=reemplazar($result->fields[23]);
$dstipoenvio=reemplazar($result->fields[24]);
$dsfechaenvio=reemplazar($result->fields[25]);
$dshoraenvio=reemplazar($result->fields[26]);
$dstipodirenvio=reemplazar($result->fields[27]);
$idconsec=reemplazar($result->fields[28]);
$preciocompra=reemplazar($result->fields[29]);
$dstalla=reemplazar($result->fields[30]);
$dscolor=reemplazar($result->fields[31]);
$idtipo=$result->fields[32];
$dsunidad=$result->fields[33];
$dsunidadesdispo=$result->fields[34];
$idprod=($resultx->fields[19]);
$dsruta=$result->fields[36];
$dsrutax=$rutalocal."/producto/".$dsruta;
$idnat=$result->fields[37];
$dscolorx=seldato('dsd','id','ecommerce_tblcolores',$result->fields[42],1);
$dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idproducto." and idactivo=1",1);
//$idproducto=$result->fields[34];
// fin datos de envio
                  $idcant=($result->fields[1]);
                  $idprecio2=$idprecio-$idprecio*($dspordescuento/100); // valor descuento
                  if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento

//                   $xsubtotal=$xsubtotal+($idprecio*$idcant);


                    $preciomostrar=$idprecio;
                    if ($idprecio2<$idprecio && $idprecio2>0) $preciomostrar=$idprecio2;
                   $preciobase=$preciomostrar;
                    if ($preciocompra>0) $preciobase=$preciocompra;

                    // contructor de manejo de precios

                   	$ivax=($result->fields[11]);
					$precio1m=$precio1/(1-($ivax/100));
            		$preciodescuentom=$preciodescuento/(1-($ivax/100));
            		if($pordescuentom<>0)$pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;



                    if ($precio2>0) $xfletes=$xfletes+$precio2;

                      $valorseguro=0;
                     if ($idnat<>1) {
                    $valorseguro=($preciobase)-($valorbasesinseguro);
                    $valorseguro=($valorseguro)*$porvalorseguro*$idcant;
					if ($idtipo==2) $valorseguro=0;

                    if ($valorseguro>0) $xvalorseguro=$xvalorseguro+$valorseguro;

                     }

					$read="";
					if ($dspara<>"") $read="readonly";

					$ivax=($result->fields[11]);
					$precio1m=$precio1/(1-($ivax/100));
            		$preciodescuentom=$preciodescuento/(1-($ivax/100));
            		if($pordescuentom<>0)	$pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;
             // recalcular los valores para los tres productos especificos
            		$idprecioiva=$idprecio-($idprecio*($dspordescuento/100)*$idcant);
              		$xiva=$xiva+($idprecioiva*($dsporiva/100)*$idcant);
                       $xdescuento=$xdescuento+($idprecio*($dspordescuento/100)*$idcant);
                    if ($preciodescuento>0) $xdescuento=$xdescuento+(($idprecio-$preciodescuento)*$idcant);// valor descuento
                       $xsubtotal=$xsubtotal+($idprecio*$idcant);



            // fin recalcular los valores para los tres productos especificos

			?>
			<tr>
				<td class="campo">
				<?if($dsimg1<>""){?>
				<a href="<? echo $rutbase?>/ecommerce.productos.detalle.php?idproducto=<? echo $idproducto  ?>">
					<img src="<? echo $rutaImagen.$dsimg1?>" alt="">
				</a>
			<?}else{?>
     		 <a href="<? echo $rutbase?>/ecommerce.productos.detalle.php?idproducto=<? echo $idproducto  ?>"><img src="<?echo  $rutbase?>/images/img_sin.png" alt=""></a>
     	 	<?}?>
				</td>
				<td>
					<article class="cont_producto">
						<h3><? echo $dsm?></h3>
						<h4>REF: 001</h4>
						<?if($dstalla<>""){?>
						<ul class="cont_tallas">
							<h3>TALLA:</h3>
							<li><p><?echo $dstalla?></p></li>

						</ul>
						<?}?>
						<? if ($dscolor<>"" && $dscolorx) {?>
						<ul class="cont_colores">
							<h3>COLOR:</h3>
							<span title="<? echo $dscolor?>" style="background:<? echo $dscolorx?>;"></span>
						</ul>
						<? } ?>
						<input input type="hidden" name="nombreprod[]" value="<? echo $dsm;?>">
						<input type="hidden" name="idproducto[]" value="<? echo $idproducto; ?>">
						<!--p class="p1"><? echo $dsmarca?></p-->
					<?if ($idtipo==2) echo "<p class='p_oferta'>Oferta Válida para Medellín y la Área Metropolitana</p>";?>
					<? if ($dsentrega<>"") { ?>
						<p class="p2" style="display:none;">Tiempo de Entrega: <span><? echo $dsentrega?></span></p>
					<? } ?>
			        <? if ($dscondiciones<>"") { ?>
									<!--p class="p3" style="display:none;"><strong>Condiciones:</strong><? echo $dscondiciones?></p-->
					<? } ?>
					<? if ($dspara<>"") {?>
						<article class="para"  id="mensajes_<? echo $idproducto ?>">
							<p class="p4"><strong>Para:</strong> <? echo $dspara?></p>
							<p class="p4"><strong>Tel&eacute;fono:</strong> <? echo $dstelefonoenvio?></p>
							<p class="p4"><strong>Zona / Sector / Ciudad:</strong> <? echo seldato("dsciudad","id","tblfletes",$dszonaenvio,1)?></p>
							<p class="p4"><strong>Direcci&oacute;n:</strong> <? echo $dstipodirenvio." ".$dsdireccionenvio?></p>
							<p class="p4"><strong>Observaciones:</strong> <? echo $dsobsenvio?></p>
							<p class="p4"><strong>Mensaje:</strong> <? echo $dsmensajeenvio?></p>
							<p class="p4"><strong>Fecha de Envio:</strong> <? echo $dsfechaenvio?></p>
							<p class="p4"><strong>Hora de Envio:</strong> <? echo $dshoraenvio?></p>
							<br>
							<a href="ecommerce.productos.detalle.mensaje.php?idproducto=<? echo $idproducto?>&idconsec=<? echo $idconsec?>" class="" title="Click si desea modificar los datos de envio">Modificar</a>
						</article>
					<? } ?>

					</article>
				</td>
				<td>X <? echo $dsunidad  ?></td>
				<td><? echo $dsunidadesdispo ?></td>
				<input type="hidden" name="unidadispo[]" value="<? echo $dsunidadesdispo ?>">
				<td>
					<article class="precio">
						<p class="p1">
							$ <? echo $idprecio ?>
						</p>
					</article>
				</td>
				<td>
					<input type="text" name="cantidad[]" value="<? echo $idcant?>" size=2 maxlength=4 <? echo $read?>>
					<input type=hidden name="idx[]" value="<? echo $idx?>">
					<input type="hidden" name="idpro[]" value=<? echo $idproducto ?>>
					<input type="hidden" name="unidaddisponible[]" value=<? echo $dsunidadesdispo ?>>
				</td>
				<td>
					<article class="subtotal">
						<p class="p1">
							$ <? echo number_format($idprecio*$idcant,0) ?>
						</p>
					</article>
				</td>
				<td class="campo">
					<a href="eliminar.php?idx=<? echo $idx?>&cant=<? echo $idcant ?>&cantd=<? echo $dsunidadesdispo ?>&idprod=<? echo $idproducto ?>">
						<img src="images/eliminar.png">
					</a>
				</td>
			</tr>
			<?
 $result->MoveNext();
}
$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalorseguro;

if($_SESSION['i_dsdescuento']){
$dsdescuento_codigo=($xsubtotal*($_SESSION['i_dsdescuento']/100));
$xsubtotal=$xsubtotal-$dsdescuento_codigo;
$xiva=($xsubtotal*($dsporiva/100));
$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalorseguro;
}
			?>

		</tbody>
	</table>

	<nav class="cont_carrito_btns_derecha">
		<? if ($xtotal>0) {?>
			<input type="button" value="CAMBIAR CANTIDADES" class="btn_zona btn_cambiar" onclick="validar_cantidad();carrito_modificar('forma_carrito')">
			<input type="hidden" name="clientex" value="1">
		<? } ?>
	</nav>


<article class="cont_carrito_derecha">

	<table width="100%" border="0" border-collapse="0" border-spacing="0" cellspacing="0" class="cont_carrito_valores">

		<tr>
			<td style="width:40%;">
				<?if($_SESSION['i_dscodigo']=="" && $_SESSION['i_dsdescuento']==""){?>
				<article class="codigo_carrito" id="codigo_carrito">
						<h3>CÓDIGO PROMOCIONAL</h3>
				     <form action="/<? echo $rutbase?>/ecommerce.buscador.php" method=post name="ecoomerce_frm_buscador">
						<input type="text" name="dscodigo_promo" id="dscodigo_promo" placeholder="Código">
						<input type="button" onclick="validar_codigo_promo()" value="Ingresar" class="btn_codigo">
					</form>
				</article>
				<?}else{?>
				<article class="codigo_carrito" id="codigo_valido">
					<? $rutaImagen_p=$rutaFuenteImagenes."/contenidos/images/ecommerce_patrocinadores/";
					if(is_file($rutaImagen_p.$_SESSION['i_img'])){
					?>
					<h3>PATROCINADOR <?ECHO $_SESSION['i_dsproveedor']?></h3>
					<h4>DESCUENTO  <?ECHO $_SESSION['i_dsdescuento']?>%</h4>
					<img src="<?echo $rutaImagen_p.$_SESSION['i_img']?>">
				</article>

				<?
				}
				}
				?>
			</td>

			<td>
				<table width="100%" border="0">
					<tr>
						<td><p class="txt"><strong>Subtotal</strong></p></td>
						<td><p class="precio"><strong>$ <? echo number_format($xsubtotal,0)?></strong></p></td>
					</tr>
					<? if ($xdescuento>0){ ?>
					
					<tr>
						<td ><p class="txt">Descuento</p></td>
						<td ><p class="precio">$ <? echo number_format($xdescuento,0)?></p></td>
					</tr>
					<? } ?>

					<? if ($xfletes>0){ ?>
					<tr>
						<td ><p class="txt">Manejo de logistica</p></td>
						<td ><p class="precio">$ <? echo number_format($xfletes+$xvalorseguro,0)?></p></td>
					</tr>
					<? } ?>

					<? if ($_SESSION['i_dsdescuento']<>""){ ?>
					<tr>
						<td ><p class="txt">Codigo Promocional</p></td>
						<td ><p class="precio">$ <? echo number_format($dsdescuento_codigo,0)?></p></td>
					</tr>
					<? } ?>

					<? if ($xiva>0){ ?>
					<tr>
						<td ><p class="txt">Impuestos</p></td>
						<td ><p class="precio">$ <? echo number_format($xiva,0)?></p></td>
					</tr>
					<? } ?>

					<tr>
						<td class="total"><p class="txt">Total</p></td>
						<td class="total"><p class="precio">$ <? echo number_format($xtotal,0)?></p></td>
					</tr>

				</table>
			</td>


			
		</tr>
		

		

		


		

	</table>

</article>


	<nav class="cont_carrito_btns_derecha">
		<? if ($xtotal>0) {?>
			<input type="button" value="FINALIZAR COMPRA" class="btn_finalizar" onclick="validar_distribuidorx()">
		<? } ?>
	</nav>


		 <? $sqlm="select dsvalorminimo from tblempresa where id>0";
                $resultx=$db->Execute($sqlm);
                if(!$resultx->EOF){
                $valorminimo=$resultx->fields[0];
                }
                $resultx->Close();
		 ?>

	<td><input type='hidden' name='totalvalor' class='forma2' value='<? echo ($xtotal)?>' ></td>
	<input type="hidden" name="preciomcliente" value="<? echo $valorminimo ?>">
	</form>
<?
} else {
	?>

	<article class="no_producto">
		<img src="<?echo $rutbase?>/images/no_compra.png">
		<h3>NO HAY PRODUCTOS ASOCIADOS EN ESTOS MOMENTOS</h3>
		<nav>
			<a href="ecommerce.categoria.php" class="btn_zona"><p>Por favor agregue uno</p></a>
		</nav>
	</article>
	<?
}
  $result->Close();
 ?>

</section>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	function validar_distribuidorx() {

		//alert("entra");
				var total=document.forma_carrito.totalvalor.value
				var compara=document.forma_carrito.preciomcliente.value;
				//alert(total);

			//alert(compara);
	if(parseInt(document.forma_carrito.totalvalor.value)<=parseInt(document.forma_carrito.preciomcliente.value)) {
					/*alertify.log("Su compra minima debe ser de "+compara+"");
					return false;*/

			alert("Su compra mánima  debe ser de $"+compara+" , lo invitamos a seguir añadiendo productos a su carritoo de compras", function () {
						//aqui introducimos lo que haremos tras cerrar la alerta.
						//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
					//alert("entra");
					});
			return;
	}
	document.forma_carrito.submit();
	}
//un alert
</SCRIPT>


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">//SCRIPT PARA VALIDAR LA CNTIDAD SELECCIONADA Y LA UNIDAD DISPONIBLE
function validar_cantidad() {
	/*for (i=0;i<4;i++){
alert(document.forma_carrito.elements['cantidad[]'][i].value);
}
*/
		for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){

				if(parseInt(document.forma_carrito.elements['cantidad[]'][i].value)>=parseInt(document.forma_carrito.elements['unidadispo[]'][i].value)) {
				var nombreproduc = document.forma_carrito.elements['nombreprod[]'][i].value
				alertify.alert("<b>La cantidad del producto "+ nombreproduc +" debe ser menor a las unidades disponibles.</b><br>", function () {
					});
					return;
				}
				//document.forma_carrito.submit();
		}
			forma_carrito.action="modificar.php";
			forma_carrito.submit();
		}
//un alert
</SCRIPT>
