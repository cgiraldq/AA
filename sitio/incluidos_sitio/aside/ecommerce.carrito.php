        <?


  if ($nomostrarcarrito=="") {
        $rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";

              $sql="select a.idproducto,a.idcant,a.idprecio,a.dstotal,b.dsimgcarrito,b.dsm,b.precio1,b.precio2,b.dsmarca";
              $sql.=",b.dsreferencia,a.dspordescuento,a.dsporiva,a.id,a.dsvalorenvio ";
              $sql.=",b.preciodescuento,b.preciocompra,b.idnat,b.dsunidad,b.dsunidadesdispo,b.id,b.dsruta,b.dsflete";

              $sql.=" from ecommerce_tbltemporalcompras a, ecommerce_tblproductos b where a.idproducto=b.id ";
              $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
              $sql.=" and idip='".$_SESSION['ipremota']."' and idtienda=$idtienda ";

//                  echo $sql;
                  $resultx=$db->Execute($sql);
                  if(!$resultx->EOF){
          ?>

<article class="carrito_compras">

 <div class="titulo_carro">
  <h2>CARRITO DE COMPRAS</h2>
  </div>
 

	<table class="tbl_producto">

          <?
          $xsubtotalx=0;
          $xdescuentox=0;
          $xivax=0;
          $xfletesx=0;
          $xvalorseguro=0;
            while(!$resultx->EOF){
                  $idproductox=reemplazar($resultx->fields[0]);
                  $dsmx=reemplazar($resultx->fields[5]);
                  $dsimg1x=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idproductox,1);
                  $idpreciox=($resultx->fields[2]); // valor venta

                  $dsmarcax=($resultx->fields[8]);
                  $precio2=($resultx->fields[21]);


                  $dsreferenciax=($resultx->fields[9]);
                  $dspordescuentox=($resultx->fields[10]);
                  $dsporivax=($resultx->fields[11]);
                  $idxx=($resultx->fields[12]);
                  $idnat=($resultx->fields[16]);
                  $dsunidad=($resultx->fields[17]);
                  $dsunidadesdispo=($resultx->fields[18]);
                   $dsruta=$resultx->fields[20];
                  $dsrutax=$rutalocal."/producto/";
                  $dsrutax.=$dsruta;
                  if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$idproductox."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
                  if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$idproductox."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
      
                  $idcantactual=($resultx->fields[1]);
                  $idprod=($resultx->fields[19]);
                  $dsvalorenviox=$precio2;
                  if ($dsvalorenviox<0) $dsvalorenviox=0;



                  $idcantx=($resultx->fields[1]);
                  $idprecio2x=$idpreciox-$idpreciox*($dspordescuentox/100); // valor descuento
                   if ($preciodescuento>0) $xdescuentox=$xdescuentox+($idpreciox-$preciodescuento); // valor descuento

                    $preciomostrarx=$idpreciox;
                    if ($idprecio2x<$idpreciox && $idprecio2x>0) $preciomostrarx=$idprecio2x;
                    $preciomostrarx1=$preciomostrarx;//+($preciomostrarx*($dsporivax/100));

                      $preciobase=$preciomostrarx;
                    $iva=$preciobase*($dsporivax/100)*$idcantx;
                       $xdescuentox=$xdescuentox+($idpreciox*($dspordescuentox/100));
                           $xsubtotalx=$xsubtotalx+($idpreciox*$idcantx);



                    //}
                    $xivax=$xivax+($iva);
                  $xfletesx=$xfletesx+$dsvalorenviox;




            ?>

		<tr>
      <!--td><? if ($dsimg1x<>""){?><a href="<?echo $dsrutax?>" title="<? echo $dsm?>" ><img src="<?echo $rutaImagen.$dsimg1x;?>" alt=""><? } ?></td--></a>
      <td><p><? echo $dsmx?></p>
        <!--p class="precio"><?
                    //echo $preciomostrarx1."+".$iva."+".$dsvalorenviox."+".$valorseguro."+".$porvalorseguro;

      //echo number_format((($preciomostrarx1+$iva+$dsvalorenviox+($valorseguro*$porvalorseguro))*$idcantx),0) ?></p-->
    </td>
			<td><a title="Eliminar este item de la compra" href="<?echo $rutbase?>eliminar.php?idx=<? echo $idxx?>&redir=<? echo $pagina?>&idprod=<? echo $idprod?>&cant=<? echo $idcantactual ?>&cantd=<? echo $dsunidadesdispo ?>"><article class="eliminar" title="Eliminar este item de la compra"></article></a></td>
		</tr>

    <?

 $resultx->MoveNext();
}
$xtotalx=$xsubtotalx-$xdescuentox+$xfletesx+$xvalorseguro+$xivax;

?>
	</table>

  <table class="tbl_totales">

      <!--tr>
        <td ><p>Subtotal: <span class="precio">$ <? echo number_format($xsubtotalx,0) ?></span></p></td>
      </tr>
        <tr>
        <td ><p>Descuento: <span class="precio">$ <? echo number_format($xdescuentox,0) ?></span></p></td>
      </tr>
       <tr>
        <td ><p>Envio: <span class="precio">$ <? echo number_format($xfletesx,0) ?></span></p></td>
      </tr>
       <tr>
        <td ><p>Iva: <span class="precio">$ <? echo number_format($xivax,0) ?></span></p></td>
      </tr-->
      <tr>
        <!--td ><p>Total: <span class="precio">$ <? //echo number_format($xtotalx,0) ?></span></p></td-->
      </tr>
      <tr>
        <td align="center">
          <a href="<?echo $rutbase?>/inicio.sesion.php?entrar=1" class="btn_carrito_aside">
            Ir a carro de compras
          </a>
        </td>
      </tr>
  </table>

</article>


<?
}
  $resultx->Close();
} // fin de nomostrarcarrito
 ?>

