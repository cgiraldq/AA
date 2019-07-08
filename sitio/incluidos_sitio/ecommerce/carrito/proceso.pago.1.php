<section class="cont_carrito">
	<h1>Proceso de Pago - Paso 1</h1>

<? if ($mensaje<>"") {?>
       <article class="texto_transaccion">
      <? echo $mensaje;?>
        </article>

<? } ?>
<?
              $rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
              $sql="select a.idproducto,a.idcant,a.idprecio,a.dstotal,b.dsimgcarrito,b.dsm,b.precio1,precio2";
              $sql.=",b.dsmarca,b.dsreferencia,a.dspordescuento,a.dsporiva,a.id,b.dsflete ";
              $sql.=",b.dsentrega,b.dscondiciones ";
              $sql.=",b.preciodescuento,b.peso ";
                $sql.=" ,dsdireccionenvio";
                $sql.=" ,dspara";
                $sql.=" ,dsciudadenvio";//20
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
                $sql.=" ,dsvalorflete";
                $sql.=" ,b.preciocompra";
                $sql.=" ,b.idnat";
                $sql.=" ,a.dstalla";
                $sql.=" ,a.dscolor";
                $sql.=" ,b.idtipo";
                $sql.=" ,b.dsunidadesdispo";
                $sql.=" ,b.dsunidad";
                $sql.=" ,b.dsruta";
                $sql.=" ,a.idcolor";//40

              $sql.=" from ecommerce_tbltemporalcompras a, ecommerce_tblproductos b where a.idproducto=b.id ";
              $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
              $sql.=" and idip='".$_SESSION['ipremota']."'";
              $sql.=" and b.idactivo not in (2,9) and a.idtienda=$idtienda ";
?>

	<form action="proceso.pago.2.php" method="POST" name="forma_carrito">

