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
if($idsubcat==""){
 $sql=" select iddestino from tbltblproductoxcategoria where  idorigen=$idproducto";
      $resultc=$db->Execute($sql);
      if(!$resultc->EOF){
        while(!$resultc->EOF) {
        $x2=($resultc->fields[0]);
         $idcate.=$x2.",";
        $resultc->Movenext();
      }
  }
  $resultc->close();
$idcate=trim($idcate,",");
}
      ?>

  <?$rutaImagen=$rutalocalimag."/contenidos/images/ecommerce_productos/";?>
  <?
  //$db->debug=true;
 
  $sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.iva,a.preciodescuento,a.dsd,a.idactivo,a.idnat,a.preciocompra";
  $sql.=",a.precio2,a.preciodistribuidor,a.dsunidadesdispo";
  $sql.=" ,precio3,precio4,precio5,dsflete,dsreferencia";
  $sql.=" from ecommerce_tblproductos a";
  if($idsubcat<>"") $sql.=" ,ecommerce_tblsubcategoriaxtblproducto b";
  if($idsubcat=="" && $idcate<>"") $sql.=" ,tbltblproductoxcategoria c";
  $sql.=" where a.id >0   and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
  $sql.=" and a.idactivo not in (2,5,9) ";
  if($idsubcat<>"") $sql.=" and b.idorigen=a.id and b.iddestino in ($idsubcat)";
  if($idsubcat=="" && $idcate<>"") $sql.=" and c.idorigen=a.id and c.iddestino in ($idcate)";
  $sql.="order by rand() ";
   $result=$db->Execute($sql);
  if(!$result->EOF){?>
  <article class="carrusel_otros_productos">
   <h2>Productos Relacionados</h2>
  <article id="carrusel_otros_productos"><?
    $contar=0;
    while (!$result->EOF) {
    $pordescuentom=0;
    $promodescuento=0;
    $id=reemplazar($result->fields[0]);
    $dsm=reemplazar($result->fields[1]);
    $dsm=str_replace("+","mas",$dsm);
    $dsm=str_replace(">;<","><",$dsm);
    //$dsm=utf8_decode($dsm);
    //$dsm=htmlspecialchars_decode($dsm);
    //$dsm=html_entity_decode($dsm);
    // $dsm=html_entity_decode($dsm);
    $dsd=elliStr(reemplazar($result->fields[7]),70);
    $dsimgx=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id." and idactivo=1",1);
    $iva=($result->fields[5]);
    $ivax=($result->fields[5]);
    $idprecio1=$precio1+$precio1*($iva/100);
    $idactivo=trim($result->fields[8]);
    $idnat=trim($result->fields[9]);
    $precio2=trim($result->fields[11]);
    $preciocompra=trim($result->fields[10]);
    $cantidadpro=trim($result->fields[13]);
    $precio2=($result->fields[17]); // flete
    $precio2=0;
    $dsreferencia=($result->fields[18]);
    $dsruta=$result->fields[2];
    if($_REQUEST['dscategoriax']<>"" && $_REQUEST['dsnombre']<>""){
    $dsrutax=$rutalocal."/productos/";
    $dsrutax.=$_REQUEST['dscategoriax']."/";
    $dsrutax.=$_REQUEST['dsnombre']."/";
    $dsrutax.=$dsruta;
    }else{
    $dsrutax=$rutalocal."/producto/";
    $dsrutax.=$dsruta;
    }
    if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
    if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
    $preciodescuento=($result->fields[6]);
    if ($preciodescuento=="") $preciodescuento=0;
    $idprecio2=0;
    if ($idnat==1 && $preciodescuento<=0) $idprecio1=$precio1; // este valor viene con el iva incluido si es producto nacional y sin descuento
    if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento
    $preciomostrar=$idprecio1;
    if ($idprecio2<$idprecio1 && $idprecio2>0) $preciomostrar=$idprecio2;
    $preciobase=$preciomostrar;
    if ($preciocompra>0) $preciobase=$preciocompra;
    //*********  inicio Bloque  Valores Segun Tipo Cliente ******************
    $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],2);
    if($tipocliente==2) {
    $xprecio=2;
  $precio1=($result->fields[11]);
  }elseif($tipocliente==3){
  $xprecio=3;
    $precio1=($result->fields[14]);
    }elseif($tipocliente==4){
  $xprecio=4;
    $precio1=($result->fields[15]);
    }elseif($tipocliente==5){
  $xprecio=5;
    $precio1=($result->fields[16]);
    }else{
  $xprecio=1;
  $precio1=($result->fields[4]);
    }
    $dsporflete=($result->fields[17]);
    //*********  Fin Bloque  Valores Segun Tipo Cliente ******************

                       //**********************inicio  Valor De La Promocion ***********************//


            $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
            $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
            $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
              $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$id or dsref='$dsreferencia')";
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
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$id,1)."'";
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
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$id,1)."'";
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

                       $preciodescuento=($precio1*($promodescuento/100));//  Valor Descunto
                       $dsporiva=($result->fields[5]);
                       $idprecio1=$precio1;
                       if ($idnat==1 && $preciodescuento<=0) $idprecio1=$precio1; // este valor viene con el iva incluido si es producto nacional y sin descuento
                       if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento
                       $preciomostrar=$idprecio1-$preciodescuento;
                       $preciobase=$preciomostrar;
                       $valorseguro=0;
                       if ($idnat<>1) {
                       if ($valorseguro<0) $valorseguro=0;
                         }
                      //   echo $preciobase;
                      $iva=($preciobase*($dsporiva/100));
                      $ivax=($result->fields[27]);
                      // constructor de mostrar porcentaje
                      $precio1m=$precio1/(1-($ivax/100));
                      $preciodescuentom=$preciodescuento/(1-($ivax/100));
                      $pordescuentom=$promodescuento;
                      // fin constructor de mostrar porcentaje
            ?>
      <article class="item_productos">
        <?
        if($dsrutamiga==2) $validar='is_file($rutaImagen.$dsimgx) && $dsimgx<>""';
        if($dsrutamiga==1) $validar='$dsimgx<>""'; 
        if ($validar){ ?>
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
        </a>

        <a href="<?echo $dsrutax?>" >
        <!--p class="precio1">
        <?if($preciomostrar==0){ ?>
        <p class="nodisponible">Producto no disponible</p><? }else{ ?>$ <? echo number_format($preciomostrar+$precio2+$valorseguro+$iva,0) ?> <? } ?>
         </p-->
        </a>
      </article>
        <?
        $contar++;
        $result->MoveNext();
        }?>
</article>
  <a id="prev_carrusel_otros_productos" class="prev" href="#"><img src="<?echo $rutbase?>/images/next2.png" alt=""></a>
  <a id="next_carrusel_otros_productos" class="next" href="#"><img src="<?echo $rutbase?>/images/prev2.png" alt=""></a>
</article>
   <? }
    $result->Close();
  ?>
  <?}?> 