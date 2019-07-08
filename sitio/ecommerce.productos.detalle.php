<?
if ($rutap==1) $rut="../../tienda/";
include ($rut."sessiones.php");
$idproducto = $_REQUEST["idproducto"];
$idtipo = $_REQUEST["idtipo"];
$vistaprevia = $_REQUEST["vistaprevia"];

if ($idproducto=="") $idproducto=$idc;
if ($idproducto=="") $idproducto=0;
$rutaImagen=$rutaFuenteImagenes."../contenidos/images/ecommerce_productos/";
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
<? $dsnombre=$_REQUEST['dsnombre']?>
<?

$idrelacion=$_REQUEST['idrelacion'];
if ($idrelacion=="") $idrelacion=$idproducto;

?>
    <?include($rut."incluidos_sitio/head/head.php");

if ($idtipo=="") $idtipo=seldato("idtipo","id","ecommerce_tblproductos",$idrelacion,1);
if ($dsnombre=="") $dsnombre=seldato("dsruta","id","ecommerce_tblproductos",$idrelacion,1);
                   // $db->debug=true;
                  $sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.dsd2,a.dsimg2,";//6
                  $sql.="a.dsimg3,a.dsimg4,a.dsimg5,a.dsimg6,a.dsimg7,a.precio2,a.descuento,  ";//13
                  $sql.="a.dsdisponible,a.dsentrega,a.dsd,a.dsimg8,a.dsimg9,a.dsimg10";//19
                  $sql.=",a.preciodescuento,a.dscondiciones,a.dsvideo,a.idactivo,a.idtipoprod,a.idnat,a.preciocompra,a.iva,a.idproveedor,a.preciodistribuidor";//29
                  $sql.=",a.dsunidadesdispo,a.dsunidad,a.dsruta,a.dsreferencia,a.dsd2txt,a.dsdcondicionestxt,a.precio3,a.precio4,a.precio5,a.dsflete,a.dscaractxt,a.dscarac,a.dsurl";
                  $sql.=" from ecommerce_tblproductos a where a.id=$idrelacion and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
                  //echo $sql;
                  if ($vistaprevia=="") $sql.=" and idactivo not in (2,5,12,9) and dsruta='$dsnombre'";
                  //echo $sql;
                  $result=$db->Execute($sql);
                  if(!$result->EOF){
                      $id=reemplazar($result->fields[0]);
                      $idproducto=reemplazar($result->fields[0]);
                      $dsproducto=reemplazar($result->fields[1]);
                      $dsproducto=str_replace("+","mas",$dsproducto);
                      $dsproducto=str_replace(">;<","><",$dsproducto);
                      $dsproducto=htmlspecialchars_decode($dsproducto);
                      $dsproducto=html_entity_decode($dsproducto);
                      $dsproducto=utf8_encode($dsproducto);
                      $dsproducto=utf8_decode($dsproducto);

                      $dsd2=($result->fields[5]);
                      $dsd2=str_replace(">;<","><",$dsd2);

                      $dsd2=html_entity_decode($dsd2);
                      $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd2));
                      $dsd2=str_replace("&nbsp;"," ",$dsd2);
                      $dsd2=utf8_decode($dsd2);
                      $dsd2=html_entity_decode($dsd2);
                      $dsd2=str_replace("$$","<img src='".$rut."images/vineta.png' id='img_vineta'>",$dsd2);

                      $dsd=reemplazar($result->fields[16]);
                      $dsd=str_replace(">;<","><",$dsd);

                      $dsd=str_replace("&nbsp;","",$dsd);
                      $dsd=htmlspecialchars_decode($dsd);
                      $dsd=utf8_decode($dsd);
                      $dsd=html_entity_decode($dsd);
                      $dsd=(reemplazar(preg_replace("/\n/","<br>",$dsd)));

                      $dscondiciones=($result->fields[21]);
                      $dscondiciones=str_replace(">;<","><",$dscondiciones);
                      $dscondiciones=utf8_decode($dscondiciones);
                      $dscondiciones=html_entity_decode($dscondiciones);

                      $dsruta=($result->fields[2]);
                      $dirredes="http://$dirredesx/contenidos/".$dsruta; // Esta variable se usa para la sindicación
                      $preciodistribuidor=($result->fields[29]);
                      $dsvideo=($result->fields[22]);
                      $idproveedor=($result->fields[28]);
                      $dsunidadesdispo=$result->fields[30];
                      $dsunidad=$result->fields[31];
                      $dsruta=$result->fields[32];
                      $dsd2txt=$result->fields[34];
                      $dsdcondicionestxt=$result->fields[35];
                      $dsrutax=$rutalocal."/productos/".$dsruta;
                      $idactivo=($result->fields[23]);
                      $idtipoprod=($result->fields[24]);
                      $idnat=($result->fields[25]);
                      $dsdisponible=($result->fields[14]);
                      $dsentrega=reemplazar($result->fields[15]);
                      $dscaractxt=reemplazar($result->fields[40]);
                      $dscarac=(trim($result->fields[41]));
                      $dscarac=str_replace(">;<","><",$dscarac);
                      /*
                      $dscarac=str_replace("&nbsp;","",$dscarac);
                      $dscarac=utf8_decode($dscarac);
                      $dscarac=html_entity_decode($dscarac);
                      */
                      $dscarac=utf8_encode($dscarac);
                      $dscarac=((preg_replace("/\n/","<br>",$dscarac)));

                      $dsreferencia=$result->fields[33];
                      $dsurlpago=(trim($result->fields[42]));

                      //$preciodescuento=($result->fields[20]);

                      //*********  Bloque  Valores Segun Tipo Cliente ******************
                      $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);
                      if($tipocliente==2) {
                      $xprecio=2;
                      $precio1=($result->fields[12]);
                      }elseif($tipocliente==3){
                        $xprecio=3;
                      $precio1=($result->fields[36]);
                      }elseif($tipocliente==4){
                        $xprecio=4;
                      $precio1=($result->fields[37]);
                      }elseif($tipocliente==5){
                        $xprecio=5;
                      $precio1=($result->fields[38]);
                      }else{
                        $xprecio=1;
                        $precio1=($result->fields[4]);
                      }
                      $dsporflete=($result->fields[39]);
                      // adicionalr la url

                      //*********  Fin Bloque  Valores Segun Tipo Cliente ******************

                       //**********************inicio  Valor De La Promocion ***********************//


                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$id or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                        //echo "<br>".$sqldes."<br>--productos";
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
                        //echo "<br>".$sqldes."<br>--Categoria";
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



                        //echo "<br>".$xpromoproducto."<br>".$xpromocatecoria."<br>".$xpromosubcategoria;


                       //**********************Fin  Valor De La Promocion ***********************//

                       $preciodescuento=($precio1*($promodescuento/100));//  Valor Descunto
                       $preciocompra=($result->fields[26]);
                       $dsporiva=($result->fields[27]);
                       $idprecio1=$precio1;
                       if ($idnat==1 && $preciodescuento<=0) $idprecio1=$precio1; // este valor viene con el iva incluido si es producto nacional y sin descuento
                       if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento
                       $preciomostrar=$idprecio1-$preciodescuento;
                       $preciobase=$preciomostrar;
                       $dsflete=($result->fields[39]);
                       $valorseguro=0;
                       if ($idnat<>1) {
                       if ($valorseguro<0) $valorseguro=0;
                         }
                      $iva=($preciobase*($dsporiva/100));
                      $ivax=($result->fields[27]);
                      // constructor de mostrar porcentaje
                      $precio1m=$precio1/(1-($ivax/100));
                      $preciodescuentom=$preciodescuento/(1-($ivax/100));
                      $pordescuentom=$promodescuento;
                      // fin constructor de mostrar porcentaje



               }else{?>
  <script language="javascript">
<!--
//    location.href="http://<? echo $autorizado; ?>";
//-->
  </script>
                <?}
                 $result->Close();


                      $cat="0";
                      $sql="select a.id from ecommerce_tblcategoria a inner join tblcategoriaxtblproducto b on b.iddestino=a.id ";
                      if ($idtienda >1 ) $sql.=" inner join ecommerce_tblempresaxtblproducto c on c.idorigen=a.id ";
                      $sql.=" where a.idactivo not in (2) ";
                      if ($idtienda >1 ) $sql.=" and c.iddestino=$idtienda ";
                      $sql.=" and  b.idorigen=$idproducto ";

                     // echo $sql;

                      // traer productos asociados por la categoria

                        $result=$db->Execute($sql);
                        if(!$result->EOF){
                            while(!$result->EOF) {
                               $cat.=",".$result->fields[0];
                            $result->Movenext();
                               }
                        }
                        $result->Close();
    ?>

  <body onload="cargar_tallas('<?echo $idproducto?>');">
        <!--[if lt IE 8 ]>
            <?include($rut."incluidos_sitio/ie7/ie7.php");?>
        <![endif]-->
        <section class="cont_pagina">

            <section class="cont_header">
              <?include("incluidos_sitio/header/header.php");?>
            </section>

              <?include("incluidos_sitio/menu/menu.superior.php");?>
              <?include("incluidos_sitio/slide/slider.php");?>
              <?//include("incluidos_sitio/slide/slider.automatico.php");?>

          <section class="bg_cuerpo_ecommerce_detalle">
            <section class="cont_cuerpo_general">

                    <?include($rut."incluidos_sitio/miga/miga.php");?>


                     <? $idcat=$_REQUEST['idcat'] ?>


                    <?//include("incluidos_sitio/ecommerce/productos/subcategoria.productos.vertical.php");?>
                     <?//include("incluidos_sitio/ecommerce/productos/subcategoria.productos.vertical2.php");?>


                    <?

                    switch ($idtipo) {
                        case 0:
                            include($rut."incluidos_sitio/ecommerce/productos/productos.detalle.php");
                            include($rut."incluidos_sitio/ecommerce/productos/otros.productos.php");

                            break;

                        case 1:
                            include($rut."incluidos_sitio/ecommerce/productos/productos.detalle.php");
                            //include($rut."incluidos_sitio/ecommerce/productos/otros.productos.php");
                            break;

                        case 2:
                            include($rut."incluidos_sitio/ecommerce/productos/productos.detalle.php");
                            //include($rut."incluidos_sitio/ecommerce/productos/otros.productos.php");
                            break;

                        default:
                            //  echo "entra";
                              $incluidotipootros=seldato("dsd2","id","ecommerce_tbltiposproductos",$idtipo,1);
                              $incluidotipo=seldato("dsd","id","ecommerce_tbltiposproductos",$idtipo,1);
                              include($rut."incluidos_sitio/ecommerce/productos/".$incluidotipo);
                               break; }
                    ?>


                       <?include($rut."incluidos_sitio/aside/aside.php");?>

                    <?
                    if($idtipo==3 && $incluidotipootros<>""){
                    include($rut."incluidos_sitio/ecommerce/productos/".$incluidotipootros);
                    }else{
                    include($rut."incluidos_sitio/ecommerce/productos/otros.productos.php");
                    }
                    ?>
                     



                </section>
               

            </section>
          </section>


            <section class="cont_footer">
                <?include($rut."incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>