<?
$search=$_REQUEST['search'];
if ($search=="") $search=$_REQUEST['dsbusqueda'];
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/productos/";

?>

<article class="cont_noticas_centro_vertical">


		<?
    if ($idrelacion<>"") {
        $sql=" select dsm from tblsubcategoriasxcategoria where id=$idrelacion";

         $resultx = $db->Execute($sql);
         if (!$resultx->EOF) {
            $dssubcategoria=$resultx->fields[0];
           }
        $resultx->Close();
 }

		// armazon de productos
			$sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.iva,a.preciodescuento,a.dsd,a.idactivo,a.idnat,a.preciocompra,a.precio2,a.preciodistribuidor,a.dsunidadesdispo";
            $sql.=" from tblproductos a";
            if ($idrelacion<>"") $sql.=" inner join tblsubcategoriaxtblproducto b on ( b.idorigen=a.id or b.dsref=a.dsreferencia) ";

            $sql.=" where a.id >0  and a.idtipoprod=1 and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
            if ($idactivox<>"") {
                $sql.=" and a.idactivo in ($idactivox) ";

            } else {
              $sql.=" and a.idactivo not in (9,2,5) ";
            }
            if ($idrelacion<>"") $sql.="  and (b.iddestino=".$idrelacion." or (b.dscategoria='".$dssubcategoria."'))";

            if ($search<>"") {
                $search=trim($search);
                $sql.=" and (";
                   $sql.=" a.dsm like '%".($search)."%'";
                   $sql.=" or a.dsd like '%".($search)."%'";
                   $sql.=" or a.dsd2 like '%".($search)."%'";
                   $sql.=" or a.dsmarca like '%".($search)."%'";
                   $sql.=" or a.dsreferencia like '%".($search)."%'";

                $sql.=" )" ;
            }

            $sql.=" order by a.id desc ";
            $rutaPaginacion="idrelacion=".$idrelacion."&search=".$search;
		    	  //echo $sql;
            //$db->debug=true;
            $maxregistros=12;
            include("incluidos_modulos/paginar.variables.php");
            $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
			?>
			<?
	        $contar=0;
            while (!$result->EOF && ($contar<$maxregistros)) {
            $id=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            $dsd=elliStr(reemplazar($result->fields[7]),70);
            $dsimg1=($result->fields[3]);
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
            $precio2=($result->fields[11]);
            $dsruta=$result->fields[2];
    	     $dsrutax=$rutalocal."/producto/".$dsruta;
  		
      	if ($rutaAmiga>1) $dsrutax="productos.detalle.php?idrelacion=".$id;
        if ($dsruta=="") $dsrutax=$rutbase."productos.detalle.php?idrelacion=".$id;

            if ($precio2<0) $precio2=0;
                                  $valorseguro=0;
                     if ($idnat<>1) {

                    $valorseguro=($preciobase)-($valorbasesinseguro);
                    $valorseguro=($valorseguro)*$porvalorseguro;
            		if ($valorseguro<0) $valorseguro=0;
                     }

            $iva=($preciobase*($ivax/100));

            // constructor de mostrar porcentaje
           $precio1m=$precio1/(1-($ivax/100));
          	$preciodescuentom=$preciodescuento/(1-($ivax/100));
          if($pordescuentom<>0)	 $pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;
            // fin constructor de mostrar porcentaje

            ?>

		  <article class="productos">
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

			<? if ($dsimg1<>""){?>
				<a href="<? echo $dsrutax?>">
					<img src="<? echo $rutaImagen.$dsimg1?>" alt="">
				</a>
			<?}?>
			<section class="info_prod">

			<h3><? echo $dsm?></h3>
      <p><? //echo $dsd?></p>
      <p class="precio1"><? if($preciomostrar==0){ ?><p class="nodisponible">Producto no disponible</p><? }else{ ?>$ <? echo number_format($preciomostrar+$precio2+$valorseguro+$iva,0) ?><? } ?></p>
      <? if ($preciodescuento>0) {?><p class="precio2">$ <? echo number_format($precio1+$precio2+$valorseguro+$iva,0) ?></p><? } ?>
			<a href="<? echo $dsruta?>" class="more" title="ver m&aacute;s"></a>
				<article class="btncomprar">
				<a href="<? echo $dsrutax?>">VER DETALLE</a>
				</article>
			</section>

			<?if ($idnat == 2) {?>

			<article class="p_inter"><p>IMPORTADO</p></article>
			<? } ?>
		</article>
        <?
        $contar++;

        $result->MoveNext();
        }
		?>

<?
// fin armazon de productos
        $rutapaginador=$rutaInclude."ecommerce.subcategoria.php";
        include("incluidos_modulos/index.paginar.php");
      }
        $result->Close();

?>
</article>


