<article class="cont_txt">
<h1><? echo reemplazar($dstituloPagina);?></h1>

  <? include("incluidos_sitio/hacemos/hacemos.menu.php");?>

    <article class="bloque_texto">
<?
  $dsnombre=$_REQUEST['dsnombre'];
  $sql="select dsm,dsd,dsimg,dsvideo from $dstabla where";

  if($dsnombre<>"") {$sql.=" idactivo not in(2,9)";}else {$sql.=" idactivo=1";}
 if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
  $sql.=" order by idpos;";
  //echo $sql;
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
    $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
?>
     <article class="bloque_horizontal">
         <? if ($dsimg<>""){?>
            <a href="<? echo $dsrutax;?>"class="ver_mas">
              <img src="<? echo $rutalocalimag;?>/contenidos/images/hacemos/<? echo $dsimg;?>" alt="">
             </a>
        <?}?>
          <? echo $dsvideo?>
          <h2><? echo $dsm;?></h2>
          <p><? echo $dsd;?></p>

          <div class="barra"></div>

    </article>
<?
$result->MOveNext();
}
}
$result->Close();
?>

</article>

</article>