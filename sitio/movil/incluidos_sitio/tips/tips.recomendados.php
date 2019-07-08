<?
$search=$_REQUEST['search'];
$search=$_REQUEST['search'];
$ordenar=$_REQUEST['orderby'];
if ($search=="") $search=$_REQUEST['dsbusqueda'];
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
//$db->debug=true;
?>



<article class="ecommerce_productos_lista">

  <!--h1><?echo reemplazar($search);?></h1-->
  <article class="img_marca">
    <?$rutaImagenx="../contenidos/images/ecommerce_marcas/";?>
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

		// armazon de productos
			      $sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.iva,a.preciodescuento,a.dsd,a.idactivo,a.idnat,a.preciocompra,a.precio2,a.preciodistribuidor,a.dsunidadesdispo";
           $sql.=" ,precio3,precio4,precio5,dsflete,dsreferencia";
            $sql.=" from ecommerce_tblproductos a";
            if ($idrelacion<>"") $sql.=" inner join ecommerce_tblsubcategoriaxtblproducto b on ( b.idorigen=a.id ) ";
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

      $sqlx="select id,dsm from tblordenar where 1";
      $resultx=$db->Execute($sqlx);
      if (!$resultx->EOF){
      $ordenarx=$resultx->fields[1];
      }$resultx->Close();
      if($ordenar=="")$ordenar=$ordenarx;
      if($ordenar==1)$sql.="order by a.dsm asc";
      if($ordenar==2)$sql.="order by a.dsm desc";
      if($ordenar==3)$sql.="order by (a.precio1+(a.precio1*(a.iva/100))+a.dsflete) asc";
      if($ordenar==4)$sql.="order by (a.precio1+(a.precio1*(a.iva/100))+a.dsflete) desc";
      if($ordenar==5)$sql.="order by a.dsreferencia asc";
      if($ordenar==6)$sql.="order by a.dsreferencia desc";
      if($ordenar==7)$sql.=" and a.idmasvendido=1 order by a.idmasvendido asc";
      if($ordenar=="")$sql.="order by rand() ";
      //echo $sql;
            $maxregistros=16;
            include("incluidos_modulos/paginar.variables.php");
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
            $id=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            $dsm=str_replace("+","mas",$dsm);
            $dsm=str_replace(">;<","><",$dsm);
            $dsm=htmlspecialchars_decode($dsm);
            $dsm=html_entity_decode($dsm);
            $dsm=utf8_encode($dsm);

           //  $dsm=html_entity_decode($dsm);
            $dsd=elliStr(reemplazar($result->fields[7]),70);
            $dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id." and idactivo=1",1);
            if ($_SESSION['i_idcliente']<>"") $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],2);
          if($tipocliente==1){
            $precio1=($result->fields[12]);
          }else{
            $precio1=($result->fields[4]);
          }
            $iva=($result->fields[5]);
      $ivax=($result->fields[5]);
            $idprecio1=$precio1+$precio1*($iva/100);
      $idactivo=trim($result->fields[8]);
            $idnat=trim($result->fields[9]);
            $precio2=trim($result->fields[11]);
        $preciocompra=trim($result->fields[10]);
        $cantidadpro=trim($result->fields[13]);
        $precio2=($result->fields[17]);
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
            //$dspordescuento=($result->fields[6]);
            $preciodescuento=($result->fields[6]);
            if ($preciodescuento=="") $preciodescuento=0;
            $idprecio2=0;
            if ($idnat==1 && $preciodescuento<=0) $idprecio1=$precio1; // este valor viene con el iva incluido si es producto nacional y sin descuento
            //$idprecio2=$precio1-$precio1*($dspordescuento/100); // valor descuento
            if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento
            //$idprecio2=$idprecio2+$idprecio2*($iva/100);
          //  $dsruta=$rutaFuenteImagenes."/contenidos/".$result->fields[2];
            //if ($rutaAmiga>1) $dsruta="productos.detalle.php?idproducto=".$id;
            $preciomostrar=$idprecio1;
            if ($idprecio2<$idprecio1 && $idprecio2>0) $preciomostrar=$idprecio2;
      $preciobase=$preciomostrar;
      if ($preciocompra>0) $preciobase=$preciocompra;
      // sumar precio2


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

                     // echo $precio1;
                      //echo $xprecio;
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

		  <li>
			<?if ($idactivo == 7) {?>
				<article class="tiket"><img src="<?echo $rut?>images/tiket.png" alt=""></article>
			<?}?>
			<? if ($preciodescuento>0) {?>
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
      <p class="precio1"><? if($preciomostrar==0){ ?><p class="nodisponible">Producto no disponible</p><? }else{ ?>$ <? echo number_format($preciomostrar+$precio2+$valorseguro+$iva,0) ?><? } ?></p>
       <? if ($preciodescuento>0) {?><p class="precio2">$ <? echo number_format($precio1+$precio2+$valorseguro+$iva,0) ?></p><? } ?>
      <?//if ($idnat == 2) {?><!--p class="p_inter">IMPORTADO</p-->      <? //} ?>
      <h2><? echo $dsm?></h2>
      </a>
     
      <h3>/ REF: <? echo $dsreferencia?></h3>

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


