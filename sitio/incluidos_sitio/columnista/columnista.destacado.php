
  <h1><? echo $dstituloPagina?></h1>
<article class="bloque_texto">

    <article class="bloque_horizontal">

          <?
          $sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg2,a.dsruta from tblnoticias a where a.idactivo=4 order by idpos asc";
          $result=$db->Execute($sql);
          if(!$result->EOF){

          $idm=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

          $dsvideo=$result->fields[3];
          $dsimg=$result->fields[4];
          $dsruta=$result->fields[5];
          $dsrutax=$rutalocal."/tv_novedades/".$dsruta;
          if ($rutaAmiga>1) $dsrutax="novedades.detalle.php?id=".$idm;

          ?>
      <iframe width="560" height="200" src="//www.youtube.com/embed/0ik8myx6ISw?rel=0" frameborder="0" allowfullscreen></iframe>
      <a href="<? echo $dsrutax;?>"><h2>TESTIMONIOS</h2></a>
      <p><? echo $dsd;?></p>
      <a href="<? echo $dsrutax;?>" class="ver_mas"><p>ver más</p></a>




    <?

  }
  $result->Close();

  ?>
        </article>
</article>