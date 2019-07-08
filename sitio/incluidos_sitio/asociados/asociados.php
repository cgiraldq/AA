<h1><? echo reemplazar($dstituloPagina);?></h1>

<? //include("enlaces.php");?>

<?include("incluidos_sitio/asociados/asociados.menu.php");?>

<?
  $sql="select dsm,dsd,dsimg,dsvideo from $dstabla where idactivo='1' order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];


   $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsvideo=$result->fields[3];
?>
    <article class="cont_asociados">


          <? echo $dsvideo?>
          <h2><? echo $dsm;?></h2>

            <? if ($dsimg<>""){?>
        <!--a href="<? echo $dsrutax;?>"class="ver_mas"-->
          <img src="<? echo $rutalocalimag;?>/contenidos/images/asociados/<? echo $dsimg;?>" alt="">
         <!--/a-->
      <?}?>

          <p><? echo $dsd;?></p>

          <div class="barra"></div>





    </article>
<?
$result->MOveNext();
}
}
$result->Close();
?>
