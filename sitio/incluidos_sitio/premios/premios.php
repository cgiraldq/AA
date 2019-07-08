
<article class="cont_txt">

      <h1><? echo $dstituloPagina?></h1>
      <article class="bloque_texto">
    <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta,dsfecha from tblpremios a  ";

     $maxregistros=4;
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
          $dsfecha=$result->fields[5];

         ?>


         <article class="bloque_horizontal">
          <? if($dsimg<>""){?>
          <img src="<?echo $rutalocalimag?>/contenidos/images/premios/<? echo $dsimg;?>">
          <?}?>

          <h2><? echo $dsm;?></h2>

          <!--p class="fecha">Fecha: <? echo $dsfecha;?></p-->

          <p><? echo $dsd;?></p>
          <div class="barra"></div>
        </article>

        <?
          $result->Movenext();
          }
        ?>

    </article>
    <?
   if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?";
            $enlace=$rutaPaginacion."page=";
            $rutaPaginador=$rutaPaginacion."page=";
            $total=$totalregistros;
            $por_pagina=$maxregistros;
            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>

    </article>
</article>
