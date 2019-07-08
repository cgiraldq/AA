<?/*
 $rutaImagen=$rutaFuenteImagenes."/contenidos/images/producto/";

              $sql="select a.idproducto,a.idcant,a.idprecio,a.dstotal,b.dsimgcarrito,b.dsm,b.precio1,precio2";
              $sql.=",b.dsmarca,b.dsreferencia,a.dspordescuento,a.dsporiva,a.id,a.dsvalorenvio ";
              $sql.=",b.dsentrega,b.dscondiciones ";
              $sql.=",b.preciodescuento,b.peso ";

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
                $sql.=" ,dstalla";
                $sql.=" ,dscolor";
                $sql.=" ,b.idtipo";


              $sql.=" from tblcompras a, tblproductos b where a.idproducto=b.id ";
              if ($idpedido=="") {
                $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
                $sql.=" and idip='".$_SESSION['ipremota']."' and a.idtienda=$idtienda  ";
              } else {
                $sql.=" and a.idpedido='".$idpedido."' ";
              }

*/?>

			<article class="cont_carrito">

			<?/*
                  $result=$db->Execute($sql);
                  if(!$result->EOF){

          $xsubtotal=0;
          $xdescuento=0;
          $xiva=0;
          $xpeso=0;
          $textoservicio=0;
            while(!$result->EOF){

                  $idproducto=reemplazar($result->fields[0]);
                  $dsm=reemplazar($result->fields[5]);
                  $dsimg1=($result->fields[4]);
                  $idprecio=($result->fields[2]); // valor venta
                  $precio1=($result->fields[6]); // valor venta
                  $precio2=($result->fields[7]); // valor venta

                  $dsmarca=($result->fields[8]);
                  $dsreferencia=($result->fields[9]);
                  $dspordescuento=($result->fields[10]);
                  $dsporiva=($result->fields[11]);
                  $idx=($result->fields[12]);
                  $dsvalorenvio=($result->fields[13]);
                  $dsentrega=reemplazar($result->fields[14]);
                  $dscondiciones=reemplazar($result->fields[15]);
                  $preciodescuento=($result->fields[16]);

                  $xfletes=$xfletes+$dsvalorenvio;
                  $peso=($result->fields[17]);

// datos de envio
$dsdireccionenvio=reemplazar($result->fields[18]);
$dspara=reemplazar($result->fields[19]);
$dsciudadenvio=reemplazar($result->fields[20]);
$dstelefonoenvio=reemplazar($result->fields[22]);
$dsmensajeenvio=reemplazar($result->fields[23]);
$dsobsenvio=reemplazar($result->fields[24]);
$dszonaenvio=reemplazar($result->fields[25]);
$dstipoenvio=reemplazar($result->fields[26]);
$dsfechaenvio=reemplazar($result->fields[27]);
$dshoraenvio=reemplazar($result->fields[28]);
$dstipodirenvio=reemplazar($result->fields[29]);
$idconsec=reemplazar($result->fields[30]);
// fin datos de envio
$dstalla=reemplazar($result->fields[31]);
$dscolor=reemplazar($result->fields[32]);
$idtipo=reemplazar($result->fields[33]);
if ($idtipo==2) $textoservicio=1;


                  $idcant=($result->fields[1]);
                  $idprecio2=$idprecio-$idprecio*($dspordescuento/100); // valor descuento
                  if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento

                   $xsubtotal=$xsubtotal+($idprecio*$idcant);

                    $xdescuento=$xdescuento+($idprecio*($dspordescuento/100)*$idcant);
                    if ($preciodescuento>0) $xdescuento=$xdescuento+(($idprecio-$preciodescuento)*$idcant);// valor descuento

                    $preciomostrar=$idprecio;
                    if ($idprecio2<$idprecio) $preciomostrar=$idprecio2;
                    $xiva=$xiva+($preciomostrar*($dsporiva/100)*$idcant);
                    $xpeso=$xpeso+$peso;


                   	$ivax=($result->fields[11]);
					$precio1m=$precio1/(1-($ivax/100));
            		$preciodescuentom=$preciodescuento/(1-($ivax/100));
            		$pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;



			 */?>

			<ul class="cont_izq">
					<li>
						<a href="productos.detalle.php?idproducto=<? echo $idproducto  ?>">
							<img src="images/1.jpg">
							<!--img src="<?echo $rutaImagen.$dsimg1?>" alt=""-->
						</a>
					</li>
				</ul>

				<ul>

			      <li>
							<h3><? echo $dsm?>CAMARA</h3>
	          </li>

	          <li>
	            <article class="precio">
	  						<p class="p1"><? echo $dsmarca?></p>
	  						<?if ($idtipo==2) echo "<p class='p_oferta'>Oferta Válida para Medellín y la Área Metropolitana</p>";?>
	  						<? if ($dsentrega<>"") { ?>
	  						<p class="p2" style="display:none;">Tiempo de Entrega: <span><? echo $dsentrega?></span></p>
	  						<? } ?>
	              <? if ($dscondiciones<>"") { ?>

	      						<p class="p3" style="display:none;"><strong>Condiciones:</strong><? echo $dscondiciones?></p>
	          		<? } ?>
	          		<? if ($dspara<>"") {?>
	            </article>
	          </li>
							<article class="para" id="mensajes_<? echo $idproducto ?>">
								<p class="p4"><strong>Para:</strong> <? echo $dspara?></p>
								<p class="p4"><strong>Tel&eacute;fono:</strong> <? echo $dstelefonoenvio?></p>
								<p class="p4"><strong>Zona / Sector / Ciudad:</strong> <? echo seldato("dsciudad","id","tblfletes",$dszonaenvio,1)?></p>
								<p class="p4"><strong>Direcci&oacute;n:</strong> <? echo $dstipodirenvio." ".$dsdireccionenvio?></p>
								<p class="p4"><strong>Observaciones:</strong> <? echo $dsobsenvio?></p>
								<p class="p4"><strong>Mensaje:</strong> <? echo $dsmensajeenvio?></p>
								<p class="p4"><strong>Fecha de Envio:</strong> <? echo $dsfechaenvio?></p>
								<p class="p4"><strong>Hora de Envio:</strong> <? echo $dshoraenvio?></p>
							</article>
			<? } ?>
			<? if ($dstalla<>"" || $dscolor<>"") {?>

							<article class="para"  id="tmensajes_<? echo $idproducto ?>">
								<p class="p4"><strong>Talla:</strong> <? echo $dstalla?></p>
								<p class="p4"><strong>Color:</strong> <? echo $dscolor?></p>

							</article>
			<? } ?>


	        <li><p><? echo $dsunidad ?></p></li>
	        <li><p><? echo $dsunidadesdispo ?></p></li>

	          <article class="cantidad">
	            <? echo $idcant?>
	            <input type=hidden name="idx[]" value="<? echo $idx?>">
	          </article>


	          <article class="precio">

	            <p class="p1">
	              $ <? echo number_format($idprecio,0) ?>
	            </p>

	          <article class="subtotal">
	            <p class="p1">
	              $ <? echo number_format($idprecio*$idcant,0) ?>
	            </p>
	          </article>

	        </ul>


			</article>

		</article>

