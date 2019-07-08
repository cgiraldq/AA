<?
 include($rut."adicionar.distribuidor.php");
/*Validacion cambiar valores*/
/*fin validacion*/
 $rutaImagen=$rutaFuenteImagenes."/contenidos/images/productos/";
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



              $sql.=" from tbltemporalcompras a, tblproductos b where a.idproducto=b.id ";
              $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
              $sql.=" and idip='".$_SESSION['ipremota']."'";
              $sql.=" and b.idactivo not in (2,9) and a.idtienda=$idtienda ";


                  //echo $sql;

?>
<section class="cont_carrito">
	<h1>SU CARRITO DE COMPRAS</h1>

<?
                $result=$db->Execute($sql);
                  if(!$result->EOF){

?>
	<form action="inicio.sesion.php" method="POST" name="forma_carrito">
	<table  class="tbl_productos" border=0 border-collapse="0" border-spacing="0" cellspacing="0"  cellpadding="0">
		<thead>
			<tr class="carrito_distribuidor">
				<th colspan="2">Producto</th>
				<th>Unidades</th>
				<th>Unidades Disponibles</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th colspan="3">Subtotal</th>
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
// $db->debug=true;
$dsimg1=seldato('dsimg','iddestino','tblproductoximg',$idx." and idactivo=1",1);
//$idproducto=$result->fields[34];
// fin datos de envio
// $db->debug=false;
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
				<td>
				<a href="<? echo $dsrutax ?>">
				<?if(is_file($rutaImagen.$dsimg1)){?>
					<img src="<?echo $rutaImagen.$dsimg1?>" alt="" class="img_producto">
					<?}else{?>
					<img src="<?echo  $rutbase?>images/img_sin.png" alt="" class="img_producto">
					<?}?>
				</a>
				</td>
				<td>
					<article class="cont_producto">
						<h3><? echo $dsm?></h3>
						<input type="hidden" name="nombreprod[]" value="<? echo $dsm; ?>">
												<input type="hidden" name="idproducto[]" value="<? echo $idproducto; ?>">
						<!--p class="p1"><? echo $dsmarca?></p-->

						<?if ($idtipo==2) echo "<p class='p_oferta'>Oferta Válida para Medellín y la Área Metropolitana</p>";?>
						<? if ($dsentrega<>"") { ?>

						<p class="p2" style="display:none;">Tiempo de Entrega: <span><? echo $dsentrega?></span></p>
						<? } ?>
        <? if ($dscondiciones<>"") { ?>

						<p class="p3" style="display:none;"><strong>Condiciones:</strong><? echo $dscondiciones?></p>
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
							<a href="productos.detalle.mensaje.php?idproducto=<? echo $idproducto?>&idconsec=<? echo $idconsec?>" class="" title="Click si desea modificar los datos de envio">Modificar</a>

						</article>
		<? } ?>

					<? if ($dstalla<>"" || $dscolor<>"") {?>
						<article class="para"  id="tmensajes_<? echo $idproducto ?>">
							<p class="p4"><strong>Talla:</strong> <? echo $dstalla?></p>
							<p class="p4"><strong>Color:</strong> <? echo $dscolor?></p>
							<br>
							<a href="productos.detalle.php?idproducto=<? echo $idproducto?>&idconsec=<? echo $idconsec?>" title="Click si desea modificar los datos de envio">Modificar</a>

						</article>
		<? } ?>


					</article>
				</td>
				<th><? echo  $dsunidad ?></th>
				<td><? echo $dsunidadesdispo?></td>
				<input type="hidden" name="unidadispo[]" value="<? echo $unidadesdispo ?>">
				<td>
					<article class="precio">
					<? if ($idproducto==416 || $idproducto==414 || $idproducto==415) {?>

						<p class="p1">
							$ <? echo number_format($preciodescuentom,0) ?>
						</p>
						<? if ($idprecio2<$idprecio) {?>
						<p class="p2">
							$ <? echo number_format($precio1m,0)?>
						</p>
						<? } ?>
		<? } else {?>
						<p class="p1">
							$ <? echo number_format($idprecio,0) ?>
						</p>


		<? } ?>
					</article>
				</td>
				<td>
					<article class="cantidad">
						<input type="text" name="cantidad[]" value="<? echo $idcant?>" id="idcantidadf" size=2 maxlength=4 <? echo $read?>>
							<input type=hidden name="idx[]" value="<? echo $idx?>">
							<input type="hidden" name="idpro[]" value=<? echo $idproducto ?>>
							<input type="hidden" name="unidaddisponible[]" value=<? echo $unidadesdispo ?>>







					</article>
				</td>
				<td>
					<article class="subtotal">
	<? if ($idproducto==416 || $idproducto==414 || $idproducto==415) {?>

						<p class="p1">
							$ <? echo number_format($preciodescuentom*$idcant,0) ?>
						</p>
						<p class="p2">
							<? echo $idcant?> x $ <? echo number_format($preciodescuentom,0) ?>
						</p>
	<? } else {?>
						<p class="p1">
							$ <? echo number_format($idprecio*$idcant,0) ?>
						</p>

	<? }?>
					</article>
				</td>
			<? $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);?>
				<td>
					<a href="eliminar.php?idx=<? echo $idx?>&tipocliente=<? echo $tipocliente ?>&cant=<? echo $idcant ?>&cantd=<? echo $unidadesdispo ?>&idprod=<? echo $idproducto ?>">
					<article class="eliminar" title="Eliminar este item de la compra"></article>
					</a>
				</td>
			</tr>
			<?
 $result->MoveNext();
}
$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalorseguro;
//echo $xsubtotal."-".$xdescuento."+".$xiva."+".$xfletes."+".$xvalorseguro;
			?>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th colspan="6">&nbsp;</th>
				<th colspan="2">
				<? if ($xtotal>0) {?>
					<input type="button" value="Cambiar Cantidades" class="btn_general" onclick="validar_cantidad();carrito_modificar('forma_carrito')">
					<input type="hidden" value="<? echo $tipocliente ?>" name="tipocliente">
				<? } ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<!--td rowspan="5"></td-->
				<!--td rowspan="5" colspan="2" align_=center>
						<img src="../contenidos/images/banner/banner_tiempos_entrega.jpg" alt="">
