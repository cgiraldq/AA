<?
$search=$_REQUEST['search'];
$search=$_REQUEST['search'];
$ordenar=$_REQUEST['orderby'];
if ($search=="") $search=$_REQUEST['dsbusqueda'];
$rutaImagen=$rutaFuenteImagenes."../../contenidos/images/ecommerce_productos/";
//$db->debug=true;
?>



<article class="ecommerce_productos_lista">

  <!--h1><?echo reemplazar($search);?></h1-->
  <article class="img_marca">
    <?$rutaImagenx="../../contenidos/images/ecommerce_marcas/";?>
    <?$imgm=seldato('dsimg','dsm','ecommerce_tblmarcas',$search,2)?>
    <?if (is_file($rutaImagenx.$imgm)){?>
      <img src="<?echo $rutaImagenx.$imgm?>" alt="<?echo $search?>" >
    <?}?>

  </article>



		<?
    if ($idrelacion<>"") {
        $sql=" select dsm from ecommerce_tblsubcategoriasxcategoria where id=$idrelacion";
       // echo $sql;
        //exit();
         $resultx = $db->Execute($sql);
         if (!$resultx->EOF) {
          $dssubcategoria=$resultx->fields[0];
          }
          $resultx->Close();
      }
     // $db->debug=true;
		// armazon de productos
             $sql="select a.id,a.dsm,a.dsreferencia,a.dsruta";
            $sql.=" from ecommerce_tblproductos a";
            if ($idrelacion<>"") $sql.=" inner join ecommerce_tblsubcategoriaxtblproducto b on ( b.idorigen=a.id ) ";
             $sql.=" inner join ecommerce_tbltallasxtblproductos c on ( c.idorigen=a.id ) ";
            $sql.=" where a.id >0  and a.idtipoprod=1 and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
            if ($idactivox<>"") {
                $sql.=" and a.idactivo in ($idactivox) ";
            } else {
              $sql.=" and a.idactivo not in (9,2,5) ";
            }
            if ($idrelacion<>"") $sql.="  and (b.iddestino=".$idrelacion." )";
            if ($search<>"") {
                $search=trim($search);
                $sql.=" and (";
                $sql.=" a.dsm like '%".($search)."%'";
                $sql.=" or a.dsmarca like '%".($search)."%'";
                $sql.=" )" ;
            }
            //echo $sql;
           // exit();
      $sql.="group by a.dsm ";

      $sqlx="select id,dsm from tblordenar where 1";
      $resultx=$db->Execute($sqlx);
      if (!$resultx->EOF){
      $ordenarx=$resultx->fields[1];
      }$resultx->Close();
      if($ordenar=="")$ordenar=$ordenarx;
      if($ordenar==1)$sql.="order by a.dsm asc";
      if($ordenar==2)$sql.="order by a.dsm desc";
      if($ordenar==3)$sql.="order by (c.dsprecio1+(c.dsprecio1*(a.iva/100))+a.dsflete) asc";
      if($ordenar==4)$sql.="order by (c.dsprecio1+(c.dsprecio1*(a.iva/100))+a.dsflete) desc";
      if($ordenar==5)$sql.="order by a.dsreferencia asc";
      if($ordenar==6)$sql.="order by a.dsreferencia desc";
      if($ordenar==7)$sql.=" and a.idmasvendido=1 order by a.idmasvendido asc";
      if($ordenar=="")$sql.="order by rand() ";
      //echo $sql;
            $maxregistros=16;
            include("../incluidos_modulos/paginar.variables.php");
            $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
      ?>


  <section class="slc_categorias">

    <!--p>Ordernar Poductos de :</p-->

    <select name=ordenar onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">

         <?if($rutaAmiga>1){
         $redu=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&orderby=";
         }else{
          if($_REQUEST['dsnombre']==""){
                $redu=$pagina."?dsbusqueda=".$search."&idrelacion=".$_REQUEST['idrelacion']."&orderby=";
          }else{
          $redu=$rutalocal.$_REQUEST['dsnombre']."&orderby=";
          }
         }
          ?>


          <option> Ordenar por: </option>
          <option <?if($ordenar==7) echo "SELECTED"?> value="<?echo $redu?>7">Más vendidos</option>
          <!--option <?if($ordenar==2) echo "SELECTED"?> value="<?echo $redu?>2">Ordenar de Z-A</option>-->
          <option <?if($ordenar==4) echo "SELECTED"?> value="<?echo $redu?>4">Mayor precio</option>
          <option <?if($ordenar==3) echo "SELECTED"?> value="<?echo $redu?>3">Menor precio</option>
          <option <?if($ordenar==1) echo "SELECTED"?> value="<?echo $redu?>1">Nombre (A-Z)</option>
          <!--option <?if($ordenar==6) echo "SELECTED"?> value="<?echo $redu?>6">Ordenar de referencia de Z-A</option-->
          <option <?if($ordenar==5) echo "SELECTED"?> value="<?echo $redu?>5">Referencia (A-Z)</option>
    </select>
