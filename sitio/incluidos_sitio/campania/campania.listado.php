
<article class="cont_txt">

      <h1><? echo $dstituloPagina?></h1>
      <article class="bloque_texto">
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
    <article class="bloque_texto">
         <?while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];
           $dsruta=$result->fields[4];
          $dsfecha=$result->fields[5];

          $dsrutax=$rutalocal."/mis_campanias/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutalocal?id=".$id;

         ?>


         <article class="bloque_campania">

          <? if($dsimg<>""){?>
           <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/noticias/<? echo $dsimg;?>"></a>
          <?}?>
           <a href="<? echo $dsrutax;?>"class="ver_mas"><h3><? echo $dsm;?></h3></a>

          

          <!--p class="fecha">Fecha: <? echo $dsfecha;?></p-->

          <!--p><? //echo $dsd;?></p-->
          <!--a href="<? //echo $dsrutax;?>"class="ver_mas"><p>ver más</p></a-->
         
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
            if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>

    </article>
</article>