<?
                $result=$db->Execute($sql);
                  if(!$result->EOF){

?>
	<table width="100%"  class="tbl_productos" border-collapse="0" border-spacing="0" border=0 >
		<thead>
			<tr class="cbz_carrito">
        <td colspan="2">Producto / Servicio</td>
        <td class="campo">Unidades</td>
        <td>Unidades Disponibles</td>
        <td class="campo">Cantidad</td>
        <td class="campo">Precio</td>
        <td class="campo">Subtotal</td>
        <td colspan="2"></td>
			</tr>
		</thead>
		<tbody>
			<?
          $xsubtotal=0;
          $xdescuento=0;
          $xiva=0;
          $xpeso=0;
          $xfletes=0;
          $xvalorseguro=0;
          $xvalormanejo=0;
          $acceso="GENERAL";
          $textoservicio=0;

            while(!$result->EOF){

              $idproducto=reemplazar($result->fields[0]);
                  $dsm=reemplazar($result->fields[5]);
                  $dsimg1=($result->fields[4]);
                  $idprecio=($result->fields[2]); // valor venta
                  $precio1=($result->fields[6]);

                  $dsmarca=($result->fields[8]);
                  $dsreferencia=($result->fields[9]);
                  $dspordescuento=($result->fields[10]);
                  $dsporiva=($result->fields[11]);
                  $idx=($result->fields[12]);
                  $dsvalorenvio=($result->fields[13]);
                  //$xfletes=$xfletes+$dsvalorenvio;
                  $dsentrega=reemplazar($result->fields[14]);
                  $dscondiciones=reemplazar($result->fields[15]);
                  $preciodescuento=($result->fields[16]);
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
if ($dshoraenvio=="Local") $acceso="LOCAL";
$dstipodirenvio=reemplazar($result->fields[29]);
$idconsec=reemplazar($result->fields[30]);

// fin datos de envio
$dsvalorflete=reemplazar($result->fields[31]);
$preciocompra=reemplazar($result->fields[32]);

$idnat=reemplazar($result->fields[33]);
$dstalla=reemplazar($result->fields[34]);
$dscolor=reemplazar($result->fields[35]);
$idtipo=reemplazar($result->fields[36]);
if ($idtipo==2) $textoservicio=1;
if ($idtipo<>2) $textoservicio=0;
$dsunidadesdispo=reemplazar($result->fields[37]);
$dsunidad=reemplazar($result->fields[38]);
$dsruta=$result->fields[39];
$dsrutax=$rutalocal."/gmproductos/".$dsruta;
$dscolorx=seldato('dsd','id','ecommerce_tblcolores',$result->fields[40],1);
$dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idproducto." and idactivo=1",1);


                  $idcant=($result->fields[1]);

                  $idprecio2=$idprecio-$idprecio*($dspordescuento/100); // valor descuento
                  if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento

//                   $xsubtotal=$xsubtotal+($idprecio*$idcant);


                    $preciomostrar=$idprecio;
                    if ($idprecio2<$idprecio) $preciomostrar=$idprecio2;

                    $preciobase=$preciomostrar;
                    if ($preciocompra>0) $preciobase=$preciocompra;


                    // contructor de manejo de precios

                   	$ivax=($result->fields[11]);
					$precio1m=$precio1/(1-($ivax/100));
            		$preciodescuentom=$preciodescuento/(1-($ivax/100));
            		$pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;



        $idprecioiva=$idprecio-($idprecio*($dspordescuento/100)*$idcant);
                  $xiva=$xiva+($idprecioiva*($dsporiva/100)*$idcant);
                       $xdescuento=$xdescuento+($idprecio*($dspordescuento/100)*$idcant);
                    if ($preciodescuento>0) $xdescuento=$xdescuento+(($idprecio-$preciodescuento)*$idcant);// valor descuento
                       $xsubtotal=$xsubtotal+($idprecio*$idcant);



					$read="";
					if ($dspara<>"") $read="readonly";


                    // cambios en el calculo de fletes

if ($dsvalorenvio>0) {
  // indica que es un arreglo entonces va hacia donde diga
// echo "s";
  $xfletes=$xfletes+$dsvalorenvio;

//$preciocompra;

} else {
if ($idnat<>1) {
//echo $pesobase;
    include("verificar.fletes.puntoventa.php");
   //echo $flete;
    $xfletes=$xfletes+($flete*$idcant);
  }
  // implica que es
  // 1.  el seguro se calcula aca

//echo $flete;
}

if ($idnat<>1) {

  $valorseguro=($preciobase*$idcant)-($valorbasesinseguro*$idcant);

  if ($valorseguro<0) $valorseguro=0;

  $xvalorseguro=$xvalorseguro+($valorseguro)*$porvalorseguro;
 $valormanejo=0;
  $xvalormanejo=$xvalormanejo+($valormanejo*$idcant); // ya viene en el precio asi que no se calcula
}
			?>


			<tr>
				<td>
          <a href="<? echo $dsrutax ?>">
            <?if($dsimg1<>""){?>
            <img src="<?echo $rutaImagen.$dsimg1?>" alt="">
            <?}else{?>
            <img src="<?echo  $rutbase?>/images/img_sin.png" alt="">
            <?}?>
          </a></td>
				<td>
					<article class="cont_producto">
						<h3><? echo $dsm?></h3>
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
						<p class="p1"><? echo $dsmarca?></p>
						<?if ($idtipo==2) echo "<p class='p_oferta'>Oferta Válida para Medellín y la Área Metropolitana</p>";?>
						<? if ($dsentrega<>"") { ?>

						<p class="p2" style="display:none;">Tiempo de Entrega: <span><? echo $dsentrega?></span></p>
						<? } ?>
        <? if ($dscondiciones<>"") { ?>

						<!--p class="p3" style="display:none;"><strong>Condiciones:</strong><? echo $dscondiciones?></p-->
      		<? } ?>
      		<? if ($dspara<>"") {?>

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

					</article>
				</td>
        <td><? echo $dsunidad ?></td>
        <td><? echo $dsunidadesdispo ?></td>
        <td>
          <article class="cantidad">
            <? echo $idcant?>
            <input type=hidden name="idx[]" value="<? echo $idx?>">
          </article>
        </td>
        <td>
          <article class="precio">
            <p class="p1">
              $ <? echo number_format($idprecio,0) ?>
            </p>
          </article>
        </td>
				<td>
					<article class="subtotal">
						<p class="p1">
							$ <? echo number_format($idprecio*$idcant,0) ?>
						</p>
					</article>
				</td>

				<td>
				</td>

			</tr>

			<?

 $result->MoveNext();
}
$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalormanejo+$xvalorseguro;
//echo $xsubtotal." -- ".$xdescuento." -- ".$xiva." -- ".$xfletes." -- ".$xvalormanejo." -- ".$xvalorseguro;
if($_SESSION['i_dsdescuento']){
$dsdescuento_codigo=($xsubtotal*($_SESSION['i_dsdescuento']/100));
$xsubtotal=$xsubtotal-$dsdescuento_codigo;
$xiva=($xsubtotal*($dsporiva/100));
$xtotal=$xsubtotal-$xdescuento+$xiva+$xfletes+$xvalorseguro;
}
			?>
    </tbody>
</table>

<table width="100%" border=0 border-collapse="0" border-spacing="0" cellspacing="0" class="cont_carrito_valores">

			<tr>
				<td colspan="2"><p class="txt"><strong>Subtotal</strong></p></td>
				<td colspan="2"><p class="precio"><strong>$ <? echo number_format($xsubtotal,0)?></strong></p></td>
			</tr>
<? if ($xdescuento>0){ ?>
			<tr>
				<td colspan="2"><p class="txt">Descuento</p></td>
				<td colspan="2"><p class="precio">$ <? echo number_format($xdescuento,0)?></p></td>
			</tr>
<? } ?>
<? if ($dsdescuento_codigo>0){ ?>
      <tr>
        <td colspan="2"><p class="txt">Descuento Codigo Promocional</p></td>
        <td colspan="2"><p class="precio">$ <? echo number_format($dsdescuento_codigo,0)?></p></td>
      </tr>
<? } ?>
<? if ($xiva>0){ ?>
			<tr>
				<td colspan="2"><p class="txt">Impuestos</p></td>
				<td colspan="2"><p class="precio">$ <? echo number_format($xiva,0)?></p></td>
			</tr>
<? } ?>

<? if ($xfletes>0) {?>

			<tr>
				<td colspan="2"><p class="txt">Manejo de Log&iacute;stica</p></td>
				<td colspan="2"><p class="precio">$ <? echo number_format($xfletes+$xvalorseguro,0)?></p></td>
			</tr>
<? } ?>

			<tr>
				<td colspan="2"><p class="txt p_total">Total en punto de venta <? if ($textoservicio==0) {?>de los productos<? } ?></p></td>
				<td colspan="2"><p class="precio p_total" id="item_total_valor" >$ <? echo number_format($xtotal,0)?></p></td>
			</tr>
          <?if ($textoservicio==0) {?>
      <tr>
        <td colspan="2"><p class="txt p_total">En caso que desee enviarlo a su direcci&oacute;n, seleccione la ciudad de entrega para los productos</p></td>
        <td colspan="2">
          <select name="dsciudadenvio" id="dsciudadenvio" onchange="cambiar_transporte('forma_carrito')"  >
              <option value="0">Seleccione</option>

            <?
            $sqlx="select id,dsciudad,idvalor,dsdep,idtarifa  ";
            $sqlx.=" from ecommerce_tblfletes where id>0  order by idpos asc,dsciudad asc";
          //  echo $sqlx;
            $resultx= $db->Execute($sqlx);
            if (!$resultx->EOF) {
            while(!$resultx->EOF){
            $id=$resultx->fields[0];
           $dsciudad=reemplazar($resultx->fields[1]);
             $idvalor=$resultx->fields[2];
             $dsdep=$resultx->fields[3];
             $idtarifa=$resultx->fields[4];
             if ($nofleteadicional==1) $idvalor=0; // todos los valores se vuelven cero

            ?>
              <option value="<? echo $dsciudad." - ".$dsdep ?>|<? echo $idtarifa; ?>|<? echo $idvalor; ?>" <? if ($dsciudadenvio==$dsciudad) echo "selected"?>><? echo $dsciudad." - ".$dsdep; ?></option>
                <?
                    $resultx->MoveNext();
                    }
                ?>

            </select>
             <span id="txt_dsciudadenvio" style="display:none" class="camp_requerido"><br><img src="images/warning.png" >Debe seleccionar el transporte</span>
             <span id="txt_cargando" style="display:none" class="camp_requerido"><br>Cargando fletes...</span>
<?
                              }
                    $resultx->Close();
?>
        </td>
      </tr>

<?
}
?>


			<tr>
				<td colspan="2"><p class="txt">Forma de Pago</p></td>
				<td colspan="2">
              <select name="dsformadepago" id="dsformadepago" onchange="cambiar_formadepago('forma_carrito')">
              <option value="">Seleccione</option>
<?
// cargar tipo de formas de pagos
        $sqlx="select id,dsm,dsd,idactivo  ";
            $sqlx.=" from ecommerce_tblformasdepagos where id>0 and idactivo not in (2) order by dsm asc";
          //  echo $sqlx;
            $resultx= $db->Execute($sqlx);
            if (!$resultx->EOF) {
			$dscombo="|Seleccione";
            while(!$resultx->EOF){
            $id=$resultx->fields[0];
           $dsm=reemplazar($resultx->fields[1]);
             $dsd=reemplazar($resultx->fields[2]);
             $idactivo=$resultx->fields[3];
			$dscombo.="-".$id."|".$dsm."|".$dsd."|".$idactivo;

    ?>
             <option value="<? echo $id?>|<? echo $dsm?>|<? echo $dsd?>|<? echo $idactivo?>"><? echo $dsm;?></option>

            <?
                    $resultx->MoveNext();
                    }
                    }
                    $resultx->Close();
                ?>

<?
// fin formas de pagos
?>
            </select>
			<input type="hidden" name="dscombo" value="<? echo $dscombo?>">
             <span id="txt_dsformadepago" style="display:none" class="camp_requerido"><br><img src="images/warning.png">Debe seleccionar la forma de pago</span>

			</td>
			</tr>

      <tr>
        <td colspan="2"><p class="txt p_total" id="item_total_texto_lg" style="display:none;">Total con transporte hacia lugar de entrega</p></td>
        <td colspan="2"><p class="txt p_total precio" id="item_total_valor_lg"></p></td>
      </tr>
      <tr>
        <td colspan="2"><p class="txt">Aceptar Condiciones</p></td>
        <td colspan="2" class="check" >
          <input type=checkbox  value="1" name="dsacepta" >
          <p class="precio">Aceptar</p>
          <a class='terminos_condiciones' href="<?echo $rutbase?>/terminos.condiciones.php?enca=3">pol&iacute;ticas y condiciones de venta</a>

          <span id="txt_dsacepta" style="display:none" class="camp_requerido">
              <img src="images/warning.png" style="margin-bottom: -2px; margin-right: 5px;">
              Debe Aceptar Los Terminos Y Condiciones
              </span>
          </td>
      </tr>
</table>

<nav class="cont_carrito_btns_centro">

          <input type=hidden name="xsubtotal" value="<? echo number_format($xsubtotal,0,"","")?>">
          <input type=hidden name="xdescuento" value="<? echo number_format($xdescuento,0,"","")?>">
          <input type=hidden name="xiva" value="<? echo number_format($xiva,0,"","")?>">
          <input type=hidden name="xfletes" value="<? echo number_format($xfletes,0,"","")?>">
          <input type=hidden name="xvalorseguro" value="<? echo number_format($xvalorseguro,0,"","")?>">
          <input type=hidden name="xvalormanejo" value="<? echo number_format($xvalormanejo,0,"","")?>">
          <input type=hidden name="xpeso" value="<? echo number_format($xpeso,0,"","")?>">
          <input type=hidden name="xtotal" value="<? echo number_format($xtotal,0,"","")?>">
          <input type=hidden name="xtransad" value="<? echo number_format($xtransad,0,"","")?>">

          <input type=hidden name="xtransad" value="<? echo number_format($xtransad,0,"","")?>">
          <input type=hidden name="xtransad" value="<? echo number_format($xtransad,0,"","")?>">



          <input type=hidden name="tipotransc" id="tipotransc" value="0">

          <? $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);?>

          <? if($tipocliente==1){?>
          <input type="button" value="Modificar" onClick="irAPaginaD('carrito.distribuidor2.php')" class="btn_general">
          <? }else { ?>
          <input type="button" value="Modificar" onClick="irAPaginaD('carrito.php')" class="btn_general">
          <? } ?>
          <input type="button" onclick="validar_pago_v2('forma_carrito',1);" value="Solo Cotizar" class="btn_general">
          <input type="button" onclick="validar_pago_v2('forma_carrito',0);" value="Finalizar Compra" class="btn_general fin_compra">
</nav>
	</form>

<?
} else {
  ?>

  <article class="no_producto">
    <img src="<?echo $rutbase?>/images/no_compra.png">
    <h3>NO HAY PRODUCTOS ASOCIADOS EN ESTOS MOMENTOS</h3>
    <nav>
      <a href="ecommerce.categoria.php" class="btn_general"><p>Por favor agregue uno</p></a>
    </nav>
  </article>
  <?
}
  $result->Close();
 ?>


</section>