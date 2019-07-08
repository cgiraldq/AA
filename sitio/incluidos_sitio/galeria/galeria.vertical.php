<article class="cont_txt">
   <h1><? echo reemplazar($dstituloPagina);?>123</h1>
<?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from tblpaginagaleria a  ";

      $maxregistros=9;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
?>

  <article class="bloques_galeria">
 <? while(!$result->EOF){

    $id=$result->fields[0];
    $dsm=reemplazar($result->fields[1]);
    $dsd=reemplazar($result->fields[2]);
    $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
    $dsimg=$result->fields[3];

    $dsruta=$result->fields[4];
    $dsrutax=$rutalocal."/tv_galerias/".$dsruta;
    if ($rutaAmiga>1) $dsrutax="galeria.detalle.php?id=".$id;


   ?>

    <article class="galeria_vertical">
      <a href="<? echo $dsrutax;?>">
        <? if ($dsimg<>""){?>
          <img src="<?echo $rutalocalimag?>/contenidos/images/paginagaleria/<? echo $dsimg;?>">
        <?}?>
        <h1><? echo $dsm;?></h1>
      </a>
    </article>
 <?
  $result->Movenext();
  }
?>

  </article>
<?
    if($totalregistros>$maxregistros){

        $rutaPaginacion=$pagina."?";
         include("incluidos_sitio/paginador/paginador.php");
      }
     }
      $result->Close();

    ?>

</article>
