
<div class="ecommerce_categorias_lateral">

	<div class="titulo_aside">
	<h2>Catálogo</h2>
	</div>

	<?
  $sql="select a.id,a.dsalias,a.dsruta from ecommerce_tblcategoria a ";
  $sql.=" where a.idactivo in (1) ";
  $sql.=" order by dsm asc ";
    $resultx=$db->Execute($sql);
  if(!$resultx->EOF){?>

	<ul>

	<?while (!$resultx->EOF) {
	    $idm=$resultx->fields[0];
	    $idmx=$idm;
	    $dsm=reemplazar($resultx->fields[1]);
	    $dsruta=$resultx->fields[2];
	    $dsrutax=$rutalocal."/categorias/".$dsruta;
	      if ($rutaAmiga>1) $dsrutax="ecommerce.subcategorias.php?idrelacion=".$idm;
	      $contar1=contar('ecommerce_tbltblproductoxcategoria',$idm);
	      $contar2=contar('ecommerce_tblcategoriaxsubcategoria',$idm);

	       //$db->debug=false;

	      ?>
	<?if($contar1>0 || $contar2>0){?>

		<li>

			<a href="<? echo $dsrutax ?>"><p><? echo reemplazar($dsm)?></p></a>

			<?// listar categorias de la tienda
			  $sqld="select b.id,b.dsalias,b.dsruta from ";
			  $sqld.="  ecommerce_tblsubcategoriasxcategoria b ,ecommerce_tblcategoriaxsubcategoria c ";
			  $sqld.=" where  c.iddestino=".$idm." and b.id=c.idorigen and b.idactivo not in (2,9) order by b.dsm asc ";
			  $resultd=$db->Execute($sqld);
			  if(!$resultd->EOF){
			  ?>

			<ul>
				 <?  while (!$resultd->EOF) {
			      $idm=$resultd->fields[0];
			      $dsms=reemplazar($resultd->fields[1]);
			      $dsrutax=$resultd->fields[2];
			      $dsrutasub=$rutalocal."/subcategorias/".$dsruta."/".$dsrutax;
			        if ($rutaAmiga>1) $dsrutasub="ecommerce.productos.php?idrelacion=".$idm."&dscategoria=".$idmx;
			        //$db->debug=true;
			        $contarx=contarx('ecommerce_tblsubcategoriaxtblproducto','ecommerce_tblproductos',$idm);
			      //$db->debug=false;
			      ?>
			      <?if($contarx>0){?>

				<li><a href="<? echo $dsrutasub?>"><p><? echo $dsms ?></p></a></li>


				   <?}
			      $resultd->MoveNext();
			      } // fin while*/
			      ?>
			</ul>
		</li>

		 <?  }
        $resultd->Close();
      }?>

      <?
      $resultx->MoveNext();
        } // fin while*/
      ?>
	</ul>

	      <?
// fin listar lkas categorias de la tienda
      }
      $resultx->Close();?>



      </li>

</div>