</section>

    <ul>
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

      $tallasx=seldato('count(*)','idorigen','ecommerce_tbltallasxtblproductos',$id." and dsunidad > 0",1);//  cuenta las tallas que tenga  asociada el producto

      $sql = "select";
      $tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],2);
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
      //$p_flete=$result_p->fields[3];
      $p_flete=0;
      /*
      $p_mayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
      $p_menor=$p_menor+($p_menor*($p_iva/100)+$p_flete);
      */
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
            ?>

		  <li>
			<?if ($idactivo == 7) {?>
				<article class="tiket"><img src="<?echo $rut?>images/tiket.png" alt=""></article>
			<?}?>
      <? if ($preciodescuento_me>0 || $preciodescuento_ma > 0) {?>

				<a href="<? echo $dsrutax?>">
				<article class="oft_pro">
					<p class="porc">-<? echo number_format($pordescuentom,0) ?>%</p>
				</article>
				</a>
			<?}?>

			<? //if (is_file($rutaImagen.$dsimg1))
      if($dsimg1<>""){?>
				<a href="<? echo $dsrutax?>">
					<img src="<? echo $rutaImagen.$dsimg1?>" alt="">
				</a>
			<?}else{?>
      <a href="<? echo $dsrutax ?>"><img src="<?echo  $rutbase?>/images/img_sin.png" alt=""></a>
      <?}?>
			<section class="info_prod">

      <a href="<? echo $dsrutax?>" title="ver detalle">
      <h2><? echo $dsm?></h2>
      <h3>Ref: <? echo $dsreferencia?></h3>
      <p class="precio1">
         <? if($tallasx==0){ ?>
          <p class="nodisponible">Producto no disponible</p>
          <? }else{ ?>

            <?if($preciomenor<>$preciomayor){?>


           $ <? echo number_format($preciomenor,0) ?> / $ <? echo number_format($preciomayor,0) ?>

           <?}else{?>
            $ <? echo number_format($preciomenor,0)?>

           <?}?>

          <? } ?>
      </p>
      </a>
      <? if ($preciodescuento_me>0 <> $preciodescuento_ma > 0) {?>
      <p class="precio2">
        $ <? echo number_format($preciodescuento_me,0) ?> / $ <? echo number_format($preciodescuento_ma,0) ?>
      </p>
      <? }elseif($preciodescuento_me>0){?>
        <p class="precio2">
        $ <? echo number_format($preciodescuento_me,0) ?>
      </p>
      <?}?>
      </section>

		</li>
        <?
        $contar++;

        $result->MoveNext();
        }
		?>

  </ul>

<?    $rutapaginador=$rutaInclude."/ecommerce.productos.php";
        include("incluidos_modulos/index.paginar.php");
      }else{?>

<article class="img_marca">
<h1>No Se encontraron Registros</h1>
</article>

      <?}
        $result->Close();

?>
</article>