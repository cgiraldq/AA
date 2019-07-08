      <?
      $rutaImagen="../contenidos/images/ecommerce_productos/";
      $sql="select a.id,a.dsm,a.dsruta,a.dsimgcarrito,a.precio1,a.iva,a.descuento,a.dsruta";
      $sql.=" from ecommerce_tblproductos a";
      $sql.=" where a.idactivo not in (2,9) and idmasvendido=1 and ($fechaBaseNum between a.idfechainicial and a.idfechafinal)";
      $sql.="  order by dsm desc ";
      $result=$db->Execute($sql);
      if(!$result->EOF){
      ?>
      <article class="cont_pro_mas_vendidos">
	    <h2>Productos m&aacute;s vendidos</h2>
  	  <article id="pro_mas_vendidos">
		  <?
            $i=0;
            while(!$result->EOF){
            $i++;
            $id=reemplazar($result->fields[0]);
            $dsm=elliStr(reemplazar($result->fields[1]),70);
            //$dsimg1=($result->fields[3]);
            $dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$id,1);
            $precio1=($result->fields[4]);
            $iva=($result->fields[5]);
            $idprecio1=$precio1+$precio1*($iva/100);
            $dspordescuento=($result->fields[6]);
            $idprecio2=$precio1-$precio1*($dspordescuento/100); // valor descuento
            $idprecio2=$idprecio2+$idprecio2*($iva/100);
            $dsruta=$result->fields[7];
            $dsrutax=$rutalocal."/producto/";
            $dsrutax.=$dsruta;
            if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
            if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$id."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
  		?>
			<article class="pro_mas_vendidos">
          <? if ($dsimg1<>""){?>
				<a href="<? echo $dsrutax?>">
						<img src="<? echo $rutaImagen.$dsimg1;?>" alt="<? echo $dsm?>">
          <? }?>
				</a>
        <a href="<? echo $dsrutax?>">
          <h3><strong><?echo $i?>.</strong> <? echo $dsm?></h3>
        </a>
			</article>

		<?
         $result->MoveNext();
        }

		?>
	</article>
	<article class="clearfix"></article>
	<a id="next_pro_mas_vendidos" class="next" href="#"><img src="<?echo $rutbase?>/images/up.png" alt=""></a>
	<a id="prev_pro_mas_vendidos" class="prev" href="#"><img src="<?echo $rutbase?>/images/down.png" alt=""></a>
	<br class="clear:both;">
</article>

 <?

}
  $result->Close();
 ?>
