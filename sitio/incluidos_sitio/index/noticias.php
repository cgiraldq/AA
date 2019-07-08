

	<h1>Noticias</h1>

          <?
          $sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg,a.dsruta from tblnoticias a where a.idactivo=3 order by idpos asc";
          $result=$db->Execute($sql);
          if(!$result->EOF){
             while(!$result->EOF){

                $idm=$result->fields[0];
                $dsm=reemplazar($result->fields[1]);
                $dsd=reemplazar($result->fields[2]);
                $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));

                $dsvideo=$result->fields[3];
                $dsimg=$result->fields[4];
                $dsruta=$result->fields[5];
                $dsrutax=$rutalocal."/mis_noticias/".$dsruta;
                if ($rutaAmiga>1) $dsrutax="noticia.detalle.php?id=".$idm;
          ?>

    <article class="bloque_index">


      <? $dsrutaImagen=$rutalocalimag."contenidos/images/noticias/";
      //echo $dsrutaImagen.$dsimg;
          if(!is_file($dsrutaImagen.$dsimg)){?>
      <a href="<? echo $dsrutax;?>">
        <img src="<? echo $rutalocalimag;?>/contenidos/images/noticias/<? echo $dsimg; ?>">
      </a>
       <a href="<? echo $dsrutax;?>"><h2><? echo $dsm;?></h2></a>
      <?}?>
			<p><? echo elliStr($dsd,200);?></p>

		</article>


			<?
      $result->MoveNext();
    }


			}
			$result->Close();
			?>

      <article class="bloque_index2">

            <a href="<? echo $dsrutax;?>">
                <img src="images/img_index.jpg">
            </a>
            <a href="<? echo $dsrutax;?>">
              <h2>NOTICIA DESTACADA 2</h2>
            </a>

      <p>
        Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.
      </p>
      </article>
