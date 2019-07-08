  <h1><? echo reemplazar($dstituloPagina);?></h1>

  <? include("enlaces.php");?>

    <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from $dstabla a where idactivo not in(2,9) ";

//echo $sql;
     $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
    ?>

    <ul class="noticias_lista">
         <?while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];
           $dsruta=$result->fields[4];
          $dsfecha=$result->fields[5];

          $dsrutax=$rutalocal."/noticias_fundacion/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutalocal?id=".$id;

         ?>

         <li>
          <? if($dsimg<>""){?>
           <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/noticias/<? echo $dsimg;?>"></a>
          <?}?>

           <a href="<? echo $dsrutax;?>"class="ver_mas"><h2><? echo $dsm;?></h2></a>
          <!--p class="fecha">Fecha: <? echo $dsfecha;?></p-->
          <p><? echo $dsd;?></p>
        </li>



        <?
          $result->Movenext();
          }
        ?>
      </ul>

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
