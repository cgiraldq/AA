<h1><? echo reemplazar($dstituloPagina);?></h1>
<? include("enlaces.php");?>
<?include("incluidos_sitio/fundacion/fundacion.menu.php");?>

<?
  $sql="select dsm,dsd,dsimg,dsvideo from $dstabla where idactivo=1 order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
?>


         <? if ($dsimg<>""){?>
          <a href="<? echo $dsrutax;?>">
            <img src="<? echo $rutalocalimag;?>/contenidos/images/fundacion/<? echo $dsimg;?>" alt="">
           </a>
        <?}?>
          <? echo $dsvideo?>
          <a href="<? echo $dsrutax;?>"><h2><? echo $dsm;?></h2></a>
          <p><? echo $dsd;?></p>

<?
$result->MOveNext();
}
}
$result->Close();
?>