<article class="txt_tbl">
</article>
				</td-->
				<td colspan="4"><p class="p_title"><strong>Subtotal</strong></p></td>
				<td colspan="4"><p class="p_precio"><strong>$ <? echo number_format($xsubtotal,0)?></strong></p></td>
			</tr>
<? if ($xdescuento>0){ ?>
			<tr>
				<td colspan="4"><p class="p_title">Descuento</p></td>
				<td colspan="4"><p class="p_precio">$ <? echo number_format($xdescuento,0)?></p></td>
			</tr>
<? } ?>
<? if ($xfletes>0){ ?>
			<tr>
				<td colspan="4"><p class="p_title">Manejo de logistica</p></td>
				<td colspan="4"><p class="p_precio">$ <? echo number_format($xfletes+$xvalorseguro,0)?></p></td>
			</tr>
<? } ?>
<? if ($xiva>0){ ?>
			<tr>
				<td colspan="4"><p class="p_title">Impuestos</p></td>
				<td colspan="4"><p class="p_precio">$ <? echo number_format($xiva,0)?></p></td>
			</tr>
<? } ?>
			<tr>
				<td colspan="4"><p class="p_title p_total">Total</p></td>
				<td colspan="4"><p class="p_precio p_total">$ <? echo number_format($xtotal)?></p></td>
				<td><input type='hidden' name='totalvalor' class='forma2' value='<? echo ($xtotal)?>' ></td>
				<? $preciomindistrib=seldato("dspreciomindistrib","id"," tblclientes",$_SESSION['i_idcliente'],1);// ?><!--VALOR MINIMO DE COMPRA DISTRIBUIDOR-->
				<td><input type='hidden' name='preciomindistrib' class='forma2' value='<? echo $preciomindistrib;?>' id='preciomindistrib'></td>
			</tr>
		</tfoot>
</table>
<table width="990px"  class="tbl_productos" border=0 border-collapse="0" border-spacing="0">
	<tfoot>
		<tr>
				<td aling=center class="btns">


					<input type="button" value="Seguir Comprando" class="btn_general" onClick="irAPaginaD('marcas.php')">

					<? if ($xtotal>0) {?>
					<input type="button" value="Finalizar Compra" class="btn_general fin_compra" onclick="validar_distribuidor()">
			<? } ?>
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
<?
} else {
	?>
	<h3>NO HAY PRODUCTOS ASOCIADOS EN ESTOS MOMENTOS. Por favor agregue uno.</h3>
	<?
}
  $result->Close();
 ?>
</section>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	function validar_distribuidor() {


				var compara=document.forma_carrito.preciomindistrib.value;
	if(eval(document.forma_carrito.totalvalor.value)<=eval(document.forma_carrito.preciomindistrib.value)) {
					/*alertify.log("Su compra minima debe ser de "+compara+"");
					return false;*/
			alertify.alert("<b>Su compra mínima  debe ser de : $"+compara+"  </b><br>", function () {
						//aqui introducimos lo que haremos tras cerrar la alerta.
						//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
					});
			return;
	}
	document.forma_carrito.submit();
	}
//un alert
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">//SCRIPT PARA VALIDAR LA CNTIDAD SELECCIONADA Y LA UNIDAD DISPONIBLE
function validar_cantidad() {
		for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
						//var unidadesdispo= document.getElementById(["unidaddispo"][i]).value;
						//var unidadesdispo=document.forma_carrito.elements['unidaddispo[]'][i].value;
					//alert(total);
				//alert(document.forma_carrito.elements['cantidad[]'][i].value);
				//alert(document.forma_carrito.elements['unidadispo[]'][i].value);
				if(parseInt(document.forma_carrito.elements['cantidad[]'][i].value)>parseInt(document.forma_carrito.elements['unidadispo[]'][i].value)) {
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
				//document.forma_carrito.submit();
		}

			forma_carrito.action="modificar.php";

			forma_carrito.submit();

}

//un alert
</SCRIPT>