<h1><? echo $dstituloPagina?></h1>

       <?include("incluidos_sitio/tips/tips.destacada.php");?>

    <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta,a.dsd2 from tbltips2 a where idactivo not in(2,9,3) order by idpos desc ";

//echo $sql;
      //$db->debug=true;
     $maxregistros=5;
      $limitemostra=1;
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
          $dsd2=$result->fields[5];

          //$dsrutax=$rutalocal."/mis_noticias/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="noticias.detalle.php?id=".$id;

         ?>

  <li>
  <? if($dsimg<>""){?>
  <?if($dsd2<>""){?>
  <a href="<? echo $dsrutax;?>"class="ver_mas">
  <?}?>
  <img src="../../contenidos/images/tips/<? echo $dsimg;?>">
  <?if($dsd2<>""){?>
  </a>
    <?}?>
  <?}?>

  <article class="info_noticia">
      <?if($dsd2<>""){?>
  <a href="<? echo $dsrutax;?>"class="ver_mas">
      <?}?>
  <h2><? echo $dsm;?></h2>
     <?if($dsd2<>""){?>
  </a>
    <?}?>
  <!--p class="fecha">Fecha: <? echo $dsfecha;?></p-->
  <p><? echo $dsd?></p>

  <?if($dsd2<>""){?>
  <a href="<? echo $dsrutax?>" class="more" title="ver m&aacute;s">ver +</a>
  <?}?>
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