<?/*

 $result->MoveNext();
}
$xvalorseguro=(($xsubtotal-$xdescuento)-$valorbasesinseguro)*$porvalorseguro;
if ($xvalorseguro<=0) $xvalorseguro=0;
$xvalormanejo=$valormanejo;
//echo $xpeso;
//exit();
if ($xpeso<=0) $xvalormanejo=0;
if ($xpeso<=0) $xvalorseguro=0;
if ($xpeso<=0) $xfletes=0;


$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalorseguro+$xvalormanejo;

}
$result->Close();
$sql="select dssubtotal,dsiva,dsflete,dsdescuento,dsvalorseguro,dsmanejo,dsvalorasistido,dstotal";
$sql.=",dsformadepago,dsciudadflete,dstransad,id from tblpagos ";
$sql.=" where idpedido=".$idpedido."";
  $result=$db->Execute($sql);
  if(!$result->EOF){
  $xtotal=$result->fields[7];
  $xsubtotal=$result->fields[0];
  $xdescuento=$result->fields[3];
  $xiva=$result->fields[1];
  $xfletes=$result->fields[2];
  $xvalorseguro=$result->fields[4];
  $xvalormanejo=$result->fields[5];
  $xvalorasistido=$result->fields[6];
  $formapago=$result->fields[8];
  $dsciudadflete=$result->fields[9];
  $dstransad=$result->fields[10];
  $idpagos=$result->fields[11];


  }
  $result->Close();

*/?>


  <?
