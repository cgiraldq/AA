<article class="cont_txt">
   <h1><? echo $dstituloPagina?></h1>

<?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblexperiencia a  ";

     $maxregistros=6;
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
          $dsrutax=$rutalocal."/tv_experiencia/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="experiencia.detalle.php?id=".$id;


         ?>

        <article class="productos_vertical">
          <a href="<? echo $dsrutax;?>">
           <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/experiencia/<? echo $dsimg;?>" alt=""></a>
      <?}?>
            <a href="<? echo $dsrutax;?>"class="ver_mas"><h2><? echo $dsm;?></h2></a>
          </a>
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


