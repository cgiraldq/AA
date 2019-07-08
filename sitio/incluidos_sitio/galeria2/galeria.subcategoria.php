<h1><? echo reemplazar($dstituloPagina);?></h1>
<?
  $dsnombre=$_REQUEST["dsnombre"];
   $id=$_REQUEST["id"];

  $sql="select a.dsimg,a.dsimg2,a.dsm,a.dsdp,b.dsm,a.id,a.dsruta from tblpaginaxgaleria2 a, tblgaleria2 b where a.idgaleria=b.id and a.idactivo not in(2,9) ";
  if($dsnombre<>"")$sql.="and b.dsruta='$dsnombre' ";
  if($id<>"")$sql.="and b.id=$id";
  //echo $sql;
  $maxregistros=9;
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
        $id=$result->fields[5];


     $dsruta=$result->fields[6];
    $dsrutax=$rutalocal."/mis_galerias/".$dsruta;
    if ($rutaAmiga>1)$dsrutax="/galeria2.detalle.php?id=".$id;

?>

 <? if ($dsvideo<>""){?>
 <div>
    <h3><? echo $dsm;?></h3>
    <? echo $dsvideo;?>
</div>
 <?}?>

<? if($dsimg2<>""){?>
    <article class="galeria_vertical">

              <a  href="<? echo $dsrutax;?>" rel="group2">
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


