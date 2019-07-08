<h1><? echo reemplazar($dstituloPagina);?>123</h1>
<?
  $dsnombre=$_REQUEST["dsnombre"];
   $id=$_REQUEST["id"];

  $sql="select a.dsimg,a.dsimg2,a.dsm,a.dsdp,b.dsm from tblpaginaxgaleria a, tblpaginagaleria b where a.idgaleria=b.id ";
  if($dsnombre<>"")$sql.="and b.dsruta='$dsnombre' ";
  if($id<>"")$sql.="and b.id=$id";
  //echo $sql;
  $maxregistros=4;
      $limitemostra=5;
      include($rut."incluidos_sitio/paginar_variables.php");
  $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
  if(!$result->EOF){
    $titulogaleria=$result->fields[4];
  ?>

<br>
<h2><? echo reemplazar($titulogaleria);?></h2>
<article class="bloques_galeria">
<? while(!$result->EOF){
    $dsm=reemplazar($result->fields[2]);

    $dsimg=$result->fields[0];
    $dsimg2=$result->fields[1];
    $dsvideo=$result->fields[3];
?>

 <? if ($dsvideo<>""){?>

  <h3><? echo $dsm;?></h3>
 <div><? echo $dsvideo;?></div>
 <?}?>

<? if($dsimg2<>""){?>
    <article class="galeria_vertical">
        <a class="customlightbox" href="<?echo $rutalocalimag?>/contenidos/images/paginaxgaleria/<? echo $dsimg2;?>" rel="group2">
          <img src="<?echo $rutalocalimag?>/contenidos/images/paginaxgaleria/<? echo $dsimg;?>">
        </a>
        <h3><? echo $dsm;?></h3>
    </article>

<?}?>

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


