<h1><? echo reemplazar($dstituloPagina);?></h1>

  <?include("incluidos_sitio/sac/sac.menu.php");?>

<article class="cont_txt">

   <article class="bloque_texto">
<?
  $id=$_REQUEST["id"];
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select dsm,dsd,dsimg,dsvideo from tblqsomos where idactivo not in(2,9)  ";
  if($id<>"") $sql.=" and id=$id";
  if($dsnombre<>"") $sql.=" and dsruta='$dsnombre'";
  //echo $sql;

  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
?>

    <article class="bloque_horizontal">

         <? if ($dsimg<>""){?>
            <a href="<? echo $dsrutax;?>"class="ver_mas">
              <img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg;?>" alt="">
           </a>
        <?}?>


          <h2><? echo $dsm;?></h2>
           <? echo $dsvideo?>
          <p><? echo $dsd;?> </p>

          <div class="barra"></div>

    </article>


    <? //include("incluidos_sitio/qsomos/otro.qsomos.php");?>

<?
$result->MOveNext();
}
}
$result->Close();
?>

    </article>

</article>

