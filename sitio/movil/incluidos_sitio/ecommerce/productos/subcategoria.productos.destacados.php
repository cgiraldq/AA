<?
//$db->debug=true;
$idatributo=$_REQUEST['idatributo'];
$idcriterio=$_REQUEST['idcriterio'];
$idcriterio1=$_REQUEST['idcriterio1'];
if($idcriterio1<>""){
  if($idcriterio<>$idcriterio1){

  $idcriteriox=$idcriterio.",".$idcriterio1;
  }else{
   $idcriteriox=$idcriterio;

  }


}else{
  $idcriteriox=$idcriterio;
}
$idmarca=$_REQUEST['idmarca'];
$dsmarca=$_REQUEST['dsmarca'];
if($idrelacion=="")$idrelacion=$_REQUEST['idrelacion'];
if($idrelacion<>""){
$search=$_REQUEST['search'];
$ordenar=$_REQUEST['orderby'];
if ($search=="") $search=$_REQUEST['dsbusqueda'];
$rutaImagen="../../contenidos/images/ecommerce_productos/";
$rutaimgcriterio="../../contenidos/images/ecommerce_criterios/";

// =================================================================================================//
//$db->debug=true;
$sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.iva,a.preciodescuento,a.dsd,a.idactivo";
$sql.=",a.idnat,a.preciocompra,a.precio2,a.preciodistribuidor,a.dsunidadesdispo";
$sql.=" ,precio3,precio4,precio5,dsflete,a.dsreferencia";
$sql.=" from ecommerce_tblproductos a, tbltblproductoxcategoria b ";
if($idcriterio<>"" || $idcriterio1<>"") $sql.=" ,tblcriterioxproducto c ";
if($idatributo<>"") $sql.=" ,tblatributosxproducto d ";
$sql.=" where a.idactivo not in (";
$sql.="2,9";
$sql.=") ";
$sql.="  and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
$sql.=" and b.iddestino=$idrelacion and b.idorigen=a.id ";
if($idcriteriox<>"") $sql.=" and c.iddestino in ($idcriteriox) and c.idorigen=a.id ";
if($idatributo<>"") $sql.=" and d.iddestino in ($idatributo) and d.idorigen=a.id ";
if($idmarca<>"")$sql.=" and (a.idmarca=$idmarca or a.dsmarca='$dsmarca') ";
//if($ordenar=="")$ordenar='$ordenarx';
if($ordenar==1 || $ordenar=="")$sql.="order by a.dsm asc";
if($ordenar==2)$sql.="order by a.dsm desc";
if($ordenar==3)$sql.="order by (a.precio1+(a.iva/100)) asc";
if($ordenar==4)$sql.="order by (a.precio1+(a.iva/100)) desc";
if($ordenar==5)$sql.="order by a.dsreferencia asc";
if($ordenar==6)$sql.="order by a.dsreferencia desc";
if($ordenar==7)$sql.=" and a.idmasvendido=1 order by a.idmasvendido asc";
//if($ordenar=="")$sql.="order by rand() ";
$resultcount=$db->Execute($sql);
// =================================================================================================//
?>

<article class="ecommerce_productos_lista">
<?if($pagina<>"ecommerce.categoria.php"){?>
<section class="slc_categorias">

  <div>
        <select name=ordenar onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">

         <?if($rutaAmiga>1){
         $redu=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&orderby=";
         }else{
          $redu=$rutalocal.$_REQUEST['dsnombre']."&orderby=";

         }
          ?>
          <option> Ordenar por: </option>
          <option <?if($ordenar==7) echo "SELECTED"?> value="<?echo $redu?>7">Más vendidos</option>
          <option <?if($ordenar==2) echo "SELECTED"?> value="<?echo $redu?>2">Ordenar de Z-A</option>>
          <option <?if($ordenar==4) echo "SELECTED"?> value="<?echo $redu?>4">Mayor precio</option>
          <option <?if($ordenar==3) echo "SELECTED"?> value="<?echo $redu?>3">Menor precio</option>
          <option <?if($ordenar==1) echo "SELECTED"?> value="<?echo $redu?>1">Nombre (A-Z)</option>
          <option <?if($ordenar==6) echo "SELECTED"?> value="<?echo $redu?>6">Ordenar de referencia de Z-A</option>
          <option <?if($ordenar==5) echo "SELECTED"?> value="<?echo $redu?>5">Referencia (A-Z)</option>
        </select>
  </div>

</section>

<?}else{?>

    <section class="slc_categorias">

      <h2><img src="images/buscador.png">BUSQUEDA RAPIDA
      </h2>
      <div>
        <img src="images/ico.png"><a href="<?echo $pagina?>?idrelacion=<?echo $idrelacion?>">Ver todos</a>

              <select name=idcriterio onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
              <?if($rutaAmiga>1){
              $redu="ecommerce.subcategorias.php?idrelacion=".$_REQUEST['idrelacion']."&orderby=".$ordenar."&idcriterio=";
              }else{
              $redu=$rutalocal.$_REQUEST['dsnombre']."&orderby=".$ordenar."&idcriterio=";
              }
              ?>
              <option value="">ENCUENTRA LO QUE QUIERAS</option>
              <?combo_criterios($idrelacion,$redu,$idcriterio)?>
              </select>
              <select name=idcriterio onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
              <?if($rutaAmiga>1){
              $redu=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&orderby=".$ordenar."&idcriterio=".$idcriterio."&idcriterio1=";
              }else{
              $redu=$rutalocal.$_REQUEST['dsnombre']."&orderby=".$ordenar."&idcriterio=".$idcriterio."&idcriterio1=";
              }
              ?>
              <option value="">ENCUENTRA LO QUE QUIERAS</option>
              <?combo_criterios($idrelacion,$redu,$idcriterio1)?>
              </select>

              <?if($idcriteriox<>""){?>
              <select name=idcriterio onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
              <?if($rutaAmiga>1){
              $redux=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=".$ordenar."&idmarca=";
              }else{
              $redux=$rutalocal.$_REQUEST['dsnombre']."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=".$ordenar."&idmarca=";
              }
              ?>
              <option value="">ENCUENTRA LO QUE QUIERAS</option>
              <?combo_criterios_marcas($idrelacion,$redux,$idcriteriox,$idmarca);?>
              </select>
              <select name=idatributo onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
              <?if($rutaAmiga>1){
              $redux2=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=".$ordenar."&idmarca=".$idmarca."&idatributo=";
              }else{
              $redux2=$rutalocal.$_REQUEST['dsnombre']."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=".$ordenar."&idmarca=".$idmarca."&idatributo=";
              }
              ?>
              <option value="">ENCUENTRA LO QUE QUIERAS</option>
              <?
              combo_atributos($idrelacion,$redux2,$idcriteriox,$idmarca,$idatributo);
                      ?>
              </select>
              <?}?>

        </div>
  </section>

  <ul class="slc2">
    <li><p># de productos: <?echo $resultcount->RecordCount()?></p></li>
    <li>
        <select name=ordenar onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">

         <?if($rutaAmiga>1){
         $redu=$pagina."?idrelacion=".$_REQUEST['idrelacion']."&idmarca=".$idmarca."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=";
         }else{
          $redu=$rutalocal.$_REQUEST['dsnombre']."&idmarca=".$idmarca."&idcriterio1=".$idcriterio1."&idcriterio=".$idcriterio."&orderby=";

         }
          ?>
          <option> Ordenar por </option>
          <!--option <?if($ordenar==7) echo "SELECTED"?> value="<?echo $redu?>7">Más vendidos</option-->
          <option <?if($ordenar==2) echo "SELECTED"?> value="<?echo $redu?>2">Ordenar de Z-A</option>>
          <option <?if($ordenar==4) echo "SELECTED"?> value="<?echo $redu?>4">Mayor precio</option>
          <option <?if($ordenar==3) echo "SELECTED"?> value="<?echo $redu?>3">Menor precio</option>
          <option <?if($ordenar==1) echo "SELECTED"?> value="<?echo $redu?>1">Nombre (A-Z)</option>
          <option <?if($ordenar==6) echo "SELECTED"?> value="<?echo $redu?>6">Ordenar de referencia de Z-A</option>
          <option <?if($ordenar==5) echo "SELECTED"?> value="<?echo $redu?>5">Referencia (A-Z)</option>
        </select>
      </li>
  </ul>

<?}?>
<ul>

		<?/*
       $maxregistros=12;
      include("../incluidos_modulos/paginar.variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      */
        $result=$db->Execute($sql);
      if(!$result->EOF){
			?>
			<?
	        $contar=0;
            /*while (!$result->EOF && ($contar<$maxregistros)) {*/
              while (!$result->EOF) {
            $id=reemplazar($result->fields[0]);
            $dsm=($result->fields[1]);
            $dsm=str_replace('&sup2;',"<sup>2</sup>",$dsm);
            $dsd=elliStr(($result->fields[7]),70);
            //$dsm=utf8_decode($dsm);
            //$dsm=htmlspecialchars_decode($dsm);
            //$dsm=html_entity_decode($dsm);
            $dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id,1);
            if ($_SESSION['i_idcliente']<>"") $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);
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
        $precio2=0;
        $dsreferencia=($result->fields[18]);
            $dsruta=$result->fields[2];
           $dsrutax=$rutalocal."/producto/".$dsruta;

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


                      $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);
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
                        //echo "<br>".$sqldes."<br>--productos";
                        $result_des=$db->Execute($sqldes);
                        $promodescuento=0;
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
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tblsubcategoriaxtblproducto',$id,1)."'";
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
                      //echo $dsporiva;
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

			<?if($dsrutamiga==2) $validar='is_file($rutaImagen.$dsimg1) && $dsimg1<>"" ' ;
        if($dsrutamiga==1) $validar=' $dsimg1<>"" ';
        if (is_file($rutaImagen.$dsimg1)){?>
				<a href="<? echo $dsrutax?>">
          <img src="<? echo $rutaImagen.$dsimg1?>" alt="">
        </a>
      <?}else{?>
         <a href="<? echo $dsrutax ?>"><img src="../images/img_sin.png" alt=""></a>
      <?}?>
      <section class="info_prod">

      <a href="<? echo $dsrutax?>">
      <p class="precio1"><? if($preciomostrar==0){ ?><p class="nodisponible"></p><? }else{ ?>$ <? echo number_format($preciomostrar+$precio2+$valorseguro+$iva,0) ?><? } ?></p>
      <? if ($preciodescuento>0) {?><p class="precio2">$ <? echo number_format($precio1+($precio1*($dsporiva/100))) ?></p><? } ?>
        <h2><? echo $dsm?></h2>
        <!--h3>ref: <? //echo $dsreferencia?></h3-->
      </a> 


      <!--<p><? //echo $dsd?></p>-->
      <? //echo $precio1."  precio 2 ".$precio2." seguro ".$valorseguro." ivas ".$iva ?>
      <!--article class="p_inter"><p>IMPORTADO</p></article-->

      </section>

      <?if ($idnat == 2) {?>

			<? } ?>
		</li>
        <?
        $contar++;

        $result->MoveNext();
        }
		?>
  </ul>

<?/*
// fin armazon de productos
        if($rutaAmiga>1){
        $pagina=$rutbase."/".$pagina;
        $rutaPaginacion="idrelacion=".$idrelacion."&idcriterio=".$idcriterio."&idcriterio1=".$idcriterio1."&orderby=".$ordenar;
        }else{
        $rutaPaginacion=$_REQUEST['dsnombre']."&idcriterio=".$idcriterio."&orderby=".$ordenar;
        $pagina=$rutalocal."/categorias/";
        }
        include("incluidos_modulos/index.paginar.php");?>
*/
  }else{?>

<!--article class="img_marca">
<h1>No Se encontraron Registros</h1>
</article-->


<?
      }
        $result->Close();

?>
</article>

<?}?>
