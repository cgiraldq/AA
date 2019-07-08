<h1><? echo $dstituloPagina?></h1>

       <?include("incluidos_sitio/noticias/noticia.destacada.php");?>

    <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from $dstabla a where idactivo not in(2,9) ";

//echo $sql;
     $maxregistros=5;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
    ?>

    <article class="bloque_horizontal">






      <ul class="noticias_lista">

         <?while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];
           $dsruta=$result->fields[4];
          $dsfecha=$result->fields[5];

          $dsrutax=$rutalocal."/mis_noticias/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutalocal/noticia.detalle.php?id=".$id;

         ?>

         <li>
          <? if($dsimg<>""){?>
           <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/noticias/<? echo $dsimg;?>"></a>
          <?}?>

          <article class="info_noticia">
           <a href="<? echo $dsrutax;?>"class="ver_mas"><h2><? echo $dsm;?></h2></a>

          <!--p class="fecha">Fecha: <? echo $dsfecha;?></p-->
          <p><? echo ellistr($dsd, 100); ?></p>
          <a href="<? echo $dsrutax?>" class="more" title="ver m&aacute;s">ver +</a>
        </article>
        </li>

        <?
          $result->Movenext();
          }
        ?>

      </ul>
    </article>

    <?
    if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
            if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>

     <?//include("incluidos_sitio/ecommerce/productos/productos.recomendados.php");?>