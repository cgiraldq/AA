<?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from tblpaginagaleria a ORDER BY a.dsm asc ";

       $maxregistros=6;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
?>
<article class="cont_txt">
   <h1><? echo reemplazar($dstituloPagina);?></h1>


  <article class="bloques_galeria">
 <? while(!$result->EOF){

    $id=$result->fields[0];
    $dsm=reemplazar($result->fields[1]);
    $dsd=reemplazar($result->fields[2]);
    $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
    $dsimg=$result->fields[3];

    $dsruta=$result->fields[4];
    $dsrutax=$rutalocal."/mis_galerias/".$dsruta;
    if ($rutaAmiga>1) $dsrutax="galeria.detalle.php?id=".$id;


   ?>

    <article class="categoria_galeria">
      <a href="<? echo $dsrutax;?>">
        <? if($dsimg<>"") {?><img src="<?echo $rutalocalimag?>/contenidos/images/paginagaleria/<? echo $dsimg;?>"><?}?>
        <h1><? echo $dsm;?></h1>
        <!--h4>12 Fotos</h4 -->
      </a>
    </article>

<?
  $result->Movenext();
  }
?>



  </article>


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