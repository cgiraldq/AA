<?if($idestado<>""){
//    $db->debug=true;
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
$sql="select a.id,a.dsm,a.dsreferencia,a.dsruta";      
$sql.=" from ecommerce_tblproductos a ";
$sql.=" where a.idtipo=3 and a.idactivo in (";
$sql.="$idestado";
$sql.=") ";
$sql.="  and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
if($ordenar=="")$ordenar='$ordenarx';
if($ordenar==1)$sql.="order by a.dsm asc";
if($ordenar==2)$sql.="order by a.dsm desc";
if($ordenar==3)$sql.="order by (a.precio1+(a.iva/100)+a.dsflete) asc";
if($ordenar==4)$sql.="order by (a.precio1+(a.iva/100)+a.dsflete) desc";
if($ordenar==5)$sql.="order by a.dsreferencia asc";
if($ordenar==6)$sql.="order by a.dsreferencia desc";
if($ordenar==7)$sql.=" and a.idmasvendido=1 order by a.idmasvendido asc";
if($ordenar=="")$sql.="order by rand() ";
$maxregistros=15;
include("incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if(!$result->EOF){?>
 <ul class="ecommerce_producto_distribuidor">
  <h4><?echo  $titulobloque?></h4>
<?
$contar=0;
while (!$result->EOF && ($contar<$maxregistros)) {
$preciodescuento_me=0;
$preciodescuento_ma=0;
$pordescuentom=0;
$promodescuento=0;         
$id=reemplazar($result->fields[0]);
$dsm=reemplazar($result->fields[1]);
$dsm=str_replace("+","mas",$dsm);
$dsm=str_replace(">;<","><",$dsm);
$dsm=htmlspecialchars_decode($dsm);
$dsm=html_entity_decode($dsm);
$dsm=utf8_encode($dsm);
$dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id,1);
$dsreferencia=($result->fields[2]);
$dsruta=$result->fields[3];



$dsruta=$result->fields[2];
$dsrutax=$rutalocal."/producto/".$dsruta;

if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];


$tallasx=seldato('count(*)','idorigen','ecommerce_tbltallasxtblproductos',$id." and dsunidad > 0",1);//  cuenta las tallas que tenga  asociada el producto

$sql = "select";
$tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],1);
if($tipocliente==2) {
$xprecio=2;
$sql.=" max(a.dsprecio2),min(a.dsprecio2)";
}elseif($tipocliente==3){
$xprecio=3;
$sql.=" max(a.dsprecio3),min(a.dsprecio3)";
}elseif($tipocliente==4){
$xprecio=4;
$sql.=" max(a.dsprecio4),min(a.dsprecio4)";
}elseif($tipocliente==5){
$xprecio=5;
$sql.=" max(a.dsprecio5),min(a.dsprecio5)";
}else {
$xprecio=1;
$sql.=" max(a.dsprecio1),min(a.dsprecio1)";
}
$sql.=",b.iva,b.dsflete";
$sql.=" FROM ecommerce_tbltallasxtblproductos a ,ecommerce_tblproductos b WHERE a.idorigen=$id and a.idorigen=b.id and a.dsunidad>0"; 
$result_p = $db->Execute($sql);
if (!$result_p->EOF) {

$p_mayor=$result_p->fields[0];
$p_menor=$result_p->fields[1];
$p_iva=$result_p->fields[2];
$p_flete=0;
}$result_p->Close();
      

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


                        $pordescuentom=$promodescuento;
                        $preciodescuento_me=($p_menor*($promodescuento/100));//  Valor Descunto
                        $preciodescuento_ma=($p_mayor*($promodescuento/100));//  Valor Descunto
                        $p_mayor= ($p_mayor-$preciodescuento_ma);
                        $p_menor= ($p_menor-$preciodescuento_me);
                        $preciomayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
                        $preciomenor=$p_menor+($p_menor*($p_iva/100)+$p_flete);   
                      
                      // fin constructor de mostrar porcentaje

            ?>






        <li>
            <? if ($dsimg1<>""){?>
            <a href="#pedidos">
            <img src="<? echo $rutaImagen.$dsimg1?>" alt="">
            </a>
            <?}else{?>
            <a href="<? echo $dsrutax ?>"><img src="<?echo  $rutbase?>/images/img_sin.png" alt=""></a>
            <?}?>
                <div>
                <? if($tallasx==0){ ?>
                <p class="nodisponible">Producto no disponible</p>
                <? }else{
                if($preciomenor<>$preciomayor){?>
                <h3>  $ <? echo number_format($preciomenor,0) ?> / $ <? echo number_format($preciomayor,0) ?></h3>
                <?}else{?>
                <h3>$ <? echo number_format($preciomenor,0)?></h3>
                <?
                }
                }
                ?>

                <? if ($preciodescuento_me<>$preciodescuento_ma && $preciodescuento_ma > 0) {?>
                <p class="ahorro">
                $ <? echo number_format($preciodescuento_me,0) ?> / $ <? echo number_format($preciodescuento_ma,0) ?>
                </p>
                <? }elseif ($preciodescuento_ma > 0) {?>
                <p class="ahorro">
                $ <? echo number_format($preciodescuento_me,0) ?> 
                </p>
                <?}?>
                <h2><? echo $dsm?></h2>
                <p>Tallas: S/M/L</p>
                <p>Ref: <? echo $dsreferencia?></p>
                <a href="#pedidos">AGREGAR</a>
                </div>
        </li>






        <?
        $contar++;

        $result->MoveNext();
        }
		?>
  </ul>

<?
$rutapaginador="/tienda/ecommerce.subcategorias.php";
include("incluidos_modulos/index.paginar.php");
}else{


}
$result->Close();




}?>