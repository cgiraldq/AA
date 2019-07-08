<?if($id<>""){?>
    <?
          //$db->debug=true;
            $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsimg2 from tblgaleriatips a where a.idactivo=1 and idevento=".$id;
            //echo $sql;
            $result=$db->Execute($sql);
            if(!$result->EOF){?>
<article class="carrusel_imagenes">
  <article id="carrusel_imagenes">

      <?
                while(!$result->EOF){
                 $dsimg=$result->fields[3];
                 $dsimg2=$result->fields[4];
                 $dsruta=$result->fields[2];
                 if($dsimg=="")$dsimg=$dsimg2;
                 if($dsim2=="")$dsim2=$dsimg;
                 if($dsimg2<>""){
          ?>
            <article class="item_img">
              <a href="/contenidos/images/galeria/<? echo $dsimg2;?>" class="customlightbox" rel="lightbox">
              <img src="/contenidos/images/galeria/<? echo $dsimg;?>"  class="img_carrousel" />
                </a>
            </article>
         <?
       }
            $result->MoveNext();
                 } // fin while
      
        ?>

  </article>
  <a id="next_carrusel_imagenes" class="next" href="#"><img src="<? echo $rutalocal;?>/images/prev2.png" alt=""></a>
  <a id="prev_carrusel_imagenes" class="prev" href="#"><img src="<? echo $rutalocal;?>/images/next2.png" alt=""></a>
</article>
<?
      }
            $result->Close();

}?>