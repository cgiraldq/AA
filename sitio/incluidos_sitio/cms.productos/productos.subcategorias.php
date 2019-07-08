<article class="cont_txt">
   <h1><? echo reemplazar($dstituloPagina);?></h1>
   <article class="bloque_texto">

   <p><? echo reemplazar($dsd2Pagina);?></p>


   <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblsubcategoriasxcategoria a where idactivo=1  ";
      //echo $sql;
      $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
    ?>
  <article class="bloques_productos">
       <? while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];

          $dsruta=$result->fields[4];
          $dsrutax=$rutalocal."/mis_productos/subcategoria/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="cms.productos.php?id=".$id;


         ?>
    <article class="productos_vertical">

      <a href="<? echo $dsrutax;?>">

      <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"><img src="<?echo $rutalocalimag?>/contenidos/images/producto/<? echo $dsimg;?>" alt=""></a>
      <?}?>
        <a href="<? echo $dsrutax;?>"><h2><?echo $dsm;?></h2></a>
      </a>
      <p><? echo ellistr($dsd,150);?></p>
    </article>
    <?
          $result->Movenext();
          }
        ?>

  </article>

 <?
   if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";

            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>

      <? include("incluidos_sitio/cms.productos/productos.destacado.php");?>
    </article>
</article>