$sql="select dsm,dsd2 ";
$sql.="from tblformasdepagos where dsm='$formapago'";

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
  $dsm=reemplazar($resultx->fields[0]);
  $dsd=reemplazar($resultx->fields[1]);
  $dsd=preg_replace("/\n/","<br>",$dsd);
  $dsd=preg_replace("/-VALOR-/","".number_format($xtotal,0),$dsd);
  $dsd=preg_replace("/-PEDIDO-/",$idpedido,$dsd);



  ?>

  <span class="txt1">Sobre la forma de pago  <? echo $dsm?></span><br>
  <p><? echo $dsd?></p>
  <?
}
$resultx->Close();

  ?>

<?
$sql="select dsm,dsd ";
$sql.="from tblcondicionesdepago where idactivo=1 order by dsm asc";

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
?>
					<h3>T&eacute;rminos y Condiciones</h3>

<?
  while(!$resultx->EOF){

  $dsm=reemplazar($resultx->fields[0]);
  $dsd=reemplazar($resultx->fields[1]);



  ?>
  <span class="txt1"><? echo $dsm?></span><br>
  <p><? echo $dsd?></p>
  <?
                      $resultx->MoveNext();
                    }


}
$resultx->Close();
if ($textoservicio==1) {
	?>
	<br>
		UTILICE EL SIGUIENTE CODIGO DE REFERENCIA PARA REDIMIR LA PROMOCION ADQUIRIDA:
	<p class="cod_referencia"><? echo $idpedido."".$idpagos;?></P>
	<?
}
  ?>

		<table width="100%" border-collapse="0" border-spacing="0">
			<tr>
				<td colspan="4"><p ><strong>Subtotal</strong></p></td>
				<td colspan="2"><p ><strong>$ <? echo number_format($xsubtotal,0)?></strong></p></td>
			</tr>

<? if ($xdescuento>0){ ?>
			<tr>
				<td colspan="4"><p >Descuento</p></td>
				<td colspan="4"><p >$ <? echo number_format($xdescuento,0)?></p></td>
			</tr>
<? } ?>
<? if ($xiva>0){ ?>
			<tr>
				<td colspan="4"><p >Impuestos</p></td>
				<td colspan="4"><p >$ <? echo number_format($xiva,0)?></p></td>
			</tr>
<? } ?>

            <? if ($xfletes>0) {?>

			<tr>
				<td colspan="4"><p >Transporte a punto de venta productos</p></td>
				<td colspan="4"><p >$ <? echo number_format($xfletes,0)?></p></td>
			</tr>


			<!--tr>
				<td colspan="2"><p "">Valor Seguro productos</p></td>
				<td colspan="2" ><p ""><strong>
        <?
            if ($xvalorseguro<=0) {
            ?>
            <strong>INCLUIDO</strong>
            <?
            } else {
            ?><span class=""><strong>$ <? echo number_format($xvalorseguro,0)?></strong></span>
            <?
            }
            ?>


				</strong></p></td>
			</tr-->
			<? } ?>


            <? if ($xvalormanejo>0) {?>

			<!--tr>
				<td colspan="2"><p >Valor Manejo productos</p></td>
				<td colspan="2" ><p ><strong>$ <? echo number_format($xvalormanejo,0)?></strong></p></td>
			</tr-->
            <? } ?>


            <? if ($dstransad<>"" && $dstransad<>"0") {?>

			<tr>
				<td colspan="4"><p >Transporte a lugar de entrega productos</p></td>
				<td colspan="4" ><p ><? echo number_format($dstransad,0)?></p></td>
			</tr>
            <? } ?>


            <? if ($dsciudadflete<>"" && $dsciudadflete<>"0") {?>

			<tr>
				<td colspan="4"><p >Lugar de Entrega de productos</p></td>
				<td colspan="4" ><p ><? echo $dsciudadflete?></p></td>
			</tr>
            <? } ?>

			<? if ($xvalorasistido>0) {?>

			<!--tr>
				<td colspan="2"><p >Valor asistido</p></td>
				<td colspan="2" ><p >$ <? echo number_format($xvalorasistido,0)?></p></td>
			</tr-->
            <? } ?>


			<tr>
				<td colspan="4"><p >Forma de Pago</p></td>
				<td colspan="4" ><p ><? echo $formapago?></p></td>
			</tr>

			<tr>
				<td colspan="4"><p >Total</p></td>
				<td colspan="4"><p >$ <? echo number_format($xtotal,0)?></p></td>
			</tr>

			<tr>
				<td colspan="4"><p >Pedido N&uacute;mero</p></td>
				<td colspan="4"><p><? echo $idpedido?></p></td>
			</tr>

			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>

	</table>
