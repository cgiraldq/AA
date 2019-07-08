<?
// 1. TRAER SUB CATEGORIAS ASOCIADAS AL PRODUCTO
if ($idproducto<>"") {
$sql=" select iddestino from ecommerce_tblsubcategoriaxtblproducto where  idorigen=$idproducto";
      $result=$db->Execute($sql);
      if(!$result->EOF){
        while(!$result->EOF) {
        $x=($result->fields[0]);
         $idsubcat.=$x.",";
        $result->Movenext();
      }
  }
  $result->close();
 $idsubcat=trim($idsubcat,",");
      ?>
<?
if($idsubcat<>""){
$rutaImagen="/contenidos/images/ecommerce_productos/";
$sqlr="select a.dsm,a.dsreferencia,a.id,a.dsruta";
$sqlr.=" from ecommerce_tblproductos a,ecommerce_tblsubcategoriaxtblproducto b ";
$sqlr.=" where 1 and a.id not in ($idproducto)  and a.idactivo not in (2,5,9) and a.id=b.idorigen and b.iddestino in ($idsubcat) ";
$sqlr.=" and ($fechaBaseNum between a.idfechainicial and a.idfechafinal)  group by dsreferencia order by rand()";
$resultr=$db->Execute($sqlr);
if(!$resultr->EOF){?>
  <article class="carrusel_otros_productos">
  <h2>Productos Relacionados</h2>
  <article id="carrusel_otros_productos">
<?
while(!$resultr->EOF) {
       $pordescuentom=0;
       $promodescuento=0;
      $dsm=reemplazar($resultr->fields[0]);
      $dsreferencia=reemplazar($resultr->fields[1]);
      $idotros=reemplazar($resultr->fields[2]);
      $dsruta=$resultr->fields[3];
      if($_REQUEST['dscategoriax']<>"" && $_REQUEST['dsnombre']<>""){
      $dsrutax=$rutalocal."/productos/";
      $dsrutax.=$_REQUEST['dscategoriax']."/";
      $dsrutax.=$_REQUEST['dsnombre']."/";
      $dsrutax.=$dsruta;
      }else{
      $dsrutax=$rutalocal."/producto/";
      $dsrutax.=$dsruta;
      }
      if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$idotros."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['subcate'];
      if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$idotros."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['subcate'];
   
      $dsimgx=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idotros,1);
      $tallasx=seldato('count(*)','idorigen','ecommerce_tbltallasxtblproductos',$idotros." and dsunidad > 0",1);//  cuenta las tallas que tenga  asociada el producto
     
      $sql = "select";
      $tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],1);
      if($tipocliente==2) {
      $sql.=" max(a.dsprecio2),min(a.dsprecio2)";
      }elseif($tipocliente==3){
      $sql.=" max(a.dsprecio3),min(a.dsprecio3)";
      }elseif($tipocliente==4){
      $sql.=" max(a.dsprecio4),min(a.dsprecio4)";
      }elseif($tipocliente==5){
      $sql.=" max(a.dsprecio5),min(a.dsprecio5)";
      }else {
      $sql.=" max(a.dsprecio1),min(a.dsprecio1)";
      }
      $sql.=",b.iva,b.dsflete";
      $sql.=" FROM ecommerce_tbltallasxtblproductos a ,ecommerce_tblproductos b WHERE a.idorigen=$idotros and a.idorigen=b.id and a.dsunidad>0"; 
      $result_p = $db->Execute($sql);
      if (!$result_p->EOF) {

      $p_mayor=$result_p->fields[0];
      $p_menor=$result_p->fields[1];
      $p_iva=$result_p->fields[2];
      //$p_flete=$result_p->fields[3];
      $p_flete=0;
      //$p_mayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
      //$p_menor=$p_menor+($p_menor*($p_iva/100)+$p_flete);
      }$result_p->Close();
                             //**********************inicio  Valor De La Promocion ***********************//


                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$idotros or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                       // echo "<br>".$sqldes."<br>--productos";
                        $result_des=$db->Execute($sqldes);
                        if(!$result_des->EOF){
                        $xpromoproducto=1;
                        $promodescuento=($result_des->fields[1]);
                        $idprecio=($result_des->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$idotros,1)."'";
                        $resultY=$db->Execute($sqldes);
                        if(!$resultY->EOF){
                        $xpromocatecoria=1;
                        $promodescuento=($resultY->fields[1]);
                        $idprecio=($resultY->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.=" ecommerce_tblpromocionesxsubcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$idotros,1)."'";
                        //echo $sqldes."<br>--Sub";
                        $resultx=$db->Execute($sqldes);
                        if(!$resultx->EOF){
                        $xpromosubcategoria=1;
                        $promodescuento=($resultx->fields[1]);
                        $idprecio=($resultx->fields[2]);
                        }$resultx->Close();//  Fin Subcategoria
                        }$resultY->Close();// Fin  promocion Categoria
                        }$result_des->Close();// Fin  promocion producto

                       //**********************Fin  Valor De La Promocion ***********************//

                        $pordescuentom=$promodescuento;
                        $preciodescuento_me=($p_menor*($promodescuento/100));//  Valor Descunto
                        $preciodescuento_ma=($p_mayor*($promodescuento/100));//  Valor Descunto
                        $p_mayor= ($p_mayor-$preciodescuento_ma);
                        $p_menor= ($p_menor-$preciodescuento_me);
                        $preciomayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
                        $preciomenor=$p_menor+($p_menor*($p_iva/100)+$p_flete);   
      ?>
      <article class="item_productos">
        <?
        if($dsimgx<>""){?>
        <a href="<?echo $dsrutax?>" >
          <img src="<? echo $rutaImagen.$dsimgx?>" title="<?echo $dsm;?>">
        </a>
        <?}else{?>
           <a href="<?echo $dsrutax?>" >
          <img src="<?echo  $rutbase?>/images/img_sin.png" title="<?echo $dsm;?>">
        </a>
          <?}?>
        <a href="<?echo $dsrutax?>" >
          <h4><? echo $dsm?></h4>
        <h3>REF: <? echo $dsreferencia?></h3>
        </a>
        <a href="<?echo $dsrutax?>" >
        <p class="precio1">
        <?/*if($tallasx==0){ ?>

        <p class="nodisponible">Producto no disponible</p>

        <? }else{ ?>
          <?if($preciomenor<>$preciomayor ){?>
          <p class="ahorro" ><span>Desde $ <?echo number_format($preciomenor)?> Hasta$ <?echo number_format($preciomayor)?></span></p>
          <?}elseif ($preciomenor>0) {?>
            <p class="ahorro" ><span>Precio $ <?echo number_format($preciomenor)?>
          <?}?>
        <? } */?>
         </p>
        </a>
      </article>
<?
$resultr->MoveNext();
}?>

</article>
  <a id="prev_carrusel_otros_productos" class="prev" href="#"><img src="<?echo $rutbase?>/images/next2.png" alt=""></a>
  <a id="next_carrusel_otros_productos" class="next" href="#"><img src="<?echo $rutbase?>/images/prev2.png" alt=""></a>
</article>
<?
}
$result->close();
?>
<?

}
}?>